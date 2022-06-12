<?php


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


/**
 * Add a block category for "Setup" if it doesn't exist already.
 *
 * @ param array $categories Array of block categories.
 *
 * @ return array
 */
add_filter( 'block_categories_all', 'setup_time_blocks_categories_fn_pull' );
function setup_time_blocks_categories_fn_pull( $categories ) {

    $category_slugs = wp_list_pluck( $categories, 'slug' );

    return in_array( 'setup', $category_slugs, TRUE ) ? $categories : array_merge(
        array(
            array(
                'slug'  => 'setup',
                'title' => __( 'Setup', 'mydomain' ),
                'icon'  => null,
            ),
        ),
        $categories
    );

}


/**
 * Register Custom Block(s)
 * 
 */
add_action( 'acf/init', 'setup_time_blocks_acf_init' );
function setup_time_blocks_acf_init() {

    $z = new SetupTimeVariables();
    $fields_func = new SetupTimeBlockGen();

    foreach( $fields_func->setup_time_block_gen_details() as $key => $value ) {
        
        $blocks[ $key ] = array(
            'name'                  => $value[ 'block' ][ 'name' ],
            'title'                 => $value[ 'block' ][ 'title' ],
            'render_template'       => $z->setup_time_dir_path().'templates/blocks/'.$value[ 'block' ][ 'template' ],
            'category'              => 'setup',
            'icon'                  => $value[ 'block' ][ 'icon' ],
            'mode'                  => 'edit',
            'keywords'              => $value[ 'block' ][ 'keywords' ],
            'supports'              => [
                'align'             => false,
                'anchor'            => true,
                'customClassName'   => true,
                'jsx'               => true,
            ],            
        );

    }

    // Bail out if function doesn’t exist or no blocks available to register.
    if ( !function_exists( 'acf_register_block_type' ) && !$blocks ) {
        return;
    }

	foreach( $blocks as $block ) {
		acf_register_block_type( $block );
	}
  
}


/**
 * Auto fill Select options | Timeline Template
 *
 */
add_filter( 'acf/load_field/name=timeline-template', 'setup_timeline_templates' );
function setup_timeline_templates( $field ) {
    
    $z = new SetupTimeVariables();

    $file_extn = 'php';

    // get all files found in VIEWS folder
    $view_dir = $z->setup_time_dir_path().'templates/views/';

    $data_from_dir = setup_pulls_view_files( $view_dir, $file_extn );

    $field['choices'] = array();

    //Loop through whatever data you are using, and assign a key/value
    if( is_array( $data_from_dir ) ) {

        foreach( $data_from_dir as $field_key => $field_value ) {
            $field['choices'][$field_key] = $field_value;
        }

        return $field;

    }
    
}


/**
 * Auto fill Checkbox options | Fields to Show
 *
 */
/*add_filter( 'acf/load_field/name=blocks-show-fields', 'acf_setup_binfo_field_choices' ); // MULTI - ENTRIES
function acf_setup_binfo_field_choices( $field ) {
    
    $z = new SetupBlocksVariables();

    $field['choices'] = array();

    $fielders = $z->setup_block_fields();
    if( is_array( $fielders ) ) :
        
        foreach( $fielders as $key => $value ) {
            $field['choices'][$key] = $value;
            //$field['disabled'] = 1;
        }

        return $field;

    endif;
    
}*/


/**
 * Auto select Checkbox options | Fields to Show
 *
 */
/*add_filter('acf/load_field/name=blocks-show-fields', 'acf_setup_binfo_field_default' );
function acf_setup_binfo_field_default( $field ) {

    $x = new SetupBlocksVariables();
    $q = '';
    foreach ($x->setup_block_default_fields() as $f ) {

        // the next 2 lines below works in adding the fields BUT ACF cannot read them
//        $q .= trim( $f ).'
//';
        
        $q .= $f;
    }

    $field['default_value'] = $q;

    return $field;

}*/


/**
 * Auto fill Checkbox options | Media Fields to Show
 *
 */
/*add_filter( 'acf/load_field/name=blocks-show-fields-media', 'acf_setup_binfo_media_field_choices' ); // MULTI - ENTRIES
function acf_setup_binfo_media_field_choices( $field ) {
    
    $z = new SetupBlocksVariables();

    $field['choices'] = array();

    $fielders = $z->setup_block_fields_media();
    if( is_array( $fielders ) ) :
        
        foreach( $fielders as $key => $value ) {
            $field['choices'][$key] = $value;
            //$field['disabled'] = 1;
        }

        return $field;

    endif;
    
}*/


/**
 * Auto select Checkbox options | Media Fields to Show
 *
 */
/*add_filter('acf/load_field/name=blocks-show-fields-media', 'acf_setup_binfo_media_field_default' );
function acf_setup_binfo_media_field_default( $field ) {

    $x = new SetupBlocksVariables();
    $q = '';
    foreach ($x->setup_block_default_fields_media() as $f ) {
        
        $q .= $f;
    }

    $field['default_value'] = $q;

    return $field;

}*/


/**
 * Auto fill Select options | IMAGE SIZES
 *
 */
/*add_filter( 'acf/load_field/name=block-image-size', 'acf_setup_blocks_img_sizes' );
function acf_setup_blocks_img_sizes( $field ) {

    $field['choices'] = array();

    foreach( get_intermediate_image_sizes() as $value ) {
        $field['choices'][$value] = $value;
    }

    return $field;

}*/


/**
 * Auto fill Select options | POST TYPE
 *
 */
add_filter( 'acf/load_field/name=timeline-post-type', 'setup_timeline_posttypes_opts' );
function setup_timeline_posttypes_opts( $field ) {

    $x = new SetupTimeVariables();

    $field['choices'] = array();

    foreach( get_post_types() as $value ) {

        if( !in_array( $value, $x->setup_timeline_not_from_these_posttypes() ) ) {

            $field['choices'][$value] = $value;

        }

    }

    return $field;

}


/**
 * Pull all files found in $directory but get rid of the dots that scandir() picks up in Linux environments
 *
 */
if( !function_exists( 'setup_pulls_view_files' ) ) {

    function setup_pulls_view_files( $directory, $file_extn ) {

        $out = array();
        
        // get all files inside the directory but remove unnecessary directories
        $ss_plug_dir = array_diff( scandir( $directory ), array( '..', '.' ) );

        foreach( $ss_plug_dir as $filename ) {
            
            if( pathinfo( $filename, PATHINFO_EXTENSION ) == $file_extn ) {
                $out[ $filename ] = pathinfo( $filename, PATHINFO_FILENAME );
            }

        }

        /*foreach ($ss_plug_dir as $value) {
            
            // combine directory and filename
            $file = basename( $directory.$value, $file_extn );
            
            // filter files to include
            if( $file ) {
                $out[ $value ] = $file;
            }

        }*/

        // Return an array of files (without the directory)
        return $out;

    }
    
}

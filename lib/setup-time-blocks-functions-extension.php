<?php


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


class SetupTimeMainExt {

    /**
     * function where templates are called
     */
    public function setup_timeline_relationships( $data ) {
        
        var_dump( $data );

        if( array_key_exists( 'time_post_type', $data ) && !empty( $data[ 'time_post_type' ] ) ) {

            global $bars;
            $bars = array(); // declare empty variable

            $out = ''; // initialize variable

            $o = new SetupTimeVariables();

            // set the arguments
            $args = array(
                'post_type'         => $data[ 'time_post_type' ],
                'post_status'       => 'publish',
                'posts_per_page'    => !empty( $data[ 'post_count' ] ) ? $data[ 'post_count' ] : 5,
                'post__not_in'      => !empty( $data[ 'not_in' ] ) ? $data[ 'not_in' ] : '',
                'orderby'           => 'date',
                'order'             => 'DESC',
            );

            // set the taxonomy | add additional filters
            /*if( $taxy == 'both' )  {

                $args[ 'tax_query' ] = array(
                    'relation'  =>  'OR',
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'term_id',
                        'terms'    => $tax_id[ 'category' ],
                    ),
                    array(
                        'taxonomy' => 'post_tag',
                        'field'    => 'term_id',
                        'terms'    => $tax_id[ 'tag' ],
                    ),
                );

            } else {

                if( $taxy == 'tag' ) {
                    $args[ 'tag__in' ] = $tax_id; // array
                } else {
                    $args[ 'category__in' ] = $tax_id; // array
                }

            }*/

            // query
            $loop = new WP_Query( $args );
            
            // loop
            if( $loop->have_posts() ):

                // get all post IDs
                while( $loop->have_posts() ): $loop->the_post();

                    if( $o->show_post_type === TRUE ) {
                        // show post type label
                        $bars[ 'show' ] = ' <span class="item label-entry fontsize-tiny">('.ucfirst( get_post_type( get_the_ID() ) ).')</span>';
                    } else {
                        // hide post type label
                        $bars[ 'show' ] = '';
                    }
                    
                    $bars[ 'id' ] = get_the_ID();

                    $out .= $this->setup_view_template( $data[ 'template' ], 'views' );
                    
                endwhile;

            endif;

            return $out;

        } else{

            return FALSE;

        }

    }


    /**
     * Get VIEW template
     */
    public function setup_view_template( $layout, $dir_ext ) {

        $o = new SetupTimeVariables();

        $layout_file = $o->setup_time_dir_path().'templates/'.$dir_ext.'/'.$layout;

        if( is_file( $layout_file ) ) {

            ob_start();

            include $layout_file;

            $new_output = ob_get_clean();

            if( !empty( $new_output ) ) {
                $output = $new_output;
            } else {
                $output = FALSE;
            }


        } else {

            $output = FALSE;

        }

        return $output;

    }

}
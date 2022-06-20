<?php

//if( function_exists('acf_add_local_field_group') ):

	/*acf_add_local_field_group(array(
		'key' => 'group_1',
		'title' => 'My Group',
		'fields' => array (),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
		),
	));*/

/*	acf_add_local_field(array(
		'key' => 'field_1',
		'label' => 'Sub Title',
		'name' => 'sub_title',
		'type' => 'text',
		'parent' => 'group_629f6afa5bd7c'
	));

endif;*/

/*
testuser
T3st_us3r-01
*/

add_action('acf/init', 'my_acf_add_local_field_groups');
function my_acf_add_local_field_groups() {
//if( function_exists('acf_add_local_field_group') ) :
	$u = new SetupTimeVariables();

	// make a list of taxonomy as option
	foreach( get_taxonomies() as $key => $value ) {

		if( !in_array( $key, $u->setup_timeline_not_from_these_taxonomies()  ) ) :
			
			//$tax_choices[ $key ] = $value;
			// filter out those that are empty
			$tax_terms = get_terms( get_taxonomy( $value )->name );
            if( count( $tax_terms ) >= 1 ) {

                /*echo '<span style="color:blue;">';
                    var_dump( get_taxonomy( $value ) );
                echo '</span>';*/
                
                for( $e=0; $e<=( count( $tax_terms ) - 1 ); $e++ ) {

                	if( isset( $tax_terms[ $e ] ) ) {
	                    //echo '<h3>'.$tax_terms[ $e ]->name.'</h3>';
	                    //echo '<h3>'.$tax_terms[ $e ]->slug.'</h3>';
	                    $tax_choices[ $tax_terms[ $e ]->slug ] = $tax_terms[ $e ]->name;
	                }

                }
                var_dump( $tax_choices );
                die;


                acf_add_local_field(

					array(

						'key' => 'field_'.uniqid(),
						'label' => get_taxonomy( $value )->label,
						'name' => 'timeline-'.get_taxonomy( $value )->name,
						'type' => 'checkbox',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => $tax_choices,
						'default_value' => false,
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
						'parent' => 'group_629f6afa5bd7c'

					)

				);

            }

		endif;

	}
	
	
	/*
	acf_add_local_field_group(array(
		'key' => 'group_629f6afa5bd7c',
		'title' => 'Timeline',
		'fields' => array(
			array(
				'key' => 'field_629fd9abc37b7',
				'label' => 'Entries',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_629f6c9f3189f',
				'label' => 'Post Type',
				'name' => 'timeline-post-type',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'post' => 'post',
					'page' => 'page',
					'pull' => 'pull',
					'video' => 'video',
				),
				'allow_custom' => 0,
				'default_value' => array(
				),
				'layout' => 'horizontal',
				'toggle' => 0,
				'return_format' => 'value',
				'save_custom' => 0,
			),
			array(
				'key' => 'field_62a59a885eec2',
				'label' => 'Taxonomy',
				'name' => 'timeline-taxonomy',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'category' => 'Category',
					'post_tag' => 'Tag',
					'link_category' => 'Link Category',
					'movie_trailer' => 'Movie Trailer',
				),
				'allow_custom' => 0,
				'default_value' => array(
				),
				'layout' => 'horizontal',
				'toggle' => 0,
				'return_format' => 'value',
				'save_custom' => 0,
			),
			array(
				'key' => 'field_62a59fdfce9e5',
				'label' => 'Tax 1',
				'name' => 'tax_1',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_62a59a885eec2',
							'operator' => '==',
							'value' => 'category',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
				),
				'allow_custom' => 0,
				'default_value' => array(
				),
				'layout' => 'vertical',
				'toggle' => 0,
				'return_format' => 'value',
				'save_custom' => 0,
			),
			array(
				'key' => 'field_62a59ff9ce9e6',
				'label' => 'Tax 2',
				'name' => 'tax_2',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_62a59a885eec2',
							'operator' => '==',
							'value' => 'post_tag',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
				),
				'allow_custom' => 0,
				'default_value' => array(
				),
				'layout' => 'vertical',
				'toggle' => 0,
				'return_format' => 'value',
				'save_custom' => 0,
			),
			array(
				'key' => 'field_62a400a35cab3',
				'label' => 'Entry Count',
				'name' => 'timeline-entry-count',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 5,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array(
				'key' => 'field_629fd9c1c37b8',
				'label' => 'Layout',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_629fd9cfc37b9',
				'label' => 'Template',
				'name' => 'timeline-template',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'h2blue.php' => 'h2blue',
					'h3orange.php' => 'h3orange',
				),
				'default_value' => false,
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'return_format' => 'value',
				'ajax' => 0,
				'placeholder' => '',
			),
			array(
				'key' => 'field_629fd9fcc37ba',
				'label' => 'Section Class',
				'name' => 'timeline-section-class',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_629fda15c37bb',
				'label' => 'Section Style',
				'name' => 'timeline-section-style',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/info-timeline',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	));
*/

//endif;
}

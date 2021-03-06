<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

//add_action('acf/init', 'my_acf_add_local_field_groups');
add_action('wp_loaded', 'setup_acf_load_field_group');
function setup_acf_load_field_group() {
	
	if( function_exists('acf_add_local_field_group') ):

		$setup_time_taxes = new SetupTimeTaxes();

		$first_half = array(

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

	    );

	    $second_half = array(
        
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

	    );

	    /**
	     * ADD ACF CUSTOM GROUP
	     */
		acf_add_local_field_group(array(
			'key' => 'group_629f6afa5bd7c',
			'title' => 'Timeline',
			'fields' => array_merge( $first_half, $setup_time_taxes->setup_time_taxes(), $second_half ),
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

	endif;

}

<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
//$poop = new SetupTimeTaxes();
class SetupTimeTaxes {

	public function setup_time_taxes() {
		
		$u = new SetupTimeVariables();
//		echo '<span style="color:green;">'; var_dump( get_taxonomies() ); echo '</span>';
		// make a list of taxonomy as option
		foreach( get_taxonomies() as $key => $value ) {

			if( !in_array( $key, $u->setup_timeline_not_from_these_taxonomies()  ) ) :

				$t_name = get_taxonomy( $value )->name;
				$tax_terms = get_terms( $t_name );
				if( count( $tax_terms ) >= 1 ) {

/*					echo '<div style="color:blue;">';
						var_dump( $t_name );
						//echo $tax_terms->taxonomy;
					echo '</div>';
*/
					// empty variable first
					$tax_choices = array();

					foreach( $tax_terms as $key => $vals ) {
//						echo $vals->slug.' | '.$vals->name.'<br />';
						$tax_choices[ $vals->slug ] = $vals->name;
					}
//					echo '<hr />';
					//var_dump( $tax_choices );
					//die;


					$tax_fields[] = array(
						'key' => 'field_'.$t_name,
						'label' => get_taxonomy( $value )->label,
						'name' => 'timeline-'.$t_name,
						'type' => 'checkbox',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_62a59a885eec2',
									'operator' => '==',
									'value' => $t_name,
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => $tax_choices,
						'allow_custom' => 0,
						'default_value' => array(
						),
						'layout' => 'horizontal',
						'toggle' => 0,
						'return_format' => 'value',
						'save_custom' => 0,
					);

				}

			endif;

		}

		return $tax_fields;

	}

	/*public function __construct() {

		add_action( 'genesis_after_header', array( $this, 'setup_time_taxes' ) );

	}*/
	
}

<?php


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class SetupTimeMain {


    /**
     * Main Function
     */
    public function setup_blocks_main( $block ) {

        $fields_func = new SetupTimeBlockGen();
        $fields_ext = new SetupTimeMainExt();
        
        foreach( $fields_func->setup_time_block_gen_details() as $key => $value ) {
            
            $pass_data = array(); // declare empty variable
            
            // FILTER THE BLOCK
            if( $block[ "title" ] == $value[ 'block' ][ 'title' ] ):

                // LOOP THROUGH THE FIELDS
                foreach( $value[ 'fields' ] as $k => $v ) {
                    
                    if( $k != 'wrap_sel' && $k != 'wrap_sty' ) :

                        $pass_data[ $k ] = get_field( $v );

                    endif;
                    
                }

                // SECTION CLASS
                $section_class = array(
                    'block_class'               => $this->setup_array_validation( 'className', $block ) ? $block[ 'className' ] : '',
                    'item_class'                => get_field( 'timeline-section-class' ),
                    'manual_class'              => '',
                );
                $sec_class = $this->setup_combine_classes( $section_class );
                if( !empty( $sec_class ) ) {
                    $sc = ' class="'.$sec_class.'"';
                } else {
                    $sc = '';
                }

                // SECTION STYLE
                $section_styles = array(
                    'item_style'                => get_field( 'timeline-section-style' ),
                    'manual_style'              => '',
                );
                $sec_style = $this->setup_combine_styles( $section_styles );
                if( !empty( $sec_style ) ) {
                    $ss = ' style="'.$sec_style.'"';
                } else {
                    $ss = '';
                }
                
                // OUTPUT
                echo '<div'.$sc.$ss.'>'.$fields_ext->setup_timeline_relationships( $pass_data ).'</div>';

            endif;

        }

    }


    /**
     * Array validation
     */
    public function setup_array_validation( $needles, $haystacks, $args = FALSE ) {

        if( is_array( $haystacks ) && array_key_exists( $needles, $haystacks ) && !empty( $haystacks[ $needles ] ) ) {

            return $haystacks[ $needles ];

        } else {

            return FALSE;

        }

    }


    /**
     * Combine Classes for the template
     */
    public function setup_combine_classes( $classes ) {

        $block_class = !empty( $classes[ 'block_class' ] ) ? $classes[ 'block_class' ] : '';
        $item_class = !empty( $classes[ 'item_class' ] ) ? $classes[ 'item_class' ] : '';
        $manual_class = !empty( $classes[ 'manual_class' ] ) ? $classes[ 'manual_class' ] : '';

        $return = '';
        
        $ar = array( $block_class, $item_class, $manual_class );
        for( $z=0; $z<=( count( $ar ) - 1 ); $z++ ) {

            if( !empty( $ar[ $z ] ) ) {

                $return .= $ar[ $z ];

                if( $z != ( count( $ar ) - 2 ) ) {
                    $return .= ' ';
                }

            }

        }

        return $return;

    }


    /**
     * Combine Classes for the template
     */
    public function setup_combine_styles( $styles ) {

        $manual_style = $styles[ 'manual_style' ];
        $item_style = $styles[ 'item_style' ];

        if( !empty( $manual_style ) && !empty( $item_style ) ) {
                return $manual_style.' '.$item_style;
        } else {

            if( empty( $manual_style ) && !empty( $item_style ) ) {
                return $item_style;
            } else {
                return $manual_style;
            }

        }

    }

}
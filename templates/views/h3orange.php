<?php

global $bars;

/*
// class
$cs = array(
	'manual_class'		=> 'item-blocks',
	'item_class' 		=> $mfunc->setup_array_validation( 'wrap_sel', $bars ),
	'block_class'		=> $mfunc->setup_array_validation( 'block_class', $bars ),
);
$css = $mfunc->setup_combine_classes( $cs );
$classes = !empty( $css ) ? ' class="'.$css.'"' : '';

// styles
$ss = array(
	'manual_style'		=> '',
	'item_style' 		=> $mfunc->setup_array_validation( 'wrap_sty', $bars ),
);
$stayls = $mfunc->setup_combine_styles( $ss );
$inline_style = !empty( $stayls ) ? ' style="'.$stayls.'"' : '';
*/
// WRAP | OPEN
echo '<div class="item-time-entry">';

	// TITLE
	$block_title = get_the_title( $bars[ 'id' ] );
	if( !empty( $block_title ) ) {
		echo '<h3 class="item-title" style="color:orange;">
					<a href="'.get_the_permalink( $bars[ 'id' ] ).'">'.$block_title.'</a>
			  </h3>';
	}
/*
	?><InnerBlocks /><?php
*/	
// WRAP | CLOSE
echo '</div>';

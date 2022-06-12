<?php

if( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$a = new SetupTimeMain();
echo $a->setup_blocks_main( $block );
// EOF
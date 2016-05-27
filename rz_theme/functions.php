<?php 

/*Get redux options*/
if ( ! function_exists( 'rz_theme_get_options' ) ) {
	function rz_theme_get_options($arg1){
	    global $rz_redux_demo;
	    $redux = (!empty($rz_redux_demo)) ? $rz_redux_demo[$arg1] :  false;
	    return $redux;
	}
}

?> 
<?php 

/*Get redux options*/
if ( ! function_exists( 'rz_theme_get_options' ) ) {
	function rz_theme_get_options($arg1){
	    global $rz_redux_demo;
	    $redux = (!empty($rz_redux_demo)) ? $rz_redux_demo[$arg1] :  false;
	    return $redux;
	}
}

function is_logged_in(){
    if (!isset($_SESSION['username'])) {
        return false; 
    } 
    else {
        return true; 
    }
}

function get_username() {
    if(is_logged_in()){
        return $_SESSION['username']; 
    }  
    else return false; 
};

?> 
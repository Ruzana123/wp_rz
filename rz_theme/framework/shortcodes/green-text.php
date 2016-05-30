<?php
 
//green_text
if ( ! function_exists( 'rz_theme_green_text' ) ) {
   function rz_theme_green_text($attr, $content=''){
   	echo '<p style="color:'.green.'">'.$content.'</p>';
   }
   add_shortcode('green_text', 'rz_theme_green_text' ); 
}

/*Registration shortcod - green_text in Visual Composer*/
if ( ! function_exists( 'rz_theme_composer_green_text' ) ) {
   function rz_theme_composer_green_text() {
      vc_map( array(
         "name" => __( "Green text", "rz_theme" ),
         "base" => "green_text",
         "class" => "",
         "category" => __( "Content", "rz_theme"),
         "params" => array(
            array(
               "type" => "textarea_html",
               "holder" => "div",
               "class" => "",
               "heading" => __( "Content", "rz_theme" ),
               "param_name" => "content", 
               "value" => __( "<p style='color:'.green.''>I am test text block.</p>", "rz_theme" ),
               "description" => __( "Enter your content.", "rz_theme" )
           )
         )
      ) );
   }
   add_action( 'vc_before_init', 'rz_theme_composer_green_text' );
}

?>
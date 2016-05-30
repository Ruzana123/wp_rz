<?php 

//color_text
if ( ! function_exists( 'rz_theme_color_text' ) ) {
  function rz_theme_color_text($attrs, $content = ''){
  	$attrs = shortcode_atts(
  		array(
  			'color' => 'inherit'
  		), $attrs
  	);
  	return ("<span style='color: " . $attrs['color'] . "'>$content</span>");
  }
  add_shortcode( 'color_text', 'rz_theme_color_text' );
}



/*Registration shortcod - color_text in Visual Composer*/
if ( ! function_exists( 'rz_theme_composer_color_text' ) ) {
    function rz_theme_composer_color_text() {
        vc_map( array(
            "name" => __( "Color text", "rz_theme" ),
            "base" => "color_text",
            "class" => "",
            "category" => __( "Content", "rz_theme"),
            "params" => array(
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __( "Text color", "rz_theme" ),
                    "param_name" => "color",
                    "value" => '#FF0000',
                    "description" => __( "Color", "rz_theme" )
                ),
                array(
                    "type" => "textarea_html",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __( "Content", "rz_theme" ),
                    "param_name" => "content",
                    "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "rz_theme" ),
                    "description" => __( "Enter your content.", "rz_theme" )
                )
            )
        ) );
    }
    add_action( 'vc_before_init', 'rz_theme_composer_color_text' );
}

?>
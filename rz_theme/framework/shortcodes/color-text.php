<?php 

//color_text
add_shortcode( 'color_text', 'rz_color_text' );
function rz_color_text($attrs, $content = ''){
	$attrs = shortcode_atts(
		array(
			'color' => 'inherit'
		), $attrs
	);
	return ("<span style='color: " . $attrs['color'] . "'>$content</span>");
}



/*Registration shortcod - color_text in Visual Composer*/
add_action( 'vc_before_init', 'rz_theme_color_text' );
function rz_theme_color_text() {
   vc_map( array(
      "name" => __( "Color text", "rz_theme" ),
      "base" => "color_text",
      "class" => "",
      "category" => __( "Content", "rz_theme"),
      'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
      'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
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

?>
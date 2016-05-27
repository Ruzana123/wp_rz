<?php 
 
//icon_box
if ( !function_exists( 'rz_theme_icon_box' ) ) {
    function rz_theme_icon_box( $attrs, $content = null ){
        $attrs = shortcode_atts(
            array(
                'icon' => 'user',
                'title' => 'User'       
            ), $attrs
        );
        
            return ("
               <div class='icon-box' style='text-align: center' aria-hidden='true'>
                   <div class='icon-box-icon'>
                       <i class='fa fa-" . esc_attr( $attrs['icon'] ) . "'></i>
                   </div>
                   <div class='icon-box-title'>
                       <h3>" . esc_attr( $attrs['title'] ) . "</h3>
                   </div>
                   <div class='icon-box-description'>
                       <p>" . esc_attr( $content ) . "</p>
                   </div>
               </div>
           ");
    }
    add_shortcode( 'icon_box', 'rz_theme_icon_box' );
}


/*Registration shortcod - icon_box in Visual Composer*/
if ( ! function_exists( 'rz_theme_composer_icon_box' ) ) {
  function rz_theme_composer_icon_box() {
     vc_map( array(
        "name" => __( "Icon box", "rz_theme" ),
        "base" => "icon_box",
        "class" => "",
        "category" => __( "Content", "rz_theme"),
        "params" => array(
          array(
              "type" => "textfield",
              "class" => "",
              "heading" => __( "Icon", "rz_theme" ),
              "param_name" => "icon",
              "value" => __( "User", "rz_theme" )
          ),
          array(
              "type" => "textfield",
              "class" => "",
              "heading" => __( "Title", "rz_theme" ),
              "param_name" => "title",
              "value" => __( "User", "rz_theme" )
          ),
           array(
              "type" => "textarea_html",
              "holder" => "div",
              "class" => "",
              "heading" => __( "Content", "rz_theme" ),
              "param_name" => "content",
              "value" => __( "<p>I am test text block.</p>", "rz_theme" ),
              "description" => __( "Enter your content.", "rz_theme" )
          )
        )
     ) );
  }
  add_action( 'vc_before_init', 'rz_theme_composer_icon_box' );
}

?>
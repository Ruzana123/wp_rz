<?php

/*map adds a page with options: width, height, latitude, longitude*/
function rz_google_map($attrs, $content=''){
	$attrs = shortcode_atts(
		array(
			'width' => '700',
			'height' => '500',
			'latitude' => '48',
			'longitude' => '30'
			),
		$attrs );
	$height=(int)$attrs['height'];
	$width=(int)$attrs['width'];
	$latitude=(float)$attrs['latitude'];
	$longitude=(float)$attrs['longitude'];
	?><div class="map" style="position:relative">
		<iframe src='http://3planeta.com/map.html?14,<?php echo (float)$attrs['latitude'] ?>,<?php echo (float)$attrs['longitude'] ?>,2,1' width=<?php echo $width .'px' ?> height=<?php echo $height .'px' ?> frameborder=no > </iframe>
	</div>  
<?php }
add_shortcode('googlemap','rz_google_map');	


/*Registration shortcod in Visual Composer*/
add_action( 'vc_before_init', 'rz_theme_google_map' );
function rz_theme_google_map() {
   vc_map( array(
      "name" => __( "Googlemap", "rz_theme" ),
      "base" => "googlemap",
      "class" => "",
      "category" => __( "Content", "rz_theme"),
      'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
      'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
      "params" => array(
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Width", "rz_theme" ),
            "param_name" => "width",
            "value" => '500',
            "description" => __( "width map", "rz_theme" )
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Height", "rz_theme" ),
            "param_name" => "height",
            "value" => '600',
            "description" => __( "height map", "rz_theme" )
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Latitude", "rz_theme" ),
            "param_name" => "latitude",
            "value" => '50',
            "description" => __( "latitude", "rz_theme" )
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Longitude", "rz_theme" ),
            "param_name" => "longitude",
            "value" => '50',
            "description" => __( "longitude", "rz_theme" )
        ),
      )
   ) );
}

?>

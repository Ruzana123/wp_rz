<?php

/*map adds a page with options: width, height, latitude, longitude*/
if ( ! function_exists( 'rz_theme_google_map' ) ) {
  function rz_theme_google_map($attrs, $content=''){
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
  	?><div class="map" style="width:<?php echo $width . 'px' ?>; height:<?php echo $height . 'px' ?>">
  	</div>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.map').gMap({
                latitude: <?php echo $latitude ?>,
                longitude: <?php echo $longitude ?>,
                maptype: 'TERRAIN',
                zoom: 8,
                controls: {
                    panControl: true,
                    zoomControl: false,
                    mapTypeControl: true,
                    scaleControl: false,
                    streetViewControl: false,
                    overviewMapControl: false
                }
            });
        });
    </script> 
  <?php } 

  add_shortcode('googlemap','rz_theme_google_map'); 
}


/*Registration shortcod - googlemap in Visual Composer*/
if ( ! function_exists( 'rz_theme_composer_google_map' ) ) {
  function rz_theme_composer_google_map() {
     vc_map( array(
        "name" => __( "Googlemap", "rz_theme" ),
        "base" => "googlemap",
        "class" => "",
        "category" => __( "Content", "rz_theme"),
        "params" => array(
          array(
              "type" => "textfield",
              "class" => "",
              "heading" => __( "Width", "rz_theme" ),
              "param_name" => "width",
              "value" => "500",
              "description" => __( "width map", "rz_theme" )
          ),
          array(
              "type" => "textfield",
              "class" => "",
              "heading" => __( "Height", "rz_theme" ),
              "param_name" => "height",
              "value" => "600",
              "description" => __( "height map", "rz_theme" )
          ),
          array(
              "type" => "textfield",
              "class" => "",
              "heading" => __( "Latitude", "rz_theme" ),
              "param_name" => "latitude",
              "value" => "50",
              "description" => __( "latitude", "rz_theme" )
          ),
          array(
              "type" => "textfield",
              "class" => "",
              "heading" => __( "Longitude", "rz_theme" ),
              "param_name" => "longitude",
              "value" => "50",
              "description" => __( "longitude", "rz_theme" )
          ),
        )
     ) );
  }
  add_action( 'vc_before_init', 'rz_theme_composer_google_map' );
}
?>

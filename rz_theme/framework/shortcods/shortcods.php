<?php

//green_text
add_shortcode('green_text', 'rz_green_text' ); 

function rz_green_text($attr, $content=''){
	echo '<p style="color:'.green.'">'.$content.'</p>';
}

/*map*/
/*function do_googleMaps($atts, $content = null) { 
	extract(shortcode_atts(
		array( 'width' => '600', 
			'height' => '500',
			'latitude' => '',
			'longitude' => '', 
			'src'=> '' ),
		$atts)); 
	return '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d10522.
	366567425479!2d30.221931399999995!3d48.7514969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.
	1!5e0!3m2!1sru!2sua!4v1464176898702"
	allowfullscreen></iframe>'; 
}
add_shortcode("googlemap1", "do_googleMaps");

*/



function rz_google_map($attrs, $content=''){
	$attrs = shortcode_atts(
		array(
			'width' => '700px',
			'height' => '500px',
			'latitude' => '40',
			'longitude' => '50', 
			'src'=> '' ),
		$attrs );
	?><div class="map" style="position:relative">
		<div id="map" style="height:<?php echo $attrs['height'] ?>; width:<?php echo $attrs['width'] ?>" class="map-for-you"></div>
		<div class="overlay" onClick="style.pointerEvents='none'"></div>
	</div> 
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA02p7KvZC-cHha3uaXG4-JquKNG-vOYak"></script>
	<script type="text/javascript">
		// When the window has finished loading create our google map below
		google.maps.event.addDomListener(window, 'load', init);

		function init() {
		// Basic options for a simple Google Map
		// For more options see: https://developers.google.com/maps/documentation/java..
		var mapOptions = {
		// How zoomed in you want the map to start at (always required)
		zoom: 5,
		// The latitude and longitude to center the map (always required)
		// center: new google.maps.LatLng(40.6700, -73.9400), // New York
		center: new google.maps.LatLng(<?php echo (float)$attrs['latitude']; ?>, <?php echo (float)$attrs['longitude']; ?>),
		// How you would like to style the map.
		// This is where you would paste any style found on Snazzy Maps.
		styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
		};

		// Get the HTML DOM element that will contain your map
		// We are using a div with id="map" seen below in the <body>
		var mapElement = document.getElementById('map');

		// Create the Google Map using our element and options defined above
		var map = new google.maps.Map(mapElement, mapOptions);

		// Let's also add a marker while we're at it
		var marker = new google.maps.Marker({
		position: new google.maps.LatLng(<?php echo (float)$attrs['latitude'] ?>,<?php echo (float)$attrs['longitude'] ?>),
		map: map,
		title: 'Snazzy!'
		});
}
</script>   
<?php }
add_shortcode('googlemap','rz_google_map');	







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



//carrousel-post
add_shortcode('carrousel_post', 'rz_carrousel_post' ); 

function rz_carrousel_post($attrs, $content=''){
	$attrs = shortcode_atts(
		array(
			'number_of_posts' => '5',
			'number_in_slide' => '1',
			'show-text' => false,
		), $attrs
	);

$number_of_posts = (int)$atts['number_of_posts'];
$number_of_posts = ( $number_of_posts > 100 ) ? 10 : (($number_of_posts < 1) ? 1 : $number_of_posts);

$args = array(
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => $number_of_posts,
);


$post_query = new WP_Query( $args);
	ob_start();	
	?>
	<div class='owl-carousel-products'><?php
	 	if( $post_query->have_posts() ) {
	 		while($post_query->have_posts() ){
				$post_query->the_post();?>
				<div class='item' style='height: 550px;'>
					<?php echo the_post_thumbnail(); ?>
					<h4><?php the_title(); ?></h4><?php
					if ( $attrs['show-text']==true) {
						?><p><?php the_excerpt(); ?></p><?php
					} ?>
					<span><?php the_date(); ?></span><br>
					<span><?php echo __('Author','rz_theme') . get_author_name(); ?></span>
					<br><span><?php echo comments_number(); ?></span>
					<br><a href="<?php the_permalink(); ?>"><?php echo __('View Post','rz_theme') ?></a>				
				</div><?php
			}
		}
	?></div>
	<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.owl-carousel-products').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            autoHeight:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:<?php echo (int)$attrs['number_in_slide']; ?>
                }
            }
        })
        });
    </script>
	<?php

//wp_reset_postdata();
	$output=ob_get_clean();

	//$content=wp_get_recent_posts();
	//print_r($content);
	return $output;
}


//carrousel-products
add_shortcode('carrousel_products', 'rz_carrousel_products' ); 

function rz_carrousel_products($attrs, $content=''){
	$attrs = shortcode_atts(
		array(
			'number_of_product' => '5',
			'number_pr_in_slide' => '1',
			'show-text' => false,
		), $attrs
	);

$args = array(
	'post_type' => 'product',
    'order' => 'DESC',
    'orderby' => 'date',
    'product_per_page' => $number_of_product,
);


$product_query = new WP_Query( $args);
	ob_start();	
	?>
	<div class='owl-carousel'><?php
	 	if( $product_query->have_posts() ) {
	 		while($product_query->have_posts() ){
				$product_query->the_post();?>
				<div class='item' style='height: 500px;'>
					<?php woocommerce_show_product_thumbnails(); ?>
					<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a><?php
					if ( $attrs['show-text']==true) {
						?><p><?php woocommerce_template_single_excerpt(); ?></p><?php
					} ?>
					<span><?php woocommerce_template_loop_price(); ?></span>
					<span><?php woocommerce_template_loop_rating(); ?></span>
					<span><?php comments_number(); ?></span>
					<br><span><?php woocommerce_template_loop_add_to_cart(); ?></span>			
				</div><?php
			}
		}
	?></div>
	<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            autoHeight:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:<?php echo $attrs['number_pr_in_slide']; ?>
                }
            }
        })
        });
    </script>
	<?php

	$output=ob_get_clean();
	return $output;
}


//icon_box
add_shortcode( 'icon_box', function( $attrs, $content = null ) {
	$attrs = shortcode_atts(
		array(
			'icon' => 'inherit',
			'title' => 'inherit'		
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
);
?>
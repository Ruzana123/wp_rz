<?php

//green_text
add_shortcode('green_text', 'rz_green_text' ); 

function rz_green_text($attr, $content=''){
	echo '<p style="color:'.green.'">'.$content.'</p>';
}

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

$number_of_product = (int)$atts['number_of_product'];
$number_of_product = ( $number_of_product > 100 ) ? 10 : (($number_of_product < 1) ? 1 : $number_of_product);

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
				<div class='item' style='height: 700px;'>
					<?php woocommerce_show_product_thumbnails(); ?>
					<h4><?php woocommerce_template_single_title(); ?></h4><?php
					if ( $attrs['show-text']==true) {
						?><p><?php woocommerce_template_single_excerpt(); ?></p><?php
					} ?>
					<span><?php woocommerce_template_loop_price(); ?></span>
					<br><span><?php woocommerce_template_loop_rating(); ?></span>
					<br><span><?php comments_number(); ?></span>
					<br><span><?php woocommerce_template_loop_add_to_cart(); ?></span>
					<br><a href="<?php the_permalink(); ?>"><?php echo __('View Product','rz_theme') ?></a>				
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
                    items:<?php echo (int)$attrs['number_pr_in_slide']; ?>
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
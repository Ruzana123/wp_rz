<?php 

//owl-carrousel-products
if ( ! function_exists( 'rz_theme_owl_carrousel_products' ) ) {
    function rz_theme_owl_carrousel_products($attrs, $content=''){
    	$attrs = shortcode_atts(
    		array(
    			'number_of_product' => '5',
    			'number_pr_in_slide' => '1',
    			'show_text' => false,
    		), $attrs
    	);

    $number_of_product=(int)$atts['number_of_product'];

    $args = array(
    	'post_type' => 'product',
        'order' => 'DESC',
        'orderby' => 'date',
        'product_per_page' => $number_of_product,
    );

    $number_pr_in_slide = (int)$atts['number_pr_in_slide'];
    $number_pr_in_slide = ( $number_pr_in_slide > 10 ) ? 5 : (($number_pr_in_slide < 1) ? 1 : $number_pr_in_slide);

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
    					if ( $attrs['show_text']==true) {
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
    add_shortcode('carrousel_products', 'rz_theme_owl_carrousel_products' ); 
}



/*Registration shortcod - carrousel_products in Visual Composer*/
if ( ! function_exists( 'rz_theme_carrousel_products' ) ) {
    function rz_theme_carrousel_products() {
       vc_map( array(
            "name" => __( "Carrousel products", "rz_theme" ),
            "base" => "carrousel_products",
            "class" => "",
            "category" => __( "Content", "rz_theme"),
            "params" => array(
           	array(
                "type" => "textfield",
                "class" => "",
                "heading" => __( "Number_of_product", "rz_theme" ),
                "param_name" => "number_of_product",
                "value" => __( "6", "rz_theme" )
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __( "Number_pr_in_slide", "rz_theme" ),
                "param_name" => "number_pr_in_slide",
                "value" => __( "1", "rz_theme" )
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __( "Show_text", "rz_theme" ),
                "param_name" => "show_text",
                "value" => __( "true", "rz_theme" ),
                "description" => __( "Show text (true or false)", "rz_theme" )
            ),
          )
        ) );
    }
    add_action( 'vc_before_init', 'rz_theme_carrousel_products' );
}

?>
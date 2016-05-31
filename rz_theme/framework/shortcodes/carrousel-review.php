<?php 

//owl-carrousel-reviews
if ( ! function_exists( 'rz_theme_owl_carrousel_reviews' ) ) {
    function rz_theme_owl_carrousel_reviews($attrs, $content=''){
    	$attrs = shortcode_atts(
    		array(
    			'number_of_review' => '5',
    			'number_reviews_in_slide' => '1',
    			'show_text' => false,
    		), $attrs
    	);
   
    $number_of_reviews =(int)$atts['number_of_review'];

    $args = array(
    	'post_type' => 'review',
        'order' => 'DESC',
        'orderby' => 'date',
        'reviews_per_page' => $number_of_reviews,
    );

    $review_query = new WP_Query( $args);
    	ob_start();	
    	?>
    	<div class='owl-carousel-reviews'><?php
    	 	if( $review_query->have_posts() ) {
    	 		while($review_query->have_posts() ){
    				$review_query->the_post();?>
    				<div class='item' style='height: 200px;'>
    					<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a><?php
    					if ( $attrs['show_text']==true) {
    						?><p><?php the_excerpt(); ?></p><?php
    					} ?>
    					<span><?php the_date(); ?></span><br>
    					<span><?php echo __('Author','rz_theme') . get_author_name(); ?></span>
    					<br><span><?php echo comments_number(); ?></span>
    					<br><a href="<?php the_permalink(); ?>"><?php echo __('View Review','rz_theme') ?></a>	
    				</div><?php
    			}
    		}
    	?></div>
    	<script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.owl-carousel-reviews').owlCarousel({
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
                            items:<?php echo $attrs['number_reviews_in_slide']; ?>
                        }
                    }
                })
            });
        </script>
    	<?php

    	$output=ob_get_clean();
    	return $output;
    }
    add_shortcode('carrousel_reviews', 'rz_theme_owl_carrousel_reviews' ); 
}



/*Registration shortcod - carrousel_reviews in Visual Composer*/
if ( ! function_exists( 'rz_theme_carrousel_reviews' ) ) {
    function rz_theme_carrousel_reviews() {
       vc_map( array(
          "name" => __( "Carrousel reviews", "rz_theme" ),
          "base" => "carrousel_reviews",
          "class" => "",
          "category" => __( "Content", "rz_theme"),
          "params" => array(
           	array(
                "type" => "textfield",
                "class" => "",
                "heading" => __( "Number_of_review", "rz_theme" ),
                "param_name" => "number_of_review",
                "value" => __( "6", "rz_theme" ),
                "description" => __( "Number of review", "rz_theme" )
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __( "Number_reviews_in_slide", "rz_theme" ),
                "param_name" => "number_reviews_in_slide",
                "value" => __( "1", "rz_theme" ),
                "description" => __( "Number reviews in slide", "rz_theme" )
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
    add_action( 'vc_before_init', 'rz_theme_carrousel_reviews' );
}

?>
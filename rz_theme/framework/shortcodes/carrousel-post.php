<?php 
 
//owl-carrousel-post
if ( ! function_exists( 'rz_theme_owl_carrousel_post' ) ) {
    function rz_theme_owl_carrousel_post($attrs, $content=''){
    	$attrs = shortcode_atts(
    		array(
    			'number_of_posts' => '5',
    			'number_in_slide' => '1',
    			'show_text' => false,
    		), $attrs
    	);

    $number_of_posts = (int)$atts['number_of_posts'];

    $number_in_slide = (int)$atts['number_in_slide'];
    $number_in_slide = ( $number_in_slide > 10 ) ? 5 : (($number_in_slide < 1) ? 1 : $number_in_slide);

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
    					if ( $attrs['show_text']==true) {
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
                            items:<?php echo $number_in_slide;  ?>
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
    add_shortcode('carrousel_post', 'rz_theme_owl_carrousel_post' ); 
}




/*Registration shortcod - carrousel_post in Visual Composer*/
if ( ! function_exists( 'rz_theme_carrousel_post' ) ) {
    function rz_theme_carrousel_post() {
       vc_map( array(
           "name" => __( "Carrousel post", "rz_theme" ),
           "base" => "carrousel_post",
           "class" => "",
           "category" => __( "Content", "rz_theme"),
           "params" => array(
           	array(
                "type" => "textfield",
                "class" => "",
                "heading" => __( "Number_of_posts", "rz_theme" ),
                "param_name" => "number_of_posts",
                "value" => __( "6", "rz_theme" )
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __( "Number_in_slide", "rz_theme" ),
                "param_name" => "number_in_slide",
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
    add_action( 'vc_before_init', 'rz_theme_carrousel_post' );
}

 ?>
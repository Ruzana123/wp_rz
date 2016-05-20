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

//carrousel
add_shortcode('carrousel_post', 'rz_carrousel_post' ); 

function rz_carrousel_post($attrs, $content=''){
	$attrs = shortcode_atts(
		array(
			'title' => 'inherit',
			'koll' => 'inherit',
			'koll-it' => 'inherit',
			'show-text' => false,
		), $attrs
	);


$args = array(
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => 6,
);

$query = new WP_Query( $args);
	ob_start();	
	?>	
	<div class='owl-carousel'><?php
	 	if( $query->have_posts() ) {
	 		while($query->have_posts() && $k<$attrs['koll'] ){
				$query->the_post();?>
					<div class='item'>
						<?php echo the_post_thumbnail(); ?>
						<h4><?php the_title(); ?></h4><?php
						if ( $attrs['show-text']==true) {
							?><p><?php the_excerpt(); ?></p><?php
						} ?>
						<span><?php the_date(); ?></span><br>
						<span> Author:<?php echo get_author_name(); ?></span>
						<br><span><?php echo comments_number(); ?></span>
						<br><a href="<?php the_permalink(); ?>">View Post</a>				
					</div><?php
				$k=$k+1;
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
                    items:<?php echo $attrs['koll-it']; ?>
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
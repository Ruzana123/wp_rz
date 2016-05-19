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
	$content=wp_get_recent_posts();
	//print_r($content);
	ob_start();?>
		
	<div class='owl-carousel' style='display:block'><?php
	    foreach ($content as $key => $value) { 
	    	while ($k < $attrs['koll']) {	
				?><div class='item'>
					<?php echo get_the_post_thumbnail($value['ID'],'thumbnail') ?>
					<h4><?php echo $value['post_title'] ?></h4><?php
					if ( $attrs['show-text']==true) {
						?><p><?php echo $value['post_excerpt'] ?></p><?php
					}
					?><span><?php echo $value['post_date'] ?></span><br><span> Post author:<?php 
					get_author_name($value['post_author']) ?></span>
					<br><span>Comment count:<?php echo $value['comment_count']?></span>
					<br><a href="<?php echo $value['guid'] ?>">View Post</a>
				</div><?php
				$k=$k+1;
				break;
			}
		}?>
	</div>
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
    </script><?php
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
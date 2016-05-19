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

function rz_carrousel_post($attr, $content=''){
	$attrs = shortcode_atts(
		array(
			'title' => 'inherit',
			'posts' => 'inherit'
		), $attrs
	);
	$content=wp_get_recent_posts();
	//print_r($content);
	$carrousel="<div class='owl-carousel' style='display:block'>";
    foreach ($content as $key => $value) { 
		$carrousel .= "<div class='item'>" . get_the_post_thumbnail($value['ID'],'thumbnail') . "<h4>"
		. $value['post_title'] . "</h4><p>" . $value['post_excerpt'] ."</p><span>". 
		$value['post_date'] . "</span><br><span> Post author:".get_the_author() ."</span>
		<br><span>Comment count:" . $value['comment_count'] . "</span><br><a href=".$value['guid'].">View Post</a></div>";
	}
	$carrousel .="</div>";
	return $carrousel;

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


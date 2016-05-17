<?php
/**
* widget-weather.php
*
* Plugin Name: RZ_Theme_Widget_Weather
* Plugin URI: 
* Description: A widget that displays weather.
* Version: 1.0
* Author: student4 Ruzana
* Author URI: 
*/
?>

<?php
class RZ_Theme_Widget_Weather extends WP_Widget {
		/**
	* Specifies the widget name, description, class name and instatiates it.
	*/
	public function __construct() {
		parent::__construct(
			'widget-weather',
			__( 'rz_theme: weather', 'rz_theme' ),
		array(
			'classname' => 'widget-weather',
			'description' => __( 'A custom widget that displays weather.', 'rz_theme' )
		)
	);
}

/**
* Generates the back-end layout for the widget.
*/
public function form( $instance ) {
// Default widget settings
	$defaults = array(
	'title' => 'Weather',
	'city' => ''
);

$instance = wp_parse_args( (array) $instance, $defaults );

// The widget content ?>
	<!-- Title -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'rz_theme' ); ?></label>
		<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
	</p>

	<!-- City -->
	<select name="<?php echo $this->get_field_name( 'city' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>">            
		<option <?php selected( $instance['city'], 'Uman' ); ?> >Uman</option>
  		<option <?php selected( $instance['city'], 'Lviv' ); ?> >Lviv</option>
  		<option <?php selected( $instance['city'], 'Odesa' ); ?> >Odesa</option>
	</select>
	<?php
}

/**
* Process the widget's values.
*/
public function update( $new_instance, $old_instance ) {
	$insistance = $old_instance;

	// Update values
	$insistance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
	$insistance['city'] = strip_tags( stripslashes( $new_instance['city'] ) );

	return $insistance;
}

/**
* Output the contents of the widget.
*/
public function widget( $args, $instance ) {
	extract( $args );

	$title = apply_filters( 'widget_title', $instance['title'] );
	$city = $instance['city'];
	// Display the
	//markup before the widget ( as defined in functions.php )
	echo $before_widget;

	if ( $title ) {
		echo $before_title . $title . $after_title;
	}

	if ( $city ): 
		printf('<div id="meteoprog_informer_standart" data-params="boy:%s:300x100:dark:48x50" ><a href="http://www.meteoprog.ua/en/">weather</a><br /><a href="http://www.meteoprog.ua/en/weather/%s/">Weather in %s </a><br /></div>
        <script src="http://www.meteoprog.ua/en/weather/informer/standart.js"></script>',$city,$city,$city);
  	?>
	<?php endif; ?>

			<?php echo $after_widget;
		}
	}

// Register the widget using an annonymous function.
add_action( 'widgets_init', create_function( '', 'register_widget( "RZ_Theme_Widget_Weather" );' ) );
?>
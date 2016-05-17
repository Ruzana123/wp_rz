<?php
/**
* widget-business-hours.php
*
* Plugin Name: RZ_Theme_Widget_Business_Hours
* Plugin URI: 
* Description: A widget that displays business hours.
* Version: 1.0
* Author: student4 Ruzana
* Author URI: 
*/
?>

<?php
class RZ_Theme_Widget_Business_Hours extends WP_Widget {
	/**
	* Specifies the widget name, description, class name and instatiates it.
	*/
	public function __construct() {
		parent::__construct(
			'widget-business-hours',
			__( 'rz_theme: Business Hours', 'rz_theme' ),
		array(
			'classname' => 'widget-business-hours',
			'description' => __( 'A custom widget that displays hours.', 'rz_theme' )
		)
	);
}

/**
* Generates the back-end layout for the widget.
*/
public function form( $instance ) {
// Default widget settings
	$defaults = array(
	'title' => 'Business Hours',
	'hours_description' => '',
	'hours_monday_friday' => '9am to 5pm',
	'hours_saturday' => 'Closed',
	'hours_sunday' => 'Closed'
);

$instance = wp_parse_args( (array) $instance, $defaults );

// The widget content ?>
	<!-- Title -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'rz_theme' ); ?></label>
		<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
	</p>

	<!-- Description -->
	<p>
		<label for="<?php echo $this->get_field_id( 'hours_description' ) ?>"><?php _e( 'Description:', 'rz_theme' ); ?></label>
		<textarea name="<?php echo $this->get_field_name( 'hours_description' ) ?>" class="widefat" id="<?php echo $this->get_field_id( 'hours_description' ) ?>" cols="30" rows="10"><?php echo esc_attr( $instance['hours_description'] ); ?></textarea>
	</p>

	<!-- Monday-Friday -->
	<p>
		<label for="<?php echo $this->get_field_id( 'hours_monday_friday' ); ?>"><?php _e( 'Monday-Friday:', 'rz_theme' ); ?></label>
		<input type="text" name="<?php echo $this->get_field_name( 'hours_monday_friday' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'hours_monday_friday' ); ?>" value="<?php echo esc_attr( $instance['hours_monday_friday'] ); ?>">
	</p>

	<!-- Saturday -->
	<p>
		<label for="<?php echo $this->get_field_id( 'hours_saturday' ); ?>"><?php _e( 'Saturday:', 'rz_theme' ); ?></label>
		<input type="text" name="<?php echo $this->get_field_name( 'hours_saturday' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'hours_saturday' ); ?>" value="<?php echo esc_attr( $instance['hours_saturday'] ); ?>">
	</p>

	<!-- Sunday -->
	<p>
		<label for="<?php echo $this->get_field_id( 'hours_sunday' ); ?>"><?php _e( 'Sunday:', 'rz_theme' ); ?></label>
		<input type="text" name="<?php echo $this->get_field_name( 'hours_sunday' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'hours_sunday' ); ?>" value="<?php echo esc_attr( $instance['hours_sunday'] ); ?>">
	</p>
	<?php
}

/**
* Process the widget's values.
*/
public function update( $new_instance, $old_instance ) {
	$insistance = $old_instance;

	// Update values
	$insistance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
	$insistance['hours_description'] = strip_tags( stripslashes( $new_instance['hours_description'] ) );
	$insistance['hours_monday_friday'] = strip_tags( stripslashes( $new_instance['hours_monday_friday'] ) );
	$insistance['hours_saturday'] = strip_tags( stripslashes( $new_instance['hours_saturday'] ) );
	$insistance['hours_sunday'] = strip_tags( stripslashes( $new_instance['hours_sunday'] ) );

	return $insistance;
}

/**
* Output the contents of the widget.
*/
public function widget( $args, $instance ) {
	extract( $args );

	$title = apply_filters( 'widget_title', $instance['title'] );
	$hours_description = $instance['hours_description'];
	$hours_monday_friday = $instance['hours_monday_friday'];
	$hours_saturday = $instance['hours_saturday'];
	$hours_sunday = $instance['hours_sunday'];

	// Display the
	//markup before the widget ( as defined in functions.php )
	echo $before_widget;

	if ( $title ) {
		echo $before_title . $title . $after_title;
	}

	if ( $hours_description ): ?>
		<p>
			<?php echo $hours_description; ?>
		</p>
	<?php endif; ?>

	<ul>

	<?php if ( $hours_monday_friday ): ?>
			<li>
				<span><?php _e( 'Monday-Friday:', 'rz_theme' ); ?></span>
				<?php echo $hours_monday_friday; ?>
			</li>
		<?php endif;

		if ( $hours_saturday ): ?>
			<li>
				<span><?php _e( 'Saturday:', 'rz_theme' ); ?></span>
				<?php echo $hours_saturday; ?>
			</li>
		<?php endif;

		if ( $hours_sunday ): ?>
			<li>
				<span><?php _e( 'Sunday:', 'rz_theme' ); ?></span>
				<?php echo $hours_sunday; ?>
			</li>
		<?php endif; ?>

		</ul>
		<?php echo $after_widget;
		}
	}

// Register the widget using an annonymous function.
add_action( 'widgets_init', create_function( '', 'register_widget( "RZ_Theme_Widget_Business_Hours" );' ) );
?>
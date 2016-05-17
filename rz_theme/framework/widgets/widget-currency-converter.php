<?php
/**
* widget-currency-converter.php
*
* Plugin Name: RZ_Theme_Widget_Currency-Converter
* Plugin URI: 
* Description: A widget that displays currency.
* Version: 1.0
* Author: student4 Ruzana
* Author URI: 
*/
?>

<?php
class RZ_Theme_Widget_Currency_Converter extends WP_Widget {
		/**
	* Specifies the widget name, description, class name and instatiates it.
	*/
	public function __construct() {
		parent::__construct(
			'widget-currency-converter',
			__( 'rz_theme: currency-converter', 'rz_theme' ),
		array(
			'classname' => 'widget-currency-converter',
			'description' => __( 'A custom widget that displays currency.', 'rz_theme' )
		)
	);
}

/**
* Generates the back-end layout for the widget.
*/
public function form( $instance ) {
// Default widget settings
	$defaults = array(
	'title' => 'Currency converter',
	'currency' => ''
);

$instance = wp_parse_args( (array) $instance, $defaults );

// The widget content ?>
	<!-- Title -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'rz_theme' ); ?></label>
		<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
	</p>

	<!-- City -->
	<select name="<?php echo $this->get_field_name( 'currency' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>">
		<option>usd</option>
  		<option>eur</option>
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
	$insistance['currency'] = strip_tags( stripslashes( $new_instance['currency'] ) );

	return $insistance;
}

/**
* Output the contents of the widget.
*/
public function widget( $args, $instance ) {
	extract( $args );

	$title = apply_filters( 'widget_title', $instance['title'] );
	$currency = $instance['currency'];
	// Display the
	//markup before the widget ( as defined in functions.php )
	echo $before_widget;

	if ( $title ) {
		echo $before_title . $title . $after_title;
	}

	if ( $currency ): ?>
		<!-- PROext: Currency Imformer Begin -->
		
	<?php endif; ?>

			<?php echo $after_widget;
		}
	}

// Register the widget using an annonymous function.
add_action( 'widgets_init', create_function( '', 'register_widget( "RZ_Theme_Widget_Currency_Converter" );' ) );
?>
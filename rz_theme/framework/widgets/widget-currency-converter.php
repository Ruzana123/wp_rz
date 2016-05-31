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
	'currency' => '',
	'currency1' => ''
);

$instance = wp_parse_args( (array) $instance, $defaults );

// The widget content ?>
	<!-- Title -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'rz_theme' ); ?></label>
		<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
	</p>

	<select name="<?php echo $this->get_field_name( 'currency' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>">
		<option <?php selected( $instance['currency'], '' ); ?> >''</option>
		<option <?php selected( $instance['currency'], 'USD' ); ?> >USD</option>
  		<option <?php selected( $instance['currency'], 'EUR' ); ?> >EUR</option>
  		<option <?php selected( $instance['currency'], 'RUB' ); ?> >RUB</option>
	</select>

	<select name="<?php echo $this->get_field_name( 'currency1' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>">
  		<option <?php selected( $instance['currency1'], 'EUR' ); ?> >EUR</option>
  		<option <?php selected( $instance['currency1'], 'RUB' ); ?> >RUB</option>
  		<option <?php selected( $instance['currency1'], 'USD' ); ?> >USD</option>
  		<option <?php selected( $instance['currency1'], '' ); ?> >''</option>		
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
	$insistance['currency1'] = strip_tags( stripslashes( $new_instance['currency1'] ) );
	return $insistance;
}

/**
* Output the contents of the widget.
*/
public function widget( $args, $instance ) {
	extract( $args );
	$title = apply_filters( 'widget_title', $instance['title'] );
	$currency = $instance['currency'];
	$currency1 = $instance['currency1'];
	// Display the
	//markup before the widget ( as defined in functions.php )
	echo $before_widget;

	if ( $title ) {
		echo $before_title . $title . ' ' . date('d-m-Y') . $after_title;
	}

	if ( $currency ): ?>
		<!-- PROext: Currency Imformer Begin --> <?php
			$currency_array=json_decode(file_get_contents("http://resources.finance.ua/ru/public/currency-cash.json"),true) ;
			//print_r($currency_array);
			$buy = $currency_array['organizations'][0]['currencies'][$currency]['ask'];
			$sale =  $currency_array['organizations'][0]['currencies'][$currency]['bid'];
			printf('<div><h4 class="text-center">Валюта:%s</h4><span>Продаж: %s</span><br><span>Купівля: %s</span><div>',$currency,$buy,$sale);	
	endif; 
	if ( $currency1 ): ?>
		<!-- PROext: Currency Imformer Begin --> <?php
			$currency_array=json_decode(file_get_contents("http://resources.finance.ua/ru/public/currency-cash.json"),true) ;
			//print_r($currency_array);
			$buy1 = $currency_array['organizations'][0]['currencies'][$currency1]['ask'];
			$sale1 =  $currency_array['organizations'][0]['currencies'][$currency1]['bid'];
			printf('<div><h4 class="text-center">Валюта:%s</h4><span>Продаж: %s</span><br><span>Купівля: %s</span><div>',$currency1,$buy1,$sale1);	
	endif; 
		echo $after_widget;
		}
	}

// Register the widget using an annonymous function.
add_action( 'widgets_init', create_function( '', 'register_widget( "RZ_Theme_Widget_Currency_Converter" );' ) );
?>
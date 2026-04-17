<?php
/**
 * Pizzeria Online Delivery Theme Info
 *
 * @package pizzeria_online_delivery
 */

if( class_exists( 'WP_Customize_control' ) ){

	class Pizzeria_Online_Delivery_Theme_Info extends WP_Customize_Control{
    	/**
       	* Render the content on the theme customizer page
       	*/
       	public function render_content()
       	{
       		?>
       		<label>
       			<strong class="customize-text_editor"><?php echo esc_html( $this->label ); ?></strong>
       			<br />
       			<span class="customize-text_editor_desc">
       				<?php echo wp_kses_post( $this->description ); ?>
       			</span>
       		</label>
       		<?php
       	}
    }
    
}

if( class_exists( 'WP_Customize_Section' ) ) :


/**
 * Adding Go to Pro Section in Customizer
 * https://github.com/justintadlock/trt-customizer-pro
 */
class Pizzeria_Online_Delivery_Customize_Section_Pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'pro-section';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}
endif;

if ( ! defined( 'PIZZERIA_ONLINE_DELIVERY_TEXT' ) ) {
    define( 'PIZZERIA_ONLINE_DELIVERY_TEXT', __( 'Pizzeria Online Delivery PRO','pizzeria-online-delivery' ));
}
if ( ! defined( 'PIZZERIA_ONLINE_DELIVERY_DOC_URL' ) ) {
    define( 'PIZZERIA_ONLINE_DELIVERY_DOC_URL', esc_url( 'https://demo.themeignite.com/documentation/pizzeria-online-delivery-free/', 'pizzeria-online-delivery') );
}
if ( ! defined( 'PIZZERIA_ONLINE_DELIVERY_DOC_TEXT' ) ) {
    define( 'PIZZERIA_ONLINE_DELIVERY_DOC_TEXT', __( 'Lite Documentation','pizzeria-online-delivery' ));
}

add_action( 'customize_register', 'pizzeria_online_delivery_sections_pro' );
function pizzeria_online_delivery_sections_pro( $manager ) {
	// Register custom section types.
	$manager->register_section_type( 'Pizzeria_Online_Delivery_Customize_Section_Pro' );

	// Register sections.
	$manager->add_section(
		new Pizzeria_Online_Delivery_Customize_Section_Pro(
			$manager,
			'pizzeria_online_delivery_view_pro',
			array(
				'title'    => esc_html__( 'Pro Available', 'pizzeria-online-delivery' ),
                'priority' => 5, 
				'pro_text' => esc_html( PIZZERIA_ONLINE_DELIVERY_TEXT, 'pizzeria-online-delivery' ),
				'pro_url'  => esc_url( PIZZERIA_ONLINE_DELIVERY_URL)
			)
		)
	);

	// Register sections.
	$manager->add_section(
		new Pizzeria_Online_Delivery_Customize_Section_Pro(
			$manager,
			'pizzeria_online_delivery_view_lite_doc',
			array(
				'title'    => esc_html__( 'For Reference', 'pizzeria-online-delivery' ),
				'priority' => 5, 
				'pro_text' => esc_html( PIZZERIA_ONLINE_DELIVERY_DOC_TEXT, 'pizzeria-online-delivery' ),
				'pro_url'  => esc_url( PIZZERIA_ONLINE_DELIVERY_DOC_URL)
			)
		)
	);
}
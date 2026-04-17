<?php
/**
 * Help Panel.
 *
 * @package pizzeria_online_delivery
 */

$pizzeria_online_delivery_import_done = get_option( 'pizzeria_online_delivery_demo_import_done' );
$pizzeria_online_delivery_button_text = $pizzeria_online_delivery_import_done
	? __( 'View Site', 'pizzeria-online-delivery' )
	: __( 'Start Demo Import', 'pizzeria-online-delivery' );
$pizzeria_online_delivery_button_link = $pizzeria_online_delivery_import_done
	? home_url( '/' )
	: admin_url( 'themes.php?page=pizzeriaonlinedelivery-wizard' );
?>
<div id="help-panel" class="panel-left visible">
    <div class="panel-aside active">
        <div class="demo-content">
            <div class="demo-info">
                <h4><?php esc_html_e( 'DEMO CONTENT IMPORTER', 'pizzeria-online-delivery' ); ?></h4>
                <p><?php esc_html_e('The Demo Content Importer helps you quickly set up your website to look exactly like the theme demo. Instead of building pages from scratch, you can import pre-designed layouts, pages, menus, images, and basic settings in just a few clicks.','pizzeria-online-delivery'); ?></p>
                <a class="button button-primary first-color" style="text-transform: capitalize" href="<?php echo esc_url( $pizzeria_online_delivery_button_link ); ?>" title="<?php echo esc_attr( $pizzeria_online_delivery_button_text ); ?>"
                    <?php echo $pizzeria_online_delivery_import_done ? 'target="_blank"' : ''; ?>>
                    <?php echo esc_html( $pizzeria_online_delivery_button_text ); ?>
                </a>
            </div>
            <div class="demo-img">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" alt="<?php echo esc_attr( 'screenshot', 'pizzeria-online-delivery'); ?>"/>
            </div>
        </div>
    </div>

    <div class="panel-aside" >
        <h4><?php esc_html_e( 'USEFUL LINKS', 'pizzeria-online-delivery' ); ?></h4>
        <p><?php esc_html_e( 'Find everything you need to set up, customize, and manage your website with ease. These helpful resources are designed to guide you at every step, from installation to advanced customization.', 'pizzeria-online-delivery' ); ?></p>
        <div class="useful-links">
            <a class="button button-primary second-color" href="<?php echo esc_url( PIZZERIA_ONLINE_DELIVERY_DEMO_URL ); ?>" title="<?php esc_attr_e( 'Live Demo', 'pizzeria-online-delivery' ); ?>" target="_blank">
                <?php esc_html_e( 'Live Demo', 'pizzeria-online-delivery' ); ?>
            </a>
            <a class="button button-primary first-color" href="<?php echo esc_url( PIZZERIA_ONLINE_DELIVERY_FREE_DOC_URL ); ?>" title="<?php esc_attr_e( 'Documentation', 'pizzeria-online-delivery' ); ?>" target="_blank">
                <?php esc_html_e( 'Documentation', 'pizzeria-online-delivery' ); ?>
            </a>
            <a class="button button-primary second-color" href="<?php echo esc_url( PIZZERIA_ONLINE_DELIVERY_URL ); ?>" title="<?php esc_attr_e( 'Get Premium', 'pizzeria-online-delivery' ); ?>" target="_blank">
                <?php esc_html_e( 'Get Premium', 'pizzeria-online-delivery' ); ?>
            </a>
            <a class="button button-primary first-color" href="<?php echo esc_url( PIZZERIA_ONLINE_DELIVERY_BUNDLE_URL ); ?>" title="<?php esc_attr_e( 'Get Bundle - 60+ Themes', 'pizzeria-online-delivery' ); ?>" target="_blank">
                <?php esc_html_e( 'Get Bundle - 60+ Themes', 'pizzeria-online-delivery' ); ?>
            </a>
        </div>
    </div>

    <div class="panel-aside" >
        <h4><?php esc_html_e( 'REVIEW', 'pizzeria-online-delivery' ); ?></h4>
        <p><?php esc_html_e( 'If you have a moment, please consider leaving a rating and short review. It only takes a minute, and your support means a lot to us.', 'pizzeria-online-delivery' ); ?></p>
        <a class="button button-primary first-color" href="<?php echo esc_url( PIZZERIA_ONLINE_DELIVERY_REVIEW_URL ); ?>" title="<?php esc_attr_e( 'Visit the Review', 'pizzeria-online-delivery' ); ?>" target="_blank">
            <?php esc_html_e( 'Leave a Review', 'pizzeria-online-delivery' ); ?>
        </a>
    </div>
    
    <div class="panel-aside">
        <h4><?php esc_html_e( 'CONTACT SUPPORT', 'pizzeria-online-delivery' ); ?></h4>
        <p>
            <?php esc_html_e( 'Thank you for choosing Pizzeria Online Delivery! We appreciate your interest in our theme and are here to assist you with any support you may need.', 'pizzeria-online-delivery' ); ?></p>
        <a class="button button-primary first-color" href="<?php echo esc_url( PIZZERIA_ONLINE_DELIVERY_SUPPORT_URL ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'pizzeria-online-delivery' ); ?>" target="_blank">
            <?php esc_html_e( 'Contact Support', 'pizzeria-online-delivery' ); ?>
        </a>
    </div>
</div>
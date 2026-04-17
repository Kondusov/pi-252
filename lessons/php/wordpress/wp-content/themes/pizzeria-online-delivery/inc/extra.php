<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package pizzeria_online_delivery
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pizzeria_online_delivery_body_classes( $classes ) {
  global $pizzeria_online_delivery_post;
  
    if( !is_page_template( 'template-home.php' ) ){
        $classes[] = 'inner';
        // Adds a class of group-blog to blogs with more than 1 published author.
    }

    if ( is_multi_author() ) {
        $classes[] = 'group-blog ';
    }

    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }
    

    if( pizzeria_online_delivery_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || 'product' === get_post_type() ) && ! is_active_sidebar( 'shop-sidebar' ) ){
        $classes[] = 'full-width';
    }    

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_page() ) {
        $classes[] = 'hfeed ';
    }
  
    if( is_404() ||  is_search() ){
        $classes[] = 'full-width';
    }
  
    if( ! is_active_sidebar( 'right-sidebar' ) ) {
        $classes[] = 'full-width'; 
    }

    return $classes;
}
add_filter( 'body_class', 'pizzeria_online_delivery_body_classes' );

 /**
 * 
 * @link http://www.altafweb.com/2011/12/remove-specific-tag-from-php-string.html
 */
function pizzeria_online_delivery_strip_single( $tag, $string ){
    $string=preg_replace('/<'.$tag.'[^>]*>/i', '', $string);
    $string=preg_replace('/<\/'.$tag.'>/i', '', $string);
    return $string;
}

if ( ! function_exists( 'pizzeria_online_delivery_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function pizzeria_online_delivery_excerpt_more($more) {
  return is_admin() ? $more : ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'pizzeria_online_delivery_excerpt_more' );


if( ! function_exists( 'pizzeria_online_delivery_footer_credit' ) ):
/**
 * Footer Credits
*/
function pizzeria_online_delivery_footer_credit() {

    // Check if footer copyright is enabled
    $pizzeria_online_delivery_show_footer_copyright = get_theme_mod( 'pizzeria_online_delivery_footer_setting', true );

    if ( ! $pizzeria_online_delivery_show_footer_copyright ) {
        return; 
    }

    $pizzeria_online_delivery_copyright_text = get_theme_mod('pizzeria_online_delivery_footer_copyright_text');

    $pizzeria_online_delivery_text = '<div class="site-info"><div class="container"><span class="copyright">';
    if ($pizzeria_online_delivery_copyright_text) {
        $pizzeria_online_delivery_text .= wp_kses_post($pizzeria_online_delivery_copyright_text); 
    } else {
        $pizzeria_online_delivery_text .= esc_html__('&copy; ', 'pizzeria-online-delivery') . date_i18n(esc_html__('Y', 'pizzeria-online-delivery')); 
        $pizzeria_online_delivery_text .= ' <a href="' . esc_url(home_url('/')) . '">' . esc_html(get_bloginfo('name')) . '</a>' . esc_html__('. All Rights Reserved.', 'pizzeria-online-delivery');
    }
    $pizzeria_online_delivery_text .= '</span>';
    //$pizzeria_online_delivery_text .= '<span class="by"> <a href="' . esc_url('https://www.themeignite.com/products/pizzeria-online-delivery') . '" rel="nofollow" target="_blank">' . PIZZERIA_ONLINE_DELIVERY_THEME_NAME . '</a>' . esc_html__(' By ', 'pizzeria-online-delivery') . '<a href="' . esc_url('https://themeignite.com/') . '" rel="nofollow" target="_blank">' . esc_html__('Themeignite', 'pizzeria-online-delivery') . '</a>.';
    /* translators: %s: link to WordPress.org */
    //$pizzeria_online_delivery_text .= sprintf(esc_html__(' Powered By %s', 'pizzeria-online-delivery'), '<a href="' . esc_url(__('https://wordpress.org/', 'pizzeria-online-delivery')) . '" target="_blank">WordPress</a>.');
    if (function_exists('the_privacy_policy_link')) {
        $pizzeria_online_delivery_text .= get_the_privacy_policy_link();
    }
    $pizzeria_online_delivery_text .= '</span></div></div>';
    echo apply_filters('pizzeria_online_delivery_footer_text', $pizzeria_online_delivery_text);
}
add_action('pizzeria_online_delivery_footer', 'pizzeria_online_delivery_footer_credit');
endif;

/**
 * Is Woocommerce activated
*/
if ( ! function_exists( 'pizzeria_online_delivery_woocommerce_activated' ) ) {
  function pizzeria_online_delivery_woocommerce_activated() {
    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
  }
}

if( ! function_exists( 'pizzeria_online_delivery_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function pizzeria_online_delivery_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $pizzeria_online_delivery_commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $pizzeria_online_delivery_aria_req = ( $req ? " aria-required='true'" : '' );
    $pizzeria_online_delivery_required = ( $req ? " required" : '' );
    $pizzeria_online_delivery_author   = ( $req ? __( 'Name*', 'pizzeria-online-delivery' ) : __( 'Name', 'pizzeria-online-delivery' ) );
    $pizzeria_online_delivery_email    = ( $req ? __( 'Email*', 'pizzeria-online-delivery' ) : __( 'Email', 'pizzeria-online-delivery' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'pizzeria-online-delivery' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $pizzeria_online_delivery_author ) . '" type="text" value="' . esc_attr( $pizzeria_online_delivery_commenter['comment_author'] ) . '" size="30"' . $pizzeria_online_delivery_aria_req . $pizzeria_online_delivery_required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'pizzeria-online-delivery' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $pizzeria_online_delivery_email ) . '" type="text" value="' . esc_attr(  $pizzeria_online_delivery_commenter['comment_author_email'] ) . '" size="30"' . $pizzeria_online_delivery_aria_req . $pizzeria_online_delivery_required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'pizzeria-online-delivery' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'pizzeria-online-delivery' ) . '" type="text" value="' . esc_attr( $pizzeria_online_delivery_commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'pizzeria_online_delivery_change_comment_form_default_fields' );

if( ! function_exists( 'pizzeria_online_delivery_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function pizzeria_online_delivery_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'pizzeria-online-delivery' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'pizzeria-online-delivery' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'pizzeria_online_delivery_change_comment_form_defaults' );

if( ! function_exists( 'pizzeria_online_delivery_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function pizzeria_online_delivery_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
    /**
     * Triggered after the opening <body> tag.
    */
    do_action( 'wp_body_open' );
}
endif;

if ( ! function_exists( 'pizzeria_online_delivery_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function pizzeria_online_delivery_get_fallback_svg( $pizzeria_online_delivery_post_thumbnail ) {
    if( ! $pizzeria_online_delivery_post_thumbnail ){
        return;
    }
    
    $pizzeria_online_delivery_image_size = pizzeria_online_delivery_get_image_sizes( $pizzeria_online_delivery_post_thumbnail );
     
    if( $pizzeria_online_delivery_image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $pizzeria_online_delivery_image_size['width'] ); ?> <?php echo esc_attr( $pizzeria_online_delivery_image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $pizzeria_online_delivery_image_size['width'] ); ?>" height="<?php echo esc_attr( $pizzeria_online_delivery_image_size['height'] ); ?>" style="fill:#dedddd;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

function pizzeria_online_delivery_enqueue_google_fonts() {

    require get_template_directory() . '/inc/wptt-webfont-loader.php';

    wp_enqueue_style(
        'google-fonts-lato',
        pizzeria_online_delivery_wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap' ),
        array(),
        '1.0'
    );

    wp_enqueue_style(
        'google-fonts-lemon',
        pizzeria_online_delivery_wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Lemon&display=swap' ),
        array(),
        '1.0'
    );
}
add_action( 'wp_enqueue_scripts', 'pizzeria_online_delivery_enqueue_google_fonts' );


if( ! function_exists( 'pizzeria_online_delivery_site_branding' ) ) :
/**
 * Site Branding
*/
function pizzeria_online_delivery_site_branding(){
    $pizzeria_online_delivery_logo_site_title = get_theme_mod( 'header_site_title', 1 );
    $pizzeria_online_delivery_tagline = get_theme_mod( 'header_tagline', false );
    $pizzeria_online_delivery_logo_width = get_theme_mod('logo_width', 100); // Retrieve the logo width setting

    ?>
    <div class="site-branding" style="max-width: <?php echo esc_attr(get_theme_mod('logo_width', '-1'))?>px;">
        <?php 
        // Check if custom logo is set and display it
        if (function_exists('has_custom_logo') && has_custom_logo()) {
            the_custom_logo();
        }
        if ($pizzeria_online_delivery_logo_site_title):
             if (is_front_page()): ?>
            <h1 class="site-title" style="font-size: <?php echo esc_attr(get_theme_mod('pizzeria_online_delivery_site_title_size', '22')); ?>px;">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
          </h1>
            <?php else: ?>
                <p class="site-title" itemprop="name">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                </p>
            <?php endif; ?>
        <?php endif; 
    
        if ($pizzeria_online_delivery_tagline) :
            $pizzeria_online_delivery_description = get_bloginfo('description', 'display');
            if ($pizzeria_online_delivery_description || is_customize_preview()) :
        ?>
                <p class="site-description" itemprop="description"><?php echo $pizzeria_online_delivery_description; ?></p>
            <?php endif;
        endif;
        ?>
    </div>
    <?php
}
endif;
if( ! function_exists( 'pizzeria_online_delivery_navigation' ) ) :
    /**
     * Site Navigation
    */
    function pizzeria_online_delivery_navigation(){
        ?>
        <nav class="main-navigation" id="site-navigation" role="navigation">
            <?php 
            wp_nav_menu( array( 
                'theme_location' => 'primary', 
                'menu_id' => 'primary-menu' 
            ) ); 
            ?>
        </nav>
        <?php
    }
endif;

if( ! function_exists( 'pizzeria_online_delivery_header' ) ) :
    /**
     * Header Start
    */
    function pizzeria_online_delivery_header(){
        $pizzeria_online_delivery_header_image = get_header_image();
        $pizzeria_online_delivery_sticky_header = get_theme_mod('pizzeria_online_delivery_sticky_header');
        $pizzeria_online_delivery_header_setting     = get_theme_mod( 'pizzeria_online_delivery_header_setting', false );
        $pizzeria_online_delivery_header_btn_text     = get_theme_mod( 'pizzeria_online_delivery_header_btn_text' );
        $pizzeria_online_delivery_header_btn_url     = get_theme_mod( 'pizzeria_online_delivery_header_btn_url' );
        ?>
        <div id="page-site-header" class="main-header">
            <header id="masthead" class="site-header header-inner" role="banner">
                <div class="theme-menu head_bg" <?php echo $pizzeria_online_delivery_header_image != '' ? 'style="background-image: url(' . esc_url( $pizzeria_online_delivery_header_image ) . '); background-repeat: no-repeat; background-size: cover"': ""; ?> data-sticky="<?php echo esc_attr( $pizzeria_online_delivery_sticky_header ); ?>">
                    <div class="container">
                        <div class="row menu-bg py-2">
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12 align-self-center position-relative logo-div">
                                <?php pizzeria_online_delivery_site_branding(); ?>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-12 align-self-center theme-menu-bg site-header-img"  style="background-image: url('<?php echo esc_url( $pizzeria_online_delivery_header_image ); ?>');" role="banner">
                                <div class="row m-0">
                                    <div class="col-xl-9 col-lg-8 col-md-3 align-self-center">
                                        <?php pizzeria_online_delivery_navigation(); ?> 
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-9 align-self-center position-relative">
                                        <div class="d-flex justify-content-end align-items-center flex-wrap gap-4">
                                            <?php if( get_theme_mod('pizzeria_online_delivery_show_hide_search', false) ) { ?>
                                                <div class="search-body">
                                                    <button type="button" class="search-show">
                                                        <i class="<?php echo esc_attr(get_theme_mod('pizzeria_online_delivery_search_icon', 'fas fa-search')); ?>"></i>
                                                    </button>
                                                </div>
                                                <div class="searchform-inner">
                                                    <?php get_search_form(); ?>
                                                    <button 
                                                        type="button" 
                                                        class="close" 
                                                        aria-label="<?php esc_attr_e( 'Close', 'pizzeria-online-delivery' ); ?>"
                                                    >
                                                        <span aria-hidden="true">X</span>
                                                    </button>
                                                </div> 
                                            <?php } ?> 
                                            <?php if ( $pizzeria_online_delivery_header_btn_text ) { ?>
                                                <div class="menudiv-button">
                                                    <a href="<?php echo esc_url($pizzeria_online_delivery_header_btn_url); ?>">
                                                        <?php echo esc_html($pizzeria_online_delivery_header_btn_text); ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div> 
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>                 
            </header>
        </div>
        <?php
    }
endif;
add_action( 'pizzeria_online_delivery_header', 'pizzeria_online_delivery_header', 20 );
<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pizzeria_online_delivery
 */
$pizzeria_online_delivery_heading_setting  = get_theme_mod( 'pizzeria_online_delivery_post_heading_setting' , true );
$pizzeria_online_delivery_meta_setting  = get_theme_mod( 'pizzeria_online_delivery_post_meta_setting' , true );
$pizzeria_online_delivery_image_setting  = get_theme_mod( 'pizzeria_online_delivery_post_image_setting' , true );
$pizzeria_online_delivery_content_setting  = get_theme_mod( 'pizzeria_online_delivery_post_content_setting' , true );
$pizzeria_online_delivery_read_more_setting = get_theme_mod( 'pizzeria_online_delivery_read_more_setting' , true );
$pizzeria_online_delivery_read_more_text = get_theme_mod( 'pizzeria_online_delivery_read_more_text', __( 'Read More', 'pizzeria-online-delivery' ) );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php 
    $pizzeria_online_delivery_meta_order = get_theme_mod('pizzeria_online_delivery_blog_meta_order', array('heading', 'author', 'featured-image', 'content', 'button'));
    
    foreach ($pizzeria_online_delivery_meta_order as $pizzeria_online_delivery_order) :
        if ('heading' === $pizzeria_online_delivery_order) :
            if ($pizzeria_online_delivery_heading_setting) { ?>
                <header class="entry-header">
                    <?php if (is_single()) {
                        the_title('<h1 class="entry-title" itemprop="headline">', '</h1>');
                    } else {
                        the_title('<h2 class="entry-title" itemprop="headline"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    } ?>
                </header>
            <?php }
        endif;

        if ('author' === $pizzeria_online_delivery_order) :
            if ('post' === get_post_type() && $pizzeria_online_delivery_meta_setting) { ?>
                <div class="entry-meta">
                    <?php pizzeria_online_delivery_posted_on(); ?>
                </div>
            <?php }
        endif;

        if ('featured-image' === $pizzeria_online_delivery_order) :
            if ($pizzeria_online_delivery_image_setting) { ?>
                <?php echo (!is_single()) ? '<a href="' . esc_url(get_the_permalink()) . '" class="post-thumbnail wow fadeInUp" data-wow-delay="0.2s"">' : '<div class=" wow fadeInUp" data-wow-delay="0.2s">'; ?>
                    <?php if (has_post_thumbnail()) {
                        if (is_active_sidebar('right-sidebar')) {
                            the_post_thumbnail('pizzeria-online-delivery-with-sidebar', array('itemprop' => 'image'));
                        } else {
                            the_post_thumbnail('pizzeria-online-delivery-without-sidebar', array('itemprop' => 'image'));
                        }
                    } else { ?>
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/images/default.png'); ?>">
                    <?php } ?>
                <?php echo (!is_single()) ? '</a>' : '</div>'; ?>
            <?php }
        endif;

        if ('content' === $pizzeria_online_delivery_order) :
            if ($pizzeria_online_delivery_content_setting) { ?>
                <div class="entry-content" itemprop="text">
                    <?php if (is_single()) {
                        the_content(
                            sprintf(
                                wp_kses(
                                    __('Continue reading %s <span class="meta-nav">&rarr;</span>', 'pizzeria-online-delivery'),
                                    array('span' => array('class' => array()))
                                ),
                                '<span class="screen-reader-text">"' . get_the_title() . '"</span>'
                            )
                        );
                    } else {
                        the_excerpt();
                    }
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'pizzeria-online-delivery'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            <?php }
        endif;

        if ('button' === $pizzeria_online_delivery_order) :
            if (!is_single() && $pizzeria_online_delivery_read_more_setting) { ?>
                <div class="read-more-button">
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="read-more-button"><?php echo esc_html($pizzeria_online_delivery_read_more_text); ?></a>
                </div>
            <?php }
        endif;
    endforeach; ?>
</article>
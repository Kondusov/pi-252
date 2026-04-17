<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pizzeria_online_delivery
 */
$pizzeria_online_delivery_scroll_top  = get_theme_mod( 'pizzeria_online_delivery_scroll_to_top', true );
$pizzeria_online_delivery_footer_background = get_theme_mod('pizzeria_online_delivery_footer_background_image');
$pizzeria_online_delivery_footer_background_url = '';
if(!empty($pizzeria_online_delivery_footer_background)){
    $pizzeria_online_delivery_footer_background = absint($pizzeria_online_delivery_footer_background);
    $pizzeria_online_delivery_footer_background_url = wp_get_attachment_url($pizzeria_online_delivery_footer_background);
}

$pizzeria_online_delivery_footer_background_color = get_theme_mod('pizzeria_online_delivery_footer_background_color', '#000'); // New line

$pizzeria_online_delivery_footer_background_style = '';
if (!empty($pizzeria_online_delivery_footer_background_url)) {
    $pizzeria_online_delivery_footer_background_style = ' style="background-image: url(\'' . esc_url($pizzeria_online_delivery_footer_background_url) . '\'); background-repeat: no-repeat; background-size: cover;"';
} else {
    $pizzeria_online_delivery_footer_background_style = ' style="background-color: ' . esc_attr($pizzeria_online_delivery_footer_background_color) . ';"'; // Updated line
}
?>

</div>
</div>
</div>
</div>

<footer class="site-footer" <?php echo $pizzeria_online_delivery_footer_background_style; ?>>
    <?php 
    $pizzeria_online_delivery_active_areas = absint(get_theme_mod('pizzeria_online_delivery_footer_widget_areas', 4));

    if (
        is_active_sidebar('footer-1') ||
        is_active_sidebar('footer-2') ||
        is_active_sidebar('footer-3') ||
        is_active_sidebar('footer-4')
    ) : 
    ?>

    <div class="footer-t">
        <div class="container">
            <div class="row wow bounceInUp center delay-1000" data-wow-duration="2s">

            <?php
            $pizzeria_online_delivery_col = 12 / $pizzeria_online_delivery_active_areas;

            for ($pizzeria_online_delivery_i = 1; $pizzeria_online_delivery_i <= $pizzeria_online_delivery_active_areas; $pizzeria_online_delivery_i++) {

                if (is_active_sidebar('footer-' . $pizzeria_online_delivery_i)) {
            ?>

            <div class="col-xl-<?php echo esc_attr($pizzeria_online_delivery_col); ?> col-lg-<?php echo esc_attr($pizzeria_online_delivery_col); ?> col-md-6 col-sm-6">
                <?php dynamic_sidebar('footer-' . $pizzeria_online_delivery_i); ?>
            </div>

            <?php } } ?>

            </div>
        </div>
    </div>

    <?php else : ?>

    <!-- Default Footer Widgets -->

    <div class="footer-t">
        <div class="container">
            <div class="row wow bounceInUp center delay-1000" data-wow-duration="2s">

            <?php $pizzeria_online_delivery_col = 12 / $pizzeria_online_delivery_active_areas; ?>

            <!-- Archive -->
            <aside class="widget widget_archive col-xl-<?php echo esc_attr($pizzeria_online_delivery_col); ?> col-lg-<?php echo esc_attr($pizzeria_online_delivery_col); ?> col-md-6 col-sm-6">
                <h2 class="widget-title"><?php esc_html_e('Archive List', 'pizzeria-online-delivery'); ?></h2>
                <ul>
                    <?php wp_get_archives('type=monthly'); ?>
                </ul>
            </aside>

            <!-- Recent Posts -->
            <aside class="widget widget_recent_entries col-xl-<?php echo esc_attr($pizzeria_online_delivery_col); ?> col-lg-<?php echo esc_attr($pizzeria_online_delivery_col); ?> col-md-6 col-sm-6">
                <h2 class="widget-title"><?php esc_html_e('Recent Posts', 'pizzeria-online-delivery'); ?></h2>
                <ul>
                    <?php
                    $recent_posts = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 5
                    ));

                    while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
            </aside>

            <!-- Categories -->
            <aside class="widget widget_categories col-xl-<?php echo esc_attr($pizzeria_online_delivery_col); ?> col-lg-<?php echo esc_attr($pizzeria_online_delivery_col); ?> col-md-6 col-sm-6">
                <h2 class="widget-title"><?php esc_html_e('Categories', 'pizzeria-online-delivery'); ?></h2>
                <ul>
                    <?php wp_list_categories(array('title_li' => '')); ?>
                </ul>
            </aside>

            <!-- Tags -->
            <aside class="widget widget_tag_cloud col-xl-<?php echo esc_attr($pizzeria_online_delivery_col); ?> col-lg-<?php echo esc_attr($pizzeria_online_delivery_col); ?> col-md-6 col-sm-6">
                <h2 class="widget-title"><?php esc_html_e('Tags', 'pizzeria-online-delivery'); ?></h2>
                <div class="tagcloud">
                    <?php wp_tag_cloud(); ?>
                </div>
            </aside>

            </div>
        </div>
    </div>

    <?php endif; ?>


    <?php do_action('pizzeria_online_delivery_footer'); ?>

    <?php if ( get_theme_mod('pizzeria_online_delivery_enable_footer_icon_section', true) ) : ?>
        <div class="footer-social-icons text-center">
            <div class="container">
                <?php if ( get_theme_mod('pizzeria_online_delivery_footer_facebook_link', 'https://www.facebook.com/') != '' ) { ?>
                    <a target="_blank" href="<?php echo esc_url(get_theme_mod('pizzeria_online_delivery_footer_facebook_link', 'https://www.facebook.com/')); ?>">
                        <i class="<?php echo esc_attr(get_theme_mod('pizzeria_online_delivery_facebook_icon', 'fa-brands fa-facebook')); ?>"></i>
                        <span class="screen-reader-text"><?php esc_html_e('Facebook', 'pizzeria-online-delivery'); ?></span>
                    </a>
                <?php } ?>
                <?php if ( get_theme_mod('pizzeria_online_delivery_footer_twitter_link', 'https://twitter.com/') != '' ) { ?>
                    <a target="_blank" href="<?php echo esc_url(get_theme_mod('pizzeria_online_delivery_footer_twitter_link', 'https://x.com/')); ?>">
                        <i class="<?php echo esc_attr(get_theme_mod('pizzeria_online_delivery_twitter_icon', 'fa-brands fa-twitter')); ?>"></i>
                        <span class="screen-reader-text"><?php esc_html_e('Twitter', 'pizzeria-online-delivery'); ?></span>
                    </a>
                <?php } ?>
                <?php if ( get_theme_mod('pizzeria_online_delivery_footer_instagram_link', 'https://www.instagram.com/') != '' ) { ?>
                    <a target="_blank" href="<?php echo esc_url(get_theme_mod('pizzeria_online_delivery_footer_instagram_link', 'https://www.instagram.com/')); ?>">
                        <i class="<?php echo esc_attr(get_theme_mod('pizzeria_online_delivery_instagram_icon', 'fa-brands fa-instagram')); ?>"></i>
                        <span class="screen-reader-text"><?php esc_html_e('Instagram', 'pizzeria-online-delivery'); ?></span>
                    </a>
                <?php } ?>
                <?php if ( get_theme_mod('pizzeria_online_delivery_footer_linkedin_link', 'https://in.linkedin.com/') != '' ) { ?>
                    <a target="_blank" href="<?php echo esc_url(get_theme_mod('pizzeria_online_delivery_footer_linkedin_link', 'https://in.linkedin.com/')); ?>">
                        <i class="<?php echo esc_attr(get_theme_mod('pizzeria_online_delivery_linkedin_icon', 'fa-brands fa-linkedin')); ?>"></i>
                        <span class="screen-reader-text"><?php esc_html_e('Linkedin', 'pizzeria-online-delivery'); ?></span>
                    </a>
                <?php } ?>
                <?php if ( get_theme_mod('pizzeria_online_delivery_footer_youtube_link', 'https://www.youtube.com/') != '' ) { ?>
                    <a target="_blank" href="<?php echo esc_url(get_theme_mod('pizzeria_online_delivery_footer_youtube_link', 'https://www.youtube.com/')); ?>">
                        <i class="<?php echo esc_attr(get_theme_mod('pizzeria_online_delivery_youtube_icon', 'fa-brands fa-youtube')); ?>"></i>
                        <span class="screen-reader-text"><?php esc_html_e('Youtube', 'pizzeria-online-delivery'); ?></span>
                    </a>
                <?php } ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (get_theme_mod('pizzeria_online_delivery_scroll_top', true)) : ?>

    <a id="button">
        <i class="<?php echo esc_attr(get_theme_mod('pizzeria_online_delivery_scroll_icon', 'fas fa-arrow-up')); ?>"></i>
    </a>

    <?php endif; ?>

</footer>
</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
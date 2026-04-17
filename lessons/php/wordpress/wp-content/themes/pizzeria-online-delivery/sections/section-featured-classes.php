<?php
/**
 * Trending Products Section
 * 
 * @package pizzeria_online_delivery
 */

$pizzeria_online_delivery_classes = get_theme_mod('pizzeria_online_delivery_classes_setting', false);
$pizzeria_online_delivery_service_title = get_theme_mod('pizzeria_online_delivery_service_title');
$pizzeria_online_delivery_service_sub_title = get_theme_mod('pizzeria_online_delivery_service_sub_title');
$pizzeria_online_delivery_service_text = get_theme_mod('pizzeria_online_delivery_service_text');
$pizzeria_online_delivery_category_name = get_theme_mod('pizzeria_online_delivery_product_category');
?>

<?php if ($pizzeria_online_delivery_classes) : ?>
    <div class="our-products wow zoomInUp" data-wow-duration="2s">
        <div class="container">
            <div class="side-border">
                <?php if ($pizzeria_online_delivery_service_sub_title) : ?>
                    <h5><?php echo esc_html($pizzeria_online_delivery_service_sub_title); ?></h5>
                <?php endif; ?>
                <?php if ($pizzeria_online_delivery_service_title) : ?>
                    <h4><?php echo esc_html($pizzeria_online_delivery_service_title); ?></h4>
                <?php endif; ?>
                <?php if ($pizzeria_online_delivery_service_text) : ?>
                    <h3><?php echo esc_html($pizzeria_online_delivery_service_text); ?></h3>
                <?php endif; ?>
            </div>
            <?php if ($pizzeria_online_delivery_category_name && $pizzeria_online_delivery_category_name !== 'select' && class_exists('WooCommerce')) : ?>
                <div class="mt-3 owl-carousel">
                    <?php
                    $pizzeria_online_delivery_args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 4,
                        'ignore_sticky_posts' => true,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'slug',
                                'terms'    => $pizzeria_online_delivery_category_name,
                            ),
                        ),
                    );
                    $pizzeria_online_delivery_loop = new WP_Query($pizzeria_online_delivery_args);
                    if ($pizzeria_online_delivery_loop->have_posts()) :
                        while ($pizzeria_online_delivery_loop->have_posts()) : $pizzeria_online_delivery_loop->the_post();
                            global $product; ?>
                            <div class="box">
                                <div class="addcart">
                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                </div>
                                <div class="product-image-wrapper">
                                    <div class="product-img">
                                        <?php if (has_post_thumbnail()) :
                                            the_post_thumbnail('medium');
                                        else : ?>
                                            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/images/default.png'); ?>" alt="<?php esc_attr_e('Default', 'pizzeria-online-delivery'); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="product-details">
                                    <?php if (wc_review_ratings_enabled() && $product->get_average_rating()) : ?>
                                        <div class="rating">
                                            <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                                        </div>
                                    <?php endif; ?>
                                    <h6 class="product-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h6>
                                    <p>
                                        <?php echo wp_trim_words( get_the_content(), 13 ); ?>
                                    </p>
                                    <div class="price">
                                        <?php echo wp_kses_post($product->get_price_html()); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                    else : ?>
                        <p class="no-products"><?php esc_html_e('No products found.', 'pizzeria-online-delivery'); ?></p>
                    <?php endif;
                    wp_reset_postdata(); ?>
                </div>
            <?php else : ?>
                <p class="no-products text-center mt-3">
                    <?php esc_html_e('Please select a category in the Customizer.', 'pizzeria-online-delivery'); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

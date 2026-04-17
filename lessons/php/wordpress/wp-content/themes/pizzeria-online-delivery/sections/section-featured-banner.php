<?php
/**
 * Banner Section
 * 
 * @package pizzeria_online_delivery
 */

$pizzeria_online_delivery_slider = get_theme_mod( 'pizzeria_online_delivery_slider_setting', false );
$pizzeria_online_delivery_args   = array(
  'post_type'      => 'post',
  'post_status'    => 'publish',
  'category_name'  => get_theme_mod( 'pizzeria_online_delivery_blog_slide_category' ),
  'posts_per_page' => 6,
); ?>

<?php if ( $pizzeria_online_delivery_slider ) { ?>
  <div class="banner-main">
    <div class="test">
        <div class="owl-carousel banner-slider">
            <?php
            $pizzeria_online_delivery_arr_posts = new WP_Query( $pizzeria_online_delivery_args );

            if ( $pizzeria_online_delivery_arr_posts->have_posts() ) :
                while ( $pizzeria_online_delivery_arr_posts->have_posts() ) :
                    $pizzeria_online_delivery_arr_posts->the_post();
            ?>
            <div class="item">
                <div class="row align-items-center">
                    <div class="col-xl-7 col-lg-6 col-md-6 col-12">
                        <div class="container">
                            <div class="banner_box">
                                <div class="img-content">
                                    <?php if ( get_theme_mod('pizzeria_online_delivery_slider_text_extra') ) : ?>
                                        <p class="slide-extra-head"><?php echo esc_html(get_theme_mod('pizzeria_online_delivery_slider_text_extra')); ?></p>
                                    <?php endif; ?>
                                    <h3 class="my-1">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <p class="mb-0">
                                        <?php echo wp_trim_words( get_the_content(), 50 ); ?>
                                    </p>
                                </div>
                                <?php if ( get_theme_mod( 'pizzeria_online_delivery_slider_btn_text' ) ) : ?>
                                    <div class="slide-btn-green mt-4">
                                        <a href="<?php echo esc_url( get_theme_mod( 'pizzeria_online_delivery_slider_btn_url' ) ); ?>">
                                            <?php echo esc_html( get_theme_mod( 'pizzeria_online_delivery_slider_btn_text' ) ); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-6 col-12 banner_inner_box_img p-0 wow zoomIn" data-wow-duration="2s">
                        <div class="single-slide">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail(); ?>
                            <?php else: ?>
                                <div class="banner_inner_box">
                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/default1.png' ); ?>" alt="<?php esc_attr_e('Image', 'pizzeria-online-delivery'); ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
  </div>
<?php } ?>
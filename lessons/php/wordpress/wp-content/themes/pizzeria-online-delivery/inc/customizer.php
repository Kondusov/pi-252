<?php
/**
 * Pizzeria Online Delivery Theme Customizer.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pizzeria_online_delivery
 */

if( ! function_exists( 'pizzeria_online_delivery_customize_register' ) ):  
/**
 * Add postMessage support for site title and description for the Theme Customizer.F
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pizzeria_online_delivery_customize_register( $wp_customize ) {
    require get_parent_theme_file_path('/inc/controls/changeable-icon.php');

    require get_parent_theme_file_path('/inc/controls/sortable-control.php');
    
    //Register the sortable control type.
    $wp_customize->register_control_type( 'Pizzeria_Online_Delivery_Control_Sortable' ); 
    

    if ( version_compare( get_bloginfo('version'),'4.9', '>=') ) {
        $wp_customize->get_section( 'static_front_page' )->title = __( 'Static Front Page', 'pizzeria-online-delivery' );
    }
	
    /* Option list of all post */	
    $pizzeria_online_delivery_options_posts = array();
    $pizzeria_online_delivery_options_posts_obj = get_posts('posts_per_page=-1');
    $pizzeria_online_delivery_options_posts[''] = esc_html__( 'Choose Post', 'pizzeria-online-delivery' );
    foreach ( $pizzeria_online_delivery_options_posts_obj as $pizzeria_online_delivery_posts ) {
    	$pizzeria_online_delivery_options_posts[$pizzeria_online_delivery_posts->ID] = $pizzeria_online_delivery_posts->post_title;
    }
    
    /* Option list of all categories */
    $pizzeria_online_delivery_args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $pizzeria_online_delivery_option_categories = array();
    $pizzeria_online_delivery_category_lists = get_categories( $pizzeria_online_delivery_args );
    $pizzeria_online_delivery_option_categories[''] = esc_html__( 'Choose Category', 'pizzeria-online-delivery' );
    foreach( $pizzeria_online_delivery_category_lists as $pizzeria_online_delivery_category ){
        $pizzeria_online_delivery_option_categories[$pizzeria_online_delivery_category->term_id] = $pizzeria_online_delivery_category->name;
    }
    
    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Default Settings', 'pizzeria-online-delivery' ),
            'description' => esc_html__( 'Default section provided by wordpress customizer.', 'pizzeria-online-delivery' ),
        ) 
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel                  = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel                         = 'wp_default_panel';
    $wp_customize->get_section( 'header_image' )->panel                   = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel               = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel              = 'wp_default_panel';
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    /** Default Settings Ends */
    
    /** Site Title control */
    $wp_customize->add_setting( 
        'header_site_title', 
        array(
            'default'           => true,
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'header_site_title',
        array(
            'label'       => __( 'Show / Hide Site Title', 'pizzeria-online-delivery' ),
            'section'     => 'title_tagline',
            'type'        => 'checkbox',
        )
    );

    /** Tagline control */
    $wp_customize->add_setting( 
        'header_tagline', 
        array(
            'default'           => false,
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'header_tagline',
        array(
            'label'       => __( 'Show / Hide Tagline', 'pizzeria-online-delivery' ),
            'section'     => 'title_tagline',
            'type'        => 'checkbox',
        )
    );

    $wp_customize->add_setting('logo_width', array(
        'sanitize_callback' => 'absint', 
    ));

    // Add a control for logo width
    $wp_customize->add_control('logo_width', array(
        'label' => __('Logo Width', 'pizzeria-online-delivery'),
        'section' => 'title_tagline',
        'type' => 'number',
        'input_attrs' => array(
            'min' => '50', 
            'max' => '500', 
            'step' => '5', 
    ),
        'default' => '100', 
    ));

    $wp_customize->add_setting( 'pizzeria_online_delivery_site_title_size', array(
        'default'           => 22, // Default font size in pixels
        'sanitize_callback' => 'absint', // Sanitize the input as a positive integer
    ) );

    // Add control for site title size
    $wp_customize->add_control( 'pizzeria_online_delivery_site_title_size', array(
        'type'        => 'number',
        'section'     => 'title_tagline', // You can change this section to your preferred section
        'label'       => __( 'Site Title Font Size (px)', 'pizzeria-online-delivery' ),
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 100,
            'step' => 1,
        ),
    ) );

    /** Post & Pages Settings */
    $wp_customize->add_panel( 
        'pizzeria_online_delivery_post_settings',
         array(
            'priority' => 11,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'Post & Pages Settings', 'pizzeria-online-delivery' ),
            'description' => esc_html__( 'Customize Post & Pages Settings', 'pizzeria-online-delivery' ),
        ) 
    );

        /** Post Layouts */
    
    $wp_customize->add_section(
        'pizzeria_online_delivery_post_layout_section',
        array(
            'title' => esc_html__( 'Post Layout Settings', 'pizzeria-online-delivery' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'pizzeria_online_delivery_post_settings',
        )
    );

    $wp_customize->add_setting('pizzeria_online_delivery_post_layout_setting', array(
        'default'           => 'right-sidebar',
        'sanitize_callback' => 'pizzeria_online_delivery_sanitize_post_layout',
    ));

    $wp_customize->add_control('pizzeria_online_delivery_post_layout_setting', array(
        'label'    => __('Post Column Settings', 'pizzeria-online-delivery'),
        'section'  => 'pizzeria_online_delivery_post_layout_section',
        'settings' => 'pizzeria_online_delivery_post_layout_setting',
        'type'     => 'select',
        'choices'  => array(
            'one-column'   => __('One Column', 'pizzeria-online-delivery'),
            'right-sidebar'   => __('Right Sidebar', 'pizzeria-online-delivery'),
            'left-sidebar'   => __('Left Sidebar', 'pizzeria-online-delivery'),
            'three-column'   => __('Three Columns', 'pizzeria-online-delivery'),
            'four-column'   => __('Four Columns', 'pizzeria-online-delivery'),
            'grid-layout'   => __('Grid Layout', 'pizzeria-online-delivery')
        ),
    ));

     /** Post Layouts Ends */

    /** Blog Content Alignment */
    $wp_customize->add_setting('pizzeria_online_delivery_blog_layout_option', array(
        'default'           => 'Left',
        'sanitize_callback' => 'pizzeria_online_delivery_sanitize_choices',
    ));

    $wp_customize->add_control('pizzeria_online_delivery_blog_layout_option', array(
        'label'    => __('Post Content Alignment', 'pizzeria-online-delivery'),
        'section'  => 'pizzeria_online_delivery_post_layout_section',
        'settings' => 'pizzeria_online_delivery_blog_layout_option',
        'type'     => 'select',
        'choices'  => array(
		   'Left'     => __('Left', 'pizzeria-online-delivery'),
		   'Center'     => __('Center', 'pizzeria-online-delivery'),
		   'Right'     => __('Right', 'pizzeria-online-delivery'),
        ),
    ));
     
    /** Post Settings */
    $wp_customize->add_section(
        'pizzeria_online_delivery_post_settings',
        array(
            'title' => esc_html__( 'Post Settings', 'pizzeria-online-delivery' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'pizzeria_online_delivery_post_settings',
        )
    );

    /** Post Heading control */
    $wp_customize->add_setting( 
        'pizzeria_online_delivery_post_heading_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_post_heading_setting',
        array(
            'label'       => __( 'Show / Hide Post Heading', 'pizzeria-online-delivery' ),
            'section'     => 'pizzeria_online_delivery_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Meta control */
    $wp_customize->add_setting( 
        'pizzeria_online_delivery_post_meta_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_post_meta_setting',
        array(
            'label'       => __( 'Show / Hide Post Meta', 'pizzeria-online-delivery' ),
            'section'     => 'pizzeria_online_delivery_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Image control */
    $wp_customize->add_setting( 
        'pizzeria_online_delivery_post_image_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_post_image_setting',
        array(
            'label'       => __( 'Show / Hide Post Image', 'pizzeria-online-delivery' ),
            'section'     => 'pizzeria_online_delivery_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Content control */
    $wp_customize->add_setting( 
        'pizzeria_online_delivery_post_content_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_post_content_setting',
        array(
            'label'       => __( 'Show / Hide Post Content', 'pizzeria-online-delivery' ),
            'section'     => 'pizzeria_online_delivery_post_settings',
            'type'        => 'checkbox',
        )
    );
    /** Post ReadMore control */
     $wp_customize->add_setting( 'pizzeria_online_delivery_read_more_setting', array(
        'default'           => true,
        'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'pizzeria_online_delivery_read_more_setting', array(
        'type'        => 'checkbox',
        'section'     => 'pizzeria_online_delivery_post_settings', 
        'label'       => __( 'Display Read More Button', 'pizzeria-online-delivery' ),
    ) );

    $wp_customize->add_setting('pizzeria_online_delivery_blog_meta_order', array(
        'default' => array('heading', 'author', 'featured-image', 'content','button'),
        'sanitize_callback' => 'pizzeria_online_delivery_sanitize_sortable',
    ));
    $wp_customize->add_control(new Pizzeria_Online_Delivery_Control_Sortable($wp_customize, 'pizzeria_online_delivery_blog_meta_order', array(
        'label' => esc_html__('Post Meta Ordering', 'pizzeria-online-delivery'),
        'description' => __('Drag & drop post items to rearrange the ordering ( this control will not function by post format )', 'pizzeria-online-delivery') ,
        'section' => 'pizzeria_online_delivery_post_settings',
        'choices' => array(
            'heading' => __('heading', 'pizzeria-online-delivery') ,
            'author' => __('author', 'pizzeria-online-delivery') ,
            'featured-image' => __('featured-image', 'pizzeria-online-delivery') ,
            'content' => __('content', 'pizzeria-online-delivery') ,
            'button' => __('button', 'pizzeria-online-delivery') ,
        ) ,
    )));

    /** Post Settings Ends */

     /** Single Post Settings */
    $wp_customize->add_section(
        'pizzeria_online_delivery_single_post_settings',
        array(
            'title' => esc_html__( 'Single Post Settings', 'pizzeria-online-delivery' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'pizzeria_online_delivery_post_settings',
        )
    );

    /** Single Post Meta control */
    $wp_customize->add_setting( 
        'pizzeria_online_delivery_single_post_meta_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_single_post_meta_setting',
        array(
            'label'       => __( 'Show / Hide Single Post Meta', 'pizzeria-online-delivery' ),
            'section'     => 'pizzeria_online_delivery_single_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Single Post Content control */
    $wp_customize->add_setting( 
        'pizzeria_online_delivery_single_post_content_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_single_post_content_setting',
        array(
            'label'       => __( 'Show / Hide Single Post Content', 'pizzeria-online-delivery' ),
            'section'     => 'pizzeria_online_delivery_single_post_settings',
            'type'        => 'checkbox',
        )
    );

    //Global Color
    $wp_customize->add_section(
        'pizzeria_online_delivery_global_color',
        array(
            'title' => esc_html__( 'Global Color Settings', 'pizzeria-online-delivery' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'pizzeria_online_delivery_general_settings',
        )
    );

    $wp_customize->add_setting('pizzeria_online_delivery_primary_color', array(
        'default'           => '#F5353A',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pizzeria_online_delivery_primary_color', array(
        'label'    => __('Theme Primary Color', 'pizzeria-online-delivery'),
        'section'  => 'pizzeria_online_delivery_global_color',
        'settings' => 'pizzeria_online_delivery_primary_color',
    )));    

    $wp_customize->add_setting('pizzeria_online_delivery_second_color', array(
        'default'           => '#766F6D',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pizzeria_online_delivery_second_color', array(
        'label'    => __('Theme Secondary Color', 'pizzeria-online-delivery'),
        'section'  => 'pizzeria_online_delivery_global_color',
        'settings' => 'pizzeria_online_delivery_second_color',
    )));

    /** Single Post Settings Ends */

         // Typography Settings Section
    $wp_customize->add_section('pizzeria_online_delivery_typography_settings', array(
        'title'      => esc_html__('Typography Settings', 'pizzeria-online-delivery'),
        'priority'   => 30,
        'capability' => 'edit_theme_options',
        'panel' => 'pizzeria_online_delivery_general_settings',
    ));

    // Array of fonts to choose from
    $font_choices = array(
        ''               => __('Select', 'pizzeria-online-delivery'),
        'Arial'          => 'Arial, sans-serif',
        'Verdana'        => 'Verdana, sans-serif',
        'Helvetica'      => 'Helvetica, sans-serif',
        'Times New Roman'=> '"Times New Roman", serif',
        'Georgia'        => 'Georgia, serif',
        'Courier New'    => '"Courier New", monospace',
        'Trebuchet MS'   => '"Trebuchet MS", sans-serif',
        'Tahoma'         => 'Tahoma, sans-serif',
        'Palatino'       => '"Palatino Linotype", serif',
        'Garamond'       => 'Garamond, serif',
        'Impact'         => 'Impact, sans-serif',
        'Comic Sans MS'  => '"Comic Sans MS", cursive, sans-serif',
        'Lucida Sans'    => '"Lucida Sans Unicode", sans-serif',
        'Arial Black'    => '"Arial Black", sans-serif',
        'Gill Sans'      => '"Gill Sans", sans-serif',
        'Segoe UI'       => '"Segoe UI", sans-serif',
        'Open Sans'      => '"Open Sans", sans-serif',
        'Inter'         => 'Inter, sans-serif',
        'Lato'           => 'Lato, sans-serif',
        'Lemon'           => 'Lemon, serif',
        'Montserrat'     => 'Montserrat, sans-serif',
        'Libre Baskerville' => 'Libre Baskerville',
    );

    // Heading Font Setting
    $wp_customize->add_setting('pizzeria_online_delivery_heading_font_family', array(
        'default'           => '',
        'sanitize_callback' => 'pizzeria_online_delivery_sanitize_choicess',
    ));
    $wp_customize->add_control('pizzeria_online_delivery_heading_font_family', array(
        'type'    => 'select',
        'choices' => $font_choices,
        'label'   => __('Select Font for Heading', 'pizzeria-online-delivery'),
        'section' => 'pizzeria_online_delivery_typography_settings',
    ));

    // Body Font Setting
    $wp_customize->add_setting('pizzeria_online_delivery_body_font_family', array(
        'default'           => '',
        'sanitize_callback' => 'pizzeria_online_delivery_sanitize_choicess',
    ));
    $wp_customize->add_control('pizzeria_online_delivery_body_font_family', array(
        'type'    => 'select',
        'choices' => $font_choices,
        'label'   => __('Select Font for Body', 'pizzeria-online-delivery'),
        'section' => 'pizzeria_online_delivery_typography_settings',
    ));

    /** Typography Settings Section End */

    /** General Settings */
    $wp_customize->add_panel( 
        'pizzeria_online_delivery_general_settings',
         array(
            'priority' => 11,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'General Settings', 'pizzeria-online-delivery' ),
            'description' => esc_html__( 'Customize General Settings', 'pizzeria-online-delivery' ),
        ) 
    );

    /** General Settings */
    $wp_customize->add_section(
        'pizzeria_online_delivery_general_settings',
        array(
            'title' => esc_html__( 'Loader Settings', 'pizzeria-online-delivery' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'pizzeria_online_delivery_general_settings',
        )
    );

    /** Preloader control */
    $wp_customize->add_setting( 
        'pizzeria_online_delivery_header_preloader', 
        array(
            'default' => false,
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_header_preloader',
        array(
            'label'       => __( 'Show Preloader', 'pizzeria-online-delivery' ),
            'section'     => 'pizzeria_online_delivery_general_settings',
            'type'        => 'checkbox',
        )
    );

    $wp_customize->add_setting('pizzeria_online_delivery_loader_layout_setting', array(
        'default' => 'load',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add control for loader layout
    $wp_customize->add_control('pizzeria_online_delivery_loader_layout_control', array(
        'label' => __('Preloader Layout', 'pizzeria-online-delivery'),
        'section' => 'pizzeria_online_delivery_general_settings',
        'settings' => 'pizzeria_online_delivery_loader_layout_setting',
        'type' => 'select',
        'choices' => array(
            'load' => __('Preloader 1', 'pizzeria-online-delivery'),
            'load-one' => __('Preloader 2', 'pizzeria-online-delivery'),
            'ctn-preloader' => __('Preloader 3', 'pizzeria-online-delivery'),
        ),
    ));

    /** Header Section Settings */
    $wp_customize->add_section(
        'pizzeria_online_delivery_header_section_settings',
        array(
            'title' => esc_html__( 'Header Section Settings', 'pizzeria-online-delivery' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'pizzeria_online_delivery_home_page_settings',
        )
    );

    /** Sticky Header control */
    $wp_customize->add_setting( 
        'pizzeria_online_delivery_sticky_header', 
        array(
            'default' => false,
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_sticky_header',
        array(
            'label'       => __( 'Show Sticky Header', 'pizzeria-online-delivery' ),
            'section'     => 'pizzeria_online_delivery_header_section_settings',
            'type'        => 'checkbox',
        )
    );

    $wp_customize->add_setting( 
        'pizzeria_online_delivery_show_hide_search', 
        array(
            'default' => false ,
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_show_hide_search',
        array(
            'label'       => __( 'Show Search Icon', 'pizzeria-online-delivery' ),
            'section'     => 'pizzeria_online_delivery_header_section_settings',
            'type'        => 'checkbox',
        )
    );
    $wp_customize->add_setting('pizzeria_online_delivery_search_icon',array(
        'default'   => 'fas fa-search',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Pizzeria_Online_Delivery_Changeable_Icon(
        $wp_customize,'pizzeria_online_delivery_search_icon',array(
        'label' => __('Search Icon','pizzeria-online-delivery'),
        'transport' => 'refresh',
        'section'   => 'pizzeria_online_delivery_header_section_settings',
        'type'      => 'icon'
    )));

    $wp_customize->add_setting(
        'pizzeria_online_delivery_header_btn_text',
        array( 
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'pizzeria_online_delivery_header_btn_text',
        array(
            'label' => esc_html__( 'Add Button Text', 'pizzeria-online-delivery' ),
            'section' => 'pizzeria_online_delivery_header_section_settings',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'pizzeria_online_delivery_header_btn_url',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'pizzeria_online_delivery_header_btn_url',
        array(
            'label' => esc_html__( 'Add Button URL', 'pizzeria-online-delivery' ),
            'section' => 'pizzeria_online_delivery_header_section_settings',
            'type' => 'url',
        )
    );

    // Add Setting for Menu Font Weight
    $wp_customize->add_setting( 'pizzeria_online_delivery_menu_font_weight', array(
        'default'           => '700',
        'sanitize_callback' => 'pizzeria_online_delivery_sanitize_font_weight',
    ) );

    // Add Control for Menu Font Weight
    $wp_customize->add_control( 'pizzeria_online_delivery_menu_font_weight', array(
        'label'    => __( 'Menu Font Weight', 'pizzeria-online-delivery' ),
        'section'  => 'pizzeria_online_delivery_header_section_settings',
        'type'     => 'select',
        'choices'  => array(
            '100' => __( '100 - Thin', 'pizzeria-online-delivery' ),
            '200' => __( '200 - Extra Light', 'pizzeria-online-delivery' ),
            '300' => __( '300 - Light', 'pizzeria-online-delivery' ),
            '400' => __( '400 - Normal', 'pizzeria-online-delivery' ),
            '500' => __( '500 - Medium', 'pizzeria-online-delivery' ),
            '600' => __( '600 - Semi Bold', 'pizzeria-online-delivery' ),
            '700' => __( '700 - Bold', 'pizzeria-online-delivery' ),
            '800' => __( '800 - Extra Bold', 'pizzeria-online-delivery' ),
            '900' => __( '900 - Black', 'pizzeria-online-delivery' ),
        ),
    ) );

    // Add Setting for Menu Text Transform
    $wp_customize->add_setting( 'pizzeria_online_delivery_menu_text_transform', array(
        'default'           => 'capitalize',
        'sanitize_callback' => 'pizzeria_online_delivery_sanitize_text_transform',
    ) );

    // Add Control for Menu Text Transform
    $wp_customize->add_control( 'pizzeria_online_delivery_menu_text_transform', array(
        'label'    => __( 'Menu Text Transform', 'pizzeria-online-delivery' ),
        'section'  => 'pizzeria_online_delivery_header_section_settings',
        'type'     => 'select',
        'choices'  => array(
            'none'       => __( 'None', 'pizzeria-online-delivery' ),
            'capitalize' => __( 'Capitalize', 'pizzeria-online-delivery' ),
            'uppercase'  => __( 'Uppercase', 'pizzeria-online-delivery' ),
            'lowercase'  => __( 'Lowercase', 'pizzeria-online-delivery' ),
        ),
    ) );

    // Menu Hover Style	
    $wp_customize->add_setting('pizzeria_online_delivery_menus_style',array(
        'default' => '',
        'sanitize_callback' => 'pizzeria_online_delivery_sanitize_choices'
	));
	$wp_customize->add_control('pizzeria_online_delivery_menus_style',array(
        'type' => 'select',
		'label' => __('Menu Hover Style','pizzeria-online-delivery'),
		'section' => 'pizzeria_online_delivery_header_section_settings',
		'choices' => array(
         'None' => __('None','pizzeria-online-delivery'),
         'Zoom In' => __('Zoom In','pizzeria-online-delivery'),
      ),
	));

    $wp_customize->add_setting( 
        'pizzeria_online_delivery_header_settings_upgraded_features',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'pizzeria_online_delivery_header_settings_upgraded_features', 
        array(
            'type'=> 'hidden',
            'description' => "
                <div class='notice-pro-features'>
                    <div class='notice-pro-icon'>
                        <i class='fas fa-crown'></i>
                    </div>
                    <div class='notice-pro-content'>
                        <h3>Unlock Premium Features</h3>
                        <p>Enhance your website with advanced layouts, premium sections, and powerful customization tools.</p>
                    </div>
                    <div class='notice-pro-button'>
                        <a target='_blank' href='". esc_url(PIZZERIA_ONLINE_DELIVERY_URL) ."' class='notice-upgrade-btn'>
                            Upgrade to Pro<i class='fas fa-rocket'></i>
                        </a>
                    </div>
                </div>
            ",
            'section' => 'pizzeria_online_delivery_header_section_settings'
        )
    );

    /** Home Page Settings */
    $wp_customize->add_panel( 
        'pizzeria_online_delivery_home_page_settings',
         array(
            'priority' => 9,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'Home Page Settings', 'pizzeria-online-delivery' ),
            'description' => esc_html__( 'Customize Home Page Settings', 'pizzeria-online-delivery' ),
        ) 
    );

    /** Slider Section Settings */
    $wp_customize->add_section(
        'pizzeria_online_delivery_slider_section_settings',
        array(
            'title' => esc_html__( 'Slider Section Settings', 'pizzeria-online-delivery' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'pizzeria_online_delivery_home_page_settings',
        )
    );

    /** Slider Section control */
    $wp_customize->add_setting( 
        'pizzeria_online_delivery_slider_setting', 
        array(
            'default' => false,
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_slider_setting',
        array(
            'label'       => __( 'Show Slider', 'pizzeria-online-delivery' ),
            'section'     => 'pizzeria_online_delivery_slider_section_settings',
            'type'        => 'checkbox',
        )
    );

    // Section Text
    $wp_customize->add_setting('pizzeria_online_delivery_slider_text_extra', 
        array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',    
        'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('pizzeria_online_delivery_slider_text_extra', 
        array(
        'label'       => __('Slider Extra Title', 'pizzeria-online-delivery'),
        'section'     => 'pizzeria_online_delivery_slider_section_settings',   
        'settings'    => 'pizzeria_online_delivery_slider_text_extra',
        'type'        => 'text'
        )
    );

    $pizzeria_online_delivery_categories = get_categories();
        $pizzeria_online_delivery_cat_posts = array();
            $pizzeria_online_delivery_i = 0;
            $pizzeria_online_delivery_cat_posts[]='Select';
        foreach($pizzeria_online_delivery_categories as $pizzeria_online_delivery_category){
            if($pizzeria_online_delivery_i==0){
            $pizzeria_online_delivery_default = $pizzeria_online_delivery_category->slug;
            $pizzeria_online_delivery_i++;
        }
        $pizzeria_online_delivery_cat_posts[$pizzeria_online_delivery_category->slug] = $pizzeria_online_delivery_category->name;
    }

    $wp_customize->add_setting(
        'pizzeria_online_delivery_blog_slide_category',
        array(
            'default'   => 'select',
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_choices',
        )
    );
    $wp_customize->add_control(
        'pizzeria_online_delivery_blog_slide_category',
        array(
            'type'    => 'select',
            'choices' => $pizzeria_online_delivery_cat_posts,
            'label' => __('Select Category to display Latest Post','pizzeria-online-delivery'),
            'section' => 'pizzeria_online_delivery_slider_section_settings',
        )
    );

    // slider button Text
    $wp_customize->add_setting('pizzeria_online_delivery_slider_btn_text', 
        array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',    
        'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('pizzeria_online_delivery_slider_btn_text', 
        array(
        'label'       => __('Slider Button Text', 'pizzeria-online-delivery'),
        'section'     => 'pizzeria_online_delivery_slider_section_settings',   
        'settings'    => 'pizzeria_online_delivery_slider_btn_text',
        'type'        => 'text'
        )
    );

    // slider button Url
    $wp_customize->add_setting('pizzeria_online_delivery_slider_btn_url', 
        array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',    
        'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control('pizzeria_online_delivery_slider_btn_url', 
        array(
        'label'       => __('Slider Button URL', 'pizzeria-online-delivery'),
        'section'     => 'pizzeria_online_delivery_slider_section_settings',   
        'settings'    => 'pizzeria_online_delivery_slider_btn_url',
        'type'        => 'url'
        )
    );

    $wp_customize->add_setting( 
        'pizzeria_online_delivery_slider_settings_upgraded_features',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'pizzeria_online_delivery_slider_settings_upgraded_features', 
        array(
            'type'=> 'hidden',
            'description' => "
                <div class='notice-pro-features'>
                    <div class='notice-pro-icon'>
                        <i class='fas fa-crown'></i>
                    </div>
                    <div class='notice-pro-content'>
                        <h3>Unlock Premium Features</h3>
                        <p>Enhance your website with advanced layouts, premium sections, and powerful customization tools.</p>
                    </div>
                    <div class='notice-pro-button'>
                        <a target='_blank' href='". esc_url(PIZZERIA_ONLINE_DELIVERY_URL) ."' class='notice-upgrade-btn'>
                            Upgrade to Pro<i class='fas fa-rocket'></i>
                        </a>
                    </div>
                </div>
            ",
            'section' => 'pizzeria_online_delivery_slider_section_settings'
        )
    );

   /** Product Section Start */

   $wp_customize->add_section(
        'pizzeria_online_delivery_classes_section_settings',
        array(
            'title' => esc_html__( 'Product Section Settings', 'pizzeria-online-delivery' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'pizzeria_online_delivery_home_page_settings',
        )
    );

    $wp_customize->add_setting( 
        'pizzeria_online_delivery_classes_setting', 
        array(
            'default' => false,
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_classes_setting',
        array(
            'label'       => __( 'Show Product Section', 'pizzeria-online-delivery' ),
            'section'     => 'pizzeria_online_delivery_classes_section_settings',
            'type'        => 'checkbox',
        )
    );

    // Section Sub Title
    $wp_customize->add_setting(
        'pizzeria_online_delivery_service_sub_title', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_service_sub_title', 
        array(
            'label'       => __('Section Sub Title', 'pizzeria-online-delivery'),
            'section'     => 'pizzeria_online_delivery_classes_section_settings',
            'settings'    => 'pizzeria_online_delivery_service_sub_title',
            'type'        => 'text'
        )
    );

    // Section Title
    $wp_customize->add_setting(
        'pizzeria_online_delivery_service_title', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_service_title', 
        array(
            'label'       => __('Section Title', 'pizzeria-online-delivery'),
            'section'     => 'pizzeria_online_delivery_classes_section_settings',
            'settings'    => 'pizzeria_online_delivery_service_title',
            'type'        => 'text'
        )
    );

    // Section Text
    $wp_customize->add_setting(
        'pizzeria_online_delivery_service_text', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_service_text', 
        array(
            'label'       => __('Section Text', 'pizzeria-online-delivery'),
            'section'     => 'pizzeria_online_delivery_classes_section_settings',
            'settings'    => 'pizzeria_online_delivery_service_text',
            'type'        => 'text'
        )
    );

    // Default category list
    $pizzeria_online_delivery_cat_posts = array( 'select' => __( 'Select', 'pizzeria-online-delivery' ) );

    // Only get WooCommerce product categories if WooCommerce is active
    if ( class_exists( 'WooCommerce' ) ) {
        $categories = get_terms( array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
        ) );

        if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
            foreach ( $categories as $category ) {
                if ( isset( $category->slug, $category->name ) ) {
                    $pizzeria_online_delivery_cat_posts[ $category->slug ] = $category->name;
                }
            }
        }
    }

    // Add dropdown for selecting one category
    $wp_customize->add_setting(
        'pizzeria_online_delivery_product_category',
        array(
            'default'           => 'select',
            'sanitize_callback' => 'pizzeria_online_delivery_sanitize_choices',
        )
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_product_category',
        array(
            'type'     => 'select',
            'choices'  => $pizzeria_online_delivery_cat_posts,
            'label'    => __( 'Select Category to Display Products', 'pizzeria-online-delivery' ),
            'section'  => 'pizzeria_online_delivery_classes_section_settings',
        )
    );

    $wp_customize->add_setting( 
        'pizzeria_online_delivery_product_settings_upgraded_features',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'pizzeria_online_delivery_product_settings_upgraded_features', 
        array(
            'type'=> 'hidden',
            'description' => "
                <div class='notice-pro-features'>
                    <div class='notice-pro-icon'>
                        <i class='fas fa-crown'></i>
                    </div>
                    <div class='notice-pro-content'>
                        <h3>Unlock Premium Features</h3>
                        <p>Enhance your website with advanced layouts, premium sections, and powerful customization tools.</p>
                    </div>
                    <div class='notice-pro-button'>
                        <a target='_blank' href='". esc_url(PIZZERIA_ONLINE_DELIVERY_URL) ."' class='notice-upgrade-btn'>
                            Upgrade to Pro<i class='fas fa-rocket'></i>
                        </a>
                    </div>
                </div>
            ",
            'section' => 'pizzeria_online_delivery_classes_section_settings'
        )
    );

    /** Product Section End */
    
    /** Home Page Settings Ends */
    
    /** Footer Section */
    $wp_customize->add_section(
        'pizzeria_online_delivery_footer_section',
        array(
            'title' => __( 'Footer Settings', 'pizzeria-online-delivery' ),
            'priority' => 70,
            'panel' => 'pizzeria_online_delivery_home_page_settings',
        )
    );

    /** Footer Widget Columns */
    $wp_customize->add_setting('pizzeria_online_delivery_footer_widget_areas', array(
        'default'           => 4,
        'sanitize_callback' => 'pizzeria_online_delivery_sanitize_choices',
    ));

    $wp_customize->add_control('pizzeria_online_delivery_footer_widget_areas', array(
        'label'    => __('Footer Widget Columns', 'pizzeria-online-delivery'),
        'section'  => 'pizzeria_online_delivery_footer_section',
        'settings' => 'pizzeria_online_delivery_footer_widget_areas',
        'type'     => 'select',
        'choices'  => array(
            '1' => __('One', 'pizzeria-online-delivery'),
            '2' => __('Two', 'pizzeria-online-delivery'),
            '3' => __('Three', 'pizzeria-online-delivery'),
            '4' => __('Four', 'pizzeria-online-delivery'),
        ),
    ));
    
    /** Copyright Text */
    $wp_customize->add_setting(
        'pizzeria_online_delivery_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'pizzeria_online_delivery_footer_copyright_text',
        array(
            'label' => __( 'Copyright Info', 'pizzeria-online-delivery' ),
            'section' => 'pizzeria_online_delivery_footer_section',
            'type' => 'text',
        )
    );  
$wp_customize->add_setting('pizzeria_online_delivery_footer_background_image',
        array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        )
    );


    $wp_customize->add_control(
         new WP_Customize_Cropped_Image_Control($wp_customize, 'pizzeria_online_delivery_footer_background_image',
            array(
                'label' => esc_html__('Footer Background Image', 'pizzeria-online-delivery'),
                'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'pizzeria-online-delivery'), 1024, 800),
                'section' => 'pizzeria_online_delivery_footer_section',
                'width' => 1024,
                'height' => 800,
                'flex_width' => true,
                'flex_height' => true,
            )
        )
    );

    /** Footer Background Image Attachment */
    $wp_customize->add_setting('pizzeria_online_delivery_background_attachment', array(
        'default'           => 'scroll',
        'sanitize_callback' => 'pizzeria_online_delivery_sanitize_choices',
    ));

    $wp_customize->add_control('pizzeria_online_delivery_background_attachment', array(
        'label'    => __('Footer Background Attachment', 'pizzeria-online-delivery'),
        'section'  => 'pizzeria_online_delivery_footer_section',
        'settings' => 'pizzeria_online_delivery_background_attachment',
        'type'     => 'select',
        'choices'  => array(
            'fixed' => __('fixed','pizzeria-online-delivery'),
            'scroll' => __('scroll','pizzeria-online-delivery'),
        ),
    ));

    /* Footer Background Color*/
    $wp_customize->add_setting(
        'pizzeria_online_delivery_footer_background_color',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'pizzeria_online_delivery_footer_background_color',
            array(
                'label' => __('Footer Widget Area Background Color', 'pizzeria-online-delivery'),
                'section' => 'pizzeria_online_delivery_footer_section',
                'type' => 'color',
            )
        )
    );

     $wp_customize->add_setting('pizzeria_online_delivery_scroll_icon',array(
        'default'   => 'fas fa-arrow-up',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Pizzeria_Online_Delivery_Changeable_Icon(
        $wp_customize,'pizzeria_online_delivery_scroll_icon',array(
        'label' => __('Scroll Top Icon','pizzeria-online-delivery'),
        'transport' => 'refresh',
        'section'   => 'pizzeria_online_delivery_footer_section',
        'type'      => 'icon'
    )));

    /** Scroll to top button shape */
    $wp_customize->add_setting('pizzeria_online_delivery_scroll_to_top_radius', array(
        'default'           => 'curved-box',
        'sanitize_callback' => 'pizzeria_online_delivery_sanitize_choices',
    ));

    $wp_customize->add_control('pizzeria_online_delivery_scroll_to_top_radius', array(
        'label'    => __('Scroll Top Button Shape', 'pizzeria-online-delivery'),
        'section'  => 'pizzeria_online_delivery_footer_section',
        'settings' => 'pizzeria_online_delivery_scroll_to_top_radius',
        'type'     => 'select',
        'choices'  => array(
            'box'        => __( 'Box', 'pizzeria-online-delivery' ),
            'curved-box' => __( 'Curved Box', 'pizzeria-online-delivery' ),
            'circle'     => __( 'Circle', 'pizzeria-online-delivery' ),
        ),
    ));

    $wp_customize->add_setting( 
        'pizzeria_online_delivery_footer_settings_upgraded_features',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'pizzeria_online_delivery_footer_settings_upgraded_features', 
        array(
            'type'=> 'hidden',
            'description' => "
                <div class='notice-pro-features'>
                    <div class='notice-pro-icon'>
                        <i class='fas fa-crown'></i>
                    </div>
                    <div class='notice-pro-content'>
                        <h3>Unlock Premium Features</h3>
                        <p>Enhance your website with advanced layouts, premium sections, and powerful customization tools.</p>
                    </div>
                    <div class='notice-pro-button'>
                        <a target='_blank' href='". esc_url(PIZZERIA_ONLINE_DELIVERY_URL) ."' class='notice-upgrade-btn'>
                            Upgrade to Pro<i class='fas fa-rocket'></i>
                        </a>
                    </div>
                </div>
            ",
            'section' => 'pizzeria_online_delivery_footer_section'
        )
    );

    /** Footer Social Icon */
    $wp_customize->add_section('pizzeria_online_delivery_footer_social_section', array(
        'title' => __( 'Footer Social Settings', 'pizzeria-online-delivery' ),
        'panel' => 'pizzeria_online_delivery_home_page_settings',
    ));

    $wp_customize->add_setting('pizzeria_online_delivery_enable_footer_icon_section', array(
        'default' => true,
        'sanitize_callback' => 'pizzeria_online_delivery_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'pizzeria_online_delivery_enable_footer_icon_section', array(
        'label'       => __( 'Show Footer Icon', 'pizzeria-online-delivery' ),
        'section'     => 'pizzeria_online_delivery_footer_social_section',
        'type'        => 'checkbox',
    ));

    // Add setting for Facebook Link
    $wp_customize->add_setting(
        'pizzeria_online_delivery_footer_facebook_link',
        array(
            'default'           => 'https://www.facebook.com/',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_footer_facebook_link',
        array(
            'label'           => esc_html__( 'Facebook Link', 'pizzeria-online-delivery'  ),
            'section'         => 'pizzeria_online_delivery_footer_social_section',
            'settings'        => 'pizzeria_online_delivery_footer_facebook_link',
            'type'      => 'url'
        )
    );

    // Add setting for Facebook Icon Changing
    $wp_customize->add_setting(
        'pizzeria_online_delivery_facebook_icon',
        array(
            'default' => 'fa-brands fa-facebook',
            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
            
        )
    );	

    $wp_customize->add_control(new Pizzeria_Online_Delivery_Changeable_Icon($wp_customize, 
        'pizzeria_online_delivery_facebook_icon',
        array(
            'label'   		=> __('Facebook Icon','pizzeria-online-delivery'),
            'section' 		=> 'pizzeria_online_delivery_footer_social_section',
            'iconset' => 'fb',
        ))  
    );


    // Add setting for Twitter Link
    $wp_customize->add_setting(
        'pizzeria_online_delivery_footer_twitter_link',
        array(
            'default'           => 'https://twitter.com/',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_footer_twitter_link',
        array(
            'label'           => esc_html__( 'Twitter Link', 'pizzeria-online-delivery'  ),
            'section'         => 'pizzeria_online_delivery_footer_social_section',
            'settings'        => 'pizzeria_online_delivery_footer_twitter_link',
            'type'      => 'url'
        )
    );

    // Add setting for Twitter Icon Changing
    $wp_customize->add_setting(
        'pizzeria_online_delivery_twitter_icon',
        array(
            'default' => 'fa-brands fa-twitter',
            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
            
        )
    );	

    $wp_customize->add_control(new Pizzeria_Online_Delivery_Changeable_Icon($wp_customize, 
        'pizzeria_online_delivery_twitter_icon',
        array(
            'label'   		=> __('Twitter Icon','pizzeria-online-delivery'),
            'section' 		=> 'pizzeria_online_delivery_footer_social_section',
            'iconset' => 'fb',
        ))  
    );

    // Add setting for Instagram Link
    $wp_customize->add_setting(
        'pizzeria_online_delivery_footer_instagram_link',
        array(
            'default'           => 'https://www.instagram.com/',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_footer_instagram_link',
        array(
            'label'           => esc_html__( 'Instagram Link', 'pizzeria-online-delivery'  ),
            'section'         => 'pizzeria_online_delivery_footer_social_section',
            'settings'        => 'pizzeria_online_delivery_footer_instagram_link',
            'type'      => 'url'
        )
    );

    // Add setting for Instagram Icon Changing
    $wp_customize->add_setting(
        'pizzeria_online_delivery_instagram_icon',
        array(
            'default' => 'fa-brands fa-instagram',
            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
            
        )
    );	

    $wp_customize->add_control(new Pizzeria_Online_Delivery_Changeable_Icon($wp_customize, 
        'pizzeria_online_delivery_instagram_icon',
        array(
            'label'   		=> __('Instagram Icon','pizzeria-online-delivery'),
            'section' 		=> 'pizzeria_online_delivery_footer_social_section',
            'iconset' => 'fb',
        ))  
    );

    // Add setting for Linkedin Link
    $wp_customize->add_setting(
        'pizzeria_online_delivery_footer_linkedin_link',
        array(
            'default'           => 'https://in.linkedin.com/',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_footer_linkedin_link',
        array(
            'label'           => esc_html__( 'Linkedin Link', 'pizzeria-online-delivery'  ),
            'section'         => 'pizzeria_online_delivery_footer_social_section',
            'settings'        => 'pizzeria_online_delivery_footer_linkedin_link',
            'type'      => 'url'
        )
    );

    // Add setting for Linkedin Icon Changing
    $wp_customize->add_setting(
        'pizzeria_online_delivery_linkedin_icon',
        array(
            'default' => 'fa-brands fa-linkedin',
            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
            
        )
    );	

    $wp_customize->add_control(new Pizzeria_Online_Delivery_Changeable_Icon($wp_customize, 
        'pizzeria_online_delivery_linkedin_icon',
        array(
            'label'   		=> __('Linkedin Icon','pizzeria-online-delivery'),
            'section' 		=> 'pizzeria_online_delivery_footer_social_section',
            'iconset' => 'fb',
        ))  
    );

    // Add setting for Youtube Link
    $wp_customize->add_setting(
        'pizzeria_online_delivery_footer_youtube_link',
        array(
            'default'           => 'https://www.youtube.com/',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'pizzeria_online_delivery_footer_youtube_link',
        array(
            'label'           => esc_html__( 'Youtube Link', 'pizzeria-online-delivery'  ),
            'section'         => 'pizzeria_online_delivery_footer_social_section',
            'settings'        => 'pizzeria_online_delivery_footer_youtube_link',
            'type'      => 'url'
        )
    );

    // Add setting for Youtube Icon Changing
    $wp_customize->add_setting(
        'pizzeria_online_delivery_youtube_icon',
        array(
            'default' => 'fa-brands fa-youtube',
            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
            
        )
    );	

    $wp_customize->add_control(new Pizzeria_Online_Delivery_Changeable_Icon($wp_customize, 
        'pizzeria_online_delivery_youtube_icon',
        array(
            'label'   		=> __('Youtube Icon','pizzeria-online-delivery'),
            'section' 		=> 'pizzeria_online_delivery_footer_social_section',
            'iconset' => 'fb',
        ))  
    );

    // 404 PAGE SETTINGS
    $wp_customize->add_section(
        'pizzeria_online_delivery_404_section',
        array(
            'title' => __( '404 Page Settings', 'pizzeria-online-delivery' ),
            'priority' => 70,
            'panel' => 'pizzeria_online_delivery_general_settings',
        )
    );
   
    $wp_customize->add_setting('404_page_image', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw', // Sanitize as URL
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, '404_page_image', array(
        'label' => __('404 Page Image', 'pizzeria-online-delivery'),
        'section' => 'pizzeria_online_delivery_404_section',
        'settings' => '404_page_image',
    )));

    $wp_customize->add_setting('404_pagefirst_header', array(
        'default' => __('404', 'pizzeria-online-delivery'),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field', // Sanitize as text field
    ));

    $wp_customize->add_control('404_pagefirst_header', array(
        'type' => 'text',
        'label' => __('Heading', 'pizzeria-online-delivery'),
        'section' => 'pizzeria_online_delivery_404_section',
    ));

    // Setting for 404 page header
    $wp_customize->add_setting('404_page_header', array(
        'default' => __('Sorry, that page can\'t be found!', 'pizzeria-online-delivery'),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field', // Sanitize as text field
    ));

    $wp_customize->add_control('404_page_header', array(
        'type' => 'text',
        'label' => __('Heading', 'pizzeria-online-delivery'),
        'section' => 'pizzeria_online_delivery_404_section',
    ));

}
add_action( 'customize_register', 'pizzeria_online_delivery_customize_register' );
endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pizzeria_online_delivery_customize_preview_js() {
    // Use minified libraries if SCRIPT_DEBUG is false
    $pizzeria_online_delivery_build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $pizzeria_online_delivery_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'pizzeria_online_delivery_customizer', get_template_directory_uri() . '/js' . $pizzeria_online_delivery_build . '/customizer' . $pizzeria_online_delivery_suffix . '.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'pizzeria_online_delivery_customize_preview_js' );
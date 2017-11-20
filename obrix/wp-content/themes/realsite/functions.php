<?php

require_once 'assets/libraries/class-tgm-plugin-activation.php';
require_once 'one-click-installation/launcher.php';

define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
define( 'PROPERTY_EXCERPT_LENGTH', 22 );
define( 'AGENCY_EXCERPT_LENGTH', 20 );


/**
 * Enqueue scripts & styles
 */
add_action( 'wp_enqueue_scripts', 'aviators_enqueue_files' );

function aviators_enqueue_files() {
    wp_enqueue_style( 'roboto', '//fonts.googleapis.com/css?family=Roboto:400,300,500,700&amp;subset=latin,latin-ext' );
    wp_enqueue_style( 'montserrat', '//fonts.googleapis.com/css?family=Montserrat:400,700' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/libraries/font-awesome/css/font-awesome.min.css' );
    wp_enqueue_style( 'owlCarousel', get_template_directory_uri() . '/assets/libraries/owl.carousel/owl.carousel.css' );
    wp_enqueue_style( 'colorbox', get_template_directory_uri() . '/assets/libraries/colorbox/example1/colorbox.css' );
    wp_enqueue_style( 'bootstrap-select', get_template_directory_uri() . '/assets/libraries/bootstrap-select/dist/css/bootstrap-select.min.css' );

    $color_combination = get_theme_mod( 'realsite_general_color', null );

    if ( ! empty( $color_combination ) ) {
        wp_enqueue_style( 'realsite', get_template_directory_uri() . '/assets/css/variants/' . $color_combination . '.css', array(), '20161009' );
    } else {
        wp_enqueue_style( 'realsite', get_template_directory_uri() . '/assets/css/realsite.css', array(), '20161009' );
    }

    wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css' );

    wp_enqueue_script( 'autosize', get_template_directory_uri() . '/assets/libraries/autosize/jquery.autosize.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'bootstrap-select', get_template_directory_uri() . '/assets/libraries/bootstrap-select/dist/js/bootstrap-select.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'bootstrap-transition', get_template_directory_uri() . '/assets/libraries/bootstrap/assets/javascripts/bootstrap/transition.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'bootstrap-dropdown', get_template_directory_uri() . '/assets/libraries/bootstrap/assets/javascripts/bootstrap/dropdown.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'bootstrap-collapse', get_template_directory_uri() . '/assets/libraries/bootstrap/assets/javascripts/bootstrap/collapse.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'bootstrap-carousel', get_template_directory_uri() . '/assets/libraries/bootstrap/assets/javascripts/bootstrap/carousel.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/assets/libraries/colorbox/jquery.colorbox-min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'owlCarousel', get_template_directory_uri() . '/assets/libraries/owl.carousel/owl.carousel.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'jquery-scrollTo', get_template_directory_uri() . '/assets/libraries/jquery.scrollTo/jquery.scrollTo.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'jquery-transit', get_template_directory_uri() . '/assets/libraries/jquery-transit/jquery.transit.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'realsite', get_template_directory_uri() . '/assets/js/realsite.js', array( 'jquery' ), '20160506', true );
}

/**
 * Register navigations
 */
add_action( 'init', 'aviators_menus' );

function aviators_menus() {
    register_nav_menu( 'main', __( 'Main', 'realia' ) );
    register_nav_menu( 'topbar-anonymous', __( 'Topbar Anonymous', 'realia' ) );
    register_nav_menu( 'topbar-authenticated', __( 'Topbar Authenticated', 'realia' ) );
}


add_action( 'init', 'aviators_register_session' );

function aviators_register_session(){
    if( ! session_id() ) {
        session_start();
    }
}

/**
 * Custom widget areas
 */
add_action( 'widgets_init', 'aviators_sidebars' );

function aviators_sidebars() {
    register_sidebar( array( 'name' => __( 'Primary', 'realia' ), 'id' => 'sidebar-1', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Header Topbar Left', 'realia' ), 'id' => 'header-topbar-left', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Header Topbar Right', 'realia' ), 'id' => 'header-topbar-right', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Top Fullwidth', 'realia' ), 'id' => 'sidebar-top-fullwidth', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Top', 'realia' ), 'id' => 'sidebar-top', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Content Top', 'realia' ), 'id' => 'sidebar-content-top', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Content Bottom', 'realia' ), 'id' => 'sidebar-content-bottom', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Bottom', 'realia' ), 'id' => 'sidebar-bottom', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Footer First', 'realia' ), 'id' => 'footer-first', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Footer Second', 'realia' ), 'id' => 'footer-second', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Footer Third', 'realia' ), 'id' => 'footer-third', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Footer Fourth', 'realia' ), 'id' => 'footer-fourth', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Property Carousel', 'realia' ), 'id' => 'property-carousel', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Property Map', 'realia' ), 'id' => 'property-map', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Header Ad Space', 'realia' ), 'id' => 'header-ad-space', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Sidenav', 'realia' ), 'id' => 'sidenav', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
    register_sidebar( array( 'name' => __( 'Fullscreen Map', 'realia' ), 'id' => 'fullscreen-map', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
}

/**
 * Realia support options
 */
add_action( 'init', 'aviators_realia_support', 0 );

function aviators_realia_support() {
	add_theme_support( 'realia-custom-styles' );
	add_theme_support( 'realia-partners' );
	add_theme_support( 'realia-faq');
	add_theme_support( 'realia-pricing' );
	add_theme_support( 'realia-landlords' );
	add_theme_support( 'realia-statistics' );
	add_theme_support( 'realia-favorites' );
	add_theme_support( 'realia-currencies' );
	add_theme_support( 'realia-import' );
	add_theme_support( 'realia-compare' );
	add_theme_support( 'realia-favorite' );
}

/**
 * Additional after theme setup functions
 */
add_action( 'after_setup_theme', 'aviators_after_theme_setup' );

function aviators_after_theme_setup() {
    load_theme_textdomain( 'realia', get_template_directory() . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-header', array() );
    add_theme_support( 'custom-background' );
    add_theme_support( 'menus' );
    add_theme_support( 'title-tag' );

    add_filter( 'widget_text', 'do_shortcode' );
    add_image_size( 'post-row', 1024, 350, true );
    if ( ! isset( $content_width ) ) {
        $content_width = 1170;
    }
}

/**
 * Disable admin's bar top margin
 */
add_action( 'get_header', 'aviators_disable_admin_bar_top_margin' );

function aviators_disable_admin_bar_top_margin() {
    remove_action( 'wp_head', '_admin_bar_bump_cb' );
}

/**
 * Custom class for parent menu
 */
add_filter( 'wp_nav_menu_objects', 'aviators_menu_class' );

function aviators_menu_class( $items ) {
    $parents = array();

    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }

    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'has-children';
        }
    }

    return $items;
}

/**
 * Customizations
 */
add_action( 'customize_register', 'aviators_customizations' );

function aviators_customizations( $wp_customize ) {
    /**
     * General
     */
    $wp_customize->add_section( 'realsite_general', array( 'title' => __( 'Realsite General', 'realia' ), 'priority' => 0 ) );

    // Color combination
    $wp_customize->add_setting( 'realsite_general_color', array(
        'sanitize_callback' => 'sanitize_text_field',
        #'default'       => 'blue-pink'
    ) );

    $wp_customize->add_control( 'realsite_general_color', array(
        'label'         => __( 'Color Combination', 'realia' ),
        'type'          => 'select',
        'section'       => 'realsite_general',
        'settings'      => 'realsite_general_color',
        'description'   => __( 'Set your color combination. You can use predefined colors but if you are interested in custom colors please check our documentation.', 'realia' ),
        'choices'       => array(
            ''                           => __( 'None', 'realia' ),
            'cyan-blue-grey'             => __( 'Cyan - Blue Grey' , 'realia' ),
            'light-blue-amber'           => __( 'Light Blue - Amber' , 'realia' ),
            'blue-pink'                  => __( 'Blue - Pink' , 'realia' ),
            'blue-light-green'           => __( 'Blue - Light Green' , 'realia' ),
            'indigo-red'                 => __( 'Indigo - Red' , 'realia' ),
            'indigo-green'               => __( 'Indigo - Green' , 'realia' ),
            'brown-light-green'          => __( 'Brown - Light Green' , 'realia' ),
            'brown-red'                  => __( 'Brown - Red' , 'realia' ),
            'green-deep-orange'          => __( 'Green - Deep Orange' , 'realia' ),
            'green-amber'                => __( 'Green - Amber' , 'realia' ),
            'red-brown'                  => __( 'Red - Brown' , 'realia' ),
            'pink-amber'                 => __( 'Pink - Amber' , 'realia' ),
            'teal-amber'                 => __( 'Teal - Amber' , 'realia' ),
            'teal-cyan'                  => __( 'Teal - Cyan' , 'realia' ),
            'blue-grey-amber'            => __( 'Blue Grey - Amber' , 'realia' ),
            'blue-grey-lime'             => __( 'Blue Grey - Lime' , 'realia' ),
            'deep-purple-light-green'    => __( 'Deep Purple - Light Green' , 'realia' ),
            'deep-purple-purple'         => __( 'Deep Purple - Purple' , 'realia' ),
            'deep-orange-light-green'    => __( 'Deep Purple - Light Green' , 'realia' ),
            'deep-orange-light-blue'     => __( 'Deep Purple - Light Blue' , 'realia' ),
        ),
    ) );

    // Action layout
    $wp_customize->add_setting( 'realsite_general_layout', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'       => 'wide',
    ) );

    $wp_customize->add_control( 'realsite_general_layout', array(
        'label'         => __( 'Layout', 'realia' ),
        'type'          => 'select',
        'section'       => 'realsite_general',
        'settings'      => 'realsite_general_layout',
        'choices'       => array(
            'boxed'         => __('Boxed', 'realia'),
            'wide'          => __('Wide', 'realia'),
        ),
        'description'   => __( 'Set wide or boxed layout.', 'realia' ),
    ) );

    // Action text
    $wp_customize->add_setting( 'realsite_general_action_text', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    // Action page
    $wp_customize->add_setting( 'realsite_general_action', array( 'sanitize_callback' => 'sanitize_text_field' ) );

    $wp_customize->add_control( 'realsite_general_action', array(
        'label'         => __( 'Action Page', 'realia' ),
        'type'          => 'select',
        'section'       => 'realsite_general',
        'settings'      => 'realsite_general_action',
        'choices'       => aviators_get_pages(),
        'description'   => __( 'Page where the action button will point to.', 'realia' )
    ) );

    // Action text
    $wp_customize->add_setting( 'realsite_general_action_text', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'realsite_general_action_text', array(
        'label'             => __( 'Action Icon', 'realia' ),
        'section'           => 'realsite_general',
        'settings'          => 'realsite_general_action_text',
        'description'       => __( 'Use an icon from Font Awesome. For example "fa-plus".', 'realia' ),
    ) );

    // Logo
    $wp_customize->add_setting( 'realsite_general_logo', array( 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_logo', array(
        'label'         => __( 'Logo', 'realia' ),
        'section'       => 'realsite_general',
        'settings'      => 'realsite_general_logo',
        'description'   => __( 'Logo displayed in header. By default it has some opacity added by CSS which will change after hover.', 'realia' ),
    ) ) );

    // Allow customizer
    $wp_customize->add_setting( 'realsite_general_enable_customizer', array(
        'default'           => 'fa-plus',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'realsite_general_enable_customizer', array(
        'type'          => 'checkbox',
        'label'         => __( 'Enable Customizer', 'realia' ),
        'section'       => 'realsite_general',
        'settings'      => 'realsite_general_enable_customizer',
        'description'   => __( 'Helper displayed in bottom right corner for showing color combinations. It is recommended to disable it on production.', 'realia' )
    ) );

    /**
     * Header
     */
    $wp_customize->add_section( 'realsite_header', array( 'title' => __( 'Realsite Header', 'realia' ), 'priority' => 0 ) );

    // Sticky header
    $wp_customize->add_setting( 'realsite_header_sticky', array( 'sanitize_callback' => 'sanitize_text_field' ) );

    $wp_customize->add_control( 'realsite_header_sticky', array(
        'label'                 => __( 'Sticky Header', 'realia' ),
        'type'                  => 'checkbox',
        'section'               => 'realsite_header',
        'settings'              => 'realsite_header_sticky',
    ) );

	// Disable title
	$wp_customize->add_setting( 'realsite_header_disable_title', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control( 'realsite_header_disable_title', array(
		'label'                 => __( 'Disable Title', 'realia' ),
		'type'                  => 'checkbox',
		'section'               => 'realsite_header',
		'settings'              => 'realsite_header_disable_title',
	) );

    // Header variant
    $wp_customize->add_setting( 'realsite_header_variant', array( 'sanitize_callback' => 'sanitize_text_field' ) );

    $wp_customize->add_control( 'realsite_header_variant', array(
        'label'                 => __( 'Header Variant', 'realia' ),
        'type'                  => 'select',
        'section'               => 'realsite_header',
        'settings'              => 'realsite_header_variant',
        'choices'               => array(
            'standard'          => __( 'Standard', 'realia' ),
            'information'       => __( 'Information', 'realia' ),
            'search'            => __( 'Large Search', 'realia' ),
            'ad-space'            => __( 'Ad Space', 'realia' ),
        ),
    ) );

    for ( $i = 1; $i <= 3; $i++ ) {
        // Information Header Icon
        $wp_customize->add_setting( 'realsite_header_information_' . $i . '_icon', array( 'sanitize_callback' => 'sanitize_text_field' ) );

        $wp_customize->add_control( 'realsite_header_information_' . $i . '_icon', array(
            'label'                 => $i . '. ' . __('Information Header Icon', 'realia' ),
            'type'                  => 'text',
            'section'               => 'realsite_header',
            'settings'              => 'realsite_header_information_' . $i . '_icon',
            'description'       => __( 'Use an icon from Font Awesome. For example "fa-plus".', 'realia' ),
        ) );

        // Information Header Title
        $wp_customize->add_setting( 'realsite_header_information_' . $i . '_title', array( 'sanitize_callback' => 'sanitize_text_field' ) );

        $wp_customize->add_control( 'realsite_header_information_' . $i . '_title', array(
            'label'                 => $i . '. ' . __('Information Header Title', 'realia' ),
            'type'                  => 'text',
            'section'               => 'realsite_header',
            'settings'              => 'realsite_header_information_' . $i . '_title',
        ) );

        // Information Header Subtitle
        $wp_customize->add_setting( 'realsite_header_information_' . $i . '_subtitle', array( 'sanitize_callback' => 'sanitize_text_field' ) );

        $wp_customize->add_control( 'realsite_header_information_' . $i . '_subtitle', array(
            'label'                 => $i . '. ' . __('Information Header Subtitle', 'realia' ),
            'type'                  => 'text',
            'section'               => 'realsite_header',
            'settings'              => 'realsite_header_information_' . $i . '_subtitle',
        ) );
    }

    /**
     * Footer
     */
    $wp_customize->add_section( 'footer', array( 'title' => __( 'Footer', 'realia' ) ) );

    // Top
    $wp_customize->add_setting( 'footer_top', array( 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'footer_top', array(
        'label'     => __( 'Allow top', 'realia' ),
        'type'      => 'checkbox',
        'section'   => 'footer',
        'settings'  => 'footer_top',
    ) );
}

/**
 * Read more for post excerpt
 */
add_filter( 'excerpt_more', 'aviators_excerpt_read_more' );

function aviators_excerpt_read_more( $more ) {
    global $post;

    if ( $post->post_type == 'property' || $post->post_type = 'agency' ) {
        return;
    }

    return '<a class="post-read-more" href="'. get_permalink( $post->ID ) . '">' . __( 'Read more', 'realia' ) . '</a>';
}

/**
 * Custom excerpt length
 */
add_filter('excerpt_length', 'aviators_excerpt_length' );

function aviators_excerpt_length( $length ) {
    global $post;

    if ( $post->post_type == 'property' ) {
        return PROPERTY_EXCERPT_LENGTH;
    } elseif ( $post->post_type = 'agency' ) {
        return AGENCY_EXCERPT_LENGTH;
    }

    return $length;
}

/**
 * Custom menu walker
 */
class Aviators_Menu extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $display_depth = ( $depth + 1 );
        $classes = array( 'sub-menu', ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ), ( $display_depth >= 2 ? 'sub-sub-menu' : '' ), 'menu-depth-' . $display_depth );
        $class_names = implode( ' ', $classes );

        if ( $depth == 0 ) {
            $output .= sprintf( '<div><a href="%s">%s</a><ul class="%s">', $this->current_item->url, $this->current_item->title, $class_names );
        } elseif ( $depth == 1 ) {
            $output .= sprintf( '<div><ul class="%s">', $class_names );
        }
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ( $depth == 0 ) {
            $output .= '</ul></div>';
        } elseif ( $depth == 1 ) {
            $output .= '</ul></div>';
        }
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $this->current_item = $item;

        parent::start_el( $output, $item, $depth, $args, $id );
    }
}


/**
 * Breadcrumb
 */
function aviators_get_breadcrumb() {
    ob_start();
    include 'templates/misc/breadcrumb.php';
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}

/**
 * Get pages list
 */
function aviators_get_pages() {
    $pages = array();
    $pages[] =  __( 'Not set', 'realia' );

    foreach ( get_pages() as $page ) {
        $pages[$page->ID] = $page->post_title;
    }

    return $pages;
}

/**
 * Pagination
 */
function aviators_pagination() {
    if( is_singular() ) {
        return;
    }

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="clearfix"><div class="center"><ul class="pagination">' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() ) {
        printf( '<li class="prev">%s</li>', get_previous_posts_link( '<i class="fa fa-angle-left"></i>' ) );
    }
    else {
        printf( '<li class="prev disabled"><a tabindex="-1"><i class="fa fa-angle-left"></i></a></li>' );
    }

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) ) {
            echo '<li class="disabled"><a>...</a></li>';
        }
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) ) {
            echo '<li><a>...</a></li>' . "\n";
        }

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() ) {
        printf( '<li class="next">%s</li>', get_next_posts_link( '<i class="fa fa-angle-right"></i>' ) );
    } else {
        printf( '<li class="next disabled"><a tabindex="-1"><i class="fa fa-angle-right"></i></a></li>' );
    }

    echo '</ul></div></div>' . "\n";
}

/**
 * Comments template
 */
function aviators_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    extract( $args, EXTR_SKIP );
    include 'templates/misc/comment.php';
}

/**
 * Register plugins
 */
add_action( 'tgmpa_register', 'aviators_register_required_plugins' );

function aviators_register_required_plugins() {
    $plugins = array(
        array(
            'name'                  => 'Realia',
            'slug'                  => 'realia',
            'source'                => get_template_directory() . '/plugins/realia.zip',
            'required'              => false,
            'force_deactivation'    => true,
            'is_automatic'          => true,
            'version'               => '0.2.1',
        ),
        array(
            'name'                  => 'Widget Logic',
            'slug'                  => 'widget-logic',
            'required'              => false,
            'is_automatic'          => true,
        ),
        array(
            'name'                  => 'Widget Settings Importer/Exporter',
            'slug'                  => 'widget-settings-importexport',
            'required'              => false,
            'is_automatic'          => true,
        ),
        array(
            'name'                  => 'WordPress Importer',
            'slug'                  => 'wordpress-importer',
            'required'              => false,
            'is_automatic'          => true,
        ),
    );

    $config = array(
        'domain'            => 'realia',                    // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                          // Default absolute path to pre-packaged plugins
        'parent_slug'       => 'themes.php',                // Default parent menu slug
        'menu'              => 'install-required-plugins',  // Menu slug
        'capability'        => 'edit_theme_options',
        'has_notices'       => true,                        // Show admin notices or not
        'is_automatic'      => true,                        // Automatically activate plugins after installation or not
        'message'           => '',                          // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', 'realia' ),
            'menu_title'                                => __( 'Install Plugins', 'realia' ),
            'installing'                                => __( 'Installing Plugin: %s', 'realia' ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', 'realia' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', 'realia' ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', 'realia' ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'realia' ), // %1$s = dashboard link
            'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );
}


/**
 * One-Click installation
 */
add_filter( 'aviators_launcher_steps', 'realsite_launcher_steps' );

function realsite_launcher_steps($steps) {
    $steps['content'] = array(
        'title'      => __( 'Content Import', 'realia' ),
        'importer'   => 'content',
        'file'      => dirname( __FILE__ ) . '/exports/demo_content.xml',
    );

    $steps['theme-options'] = array(
        'title'      => __( 'Theme Options', 'realia' ),
        'importer'   => 'theme-options',
        'file'       => dirname( __FILE__ ) . '/exports/theme_options.json',
    );

    $steps['widget-settings'] = array(
        'title'     => __( 'Widget settings', 'realia' ),
        'importer'  => 'widget-settings',
        'file'      => dirname( __FILE__ ) . '/exports/widget_data.json',
    );

    $steps['widget-logic'] = array(
        'title'      => __( 'Widget Logic', 'realia' ),
        'importer'   => 'widget-logic',
        'file'       => dirname( __FILE__ ) . '/exports/widget_logic.json',
    );

    return $steps;
}


add_filter( 'http_request_args', 'aviators_api_wordpress_org', 10, 2 );

function aviators_api_wordpress_org( $request, $url ) {
    if ( strpos( $url, '://api.wordpress.org/' ) !== false ) {
        $request[ 'timeout' ] = 15;
    }

    return $request;
}

/**
 * Body Layout classes
 */
add_filter( 'body_class', 'realia_body_classes' );

function realia_body_classes( $body_class ) {

    $body_class[] = 'layout-' . get_theme_mod( 'realsite_general_layout' );
    $body_class[] = ( get_theme_mod( 'realsite_header_sticky' ) ? 'header-sticky' : 'header-normal');

    return $body_class;
}

add_filter( 'site_transient_update_plugins', 'aviators_exclude_from_update' );

function aviators_exclude_from_update( $item ) {
	if ( is_object( $item ) ) {
		unset( $item->response['realia/realia.php'] );
	}

	return $item;
}

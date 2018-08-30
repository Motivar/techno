<?php
/**
 * koryfo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package koryfo
 */

if (is_admin())
    {
    if (function_exists('acf_add_options_page'))
        {
        $option_page1 = acf_add_options_page(array(
            'page_title' => 'Social Media',
            'menu_title' => 'Social Media',
            'menu_slug' => 'mtv_social_media',
            'capability' => 'read',
            'redirect' => false
        ));
        }
    }
if (!function_exists('koryfo_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function koryfo_setup()
{
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on koryfo, use a find and replace
         * to change 'koryfo' to the name of your theme in all the template files.
         */
        load_theme_textdomain('koryfo', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'koryfo'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('koryfo_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'koryfo_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function koryfo_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('koryfo_content_width', 640);
}
add_action('after_setup_theme', 'koryfo_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function koryfo_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'techno'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'techno'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Menu Left', 'techno'),
        'id' => 'footer_menu_left',
        'description' => esc_html__('Add widgets here.', 'techno'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Menu Right', 'techno'),
        'id' => 'footer_menu_right',
        'description' => esc_html__('Add widgets here.', 'techno'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Mobile Menu Widgets', 'techno'),
        'id' => 'mobile-menu-widgets',
        'description' => esc_html__('Add widgets here.', 'techno'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    
}
add_action('widgets_init', 'koryfo_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function koryfo_scripts()
{
    $path = get_template_directory_uri();
    wp_enqueue_style('koryfo-style', get_stylesheet_uri());

    wp_enqueue_style('koryfo-mystyle', $path . '/mystyle.min.css');

    wp_enqueue_script('theme-slick-js', $path . '/js/slick/slick.min.js', array(), false, true);
    wp_enqueue_style('theme-slick-css', $path . '/js/slick/slick.css', true, '1.0.0');
    wp_enqueue_style('theme-slick-theme-css', $path . '/js/slick/slick-theme.css', true, '1.0.0');
    wp_enqueue_script('koryfo-sticky-menu', $path . '/js/sticky_menu.js', array(), '20180807', true);

    wp_enqueue_script('koryfo-navigation', $path . '/js/navigation.js', array(), '20151215', true);

    wp_enqueue_script('koryfo-skip-link-focus-fix', $path . '/js/skip-link-focus-fix.js', array(), '20151215', true);
    wp_enqueue_script('krf-gmap-js', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDEB3THsEXL1-4pmOPgkXfb0eFwDzZ0-R0');

    wp_enqueue_script('techno-barba', $path . '/js/barba.js', array(), '20180808', true);
    wp_enqueue_script('techno-main', $path . '/js/techno.js', array(), '20180809', true);
    wp_enqueue_script('krf-shave-js', $path . '/js/shave.min.js', array(), false, true);  
    wp_enqueue_script('count-up-js', $path . '/js/countUp.js', array(), false, true);

wp_enqueue_style( 'koryfo-pswp-css', $path . '/template-parts/photoswipe/photoswipe.css' );
    
wp_enqueue_style( 'koryfo-pswp-default-skin-css', $path . '/template-parts/photoswipe/default-skin.css' );

wp_enqueue_script( 'koryfo-pswp-min-js', $path . '/template-parts/photoswipe/photoswipe.min.js', array(), '20180813', true );

wp_enqueue_script( 'koryfo-pswp-default-js', $path . '/template-parts/photoswipe/photoswipe-ui-default.min.js', array(), '20180813', true );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'koryfo_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/*motivar code*/

function mtv_get_my_custom_posts($post_type)
{
    $msg = array();
    $all = array(
        array(
            'post' => 'krf_projects',
            'sn' => __('Project', 'koryfo'),
            'pl' => __('Projects', 'koryfo'),
            'args' => array(
                'title',
                'editor',
                'thumbnail',
            ),
            'slug' => get_option('krf_projects_slug') ?: 'krf_projects',
            'chk' => true,
            'mnp' => 2,
            'icn' => '',
            'capp' => array(
                1,
                2,
                3,
            ),
            'meta_arrays' => array(
                //  'sbp_extra_booking_meta'
            ),
            'mtv_enable' => 1,
            'en_slg' => 1,
            'tax_types' => array(
                __('Services', 'koryfo'),
                __('Service', 'koryfo'),
                'krf_services',
            ),
        ),
    );
    if ($post_type == 'all') {
        $msg = $all;
    } else {
        foreach ($all as $k) {
            if ($k['post'] == $post_type) {
                $msg = $k;
            }
        }
    }

    return $msg;
}

add_action('init', 'mtv_register_my_cpts', 10);

function mtv_register_my_cpts()
{
    $names = mtv_get_my_custom_posts('all');
    foreach ($names as $n) {
        $enable = isset($n['mtv_enable']) ? $n['mtv_enable'] : 1;
        $relation = isset($n['mtv_relation']) ? $n['mtv_relation'] : 1;
        if ($enable == 1 && $relation == 1) {
            $extra_sl = isset($n['extra_slug']) ? '/%' . $n['extra_slug'] . '%' : '';
            $wpml = (int) function_exists('icl_object_id');
            if ($wpml != 0) {
                $extra_sl = '';
            }

            $chk = $n['chk'];
            $labels = $args = array();
            $labels = array(
                'name' => $n['pl'],
                'singular_name' => $n['sn'],
                'menu_name' => $n['pl'],
                'add_new' => __('New', 'koryfo') . ' ' . $n['sn'],
                'add_new_item' => __('New', 'koryfo') . ' ' . $n['sn'],
                'edit' => 'Edit',
                'edit_item' => __('Edit', 'koryfo') . ' ' . $n['sn'],
                'new_item' => __('New', 'koryfo') . ' ' . $n['sn'],
                'view' => __('View', 'koryfo') . ' ' . $n['sn'],
                'view_item' => __('View', 'koryfo') . ' ' . $n['sn'],
                'search_items' => __('Search', 'koryfo') . ' ' . $n['sn'],
                'not_found' => __('No', 'koryfo') . ' ' . $n['pl'],
                'not_found_in_trash' => __('No Trashed', 'koryfo') . ' ' . $n['pl'],
                'parent' => 'Parent ' . $n['sn'],
            );
            $args = array(
                'labels' => $labels,
                'description' => __('My custom post type for', 'koryfo') . ' ' . $n['pl'],
                'public' => true, //$chk
                'show_ui' => true,
                'has_archive' => true, //$chk
                'show_in_menu' => true,
                'exclude_from_search' => false, //!$chk
                'capability_type' => 'post',
                'map_meta_cap' => true,
                'hierarchical' => false,
                'rewrite' => array(
                    'slug' => $n['post'] . $extra_sl,
                    'with_front' => true,
                    'feeds' => true, //$chk
                ),
                'query_var' => true,
                'supports' => $n['args'],
                'show_in_rest' => true, //$chk
              //  'show_in_admin' => true
            );
            if (!empty($n['slug'])) {
                $args['rewrite']['slug'] = $n['slug'] . $extra_sl;
            }

            if (!empty($n['mnp'])) {
                $args['menu_position'] = $n['mnp'];
            }

            if (!empty($n['icn'])) {
                $args['menu_icon'] = $n['icn'];
            }

            if ($extra_sl != '') {
                $args['rewrite']['has_archive'] = $n['extra_slug'];
            }

            if ((isset($n['sbp_book']) && $n['sbp_book'] == 1) && (isset($n['sbp_main_product']) && $n['sbp_main_product'] == 1) && isset($n['sbp_period_checkout_type'])) {
                define('sbp_period_checkout_type', $n['sbp_period_checkout_type']);
            }

            /*enable custom capabilities
            if (isset($n['capp']) && $n['capp'] >= 1)
            {
            $capps = create_custom_capabilities($n['post'], 1);
            $k = array_merge($args, $capps);
            $args = $k;
            }
             */

            register_post_type($n['post'], $args);
            if (isset($n['en_slg']) && $n['en_slg'] == 1 && $chk == true) {
                add_action('load-options-permalink.php',
                    function ($views) use ($n) {
                        if (isset($_POST[$n['post'] . '_slug'])) {
                            update_option($n['post'] . '_slug', sanitize_title_with_dashes($_POST[$n['post'] . '_slug']));
                        }

                        add_settings_field($n['post'] . '_slug', __($n['pl'] . ' Slug'),
                            function ($views) use ($n) {
                                $value = get_option($n['post'] . '_slug');
                                echo '<input type="text" value="' . esc_attr($value) . '" name="' . $n['post'] . '_slug' . '" id="' . $n['post'] . '_slug' . '" class="regular-text" placeholder="' . $n['slug'] . '"/>';
                            }

                            , 'permalink', 'optional');
                    });
            }

            if (isset($n['custom_status']) && !empty($n['custom_status'])) {
                foreach ($n['custom_status'] as $k => $v) {
                    register_post_status($k, array(
                        'label' => __($k, $n['post']),
                        'public' => true,
                        'exclude_from_search' => false,
                        'show_in_admin_all_list' => true,
                        'show_in_admin_status_list' => true,
                        'label_count' => _n_noop($v . '  <span class="count">(%s)</span>', $v . ' <span class="count">(%s)</span>'),
                    ));
                }
            }

            /*end for registering custom types*/
            /*check for taxes*/
            if (isset($n['tax_types']) && !empty($n['tax_types'])) {
                $i = $n['tax_types'];
                $labels = $args = array();
                $labels = array(
                    'name' => $i[0],
                    'label' => $i[0],
                    'all_items' => __('All', 'koryfo') . ' ' . $i[0],
                    'edit_item' => __('Edit', 'koryfo') . ' ' . $i[1],
                    'update_item' => __('Update', 'koryfo') . ' ' . $i[1],
                    'add_new_item' => __('New', 'koryfo') . ' ' . $i[1],
                    'new_item_name' => __('New', 'koryfo') . ' ' . $i[1],
                    'parent_item' => $i[1] . ' ' . __('Parent', 'koryfo'),
                    'parent_item_colon' => $i[1] . ' ' . __('Parent :)', 'koryfo'),
                    'search_items' => __('Search', 'koryfo') . ' ' . $i[0],
                    'popular_items' => __('Popular', 'koryfo') . ' ' . $i[0],
                    'separate_items_with_commas' => __('Split', 'koryfo') . ' ' . $i[0] . ' ' . __('with comma', 'koryfo'),
                    'add_or_remove_items' => __('Insert / Delete', 'koryfo') . ' ' . $i[1],
                    'choose_from_most_used' => __('Select', 'koryfo') . ' ' . $i[0],
                );
                $args = array(
                    'labels' => $labels,
                    'hierarchical' => true,
                    'label' => $i[2],
                    'show_ui' => true,
                    'show_in_rest' => true,
                    'query_var' => true,
                    'rewrite' => array(
                        'slug' => get_option($i[2] . '_slug') ?: $i[2],
                        'with_front' => false,
                    ),
                    'show_admin_column' => false,
                );
                register_taxonomy($i[2], array(
                    $n['post'],
                ), $args);
                if (isset($i[3]) && $i[3] == 1) {
                    add_action('load-options-permalink.php',
                        function ($views) use ($i) {
                            if (isset($_POST[$i[2] . '_slug']) && !empty($_POST[$i[2] . '_slug'])) {
                                update_option($i[2] . '_slug', sanitize_title_with_dashes($_POST[$i[2] . '_slug']));
                            }

                            add_settings_field($i[2] . '_slug', __($i[0] . ' Slug'),
                                function ($views) use ($i) {
                                    $value = get_option($i[2] . '_slug');
                                    echo '<input type="text" value="' . esc_attr($value) . '" name="' . $i[2] . '_slug' . '" id="' . $i[2] . '_slug' . '" class="regular-text" placeholder="' . $i[2] . '"/>';
                                }

                                , 'permalink', 'optional');
                        });
                }
            }

            /*end for adding*/
        }
    }

/*
if (sbp_refact==1)
{
/* Filter the single_template with our custom function*/
/*    add_filter('single_template', 'sbp_custom_templates');
}
 */

}

add_action('init', 'mtv_definitions');
function mtv_definitions()
{
    $wpml = (int) function_exists('icl_object_id');
    define('mtv_wpml', $wpml);
}

add_action('init', 'custom_image_sizes');

function custom_image_sizes()
{
    for ($i = 2; $i <= 15; $i++) {
        $d = $i - 1;
        add_image_size('custom-size-' . $i, $i * 100, 9999, false);
    }
}

if (!function_exists('custom_image_element')) {

    function custom_image_element($img_id, $mode = 'cover', $shadow = 0, $pswp = 0, $size = '')
    {
        $image = wp_get_attachment_url($img_id);
        $alt_text = get_post_meta($img_id, '_wp_attachment_image_alt', true);
        switch ($size) {
            case 'large':
                $desktop = '75';
                $tablet = '75';
                $mobile = '90';
                break;
            default:
                $desktop = '33.3';
                $tablet = '50';
                $mobile = '90';
                break;
        }
        $srcset = 'srcset="';
        if ($pswp == 1) {
            $pswp = 'data-sbp_pswp="sbp_pswp_item"';
        } else {
            $pswp = '';
        }

        for ($i = 3; $i <= 10; $i++) {
            if ($i == 10) {
                $comma = '';
            } else {
                $comma = ', ';
            }
            $img = wp_get_attachment_image_src($img_id, 'custom-size-' . $i);
            $w = $i * 100;

            $srcset .= $img[0] . ' ' . $w . 'w' . $comma;
        }
        $srcset .= '"';
        if ($shadow == 1) {
            $shd = 'custom_shadow';
        } else {
            $shd = '';
        }
        $size = getimagesize($image);
        $img = '<img ' . $srcset . ' class="' . $mode . ' ' . $shd . '" alt="' . $alt_text . '" src="' . $image . '" sizes="(min-width: 1100px) ' . $desktop . 'vw, (min-width: 767px) ' . $tablet . 'vw, (min-width: 550px) ' . $mobile . 'vw" data-natural_width="' . $size[0] . '" data-natural_height="' . $size[1] . '" ' . $pswp . '/>';

        return $img;
    }
}

add_shortcode('projects_slider', 'projects_slider_func');

function projects_slider_func($atts)
{
    extract(shortcode_atts(array(
        'post_type' => 'krf_projects',
        'number' => '-1',
        'slick' => '1',
        'img_show' => 'contain',
        /* insert post_type*/
    ), $atts));
    $msg = '';

    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => $number,
        'post_status' => 'publish',
    );
    $posts = get_posts($args);
    $msg = '
    <div class="projects_slider">
        <div class="image_section">
            <div class="slider-for">';
    foreach ($posts as $post) {
        $img = get_post_meta($post->ID, '_thumbnail_id', true) ?: '';
        $image = custom_image_element($img, $img_show);
        $link = get_permalink($post->ID);
        $msg .= '<div class="slider_img_container"><a href="' . $link . '">' . $image . '</a></div>';
    }
    $msg .= '
            </div>
        </div>
        <div class="title_section">
            <div class="slider-nav">';
    foreach ($posts as $post) {
        $msg .= '<div class="slider_title_container"><h3>' . $post->post_title . '</h3></div>';
    }
    $msg .=
        '</div>
        </div>';

    $msg .=
        '</div>';

    return $msg;
}

add_shortcode('services_slider', 'services_slider_func');

function services_slider_func($atts)
{
    
    extract(shortcode_atts(array(
        'taxonomy' => 'krf_services',
        'slick' => '1',
        'img_show' => 'contain'
    ), $atts));

    $services = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
        'post_status' => 'publish',
    ));

    $msg = '
    <div class="services_slider">
        <div class="image_section">
            <div class="slider-for">';
    foreach ($services as $service) {
        $img = get_term_meta($service->term_id, 'image', true) ?: '';
        $image = custom_image_element($img, $img_show);
        $link = get_term_link($service->term_id);
        $msg .= '<div class="slider_img_container"><a href="' . $link . '">' . $image . '</a></div>';
    }
    $msg .= '
            </div>
        </div>
        <div class="title_section">
            <div class="slider-nav">';
    foreach ($services as $service) {
        $msg .= '<div class="slider_title_container"><a href="'.$link.'"><h3>' . $service->name . '</h3></a></div>';
    }
    $msg .=
        '</div>
        </div>';

    $msg .=
        '</div>';    



    return $msg;

}

add_shortcode('custom_button', 'custom_button_func');

function custom_button_func($atts)
{
    extract(shortcode_atts(array(
        'title' => '',
        'link' => '',
        'post_id' => '',
        'term_id' => '',
        'post_type_archive' => '',
    ), $atts));

    $msg = '';
    if (!empty($post_id)) {
        $link = get_permalink($post_id);
    } elseif (!empty($term_id)) {
        $link = get_term_link($term_id);
    } elseif (!empty($post_type_archive)) {
        $link = get_post_type_archive_link($post_type_archive);
    }

    $msg .= '<div class="custom_button_wrap"><div class="custom_button"><a href="' . $link . '"><h2>' . $title . '</h2></a></div></div>';

    return $msg;

}

add_shortcode('projects_map', 'projects_map_function');

function projects_map_function($atts)
{
    

    $msg .= '<div id="map_wrapper">
                <div id="map_canvas" class="mapping"></div>
            </div>';
    $args = array(
        'post_type' => 'krf_projects',
        'posts_per_page' => '-1',
        'post_status' => 'publish',
        'field' => 'id',
    );
    $posts = get_posts($args);
    $projects_array = array();
    foreach ($posts as $p) {
        $id = $p->ID;
        $title = $p->post_title;
        $content = $p->post_content;
        $coordinates = get_post_meta($id, 'map_location', true);
        $latitude = $coordinates['lat'];
        $longtitude = $coordinates['lng'];
        $permalink = get_permalink($id);

        $project_array = array(
            'title' => $title,
            'lat' => $latitude,
            'lng' => $longtitude,
            'link' => $permalink,
        );

        $projects_array[] = $project_array;
    }
    //print_r($projects_array);
    $projects = json_encode($projects_array);
    // print_r($projects);
    $msg .= '<div class="coordinates krf_hidden">' . $projects . '</div>';

    return $msg;
}

add_shortcode('project_services', 'project_services_func');

function project_services_func($atts)
{
    extract(shortcode_atts(array(
        'number' => '4',
    ), $atts));

    $services = get_terms(array(
        'taxonomy' => 'krf_services',
        'hide_empty' => false,
        'post_status' => 'publish',
        'number' => $number,
    ));

    $msg .= '<div class="services_list">';
    foreach ($services as $service) {
        $link = get_term_link($service->term_id);
        $msg .= '<div class="service_item"><a href="' . $link . '"><h2>' . $service->name . '</h2></a></div>';
    }
    $msg .= '</div>';

    return $msg;
}

add_shortcode('partners_slider', 'partners_slider_func');

function partners_slider_func($atts)
{
    extract(shortcode_atts(array(
        'number' => '',
        'columns' => '4',
        'mcolumns' => '3',
        'scolumns' => '1',
        'import_scripts' => '0', /** use "1" if you want to enqueue slick*/
    ), $atts));

    $partners = get_terms(array(
        'taxonomy' => 'krf_partners',
        'hide_empty' => false,
        'post_status' => 'publish',
        'number' => $number,
    ));

    // print_r($partners);
    $msg = '<div class="partners_carousel" data-columns="' . $columns . '" data-mcolumns="' . $mcolumns . '" data-scolumns="' . $scolumns . '">';
    foreach ($partners as $partner) {
        $img = get_term_meta($partner->term_id, 'image', true) ?: '';
        $image = custom_image_element($img, 'contain');
        $msg .= '<div class="partner">' . $image . '</div>';
    }
    $msg .= '</div>';
    return $msg;
}



add_shortcode('social_media', 'social_media_func');

function social_media_func($atts)
{
    extract(shortcode_atts(array(
        'phone' => '',
        'email' => ''
    ), $atts));

    $msg = '';
        $social_media = get_field('social_media', 'options') ?: '';
            if (!empty($social_media)){
                $msg .= '<div class="social_media_container media_section">';
                foreach ($social_media as $s) {
                    switch ($s['name']) {
                        case 'facebook':
                            $icon = 'fa-facebook';
                            break;
                        case 'instagram':
                            $icon = 'fa-instagram';
                            break;
                        case 'pinterest':
                            $icon = 'fa-pinterest';
                            break;
                        case 'twitter':
                            $icon = 'fa-twitter';
                            break; 
                        default:
                            $icon = '';
                            break;              
                    }
                        $msg .= '<div class="social_media_item"><a href="'.$s['link'].'" target="_blank"><i class="fa '.$icon.'" aria-hidden="true"></i></a></div>';

                }
                $msg .= '';
            }
    
    return $msg;
}


add_shortcode('animated_numbers', 'animated_numbers_func');

function animated_numbers_func($atts)
{
    extract(shortcode_atts(array(
        'id' => '',
        'start_val' => '',
        'final_val' => '',
        'decimals' => '0',
        'duration' => ''
    ), $atts));


    $msg = '<div id="'.$id.'" class="anim_numbers" data-start="'.$start_val.'"  data-final="'.$final_val.'" data-decimals="'.$decimals.'" data-duration="'.$duration.'" ></div>';


    return $msg;
}



if (!function_exists('sbp_post_title_breadcrumb')) {

    function sbp_post_title_breadcrumb($post_id, $post_title)
    {
        $msg = '<div class="sbp_breadcrumb">' . sbp_breadcrumbs() . '</div>';
        $developer_content = do_action_ref_array('sbp_title_wrap_filter', array(&$msg));
        if ($developer_content != '') {
            $msg = $developer_content;
        }
        return $msg;
    }
}
add_filter('sbp_get_post_title_breadcrumb', 'sbp_post_title_breadcrumb', 10, 2);

function sbp_breadcrumbs()
{

    // Settings
    $separator = '<span class="sbp-breadcrump-seperator">></span>';
    $breadcrums_id = 'breadcrumbs';
    $breadcrums_class = 'breadcrumbs';
    $home_title = __('Home', 'simple-bookings-plugin');
    $prefix = '';
    $custom_taxonomy = '';
    $msg = '';

    // Get the query & post information
    global $post, $wp_query;

    // Do not display on the homepage
    if (!is_front_page()) {

        // Build the breadcrums
        $msg .= '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '" itemscope itemtype="http://schema.org/BreadcrumbList">';

        // Home page
        $msg .= '<li class="item-home" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        $msg .= '<li class=""> ' . $separator . ' </li>';

        if (is_archive() && !is_tax() && !is_category() && !is_tag()) {

            $msg .= '<li class="item-current item-archive" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';

        } else if (is_archive() && is_tax() && !is_category() && !is_tag()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                $msg .= '<li class="item-cat item-custom-post-type-' . $post_type . '" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                $msg .= '<li class=""> ' . $separator . ' </li>';

            }

            $custom_tax_name = get_queried_object()->name;
            $msg .= '<li class="item-current item-archive" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';

        } else if (is_single()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {

                $post_id = get_the_ID();
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                $msg .= '<li class="item-cat item-custom-post-type-' . $post_type . '" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                $msg .= '<li class="">  ' . $separator . '  </li>';

                switch ($post_type) {
                    case 'krf_projects':
                        $taxonomy = 'krf_services';
                        break;
                    default:
                        $taxonomy = '';
                        break;
                }

                if (!empty($taxonomy)) {
                    $terms = get_the_terms($post_id, $taxonomy) ?: array();
                    if (!empty($terms)) {
                        $term_link = get_term_link($terms[0]->term_id);

                        $msg .= '<li class="item-cat item-custom-post-type-' . $post_type . '" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $term_link . '" title="' . $terms[0]->name . '">' . $terms[0]->name . '</a></li>';
                        $msg .= '<li class="">  ' . $separator . '  </li>';
                    }
                }

            }

            // Get post category info
            $category = get_the_category();

            if (!empty($category)) {

                // Get last category post is in
                $last_category = end(array_values($category));

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','), ',');
                $cat_parents = explode(',', $get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach ($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">' . $parents . '</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }

            }

            // If it's a custom post type within a custom taxonomy

            /*ssos edw prepei na mpei o kwdikos gia tin katigoria*/

            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);
                $cat_id = $taxonomy_terms[0]->term_id;
                $cat_nicename = $taxonomy_terms[0]->slug;
                $cat_link = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name = $taxonomy_terms[0]->name;

            }

            // Check if the post is in a category
            if (!empty($last_category)) {
                $msg .= $cat_display;
                $msg .= '<li class="item-current item-' . $post->ID . '" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

                // Else if post is in a custom taxonomy
            } else if (!empty($cat_id)) {

                $msg .= '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                $msg .= '<li class="separator"> ' . $separator . ' </li>';
                $msg .= '<li class="item-current item-' . $post->ID . '" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

            } else {

                $msg .= '<li class="item-current item-' . $post->ID . '" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

            }

        }

        $msg .= '</ul>';

    }
    return $msg;

}

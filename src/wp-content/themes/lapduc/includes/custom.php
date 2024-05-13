<?php
add_action('wp_enqueue_scripts', 'namtech_scripts');
function namtech_scripts()
{
    $version = date("Hhis");

    // Load CSS
    wp_enqueue_style('bootstrap-css', THEME_URL . '/assets/lib/bootstrap/bootstrap.css', array(), $version, 'all');
    wp_enqueue_style('slick-css', THEME_URL . '/assets/lib/slickJS/slick.css', array(), $version, 'all');
    wp_enqueue_style('splide-css', THEME_URL . '/assets/lib/splide/splide.min.css', array(), $version, 'all');
    wp_enqueue_style('slick-theme-css', THEME_URL . '/assets/lib/slickJS/slick-theme.css', array(), $version, 'all');
    wp_enqueue_style('custom-css', THEME_URL . '/assets/css/style.css', array(), $version, 'all');

    // Load JS
    wp_enqueue_script('bootstrap-js', THEME_URL . '/assets/lib/bootstrap/bootstrap.bundle.min.js', array('jquery'), $version, true);
    wp_enqueue_script('slick-js', THEME_URL . '/assets/lib/slickJS/slick.js', array('jquery'), $version, true);
    wp_enqueue_script('splide-js', THEME_URL . '/assets/lib/splide/splide.min.js', array('jquery'), $version, true);
    wp_enqueue_script('custom-scripts-js', THEME_URL . '/assets/js/main.js', array('jquery'), $version, true);
}


/**
 * Menu Register
 */
register_nav_menus(
    array(
        "primary"    => __("Primary Menu"),
        "footer"     => __("Footer Menu")
    )
);



/*
 * Add Image Size for Wordpress
 */
if (function_exists('add_image_size')) {
    // add_image_size('nameImage', 392, 245, true);    
}

add_theme_support('post-thumbnails', array(
    'post',
    'page',
    'custom-post-type-name',
));
add_theme_support('custom-logo');

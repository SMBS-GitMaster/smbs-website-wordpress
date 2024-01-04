<?php

// Desactivar el editor de bloques Gutenberg en widgets.
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

function smbs_theme_support()
{
    //Adds dynamic title tag support
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'smbs_theme_support');

function smbs_register_styles()
{
    $version = wp_get_theme()->get('Version');

    wp_enqueue_style('smbs-style', get_template_directory_uri() . "/style.css", array('smbs-bootstrap'), $version, 'all');
    wp_enqueue_style('smbs-main-style', get_template_directory_uri() . "/assets/css/main.css", array(), $version, 'all');
    wp_enqueue_style('smbs-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css", array(), '5.3.2', 'all');
    wp_enqueue_style('smbs-fontawesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css", array(), '5.13.0', 'all');
}

add_action('wp_enqueue_scripts', 'smbs_register_styles');

function smbs_register_scripts()
{
    wp_enqueue_script('jquery');
    // wp_enqueue_script('smbs-jquery', "https://code.jquery.com/jquery-3.4.1.slim.min.js", array(), '3.4.1', true);
    wp_enqueue_script('smbs-popper', "https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js", array(), '1.16.0', true);
    wp_enqueue_script('smbs-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js", array(), '5.3.2', true);
    wp_enqueue_script('smbs-mainjs', get_template_directory_uri() . "/assets/js/main.js", array(), '1.0', true);
    wp_enqueue_script('smbs-headerjs', get_template_directory_uri() . "/assets/js/layout/header.js", array(), '1.0', true);

}
add_action('wp_enqueue_scripts', 'smbs_register_scripts');

function smbs_widget_areas()
{
    register_sidebar(
        array(
            'name' => 'Footer Area',
            'id' => 'footer-1',
            'description' => 'Footer Widget Area',
            'before_title' => '',
            'after_title' => '',
            'before_widget' => '',
            'after_widget' => ''
        )
    );
}

add_action('widgets_init', 'smbs_widget_areas');

function smbs_allow_file_types($mimes)
{
    $mimes['ico'] = 'image/vnd.microsoft.icon';
    return $mimes;
}

add_filter('upload_mimes', 'smbs_allow_file_types');

function smbs_add_custom_class_to_primary_menu($classes, $item, $args)
{
    if ('primary' === $args->theme_location) {
        $classes[] = 'header-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'smbs_add_custom_class_to_primary_menu', 10, 3);

function smbs_add_custom_class_to_menu_link($atts, $item, $args)
{
    if ('primary' === $args->theme_location) {
        $atts['class'] = 'header-link '; 
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'smbs_add_custom_class_to_menu_link', 10, 3);

function smbs_theme_customize_register($wp_customize)
{
    $wp_customize->add_section('smbs_header_section', array(
        'title'    => __('Header Settings', 'mytheme'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('smbs_header_button_text', array(
        'default'   => 'Default Text',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting('smbs_header_button_url', array(
        'default'   => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'smbs_header_button_text_control',
        array(
            'label'    => __('Button Text', 'smbs'),
            'section'  => 'smbs_header_section',
            'settings' => 'smbs_header_button_text',
            'type'     => 'text'
        )
    ));

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'smbs_header_button_url_control',
        array(
            'label'    => __('Button URL', 'smbs'),
            'section'  => 'smbs_header_section',
            'settings' => 'smbs_header_button_url',
            'type'     => 'url'
        )
    ));
}
add_action('customize_register', 'smbs_theme_customize_register');

function smbs_menus()
{
    $locations = array(
        'primary' => 'Desktop Primary Left Sidebar',
        'footer' => 'Footer Menu Items'
    );

    register_nav_menus($locations);
}

add_action('init', 'smbs_menus');

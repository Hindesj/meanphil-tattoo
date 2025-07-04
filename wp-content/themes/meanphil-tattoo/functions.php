<?php

use Roots\Acorn\Application;

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

Application::configure()
    ->withProviders([
        App\Providers\ThemeServiceProvider::class,
    ])
    ->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });


if( function_exists('acf_add_options_page') ) {

    // Add the Geonetric Options page
    acf_add_options_page(array(
        'page_title'    => __('MeanPhil Options'),
        'menu_title'    => __('MeanPhil Options'),
        'menu_slug'     => 'meanphil-options',
        'capability'    => 'edit_theme_options',
        'redirect'      => false
    ));
    acf_add_options_sub_page(array(
        'page_title'    => 'Footer',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'meanphil-options',
    ));
}

// Enqueue Swiper.js in WordPress
function enqueue_alpine_assets() {
    wp_enqueue_script('alpine-js', 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js', [], "2.3.5", true);
}
add_action('wp_enqueue_scripts', 'enqueue_alpine_assets');

add_filter('nav_menu_link_attributes', 'add_custom_attribute_to_nav_links', 10, 3);
function add_custom_attribute_to_nav_links($atts, $item, $args) {
    // Target a specific menu location
    if ($args->theme_location === 'primary_navigation') {
        $atts['@click'] = 'isOpen = false'; // Replace with your desired attribute
    }
    return $atts;
}

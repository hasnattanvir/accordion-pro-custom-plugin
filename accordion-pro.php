<?php
/**
 * Plugin Name: Accordion Pro
 * Description: A simple accordion widget for Elementor.
 * Version: 1.0
 * Author: A H Tanvir
 * Requires at least: 5.6
 * Requires PHP: 8.0
 * Author URI: https://github.com/hasnattanvir
 * License: GPL V2 or later
 * License URI: http://www.gnu.org/licenses/lgpl.html
 * Text Domain:accordion-pro
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function accordion_pro_register_widget( $widgets_manager ) {
    require_once( __DIR__ . '/widgets/accordion-widget.php' );
    $widgets_manager->register( new \Accordion_Pro_Widget() );
}
add_action( 'elementor/widgets/register', 'accordion_pro_register_widget' );

function accordion_pro_register_styles() {
    wp_register_style( 'accordion-pro', plugins_url( 'assets/css/accordion-pro.css', __FILE__ ) );
    wp_enqueue_style( 'accordion-pro' );
}
add_action( 'wp_enqueue_scripts', 'accordion_pro_register_styles' );

function accordion_pro_register_scripts() {
    wp_register_script( 'accordion-pro', plugins_url( 'assets/js/accordion-pro.js', __FILE__ ), [ 'jquery' ], false, true );
    wp_enqueue_script( 'accordion-pro' );
}
add_action( 'wp_enqueue_scripts', 'accordion_pro_register_scripts' );


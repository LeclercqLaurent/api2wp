<?php

/**
 * @package Liaison_API
 * @version 1.0
 */
/*
Plugin Name: Liaison Api<>Wordpress
Plugin URI:
Description: Gestion du moteur de recherches des structures.
Author: Laurent LECLERCQ
Version: 1.0
Author URI: https://www.codeam.fr/
*/

if (!defined('ABSPATH')) die();

require 'vendor/autoload.php';

use App\Controller\FormController;
use App\Controller\ResultController;

$attributes = [];
$attributes = shortcode_atts(['thematic' => '', 'url' => ''], $attributes);

add_shortcode("form", "form");
add_shortcode("results", "results");

function wp_load_plugin_css() {
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'style1', $plugin_url . 'public/css/style.css' );
}
add_action( 'wp_enqueue_scripts', 'wp_load_plugin_css' );

function cmp($a, $b): int
{
    if ($a['weight'] === $b['weight']) {
        return 0;
    }
    return ($a['weight'] < $b['weight']) ? -1 : 1;
}

function form($attributes): string
{
    $form = new FormController($attributes);
    return $form->getForm();

}

function results($attributes): ?string
{
    $result = new ResultController($attributes);
    return $result->getResults();
}

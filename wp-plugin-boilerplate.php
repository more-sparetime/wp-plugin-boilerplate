<?php

/*
 * Plugin Name:       wp-plugin-boilerplante
 * Plugin URI:        https://github.com/more-sparetime/wp-plugin-boilerplate
 * Description:       https://github.com/more-sparetime/wp-plugin-boilerplate
 * Author:            https://github.com/more-sparetime
 * Version:           0.0.0
 * Author URI:        https://github.com/more-sparetime
 * Text Domain:       wp-plugin-boilerplate
 * Domain Path:       /assets/languages
*/

use MoreSparetime\WordPress\PluginBuilder\Plugin;

require_once 'autoloader.php';

$plugin = new Plugin('wp-plugin-boilerplate');

//$plugin->shortcode('test-shortcode');

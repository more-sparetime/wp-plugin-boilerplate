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

use MoreSparetime\WordPress\PluginBuilder\Admin\Menu\Menu;
use MoreSparetime\WordPress\PluginBuilder\Admin\Page;
use MoreSparetime\WordPress\PluginBuilder\Plugin;
use Plugin\Controllers;

require_once 'autoloader.php';

// YOUR CODES BELOW THIS LINE... have fun :)

$plugin = new Plugin('wp-plugin-boilerplate', [
    'views_dir' => __DIR__ . '/src/Views',
]);

// ADMIN PAGE / Menu
// see https://codex.wordpress.org/Shortcode

$pageHelp = new Page($plugin, 'help', 'Help', $plugin->controller(Controllers\Page\Example::class, 'help'));
$topMenu = new Menu($pageHelp, 'WP-BP');
$plugin->addMenu($topMenu);

// SHORT CODES
// see https://codex.wordpress.org/Shortcode

$plugin->shortcode('test-shortcode', $plugin->controller(Controllers\Cron\Example::class, 'test1'));

// CRONS
// see https://developer.wordpress.org/plugins/cron/

//$plugin->cron('test-shortcode', $plugin->controller(Controllers\Cron\Example::class, 'test1'));

$plugin->attachHooks();
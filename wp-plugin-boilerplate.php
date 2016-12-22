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
use MoreSparetime\WordPress\PluginBuilder\Admin\Menu\SubMenu;
use MoreSparetime\WordPress\PluginBuilder\Admin\Page;
use MoreSparetime\WordPress\PluginBuilder\Plugin;
use Plugin\Controllers;

require_once 'autoloader.php';

// YOUR CODES BELOW THIS LINE... have fun :)

$plugin = new Plugin('wp-plugin-boilerplate', [
    'views_dir'  => __DIR__ . '/src/Views',
    'assets_dir' => __DIR__ . '/assets',
]);

// ADMIN PAGE / MENU
// see https://codex.wordpress.org/Shortcode

$pageDashboard = new Page($plugin, 'dashboard-url', 'Dashboard', $plugin->controller(Controllers\Page\Example::class, 'dashboard'));
$pageProfiler = new Page($plugin, 'profiler', 'Profiler', $plugin->controller(Controllers\Page\Example::class, 'profiler'));
$pageShortcodes = new Page($plugin, 'shortcodes', 'Shortcodes', $plugin->controller(Controllers\Page\Example::class, 'shortcodes'));
$pageAjaxCalls = new Page($plugin, 'ajax-calls', "Ajax Calls", $plugin->controller(Controllers\Page\Example::class, 'ajaxCalls'));
$pageHelp = new Page($plugin, 'help', 'Help', $plugin->controller(Controllers\Page\Example::class, 'help'));

$topMenu = new Menu($pageDashboard, 'WP-PBP');

$topMenu->addSubMenu(new SubMenu($topMenu, $pageProfiler, 'Profiler'));
$topMenu->addSubMenu(new SubMenu($topMenu, $pageShortcodes, 'Shortcodes'));
$topMenu->addSubMenu(new SubMenu($topMenu, $pageAjaxCalls, 'Ajax Calls'));
$topMenu->addSubMenu(new SubMenu($topMenu, $pageHelp, 'Help'));

$plugin->addMenu($topMenu);

// ADD JS/CSS FILES
// see https://developer.wordpress.org/themes/basics/including-css-javascript/

$plugin->addCss('my-css', plugins_url('assets/css/styles.css', __FILE__));
$plugin->addJsHeader('my-js-header', plugins_url('assets/js/scripts-header.js', __FILE__));
$plugin->addJsFooter('my-js-footer', plugins_url('assets/js/scripts-footer.js', __FILE__), ['jquery']);

// SHORT CODES
// see https://codex.wordpress.org/Shortcode

$plugin->shortcode('test-shortcode', $plugin->controller(Controllers\Cron\Example::class, 'test1'));

// AJAX CALLS
// see https://codex.wordpress.org/AJAX_in_Plugins

$plugin->ajaxCallInternal('getRandomNumber', $plugin->controller(Controllers\Ajax\Internal\Example::class, 'getRandomNumber'));
$plugin->ajaxCallInternal('testError', $plugin->controller(Controllers\Ajax\Internal\Example::class, 'testError'));

// CRONS
// see https://developer.wordpress.org/plugins/cron/

//$plugin->cron('test-shortcode', $plugin->controller(Controllers\Cron\Example::class, 'test1'));

$plugin->attachHooks();
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

$plugin = new Plugin('my-prefix', [
    'views_dir'  => __DIR__ . '/src/Views',
    'assets_dir' => __DIR__ . '/assets',
]);

// ADMIN PAGE / MENU

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

$plugin->addCss('my-css', plugins_url('assets/css/styles.css', __FILE__));
$plugin->addJsHeader('my-js-header', plugins_url('assets/js/scripts-header.js', __FILE__));
$plugin->addJsFooter('my-js-footer', plugins_url('assets/js/scripts-footer.js', __FILE__), ['jquery']);

// SHORT CODES

$plugin->shortcode('test-shortcode', $plugin->controller(Controllers\Cron\Example::class, 'test1'));

// AJAX CALLS

$plugin->ajaxCallInternal('getRandomNumber', $plugin->controller(Controllers\Ajax\Internal\Example::class, 'getRandomNumber'));
$plugin->ajaxCallInternal('testError', $plugin->controller(Controllers\Ajax\Internal\Example::class, 'testError'));

// CRONS

$plugin->cron('test-hourly', $plugin->controller(Controllers\Cron\Example::class, 'hourly'), 'hourly');
$plugin->cron('test-daily', $plugin->controller(Controllers\Cron\Example::class, 'daily'), 'daily');

// WORK WITH HOOKS

$plugin->addAction('save_post', function ($postId) {
    // send an email or do something exciting
});

// CUSTOM HOOKS

$plugin->addActionCustom('subtract', function () {
    $data = func_get_arg(0);
    $result = $data[0] - $data[1];
    // do something with the result
});

$plugin->triggerActionCustom('subtract', [10, 8]);

$plugin->addActionCustomWithDefault('divide', function () {
    $data = func_get_arg(0);
    $result = $data[0] / $data[1];
    // do something with the result
}, [10, 5]);

// Custom Widgets
$plugin->addWidget('Example_Widget');

// CONNECT ALL LAZY HOOKS
$plugin->attachHooks();
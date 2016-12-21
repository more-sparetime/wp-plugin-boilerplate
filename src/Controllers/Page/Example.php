<?php

namespace Plugin\Controllers\Page;

use MoreSparetime\WordPress\PluginBuilder\Controller\Controller;

/**
 * Class Test
 *
 * @package Plugin\Controllers\Shortcodes
 * @author  Andreas Glaser
 */
class Example extends Controller
{
    public function help()
    {
        $viewData = [
            'title' => $this->plugin->t('Help'),
        ];

        echo $this->plugin->view('Page/Example/help.html.php', $viewData);
    }

    public function ajaxCalls()
    {
        $viewData = [];

        echo $this->plugin->view('Page/Example/ajax_calls.html.php', $viewData);
    }

    public function shortcodes()
    {
        $viewData = [];

        echo $this->plugin->view('Page/Example/shortcodes.html.php', $viewData);
    }
}
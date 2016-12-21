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
    /**
     * @author Andreas Glaser
     */
    public function dashboard()
    {
        $viewData = [];

        echo $this->plugin->view('Page/Example/dashboard.html.php', $viewData);
    }

    public function profiler()
    {
        $viewData = [
            'title' => $this->plugin->t('Profiler'),
        ];

        echo $this->plugin->view('Page/Example/profiler.html.php', $viewData);
    }

    /**
     * @author Andreas Glaser
     */
    public function help()
    {
        $viewData = [
            'title' => $this->plugin->t('Help'),
        ];

        echo $this->plugin->view('Page/Example/help.html.php', $viewData);
    }

    /**
     * @author Andreas Glaser
     */
    public function ajaxCalls()
    {
        $viewData = [
            'title' => "Ajax Calls"
        ];

        echo $this->plugin->view('Page/Example/ajax_calls.html.php', $viewData);
    }

    /**
     * @author Andreas Glaser
     */
    public function shortcodes()
    {
        $viewData = [];

        echo $this->plugin->view('Page/Example/shortcodes.html.php', $viewData);
    }
}
<?php

namespace Plugin\Controllers\Cron;

use MoreSparetime\WordPress\PluginBuilder\Controller\Controller;
use MoreSparetime\WordPress\PluginBuilder\Shortcode\Shortcode;

/**
 * Class Example
 *
 * @package Plugin\Controllers\Cron
 * @author  Andreas Glaser
 */
class Example extends Controller
{
    /**
     * @param \MoreSparetime\WordPress\PluginBuilder\Shortcode\Shortcode $shortcode
     * @param array                                                      $attributes
     * @param string                                                     $content
     *
     * @author Andreas Glaser
     */
    public function test1(Shortcode $shortcode, array $attributes, $content)
    {
        $viewData = [
            'subTitle' => 'This is great',
        ];

        echo $this->plugin->view('Shortcode/Example/test1.html.php', $viewData);
    }
}
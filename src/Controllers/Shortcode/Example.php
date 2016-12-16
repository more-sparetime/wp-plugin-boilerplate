<?php

namespace Plugin\Controllers\Shortcode;

use MoreSparetime\WordPress\PluginBuilder\Controller\Controller;

/**
 * Class Example
 *
 * @package Plugin\Controllers\Shortcode
 * @author  Andreas Glaser
 */
class Example extends Controller
{
    public function test1(array $data)
    {
        $viewData = [
            'subTitle' => 'This is great',
        ];

        echo $this->plugin->view('Shortcode/Example/test1.html.php', $viewData);
    }
}
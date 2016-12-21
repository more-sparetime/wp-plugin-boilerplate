<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 12/16/16
 * Time: 6:10 PM
 */
namespace Plugin\Controllers\Ajax\Internal;

use MoreSparetime\WordPress\PluginBuilder\Controller\Controller;

/**
 * Class Example
 * @package Plugin\Controllers\Ajax\Internal
 *
 */
class Example extends Controller
{
    public function getRandomNumber()
    {
        $return = array(
            'number' => mt_rand(10,1000)
        );

        wp_send_json_success($return);
    }
}
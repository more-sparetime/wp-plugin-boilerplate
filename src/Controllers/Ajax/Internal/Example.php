<?php

namespace Plugin\Controllers\Ajax\Internal;

use MoreSparetime\WordPress\PluginBuilder\Controller\Controller;

/**
 * Class Example
 *
 * @package Plugin\Controllers\Ajax\Internal
 * @author  Xavier Sanna <xavier.sanna@gmail.com>
 */
class Example extends Controller
{
    /**
     * @author  Xavier Sanna <xavier.sanna@gmail.com>
     */
    public function getRandomNumber()
    {
        $return = [
            'number' => mt_rand(10, 1000),
        ];

        wp_send_json_success($return);
    }

    /**
     * @author Andreas Glaser
     */
    public function testError()
    {
        $this->addError('The world is soon coming to an end...', 'request-validation', ['info' => 'Programming is so much fun']);

        if ($errors = $this->getErrors()) {
            wp_send_json_error($errors);
        }

        // this line should never be reached
        wp_send_json([]);
    }
}
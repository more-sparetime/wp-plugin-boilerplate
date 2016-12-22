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
        if (1 !== 2) {
            $this->addError('The world is soon coming to an end...', 'request-validation', ['info' => '1 should never be equal to 2']);
        }

        if ($errors = $this->getErrors()) {
            wp_send_json_error($errors);
        }

        wp_send_json_success(['All is well']);
    }
}
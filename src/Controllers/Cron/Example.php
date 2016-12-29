<?php

namespace Plugin\Controllers\Cron;

use MoreSparetime\WordPress\PluginBuilder\Controller\Controller;

/**
 * Class Example
 *
 * @package Plugin\Controllers\Cron
 * @author  Andreas Glaser
 */
class Example extends Controller
{
    /**
     * @author Andreas Glaser
     */
    public function hourly()
    {
        global $wpdb;

        // run some database updates or query external REST apis... anything goes

        //$wpdb->update('my_table', ['updated_at' => date('Y-m-d H:i:s'), ['id' => 123]]);
    }

    /**
     * @author Andreas Glaser
     */
    public function daily()
    {
        global $wpdb;

        // run some database updates or query external REST apis... anything goes

        //$wpdb->update('my_table', ['updated_at' => date('Y-m-d H:i:s'), ['id' => 123]]);
    }
}
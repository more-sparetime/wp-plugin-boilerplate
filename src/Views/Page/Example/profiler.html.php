<?php
/** @var \MoreSparetime\WordPress\PluginBuilder\Plugin $plugin */
?>
<div class="wrap">
    <h1>Profiler</h1>

    <h2>Registered Shortcodes</h2>
    <p>This is a list of all shortcodes you have currently registered in your plugin.</p>

    <table class="wp-list-table widefat fixed striped">

        <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Usage</th>
        </tr>
        </thead>

        <tbody>
        <?php if (!empty($plugin->getShortcodes())): ?>
            <?php foreach ($plugin->getShortcodes() AS $shortcode): ?>
                <tr>
                    <td><?php print $shortcode->getName(); ?></td>
                    <td><?php print $shortcode->getSlug(); ?></td>
                    <td>[<?php print $shortcode->getSlug(); ?>]</td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" style="text-align: center;">You do not have any shorcodes registerd yet... :(</td>
            </tr>
        <?php endif; ?>
        </tbody>

    </table>

    <h2>Registered Ajax Calls</h2>
    <p>This is a list of all ajax calls you have currently registered in your plugin.</p>

    <table class="wp-list-table widefat fixed striped">

        <thead>
        <tr>
            <th>Slug</th>
            <th>Internal</th>
            <th>External</th>
        </tr>
        </thead>

        <tbody>
        <?php if (!empty($plugin->getAjaxCalls())): ?>
            <?php foreach ($plugin->getAjaxCalls() AS $ajaxCall): ?>
                <tr>
                    <td><?php print $ajaxCall->getSlug(); ?></td>
                    <td><?php print (
                        $ajaxCall->getInternal() ?
                            '<span class="dashicons dashicons-yes"></span>' :
                            '<span class="dashicons dashicons-no-alt"></span>'
                        ); ?>
                    </td>
                    <td><?php print (
                        $ajaxCall->getExternal() ?
                            '<span class="dashicons dashicons-yes"></span>' :
                            '<span class="dashicons dashicons-no-alt"></span>'
                        ); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" style="text-align: center;">You do not have any ajax call registered yet... :(</td>
            </tr>
        <?php endif; ?>
        </tbody>

    </table>
</div>
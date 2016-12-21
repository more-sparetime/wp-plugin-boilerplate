<?php
/** @var \MoreSparetime\WordPress\PluginBuilder\Plugin $plugin */
?>

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

<h2>How to use shortcodes?</h2>
<p>Insert tutorial here...</p>

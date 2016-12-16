<?php
/** @var \MoreSparetime\WordPress\PluginBuilder\Plugin $plugin */
?>

<h2><?php print $title; ?></h2>

<p><?php print $plugin->t('Some nice copy here! :)'); ?></p>
<p><?php print $plugin->tl('My name is "%s"', 'Hans'); ?></p>
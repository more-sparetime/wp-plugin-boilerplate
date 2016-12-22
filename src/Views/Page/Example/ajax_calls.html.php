<?php
/** @var \MoreSparetime\WordPress\PluginBuilder\Plugin $plugin */
?>
<h1><?php print $title; ?></h1>
<div class="wrap">
    <div class="card">
        <h2><?php print $plugin->t('Example of a successful ajax call'); ?></h2>
        <hr>
        <p>Random Number:</p>
        <p><span id="randomNumber"><strong>click the button</strong></span></p>
        <p>
            <button id="rndButton" class="button-primary">Generate</button>
        </p>
    </div>


    <div class="card" id="ajax-error-example">
        <h2><?php print $plugin->t('Ajax call retuning a graceful error'); ?></h2>
        <hr>
        <p>Output:</p>
        <div class="output"></div>
        <p>
            <button class="button-primary">Execute call</button>
        </p>
    </div>
</div>

<script>
    jQuery(function () {

        jQuery("#rndButton").click(function () {
            jQuery.post(ajaxurl, {
                action: "wp-plugin-boilerplate_getRandomNumber"
            })
                .done(function (response) {
                    if (response.success) {
                        jQuery("#randomNumber").find('strong').html(response.data.number);
                    }
                })
        });

        var ajaxErrorExampleContainer = jQuery('#ajax-error-example');
        var ajaxErrorExampleContainerOutput = ajaxErrorExampleContainer.find('.output');

        ajaxErrorExampleContainer
            .find('button')
            .click(function () {
                jQuery.post(ajaxurl, {
                    action: 'wp-plugin-boilerplate_testError'
                })
                    .done(function (response) {
                        for (var i in response.data) {
                            ajaxErrorExampleContainerOutput.append(jQuery('</p>').html(response.data[i].message));
                        }
                    })
            })
    });
</script>
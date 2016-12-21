<?php
/** @var \MoreSparetime\WordPress\PluginBuilder\Plugin $plugin */
?>

<div class="wrap">
    <h1><?php print $title; ?></h1>
    <div class="card">
        <h2>Example of internal ajax call</h2>
        <hr>
        <p>Random Number:</p>
        <p><span id="randomNumber"><strong>click the button</strong></span></p>
        <p><button id="rndButton" class="button-primary">Generate</button></p>
    </div>
</div>

<script>
    jQuery("#rndButton").click(function(){
        jQuery.post(ajaxurl, {
            action: "wp-plugin-boilerplate_getRandomNumber"
        })
            .done(function(response){
                if(response.success) {
                    jQuery("#randomNumber").find('strong').html(response.data.number);
                }
            })
    })
</script>
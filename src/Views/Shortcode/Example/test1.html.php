<?php
use AndreasGlaser\Helpers\Html\FormHelper;

?>

<h2>SHORT CODE CONTENT
    <small><?php print $subTitle; ?></small>
</h2>

<?php print FormHelper::open(); ?>

<div>
    <?php print FormHelper::text('full_name', null, ['placeholder' => 'Your name']); ?>
</div>

<div>
    <?php print FormHelper::submit(null, 'Submit form'); ?>
</div>

<?php print FormHelper::close(); ?>

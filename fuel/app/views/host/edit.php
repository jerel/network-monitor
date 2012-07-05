<h2>Editing Host</h2><?php echo get_defined_vars(); ?>
<br>

<?php echo render('host/_form'); ?>
<p>
	<?php echo Html::anchor('host/view/'.$host->id, 'View'); ?> |
	<?php echo Html::anchor('host', 'Back'); ?></p>

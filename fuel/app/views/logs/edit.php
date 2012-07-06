<h2>Editing Log</h2>
<br>

<?php echo render('logs/_form'); ?>
<p>
	<?php echo Html::anchor('logs/view/'.$log->id, 'View'); ?> |
	<?php echo Html::anchor('logs', 'Back'); ?></p>

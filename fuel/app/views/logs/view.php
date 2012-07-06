<h2>Viewing #<?php echo $log->id; ?></h2>

<p>
	<strong>Log data:</strong>
	<?php echo $log->log_data; ?></p>

<?php echo Html::anchor('logs/edit/'.$log->id, 'Edit'); ?> |
<?php echo Html::anchor('logs', 'Back'); ?>
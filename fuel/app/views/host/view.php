<h2>Viewing #<?php echo $host->id; ?></h2>

<p>
	<strong>Location:</strong>
	<?php echo $host->location; ?></p>
<p>
	<strong>Frequency:</strong>
	<?php echo $host->frequency; ?></p>
<p>
	<strong>Notify email:</strong>
	<?php echo $host->notify_email; ?></p>
<p>
	<strong>Notify call:</strong>
	<?php echo $host->notify_call; ?></p>
<p>
	<strong>Notify sms:</strong>
	<?php echo $host->notify_sms; ?></p>
<p>
	<strong>Downtime allowed:</strong>
	<?php echo $host->downtime_allowed; ?></p>

<?php echo Html::anchor('host/edit/'.$host->id, 'Edit'); ?> |
<?php echo Html::anchor('host', 'Back'); ?>
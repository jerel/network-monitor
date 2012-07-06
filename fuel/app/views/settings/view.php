<h2>Viewing #<?php echo $setting->id; ?></h2>

<p>
	<strong>Slug:</strong>
	<?php echo $setting->slug; ?></p>
<p>
	<strong>Value:</strong>
	<?php echo $setting->value; ?></p>
<p>
	<strong>Required:</strong>
	<?php echo $setting->required; ?></p>

<?php echo Html::anchor('settings/edit/'.$setting->id, 'Edit'); ?> |
<?php echo Html::anchor('settings', 'Back'); ?>
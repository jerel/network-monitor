<h2>Editing Setting</h2>
<br>

<?php echo render('settings/_form'); ?>
<p>
	<?php echo Html::anchor('settings/view/'.$setting->id, 'View'); ?> |
	<?php echo Html::anchor('settings', 'Back'); ?></p>

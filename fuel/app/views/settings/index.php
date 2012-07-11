<h2>Listing Settings</h2>
<br>
<?php if ($settings): ?>
<table class="zebra-striped">
	<thead>
		<tr>
			<th>Slug</th>
			<th>Value</th>
			<th>Required</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($settings as $setting): ?>		<tr>

			<td><?php echo $setting->slug; ?></td>
			<td>
				<?php echo $setting->value; ?>
				<?php if (in_array($setting->slug, array('downtime_allowed', 'ping_frequency', 'notification_frequency'))): ?>
					seconds
				<?php endif; ?>
			</td>
			<td><?php echo $setting->required; ?></td>
			<td>
				<?php echo Html::anchor('settings/view/'.$setting->id, 'View'); ?> |
				<?php echo Html::anchor('settings/edit/'.$setting->id, 'Edit'); ?>
				<?php if ( ! $setting->required): ?> |
					<?php echo Html::anchor('settings/delete/'.$setting->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
				<?php endif; ?>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Settings.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('settings/create', 'Add new Setting', array('class' => 'btn success')); ?>

</p>

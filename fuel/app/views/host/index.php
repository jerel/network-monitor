<h2>Servers Currently Monitored</h2>
<br>
<?php if ($hosts): ?>
<table class="zebra-striped">
	<thead>
		<tr>
			<th>Location</th>
			<th>Monitoring</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($hosts as $host): ?>		
			<tr>
				<td><?php echo $host->location; ?></td>
				<td><?php echo $host->monitor; ?></td>
				<td>
					<?php echo Html::anchor('host/view/'.$host->id, 'View'); ?> |
					<?php echo Html::anchor('host/edit/'.$host->id, 'Edit'); ?> |
					<?php echo Html::anchor('host/delete/'.$host->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

					</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
	<p>No servers are being monitored.</p>
<?php endif; ?><p>
	<?php echo Html::anchor('host/create', 'Add new Host', array('class' => 'btn success')); ?>
</p>

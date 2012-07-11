<h2>Listing Logs</h2>
<p>If logs are not being generated open a terminal and run these commands:</p>
<pre><code>cd <?php echo str_replace('/fuel/app/', '', APPPATH); ?> 
sudo php oil r monitor</code></pre>
<br>
<?php if ($logs): ?>
<table class="zebra-striped">
	<thead>
		<tr>
			<th>Log data</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($logs as $log): ?>		<tr>

			<td><?php echo $log->log_data; ?></td>
			<td>
				<?php echo Html::anchor('logs/view/'.$log->id, 'View'); ?> |
				<?php echo Html::anchor('logs/edit/'.$log->id, 'Edit'); ?> |
				<?php echo Html::anchor('logs/delete/'.$log->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Logs.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('logs/create', 'Add new Log', array('class' => 'btn success')); ?>

</p>

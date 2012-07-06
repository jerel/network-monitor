<?php echo Form::open(array('class' => 'form-stacked')); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Log data', 'log_data'); ?>

			<div class="input">
				<?php echo Form::textarea('log_data', Input::post('log_data', isset($log) ? $log->log_data : ''), array('class' => 'span10', 'rows' => 8)); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>
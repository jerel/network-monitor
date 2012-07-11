<?php echo Form::open(array('class' => 'form-stacked')); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Location', 'location'); ?>
			<span>Domain or IP address</span>

			<div class="input">
				<?php echo Form::input('location', Input::post('location', isset($host) ? $host->location : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Monitor', 'monitor'); ?>
			<span>Set to 0 to temporarily disable monitoring of this server so you can do maintenance. Set to 1 to activate.</span>

			<div class="input">
				<?php echo Form::input('monitor', Input::post('monitor', isset($host) ? $host->monitor : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>
			<?php echo Html::anchor('host', 'Back', array('class' => 'btn')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>
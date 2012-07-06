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
			<?php echo Form::label('Notify email', 'notify_email'); ?>
			<span>Email address to notify if this machine goes down. Separate multiple addresses with a comma.</span>

			<div class="input">
				<?php echo Form::input('notify_email', Input::post('notify_email', isset($host) ? $host->notify_email : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Notify call', 'notify_call'); ?>
			<span>Phone number to call if this machine goes down. Separate multiple phones with a comma.</span>

			<div class="input">
				<?php echo Form::input('notify_call', Input::post('notify_call', isset($host) ? $host->notify_call : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Notify sms', 'notify_sms'); ?>
			<span>Mobile number to text if this machine goes down. Separate multiple mobiles with a comma.</span>

			<div class="input">
				<?php echo Form::input('notify_sms', Input::post('notify_sms', isset($host) ? $host->notify_sms : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Downtime allowed', 'downtime_allowed'); ?>
			<span>Number of seconds this machine can be down before notifications are sent.</span>

			<div class="input">
				<?php echo Form::input('downtime_allowed', Input::post('downtime_allowed', isset($host) ? $host->downtime_allowed : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>
			<?php echo Html::anchor('host', 'Back', array('class' => 'btn')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>
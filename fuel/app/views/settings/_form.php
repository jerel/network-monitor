<?php echo Form::open(array('class' => 'form-stacked')); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Slug', 'slug'); ?>

			<div class="input">
				<?php echo Form::input('slug', Input::post('slug', isset($setting) ? $setting->slug : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Value', 'value'); ?>

			<div class="input">
				<?php echo Form::textarea('value', Input::post('value', isset($setting) ? $setting->value : ''), array('class' => 'span10', 'rows' => 8)); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Required', 'required'); ?>

			<div class="input">
				<?php echo Form::input('required', Input::post('required', isset($setting) ? $setting->required : ''), array('class' => 'span6')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>
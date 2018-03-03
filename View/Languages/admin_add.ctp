<div class="languages form">
<?php echo $this->Form->create('Language'); ?>
	<fieldset>
		<legend><?php echo __('Adauga o limba'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => 'Nume', 'class' => 'form-control'));
		echo $this->Form->input('code', array('label' => 'Cod', 'class' => 'form-control'));
		echo $this->Form->input('is_default', array('label' => 'Seteaza ca limba primara', 'class' => 'form-control', 'value' => '0'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Salveaza')); ?>
</div>

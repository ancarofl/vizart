<div class="intrebariTraduceris form">
<?php echo $this->Form->create('IntrebariTraduceri'); ?>
	<fieldset>
		<legend><?php echo __('Add Intrebari Traduceri'); ?></legend>
	<?php
		echo $this->Form->input('intrebare_id');
		echo $this->Form->input('language_id');
		echo $this->Form->input('translation');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Intrebari Traduceris'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Intrebares'), array('controller' => 'intrebares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Intrebare'), array('controller' => 'intrebares', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Languages'), array('controller' => 'languages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Language'), array('controller' => 'languages', 'action' => 'add')); ?> </li>
	</ul>
</div>

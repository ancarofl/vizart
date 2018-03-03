<div class="raspunsuriTraduceris form">
<?php echo $this->Form->create('RaspunsuriTraduceri'); ?>
	<fieldset>
		<legend><?php echo __('Edit Raspunsuri Traduceri'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('raspuns_id');
		echo $this->Form->input('language_id');
		echo $this->Form->input('translation');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('RaspunsuriTraduceri.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('RaspunsuriTraduceri.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Raspunsuri Traduceris'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Raspuns'), array('controller' => 'raspuns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Raspuns'), array('controller' => 'raspuns', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Languages'), array('controller' => 'languages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Language'), array('controller' => 'languages', 'action' => 'add')); ?> </li>
	</ul>
</div>

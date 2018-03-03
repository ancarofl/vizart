<div class="intrebariTraduceris view">
<h2><?php echo __('Intrebari Traduceri'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($intrebariTraduceri['IntrebariTraduceri']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Intrebare'); ?></dt>
		<dd>
			<?php echo $this->Html->link($intrebariTraduceri['Intrebare']['id'], array('controller' => 'intrebares', 'action' => 'view', $intrebariTraduceri['Intrebare']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Language'); ?></dt>
		<dd>
			<?php echo $this->Html->link($intrebariTraduceri['Language']['name'], array('controller' => 'languages', 'action' => 'view', $intrebariTraduceri['Language']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Translation'); ?></dt>
		<dd>
			<?php echo h($intrebariTraduceri['IntrebariTraduceri']['translation']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Intrebari Traduceri'), array('action' => 'edit', $intrebariTraduceri['IntrebariTraduceri']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Intrebari Traduceri'), array('action' => 'delete', $intrebariTraduceri['IntrebariTraduceri']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $intrebariTraduceri['IntrebariTraduceri']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Intrebari Traduceris'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Intrebari Traduceri'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Intrebares'), array('controller' => 'intrebares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Intrebare'), array('controller' => 'intrebares', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Languages'), array('controller' => 'languages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Language'), array('controller' => 'languages', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="expositions view">
<h2><?php echo __('Exposition'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($exposition['Exposition']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($exposition['Exposition']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Exposition'), array('action' => 'edit', $exposition['Exposition']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Exposition'), array('action' => 'delete', $exposition['Exposition']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $exposition['Exposition']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Expositions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exposition'), array('action' => 'add')); ?> </li>
	</ul>
</div>

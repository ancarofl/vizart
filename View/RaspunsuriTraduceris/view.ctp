<div class="raspunsuriTraduceris view">
<h2><?php echo __('Raspunsuri Traduceri'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($raspunsuriTraduceri['RaspunsuriTraduceri']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Raspuns'); ?></dt>
		<dd>
			<?php echo $this->Html->link($raspunsuriTraduceri['Raspuns']['id'], array('controller' => 'raspuns', 'action' => 'view', $raspunsuriTraduceri['Raspuns']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Language'); ?></dt>
		<dd>
			<?php echo $this->Html->link($raspunsuriTraduceri['Language']['name'], array('controller' => 'languages', 'action' => 'view', $raspunsuriTraduceri['Language']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Translation'); ?></dt>
		<dd>
			<?php echo h($raspunsuriTraduceri['RaspunsuriTraduceri']['translation']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Raspunsuri Traduceri'), array('action' => 'edit', $raspunsuriTraduceri['RaspunsuriTraduceri']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Raspunsuri Traduceri'), array('action' => 'delete', $raspunsuriTraduceri['RaspunsuriTraduceri']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $raspunsuriTraduceri['RaspunsuriTraduceri']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Raspunsuri Traduceris'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Raspunsuri Traduceri'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Raspuns'), array('controller' => 'raspuns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Raspuns'), array('controller' => 'raspuns', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Languages'), array('controller' => 'languages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Language'), array('controller' => 'languages', 'action' => 'add')); ?> </li>
	</ul>
</div>

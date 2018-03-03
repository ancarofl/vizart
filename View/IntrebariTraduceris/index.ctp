<div class="intrebariTraduceris index">
	<h2><?php echo __('Intrebari Traduceris'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('intrebare_id'); ?></th>
			<th><?php echo $this->Paginator->sort('language_id'); ?></th>
			<th><?php echo $this->Paginator->sort('translation'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($intrebariTraduceris as $intrebariTraduceri): ?>
	<tr>
		<td><?php echo h($intrebariTraduceri['IntrebariTraduceri']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($intrebariTraduceri['Intrebare']['id'], array('controller' => 'intrebares', 'action' => 'view', $intrebariTraduceri['Intrebare']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($intrebariTraduceri['Language']['name'], array('controller' => 'languages', 'action' => 'view', $intrebariTraduceri['Language']['id'])); ?>
		</td>
		<td><?php echo h($intrebariTraduceri['IntrebariTraduceri']['translation']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $intrebariTraduceri['IntrebariTraduceri']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $intrebariTraduceri['IntrebariTraduceri']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $intrebariTraduceri['IntrebariTraduceri']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $intrebariTraduceri['IntrebariTraduceri']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Intrebari Traduceri'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Intrebares'), array('controller' => 'intrebares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Intrebare'), array('controller' => 'intrebares', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Languages'), array('controller' => 'languages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Language'), array('controller' => 'languages', 'action' => 'add')); ?> </li>
	</ul>
</div>

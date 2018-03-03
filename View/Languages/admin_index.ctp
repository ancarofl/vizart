<div class="languages index">
	<h2>Limbi</h2>
	  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('name', 'Nume'); ?></th>
			<th><?php echo $this->Paginator->sort('code', 'Cod'); ?></th>
			<th><?php echo $this->Paginator->sort('is_default', 'Limba Primara'); ?></th>
			<th class="actions"><?php echo __('Actiuni'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($languages as $language): ?>
	<tr>
		<td><?php echo h($language['Language']['name']); ?>&nbsp;</td>
		<td><?php echo h($language['Language']['code']); ?>&nbsp;</td>
		<td><?php echo ($language['Language']['is_default']==1)?'Da':''; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Modifica'), array('action' => 'edit', $language['Language']['id'])); ?>
			<?php echo $this->Form->postLink(__('Sterge'), array('action' => 'delete', $language['Language']['id']), array('confirm' => __('Esti sigur ca doresti sa stergi limba # %s?', $language['Language']['name']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
		</p>
	
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Limba noua'), array('action' => 'add')); ?></li>
	</ul>
</div>

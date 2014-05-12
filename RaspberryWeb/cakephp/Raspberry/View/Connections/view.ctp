<div class="connections view">
<h2><?php echo __('Connection'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($connection['Connection']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fifo'); ?></dt>
		<dd>
			<?php echo h($connection['Connection']['fifo_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($connection['User']['name'], array('controller' => 'users', 'action' => 'view', $connection['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Connection'), array('action' => 'edit', $connection['Connection']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Connection'), array('action' => 'delete', $connection['Connection']['id']), null, __('Are you sure you want to delete # %s?', $connection['Connection']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Connections'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Connection'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Connection Notifications'), array('controller' => 'connection_notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Connection Notification'), array('controller' => 'connection_notifications', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Connection Notifications'); ?></h3>
	<?php if (!empty($connection['ConnectionNotification'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Notification Id'); ?></th>
		<th><?php echo __('Connection Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($connection['ConnectionNotification'] as $connectionNotification): ?>
		<tr>
			<td><?php echo $connectionNotification['id']; ?></td>
			<td><?php echo $connectionNotification['notification_id']; ?></td>
			<td><?php echo $connectionNotification['connection_id']; ?></td>
			<td><?php echo $connectionNotification['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'connection_notifications', 'action' => 'view', $connectionNotification['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'connection_notifications', 'action' => 'edit', $connectionNotification['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'connection_notifications', 'action' => 'delete', $connectionNotification['id']), null, __('Are you sure you want to delete # %s?', $connectionNotification['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Connection Notification'), array('controller' => 'connection_notifications', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

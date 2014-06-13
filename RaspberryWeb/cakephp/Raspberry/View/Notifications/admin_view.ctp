<div class="notifications view">
<h2><?php echo __('Notification'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Action'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['action']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['data']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Notification'), array('action' => 'edit', $notification['Notification']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Notification'), array('action' => 'delete', $notification['Notification']['id']), null, __('Are you sure you want to delete # %s?', $notification['Notification']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notification'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Responses'), array('controller' => 'responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Response'), array('controller' => 'responses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Devices Notifications'), array('controller' => 'devices_notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Devices Notifications'), array('controller' => 'devices_notifications', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Responses'); ?></h3>
	<?php if (!empty($notification['Response'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Notification Id'); ?></th>
		<th><?php echo __('Data'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($notification['Response'] as $response): ?>
		<tr>
			<td><?php echo $response['id']; ?></td>
			<td><?php echo $response['notification_id']; ?></td>
			<td><?php echo $response['data']; ?></td>
			<td><?php echo $response['status']; ?></td>
			<td><?php echo $response['created']; ?></td>
			<td><?php echo $response['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'responses', 'action' => 'view', $response['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'responses', 'action' => 'edit', $response['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'responses', 'action' => 'delete', $response['id']), null, __('Are you sure you want to delete # %s?', $response['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Response'), array('controller' => 'responses', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Devices Notifications'); ?></h3>
	<?php if (!empty($notification['DevicesNotifications'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Notification Id'); ?></th>
		<th><?php echo __('Device Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($notification['DevicesNotifications'] as $devicesNotifications): ?>
		<tr>
			<td><?php echo $devicesNotifications['id']; ?></td>
			<td><?php echo $devicesNotifications['notification_id']; ?></td>
			<td><?php echo $devicesNotifications['device_id']; ?></td>
			<td><?php echo $devicesNotifications['status']; ?></td>
			<td><?php echo $devicesNotifications['created']; ?></td>
			<td><?php echo $devicesNotifications['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'devices_notifications', 'action' => 'view', $devicesNotifications['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'devices_notifications', 'action' => 'edit', $devicesNotifications['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'devices_notifications', 'action' => 'delete', $devicesNotifications['id']), null, __('Are you sure you want to delete # %s?', $devicesNotifications['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Devices Notifications'), array('controller' => 'devices_notifications', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

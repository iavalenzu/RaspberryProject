<div class="devices view">
<h2><?php echo __('Device'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($device['Device']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($device['User']['name'], array('controller' => 'users', 'action' => 'view', $device['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fifo Name'); ?></dt>
		<dd>
			<?php echo h($device['Device']['fifo_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Token'); ?></dt>
		<dd>
			<?php echo h($device['Device']['access_token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($device['Device']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($device['Device']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($device['Device']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($device['Device']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Device'), array('action' => 'edit', $device['Device']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Device'), array('action' => 'delete', $device['Device']['id']), null, __('Are you sure you want to delete # %s?', $device['Device']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Devices'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Device'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Devices Notifications'), array('controller' => 'devices_notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Devices Notifications'), array('controller' => 'devices_notifications', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Devices Notifications'); ?></h3>
	<?php if (!empty($device['DevicesNotifications'])): ?>
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
	<?php foreach ($device['DevicesNotifications'] as $devicesNotifications): ?>
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

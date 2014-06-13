<div class="devicesNotifications view">
<h2><?php echo __('Devices Notification'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($devicesNotification['DevicesNotification']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notification'); ?></dt>
		<dd>
			<?php echo $this->Html->link($devicesNotification['Notification']['id'], array('controller' => 'notifications', 'action' => 'view', $devicesNotification['Notification']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Device'); ?></dt>
		<dd>
			<?php echo $this->Html->link($devicesNotification['Device']['name'], array('controller' => 'devices', 'action' => 'view', $devicesNotification['Device']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($devicesNotification['DevicesNotification']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($devicesNotification['DevicesNotification']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($devicesNotification['DevicesNotification']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Devices Notification'), array('action' => 'edit', $devicesNotification['DevicesNotification']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Devices Notification'), array('action' => 'delete', $devicesNotification['DevicesNotification']['id']), null, __('Are you sure you want to delete # %s?', $devicesNotification['DevicesNotification']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Devices Notifications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Devices Notification'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('controller' => 'notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notification'), array('controller' => 'notifications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Devices'), array('controller' => 'devices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Device'), array('controller' => 'devices', 'action' => 'add')); ?> </li>
	</ul>
</div>

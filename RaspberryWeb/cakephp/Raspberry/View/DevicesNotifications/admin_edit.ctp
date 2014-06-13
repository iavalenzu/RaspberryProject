<div class="devicesNotifications form">
<?php echo $this->Form->create('DevicesNotification'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Devices Notification'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('notification_id');
		echo $this->Form->input('device_id');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DevicesNotification.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('DevicesNotification.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Devices Notifications'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('controller' => 'notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notification'), array('controller' => 'notifications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Devices'), array('controller' => 'devices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Device'), array('controller' => 'devices', 'action' => 'add')); ?> </li>
	</ul>
</div>

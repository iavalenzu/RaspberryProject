<div class="connectionNotifications form">
<?php echo $this->Form->create('ConnectionNotification'); ?>
	<fieldset>
		<legend><?php echo __('Edit Connection Notification'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('notification_id');
		echo $this->Form->input('connection_id');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ConnectionNotification.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ConnectionNotification.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Connection Notifications'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('controller' => 'notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notification'), array('controller' => 'notifications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Connections'), array('controller' => 'connections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Connection'), array('controller' => 'connections', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="notifications form">
<?php echo $this->Form->create('Notification'); ?>
	<fieldset>
		<legend><?php echo __('Edit Notification'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('data');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Notification.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Notification.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Connection Notifications'), array('controller' => 'connection_notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Connection Notification'), array('controller' => 'connection_notifications', 'action' => 'add')); ?> </li>
	</ul>
</div>

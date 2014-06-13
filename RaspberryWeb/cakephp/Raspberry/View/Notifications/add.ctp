<div class="notifications form">
<?php echo $this->Form->create('Notification'); ?>
	<fieldset>
		<legend><?php echo __('Add Notification'); ?></legend>
	<?php
		echo $this->Form->input('action');
		echo $this->Form->input('data');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Notifications'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Responses'), array('controller' => 'responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Response'), array('controller' => 'responses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Devices Notifications'), array('controller' => 'devices_notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Devices Notifications'), array('controller' => 'devices_notifications', 'action' => 'add')); ?> </li>
	</ul>
</div>

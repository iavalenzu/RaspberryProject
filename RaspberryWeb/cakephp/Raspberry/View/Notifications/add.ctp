<div class="notifications form">
<?php echo $this->Form->create('Notification'); ?>
	<fieldset>
		<legend><?php echo __('Add Notification'); ?></legend>
	<?php
		echo $this->Form->input('data');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Notifications'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Connection Notifications'), array('controller' => 'connection_notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Connection Notification'), array('controller' => 'connection_notifications', 'action' => 'add')); ?> </li>
	</ul>
</div>

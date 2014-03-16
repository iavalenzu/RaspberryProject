<div class="connections form">
<?php echo $this->Form->create('Connection'); ?>
	<fieldset>
		<legend><?php echo __('Add Connection'); ?></legend>
	<?php
		echo $this->Form->input('pid');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Connections'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Connection Notifications'), array('controller' => 'connection_notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Connection Notification'), array('controller' => 'connection_notifications', 'action' => 'add')); ?> </li>
	</ul>
</div>

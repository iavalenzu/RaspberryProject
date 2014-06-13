<div class="responses form">
<?php echo $this->Form->create('Response'); ?>
	<fieldset>
		<legend><?php echo __('Add Response'); ?></legend>
	<?php
		echo $this->Form->input('notification_id');
		echo $this->Form->input('data');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Responses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('controller' => 'notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notification'), array('controller' => 'notifications', 'action' => 'add')); ?> </li>
	</ul>
</div>

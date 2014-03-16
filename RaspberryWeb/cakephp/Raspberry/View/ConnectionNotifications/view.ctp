<div class="connectionNotifications view">
<h2><?php echo __('Connection Notification'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($connectionNotification['ConnectionNotification']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notification'); ?></dt>
		<dd>
			<?php echo $this->Html->link($connectionNotification['Notification']['id'], array('controller' => 'notifications', 'action' => 'view', $connectionNotification['Notification']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Connection'); ?></dt>
		<dd>
			<?php echo $this->Html->link($connectionNotification['Connection']['id'], array('controller' => 'connections', 'action' => 'view', $connectionNotification['Connection']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($connectionNotification['ConnectionNotification']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Connection Notification'), array('action' => 'edit', $connectionNotification['ConnectionNotification']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Connection Notification'), array('action' => 'delete', $connectionNotification['ConnectionNotification']['id']), null, __('Are you sure you want to delete # %s?', $connectionNotification['ConnectionNotification']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Connection Notifications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Connection Notification'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('controller' => 'notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notification'), array('controller' => 'notifications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Connections'), array('controller' => 'connections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Connection'), array('controller' => 'connections', 'action' => 'add')); ?> </li>
	</ul>
</div>

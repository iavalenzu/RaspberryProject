<div class="responses view">
<h2><?php echo __('Response'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($response['Response']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notification'); ?></dt>
		<dd>
			<?php echo $this->Html->link($response['Notification']['id'], array('controller' => 'notifications', 'action' => 'view', $response['Notification']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($response['Response']['data']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($response['Response']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($response['Response']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($response['Response']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Response'), array('action' => 'edit', $response['Response']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Response'), array('action' => 'delete', $response['Response']['id']), null, __('Are you sure you want to delete # %s?', $response['Response']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Responses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Response'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('controller' => 'notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notification'), array('controller' => 'notifications', 'action' => 'add')); ?> </li>
	</ul>
</div>

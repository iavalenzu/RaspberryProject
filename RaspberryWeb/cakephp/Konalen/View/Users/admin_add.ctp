<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add User'); ?></legend>
	<?php
		echo $this->Form->input('email');
		echo $this->Form->input('authenticated');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List User Partners'), array('controller' => 'user_partners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Partner'), array('controller' => 'user_partners', 'action' => 'add')); ?> </li>
	</ul>
</div>

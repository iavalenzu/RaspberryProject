<div class="partners form">
<?php echo $this->Form->create('Partner'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Partner'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('secret_key');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Partner.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Partner.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Partners'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Partners'), array('controller' => 'user_partners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Partner'), array('controller' => 'user_partners', 'action' => 'add')); ?> </li>
	</ul>
</div>

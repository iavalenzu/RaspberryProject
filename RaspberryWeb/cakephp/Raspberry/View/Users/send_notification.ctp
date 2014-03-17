<div class="users form">
    
    <?php if(!empty($active_connections)): ?>
    
    <fieldset>
        <legend>Active Connections</legend>
    
    <table>
        <?php echo $this->Html->tableHeaders(array('Id', 'Pid', 'Status')); ?>
        
        <?php foreach($active_connections as $active_connection): ?>
        
        <?php  echo $this->Html->tableCells(array($active_connection['Connection']['id'], $active_connection['Connection']['pid'], $active_connection['Connection']['status'])); ?>
        
        <?php endforeach; ?>
        
    </table>   
        
    </fieldset>
    
    <?php endif; ?>
    
<?php echo $this->Form->create(); ?>
	<fieldset>
		<legend><?php echo __('Send Notification'); ?></legend>
	<?php
		echo $this->Form->textarea('Notification.data', array('rows' => '10'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
<!--
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Connections'), array('controller' => 'connections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Connection'), array('controller' => 'connections', 'action' => 'add')); ?> </li>
-->
	</ul>
</div>

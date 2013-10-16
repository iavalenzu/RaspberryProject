<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Authenticated'); ?></dt>
		<dd>
			<?php echo h($user['User']['authenticated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Partners'), array('controller' => 'user_partners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Partner'), array('controller' => 'user_partners', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related User Partners'); ?></h3>
	<?php if (!empty($user['UserPartner'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Partner Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('User Password'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserPartner'] as $userPartner): ?>
		<tr>
			<td><?php echo $userPartner['id']; ?></td>
			<td><?php echo $userPartner['user_id']; ?></td>
			<td><?php echo $userPartner['partner_id']; ?></td>
			<td><?php echo $userPartner['created']; ?></td>
			<td><?php echo $userPartner['modified']; ?></td>
			<td><?php echo $userPartner['user_password']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_partners', 'action' => 'view', $userPartner['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_partners', 'action' => 'edit', $userPartner['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_partners', 'action' => 'delete', $userPartner['id']), null, __('Are you sure you want to delete # %s?', $userPartner['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Partner'), array('controller' => 'user_partners', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

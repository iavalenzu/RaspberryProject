<div class="partners view">
<h2><?php echo __('Partner'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($partner['Partner']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($partner['Partner']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Secret Key'); ?></dt>
		<dd>
			<?php echo h($partner['Partner']['secret_key']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Partner'), array('action' => 'edit', $partner['Partner']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Partner'), array('action' => 'delete', $partner['Partner']['id']), null, __('Are you sure you want to delete # %s?', $partner['Partner']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Partners'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Partner'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Partners'), array('controller' => 'user_partners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Partner'), array('controller' => 'user_partners', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Services'); ?></h3>
	<?php if (!empty($partner['Service'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Partner Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($partner['Service'] as $service): ?>
		<tr>
			<td><?php echo $service['id']; ?></td>
			<td><?php echo $service['name']; ?></td>
			<td><?php echo $service['created']; ?></td>
			<td><?php echo $service['modified']; ?></td>
			<td><?php echo $service['partner_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'services', 'action' => 'view', $service['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'services', 'action' => 'edit', $service['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'services', 'action' => 'delete', $service['id']), null, __('Are you sure you want to delete # %s?', $service['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Partners'); ?></h3>
	<?php if (!empty($partner['UserPartner'])): ?>
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
	<?php foreach ($partner['UserPartner'] as $userPartner): ?>
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

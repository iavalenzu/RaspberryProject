<div class="users form">

    <?php if (!empty($active_connections)): ?>

        <fieldset>
            <legend>Active Connections</legend>

            <table>
                <?php echo $this->Html->tableHeaders(array('Id', 'Fifo', 'Status')); ?>

                <?php foreach ($active_connections as $active_connection): ?>

                    <?php echo $this->Html->tableCells(array($active_connection['Connection']['id'], $active_connection['Connection']['fifo_name'], $active_connection['Connection']['status'] )); ?>

                <?php endforeach; ?>

            </table>   

        </fieldset>

        <?php echo $this->Form->create(); ?>
        <fieldset>
            <legend><?php echo __('Send Notification'); ?></legend>

            <?php
            $options = array(
                'GET_FORTUNE' => 'GET_FORTUNE',
                'STOP_CLIENT' => 'STOP_CLIENT',
                'CHECK_CONNECTION' => 'CHECK_CONNECTION',
                'UPDATE_CLIENT' => 'UPDATE_CLIENT',
                'PIN_METER' => 'PIN_METER'
            );
            echo $this->Form->input('Notification.action', array('options' => $options, 'default' => '', 'label' => 'Action'));
            ?>        

            <?php for($i=0; $i<5; $i++): ?>
            
            <?php echo $this->Form->input("Notification.data.$i.Name", array('label' => "Name $i")); ?>
            <?php echo $this->Form->input("Notification.data.$i.Value", array('label' => "Value $i")); ?>
            <br>

            <?php endfor; ?>

            <?php //echo $this->Form->textarea('Notification.Data', array('rows' => '10')); ?>
        </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>

    <?php else: ?>

        <h2>No hay coneciones activas!!</h2>

    <?php endif; ?>

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

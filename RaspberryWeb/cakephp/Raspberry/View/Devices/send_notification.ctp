<div class="users form">

    <fieldset>
        <legend><?php echo __('Device'); ?></legend>
        
        <table>
            <tr>
                <td>Name</td>
                <td><?php echo $device['Device']['name']; ?></td>
            </tr>
            <tr>
                <td>Access Token</td>
                <td><?php echo $device['Device']['access_token']; ?></td>
            </tr>
            <tr>
                <td>Fifo Name</td>
                <td><?php echo $device['Device']['fifo_name']; ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?php echo $device['Device']['status']; ?></td>
            </tr>
            
        </table>
        
        
    </fieldset>
    

    <?php echo $this->Form->create(); ?>
    <fieldset>
        <legend><?php echo __('Send Notification'); ?></legend>

        <?php
        $options = array(
            'ACTION_GET_FORTUNE' => 'ACTION_GET_FORTUNE',
            'ACTION_STOP_CLIENT' => 'ACTION_STOP_CLIENT',
            'ACTION_CHECK_CONNECTION' => 'ACTION_CHECK_CONNECTION',
            'ACTION_UPDATE_CLIENT' => 'ACTION_UPDATE_CLIENT',
            'ACTION_START_PIN_METER' => 'ACTION_START_PIN_METER',
            'ACTION_STOP_PIN_METER' => 'ACTION_STOP_PIN_METER'
        );
        echo $this->Form->input('Notification.action', array('options' => $options, 'default' => '', 'label' => 'Action'));
        ?>        

        <?php for ($i = 0; $i < 5; $i++): ?>

            <?php echo $this->Form->input("Notification.data.$i.Name", array('label' => "Name $i")); ?>
            <?php echo $this->Form->input("Notification.data.$i.Value", array('label' => "Value $i")); ?>
            <br>

        <?php endfor; ?>

        <?php //echo $this->Form->textarea('Notification.Data', array('rows' => '10')); ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>


</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
    </ul>
</div>

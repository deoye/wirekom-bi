<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('host')); ?>:</b>
    <?php echo CHtml::encode($data->host); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('port')); ?>:</b>
    <?php echo CHtml::encode($data->port); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('dbname')); ?>:</b>
    <?php echo CHtml::encode($data->dbname); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
    <?php echo CHtml::encode($data->username); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
    <?php echo CHtml::encode($data->password); ?>
    <br />

</div>
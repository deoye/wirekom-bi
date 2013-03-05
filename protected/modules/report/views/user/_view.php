<?php
/* @var $this UserController */
/* @var $model User */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
    <?php echo CHtml::encode($data->username); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
    <?php echo CHtml::encode($data->password); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
    <?php echo CHtml::encode($data->email); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('activkey')); ?>:</b>
    <?php echo CHtml::encode($data->activkey); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('lastvisit')); ?>:</b>
    <?php echo CHtml::encode($data->lastvisit); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('superuser')); ?>:</b>
    <?php echo CHtml::encode($data->superuser); ?>
    <br />

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
      <?php echo CHtml::encode($data->status); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
      <?php echo CHtml::encode($data->created); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('updated')); ?>:</b>
      <?php echo CHtml::encode($data->updated); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('report_id')); ?>:</b>
      <?php echo CHtml::encode($data->report_id); ?>
      <br />

     */ ?>

</div>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'data-source-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'host'); ?>
        <?php echo $form->textField($model, 'host', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'host'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'port'); ?>
        <?php echo $form->textField($model, 'port'); ?>
        <?php echo $form->error($model, 'port'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'dbname'); ?>
        <?php echo $form->textField($model, 'dbname', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'dbname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'kpi-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'data_source_id'); ?>
        <?php echo $form->dropDownList($model, 'data_source_id', $model->getDataSourceOptions()); ?>
        <?php echo $form->error($model, 'data_source_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'target'); ?>
        <?php echo $form->textField($model, 'target', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'target'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'query'); ?>
        <?php echo $form->textArea($model, 'query', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'query'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'advice'); ?>
        <?php echo $form->textArea($model, 'advice', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'advice'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<div class="form">
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'data_source_id'); ?>
        <?php echo $form->dropDownList($model, 'data_source_id', $model->getDataSourceOptions()); ?>
        <?php echo $form->error($model, 'data_source_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'bentuk_id'); ?>
        <?php echo $form->dropDownList($model, 'bentuk_id', $model->getBentukOptions()); ?>
        <?php echo $form->error($model, 'bentuk_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'query'); ?>
        <?php echo $form->textArea($model, 'query', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'query'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

</div><!-- form -->
<script type="text/javascript">
    $(function(){                   
        $("#tree").dynatree({
            checkbox: true,
            selectMode: 3,
            initAjax: {
                url: "<?php echo Yii::app()->request->baseUrl; ?>/report/dataSource/getDataById",
                data: {
                    data_source_id: $("#Report_data_source_id").find('option:selected').val()
                }
            },
            onSelect: function(select, node) {
                var objKeys = [];
                var query = '';
                var s_query = '';
                var f_query = '';
                var w_query = '';
                var t_array = [];
                $.each( node.tree.getSelectedNodes(), function( key, value ) {
                    objKeys.push( value );
                                
                    if(value.data.type == 'cl'){
                        p = value.getParent();
                        if($.inArray(p, t_array) == -1)
                            t_array.push(p);
                        s_query += '\t' + p.data.title + '.`' + value.data.title + '` AS ' + p.data.title + '_' + value.data.title + ',\n'
                                    
                    }
                    console.log('type : ' + value.data.type);
                    console.log('key : ' + value.data.key);
                });
                $.each(t_array, function(key, value){
                    console.log('data table : ' + value.data.title);
                    f_query += '\t' + value.data.title + ',\n';
                            
                });
                console.log('nilai objKey: ' + objKeys.join(' + '));
                s_query = s_query.replace(/,\n$/, "\n");
                f_query = f_query.replace(/,\n$/, "\n");
                if (s_query != '') s_query =  'SELECT \n' + s_query;
                if (f_query != '') f_query =  'FROM \n' + f_query;
                query += s_query;
                query += f_query;
                $("#Report_query").val(query);
                //                            console.log(selKeys); 
                //                            console.log(node.tree.getSelectedNodes());
            },
            onActivate: function(node) {
                $("#Report_description").val(node.data.title);
                //                            alert('isForeignKey ' + node.data.isForeignKey);
                if( node.data.href ){
                    window.open(node.data.href, node.data.target);
                }
            },
            onDeactivate: function(node) {
                $("#Report_description").val("-");
            }
        });
        
        $("#Report_data_source_id").change(function(){
            $("#tree").dynatree("option", "initAjax", {
                url: "<?php echo Yii::app()->request->baseUrl; ?>/report/dataSource/getDataById",
                data: {
                    data_source_id: $(this).find('option:selected').val()
                }
            });
            
            $("#tree").dynatree("getTree").reload();
        });
        
        
            
        function addParam(i, param){                
            var paramName = $('<input type="text" id="parameter-name" name="param[' + i + '][name]" size="30" placeholder="Parameter Name" />');
            var paramLabel = $('<input type="text" id="parameter-label" name="param[' + i + '][label]" size="30" placeholder="Parameter Label" />');
            var paramType = $('<select id="parameter-type" name="param[' + i + '][type]"><option value="0">Select Type Parameter</option><option value="1">Text</option><option value="2">Date</option><option value="3">Select</option></select>');
            var paramSql = $('<textarea name="param[' + i + '][sql]" rows="4" cols="28">Fill SQL for option</textarea>');
            var fieldWrapper = $('<div id="' + i + '" class="row"></div>');
          
            if(typeof(param)!=='undefined'){
                paramName.attr('value', param.name);
                paramLabel.attr('value', param.label);
                paramType.attr('value', param.type);
            }
            fieldWrapper.append('<label for="param-' + i + '">Parameter ' + i + '</label>');
            fieldWrapper.append(paramName);
            fieldWrapper.append(paramLabel);
            fieldWrapper.append(paramType);
            
            if(paramType.attr('value') == '3'){
                fieldWrapper.append(paramSql);
            }
            
            paramType.change(function(){
                paramSql.remove();
                if($(this).val() == '3') 
                    fieldWrapper.append(paramSql);
            });
            paramName.focus();
            return fieldWrapper;
            
        }
        var paramCounter = 0; 
        var params = <?php echo ($model->parameter !== null) ? $model->parameter : '[]'; ?>;
        for (paramCounter = 0, length = params.length; paramCounter < length; paramCounter++) {
            var data = params[paramCounter];
            $("#form-parameter").append(addParam(paramCounter, data));
        }
        $(".add-parameter").click(function (){    
            $("#form-parameter").append(addParam(paramCounter));
            paramCounter++;
        });
    });
</script>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'report-form',
    'enableAjaxValidation' => false,
        ));
?>
<div class="container showgrid">
    <div class="span-8">
        <div id="content">
            <div id="tree"></div>
            <div class="add-parameter">
                <a id="add-parameter" href="#">Add Parameter</a>
            </div>
            <div id="form-parameter" class="form">
            </div>
        </div>
    </div>
    <div class="span-16 last">
        <div id="content">
            <h1>Create Report</h1>
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
        </div><!-- content -->
    </div>
</div>

<?php $this->endWidget(); ?>
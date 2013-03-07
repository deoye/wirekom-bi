<?php
$this->breadcrumbs = array(
    'Reports' => array('admin'),
    'Create',
);

$this->menu = array(
    array('label' => 'Manage Report', 'url' => array('admin')),
);
?>

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
        
        var paramCounter = 0; 
        $(".add-parameter").click(function (){
            var paramName = $('<input type="text" id="parameter-name" name="param-name[' + paramCounter + ']" size="30" placeholder="Parameter Name" />');
            var paramLabel = $('<input type="text" id="parameter-label" name="param-label[' + paramCounter + ']" size="30" placeholder="Parameter Label" />');
            var select = $('<select id="parameter-type" name="param-type[' + paramCounter + ']"><option value="0">Select Type Parameter</option><option value="1">Text</option><option value="2">Date</option><option value="3">Select</option></select>');
            var fieldWrapper = $('<div id="' + paramCounter + '" class="row"></div>');
       
            fieldWrapper.append('<label for="param-' + paramCounter + '">Parameter ' + paramCounter + '</label>');
            fieldWrapper.append(paramName);
            fieldWrapper.append(paramLabel);
            fieldWrapper.append(select);
            select.focus();
            $("#form-parameter").append(fieldWrapper);
            var input = null;
            select.change(function(){
                if(input != null){
                    input.remove();
                    input = null;                    
                }
                var n = $(this).val();
                switch(n){
                    case '3':
                        input = $('<textarea name="param-sql[' + $(this).parent().attr('id') + ']" rows="4" cols="28">Fill SQL for option</textarea>');
                        console.log('select 3');
                        break;
                    }
                    fieldWrapper.append(input);
                });
            });
                
            paramCounter++;
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
            <?php echo $this->renderPartial('_form', array('form' => $form, 'model' => $model)); ?>
        </div><!-- content -->
    </div>
</div>

<?php $this->endWidget(); ?>
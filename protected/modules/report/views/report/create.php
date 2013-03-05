<?php
$this->breadcrumbs = array(
    'Reports' => array('admin'),
    'Create',
);

$this->menu = array(
    array('label' => 'Manage Report', 'url' => array('admin')),
);
?>

<div class="container showgrid">
    <div class="span-8">
        <div id="content">

            <script type="text/javascript">
                $(function(){
                    //                    alert($("#Report_data_source_id").find('option:selected').val());
                   
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
                            //                            alert(select);
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
                });
            </script>
            <div id="tree"> </div>
        </div>
    </div>
    <div class="span-16 last">
        <div id="content">
            <h1>Create Report</h1>
            <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
        </div><!-- content -->
    </div>
</div>
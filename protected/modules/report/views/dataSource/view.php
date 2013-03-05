<?php
$this->breadcrumbs = array(
    'Data Sources' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List DataSource', 'url' => array('index')),
    array('label' => 'Create DataSource', 'url' => array('create')),
    array('label' => 'Update DataSource', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete DataSource', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage DataSource', 'url' => array('admin')),
);
?>

<h1>View DataSource <?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'host',
        'port',
        'dbname',
        'username',
        'password',
    ),
));
?>
<script type="text/javascript">
<?php
$params = sprintf("{host:\"%s\", port:\"%s\", dbname:\"%s\", username:\"%s\", password:\"%s\"}", $model->host, $model->port, $model->dbname, $model->username, $model->password);
?>
    $(function(){
        $("#tree").dynatree({
            checkbox: true,
            selectMode: 3,
            initAjax: {
                url: "<?php echo Yii::app()->request->baseUrl; ?>/report/dataSource/getData",
                data: <?php echo $params; ?>
            },
            onSelect: function(select, node) {
                
                var selKeys = $.map(node.tree.getSelectedNodes(), function(node){
                    return node.data.key;
                });
                $("#sql").text(selKeys.join(", "));
                console.log(selKeys);
            },
            onActivate: function(node) {
                $("#echoActive").text(node.data.title);
                if( node.data.href ){
                    window.open(node.data.href, node.data.target);
                }

            },
            onDeactivate: function(node) {
                $("#echoActive").text("-");
            }
        });
        $('#reload').click(function(){
            $("#tree").dynatree("getTree").reload();
        });
    });
</script>
<div id="tree"> </div>
<div id="sql"> </div>
<div id="echoActive"> </div>
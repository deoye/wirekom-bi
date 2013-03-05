<?php
$this->breadcrumbs = array(
    'Kpis' => array('admin'),
    $model->name,
);

$this->menu = array(
    array('label' => 'Create Kpi', 'url' => array('create')),
    array('label' => 'Update Kpi', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Kpi', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Kpi', 'url' => array('admin')),
    array('label' => 'Export PDF', 'url' => array('exportPdf', 'id' => $model->id)),
    array('label' => 'Export Xls', 'url' => array('exportXls', 'id' => $model->id)),
);
?>

<h1>View Kpi <?php echo $model->name; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'data_source_id',
            'type' => 'raw',
            'value' => CHtml::encode($model->dataSource->getDsn())
        ),
        'name',
        'advice',
        array(
            'name' => 'query',
            'type' => 'raw',
            'value' => nl2br($model->query)
        ),
        'target',
    ),
));
?>

<pre>

<?php
    print_r($reader->readAll());
?>
</pre>
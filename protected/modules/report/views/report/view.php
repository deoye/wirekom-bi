<?php
$this->breadcrumbs = array(
    'Reports' => array('admin'),
    $model->name,
);

$this->menu = array(
    array('label' => 'Create Report', 'url' => array('create')),
    array('label' => 'Update Report', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Report', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Report', 'url' => array('admin')),
    array('label' => 'Export PDF', 'url' => array('exportPdf', 'id' => $model->id)),
    array('label' => 'Export Xls', 'url' => array('exportXls', 'id' => $model->id)),
);
?>

<h1>View Report <?php echo $model->name; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'bentuk_id',
            'type' => 'raw',
            'value' => CHtml::encode($model->bentuk->name)
        ),
        array(
            'name' => 'data_source_id',
            'type' => 'raw',
            'value' => CHtml::encode($model->dataSource->getDsn())
        ),
        'name',
        'description',
        array(
            'name' => 'query',
            'type' => 'raw',
            'value' => nl2br($model->query)
        ),
    ),
));
?>

<?php
if ($model->bentuk_id == 1)
    echo $this->renderPartial('_table', array('data' => $reader));
else if ($model->bentuk_id == 2)
    echo $this->renderPartial('_grafik', array('data' => $reader, 'title' => $model->name));
?>

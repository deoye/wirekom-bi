<?php
$this->breadcrumbs = array(
    'Bentuks' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Bentuk', 'url' => array('index')),
    array('label' => 'Create Bentuk', 'url' => array('create')),
    array('label' => 'Update Bentuk', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Bentuk', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Bentuk', 'url' => array('admin')),
);
?>

<h1>View Bentuk <?php echo $model->name; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'name',
    ),
));
?>

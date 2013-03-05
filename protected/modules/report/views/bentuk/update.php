<?php
$this->breadcrumbs = array(
    'Bentuks' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Bentuk', 'url' => array('index')),
    array('label' => 'Create Bentuk', 'url' => array('create')),
    array('label' => 'View Bentuk', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Bentuk', 'url' => array('admin')),
);
?>

<h1>Update Bentuk <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
<?php
$this->breadcrumbs = array(
    'Reports' => array('admin'),
    $model->name => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Create Report', 'url' => array('create')),
    array('label' => 'View Report', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Report', 'url' => array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
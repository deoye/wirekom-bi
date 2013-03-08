<?php

$this->breadcrumbs = array(
    'Reports' => array('admin'),
    'Create',
);

$this->menu = array(
    array('label' => 'Manage Report', 'url' => array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
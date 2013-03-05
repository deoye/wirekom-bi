<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('admin'),
    $model->id => array('view', 'id' => $model->id),
    'Sunting',
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('admin')),
    array('label' => 'Buat User', 'url' => array('create')),
    array('label' => 'Lihat User', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Kelola User', 'url' => array('admin')),
);
?>

<h1>Sunting User <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
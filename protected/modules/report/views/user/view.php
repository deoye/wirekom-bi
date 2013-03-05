<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('admin'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('admin')),
    array('label' => 'Buat User', 'url' => array('create')),
    array('label' => 'Sunting User', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Hapus User', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Kelola User', 'url' => array('admin')),
);
?>

<h1>Lihat User <?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'username',
        'password',
        'email',
        'activkey',
        'lastvisit',
        'superuser',
        'status',
        'created',
        'updated',
        'report_id',
    ),
));
?>

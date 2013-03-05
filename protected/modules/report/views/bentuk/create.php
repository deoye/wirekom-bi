<?php
$this->breadcrumbs=array(
	'Bentuks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bentuk', 'url'=>array('index')),
	array('label'=>'Manage Bentuk', 'url'=>array('admin')),
);
?>

<h1>Create Bentuk</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
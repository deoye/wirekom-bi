<?php
$this->breadcrumbs=array(
	'Bentuks',
);

$this->menu=array(
	array('label'=>'Create Bentuk', 'url'=>array('create')),
	array('label'=>'Manage Bentuk', 'url'=>array('admin')),
);
?>

<h1>Bentuks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

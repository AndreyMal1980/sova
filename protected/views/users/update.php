<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name=>array('index','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Users', 'url'=>array('index')),
	//array('label'=>'Create Users', 'url'=>array('create')),
	//array('label'=>'View Users', 'url'=>array('view', 'id'=>$model->user_id)),
	//array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>Редактирование данных пользователя <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
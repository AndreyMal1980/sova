<?php
/* @var $this RegistrationController */
Yii::app()->getClientScript()->registerScriptFile('/js/admin/programms/edit.js');
$this->breadcrumbs = array(
    'Статусы' => '/index.php/admin/statusUser',
    'редактирование статуса' => '/index.php/admin/statusUser/edit/id/'.$model->id,
    ' '.($model->name),
);
?>
<h1>Редактирование статуса</h1>
<h2>(<?php echo $model->name; ?>)</h2>
<div class="form">
<?php $this->renderPartial('/statusUser/_form', array('model' => $model)); ?>
</div>
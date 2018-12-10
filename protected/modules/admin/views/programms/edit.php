<?php
/* @var $this RegistrationController */
Yii::app()->getClientScript()->registerScriptFile('/js/admin/programms/edit.js');
$this->breadcrumbs = array(
    'программы' => '/index.php/admin/programms',
    'редактирование программы' => '/index.php/admin/programms/edit/id/'.$model->programm_id,
    ' '.($model->name),
);
?>
<h1>Редактирование программы</h1>
<h2>(<?php echo $model->name; ?>)</h2>
<div class="form">
<?php $this->renderPartial('/programms/_form', array('model' => $model)); ?>
</div>
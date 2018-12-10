<?php
/* @var $this RegistrationController */
Yii::app()->getClientScript()->registerScriptFile('/js/admin/programms/edit.js');
$this->breadcrumbs = array(
    'Маркетинг план' => '/index.php/admin/marketing/',
    'редактирование маркетинг плана' => '/index.php/admin/marketing/edit/id/'.
    ' '.($model->name),
);
?>
<h1>Редактирование маркетинг плана</h1>
<h2>(<?php echo $model->name; ?>)</h2>
<div class="form">
<?php $this->renderPartial('/marketing/_form', array('model' => $model)); ?>
</div>
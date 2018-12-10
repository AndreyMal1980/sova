<?php
/* @var $this RegistrationController */
//Yii::app()->getClientScript()->registerScriptFile('/js/admin/settingAccount/edit.js');
$this->breadcrumbs = array(
    'настройки' => '/index.php/admin/settingLines',
    'редактирование линии' => '/index.php/admin/settingLines/edit/id/'.$model->id,
    ' '.($model->line),
);
?>
<h1>Редактирование линии</h1>
<h2>(<?php echo $model->line; ?>)</h2>
<div class="form">
<?php $this->renderPartial('/settingLines/_form', array('model' => $model)); ?>
</div>


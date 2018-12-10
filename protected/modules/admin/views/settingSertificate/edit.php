<?php
/* @var $this RegistrationController */
//Yii::app()->getClientScript()->registerScriptFile('/js/admin/settingAccount/edit.js');
$this->breadcrumbs = array(
    'настройки' => '/index.php/admin/settingSertificate',
    'редактирование настройки' => '/index.php/admin/settingSertificate/edit/id/'.$model->id,
    ' '.($model->name),
);
?>
<h1>Редактирование настройки</h1>
<h2>(<?php echo $model->name; ?>)</h2>
<div class="form">
<?php $this->renderPartial('/settingSertificate/_form', array('model' => $model)); ?>
</div>
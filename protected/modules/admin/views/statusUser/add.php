<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}
$this->breadcrumbs = array(
    'Статусы' => '/index.php/admin/statusUser/',
    'Добавление статуса' => '/admin/statusUser/add',
    'Добавление статуса '
);

?>
<h1>Добавление нового статуса </h1>

<small>Поля отмеченные <span class="required">*</span> обязательны  для заполнения</small>
<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
        )
);
echo $form->textFieldRow($model, 'name',array('class' => 'span12'));
$this->widget('application.extensions.ckeditor.CKEditor', array(
    'model' => $model,
    'attribute' => 'description',
    'language' => 'ru',
    'editorTemplate' => 'full', 'htmlOptions' => array('value' => $model->description))
);
echo $form->checkBoxListRow($model, 'lines_array',CHtml::listData(SettingLines::model()->findAll(), 'id', 'line'),array('empty'=>'Выберите линию'));
echo '</br>';
echo 'Добавьте необходимые настройки к создаваемому статусу';
echo '</br>';
?>
<div class="form-actions" style="text-align: right;">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Сохранить')); ?>&nbsp;
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отмена')); ?>
</div>
<?php
$this->endWidget();
?>


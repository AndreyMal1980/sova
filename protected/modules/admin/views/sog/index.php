<?php
/* @var $this UserController */
$this->breadcrumbs = array(
    'Соглашение' => '/index.php/admin/sog',
    'Текст соглашения',
);
?>
<h1>Соглашение</h1>
<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}
?>

<small>Поля отмеченные <span class="required">*</span> обязательны  для заполнения</small>
<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
        )
);
$this->widget('application.extensions.ckeditor.CKEditor', array(
    'model' => $model,
    'attribute' => 'description',
    'language' => 'ru',
    'editorTemplate' => 'full', 'htmlOptions' => array('value' => $model->description))
)
?>
<div class="form-actions" style="text-align: right;">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Сохранить')); ?>&nbsp;
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'info', 'label' => 'Сохранить и выйти')); ?>&nbsp;
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отмена')); ?>
</div>
<?php
$this->endWidget();
?>

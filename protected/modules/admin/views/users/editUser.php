<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}
$this->breadcrumbs = array(
    'Пользователи' => '/index.php/admin/users/',
    'Редактирование пользователя'
);
?>
<h1>Редактирование пользователя</h1>
<h2>(<?php echo $model->name; ?>)</h2>

<small>Поля отмеченные <span class="required">*</span> обязательны  для заполнения</small>
<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
        )
);
echo $form->textFieldRow($model, 'name', array('class' => 'span12'));
echo $form->textFieldRow($model, 'surname', array('class' => 'span12'));
echo $form->textFieldRow($model, 'number_ticket', array('class' => 'span12'));
echo $form->textFieldRow($model, 'number_ticket_change'/* ,$data,$htmlOptions = array('empty' => $model->number_ticket_change) */);
echo $form->textFieldRow($model, 'password', array('class' => 'span12'));
echo $form->textFieldRow($model, 'email', array('class' => 'span12'));
echo $form->textFieldRow($model, 'city', array('class' => 'span12'));
echo $form->textFieldRow($model, 'phone', array('class' => 'span12'));
//echo $form->textFieldRow($model, 'share', array('class' => 'span12'));
//echo $form->textFieldRow($model, 'status_user_ref', array('class' => 'span12'));
//echo $form->checkBoxListRow($model, 'programmsArray',CHtml::listData(Programms::model()->findAll(), 'programm_id', 'name'));
echo $form->textFieldRow($model, 'date', array('class' => 'span12','value' => $dataRegistrations));
?>
<div class="form-actions" style="text-align: right;">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Сохранить')); ?>&nbsp;
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отмена')); ?>
</div>
<?php
$this->endWidget();
?>




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
echo $form->textFieldRow($model, 'name', array('class' => 'span12'));
echo $form->textFieldRow($model, 'date', array('class' => 'span12','value' => date("Y.m.d",$model->date)));
echo $form->textFieldRow($model, 'percent', array('class' => 'span12'));
echo $form->textFieldRow($model, 'frequency_of_payments', array('class' => 'span12'));
echo $form->textFieldRow($model, 'period_of_payment', array('class' => 'span12'));

  $this->widget('application.extensions.ckeditor.CKEditor', array( 
                     'model'=>$model, 
                     'attribute'=>'description', 
                     'language'=>'ru', 
                     'editorTemplate'=>'full', )); 
?>
<div class="form-actions" style="text-align: right;">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Сохранить')); ?>&nbsp;
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отмена')); ?>
</div>
<?php
$this->endWidget();





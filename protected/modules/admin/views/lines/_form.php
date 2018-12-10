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
/*
echo '</br>';
echo '<hr>';
echo CHtml::beginForm('add');
echo CHtml::dropDownList('lines','',$lines,array('empty' => 'Выбор линии'));
echo '</br>';
echo CHtml::textField('count_users');
echo '</br>';
echo CHtml::textField('sum_pay'); 
echo '</br>';echo '</br>';
echo CHtml::submitButton('Сохранить', array('name' => 'addLine','class' => 'btn-primary'));
echo CHtml::endForm();
 */



/** @var BootActiveForm $form */

 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
        )
);

echo $form->dropDownList($model,'line',  CHtml::listData($a, 'number', 'number'),array('empty' => 'Выберите линию'));
echo $form->textFieldRow($model, 'sum_pay', array('class' => 'span12'));
echo $form->textFieldRow($model, 'count_users', array('class' => 'span12'));
?>
<div class="form-actions" style="text-align: right;">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Сохранить')); ?>&nbsp;
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отмена')); ?>
</div>
<?php
$this->endWidget();

?>
<script>
/*
$("#SettingLines_line").change(function(){
      var line = $("#SettingLines_line :selected").text();
      alert(line);
});
*/
</script>



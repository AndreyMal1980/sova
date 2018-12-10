<?php
/* @var $this RegistrationController */
//Yii::app()->getClientScript()->registerScriptFile('/js/admin/settingAccount/edit.js');
$this->breadcrumbs = array(
    'настройки' => '/index.php/admin/settingLines',
    'редактирование линии' => '/index.php/admin/settingLines/add/id/'.$model->id,
);
?>
<h1>Добавление линии</h1>
<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
    
}
?>
<?php
 $lines = array();
    for($i=1;$i<=$maxLines;$i++)
    {
      $lines[] = $i;
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
  echo $form->DropDownListRow($model, 'line',$lines,array('empty'=>'Выберите линию'));
  echo $form->textFieldRow($model, 'sum_pay', array('class' => 'span12'));
  echo $form->textFieldRow($model, 'count_users', array('class' => 'span12'));
  echo $form->DropDownListRow($model, 'statusUsers',CHtml::listData(StatusUser::model()->findAll(),'id', 'name'),array('empty'=>'Выберите статус'));
  ?>
  <div class="form-actions" style="text-align: right;">
  <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Сохранить')); ?>&nbsp;
  <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отмена')); ?>
  </div>
  <?php
  $this->endWidget();
 




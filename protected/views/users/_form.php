<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php/*echo $form->labelEx($model,'role'); ?>
		<?php echo $form->textField($model,'role',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'role'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'name'); */?>
	</div>

	<div class="row">
		<?php/* echo $form->labelEx($model,'surname'); ?>
		<?php echo $form->textField($model,'surname',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'surname'); */?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'number_ticket'); ?>
		<?php echo $form->textField($model,'number_ticket'); ?>
		<?php echo $form->error($model,'number_ticket');*/ ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

         <div class="row">
               <?php $model->programms = array(); ?>
            <?php echo $form->labelEx($model, 'programms'); ?>
            <?php $form->checkBoxList($model, 'programmsArray',CHtml::listData(Programms::model()->findAll(), 'programm_id', 'name')); ?>
            <?php echo $form->error($model, 'programms'); ?>
        </div>

	<div class="row">
		<?php/* echo $form->labelEx($model,'share'); ?>
		<?php echo $form->textField($model,'share'); ?>
		<?php echo $form->error($model,'share'); */?>
	</div>

	<div class="row">
            <?php/* echo $form->labelEx($model, 'parent_id'); ?>
            <?php echo $form->dropDownList($model, 'parent_id',Users::model()->allUsers(),array('empty' => 'Выберите')); ?>
            <?php echo $form->error($model, 'parent_id'); */?>
        </div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date');*/ ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
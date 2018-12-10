<h1>Регистрация нового пользователя</h1>

<br/><br/>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'users-form',
       // 'action' => Yii::app()->createUrl('/paymentSystems/'),
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>
    
    <div class="row">
        <?php/* echo $form->labelEx($model, 'image'); ?>
        <?php echo $form->fileField($model, 'image'); ?>
        <?php echo $form->error($model, 'image'); */?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 120)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'surname'); ?>
        <?php echo $form->textField($model, 'surname', array('size' => 60, 'maxlength' => 120)); ?>
        <?php echo $form->error($model, 'surname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->textField($model, 'password', array('size' => 60, 'maxlength' => 120)); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 120)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php /*echo $form->labelEx($model, 'address'); ?>
        <?php echo $form->textField($model, 'address', array('size' => 60, 'maxlength' => 120)); ?>
        <?php echo $form->error($model, 'address'); */?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'city'); ?>
        <?php echo $form->textField($model, 'city', array('size' => 60, 'maxlength' => 120)); ?>
        <?php echo $form->error($model, 'city'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'phone'); ?>
        <?php echo $form->textField($model, 'phone', array('size' => 60, 'maxlength' => 120)); ?>
        <?php echo $form->error($model, 'phone'); ?>
    </div>

    <div class="row">
        <?php/* echo $form->labelEx($model, 'status_id'); ?>
        <?php echo $form->dropDownList($model, 'status_id', StatusUser::model()->allStatus(), array('empty' => 'Выберите')); ?>
        <?php echo $form->error($model, 'status_id');*/ ?>
    </div>

    <div class="row">
        <?php /*echo $form->labelEx($model, 'programms'); ?>
        <?php echo $form->dropDownList($model, 'programms', CHtml::listData(Programms::model()->findAll(), 'programm_id', 'name'),array('empty' => 'Выберие')); ?>
        <?php echo $form->error($model, 'programms'); */?>
    </div>

    <div class="row">
        <?php /*echo $form->labelEx($model, 'share'); ?>
        <?php echo $form->textField($model, 'share', array('size' => 60, 'maxlength' => 120)); ?>
        <?php echo $form->error($model, 'share'); */?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'number_ticket_change'); ?>
        <?php echo $form->textField($model, 'number_ticket_change', array('value' => $model->numberTicket,'size' => 60, 'maxlength' => 120,'readonly' => $model->getReadOnlyToRegistration($model->numberTicket,$model->readOnly))); ?>
        <?php echo $form->error($model, 'number_ticket_change'); ?>
    </div>
    
    <div class="row">
        <?php /*echo $form->labelEx($model, 'parent_id'); ?>
        <?php echo $form->dropDownList($model, 'parent_id', Users::model()->allUsers(), array('empty' => 'Выберите')); ?>
        <?php echo $form->error($model, 'parent_id'); */?>
    </div>
    <!--
        <div class="row">
                <label class="required" for="file">Заявление(скрин) <span class="required">*</span></label>
                <div style="text-align: right;" class="form-actions">
                    <input class="span12" id="file" type="file" name="filename">
                </div>
        </div>
    -->
    <div class="row">
        <?php /* echo $form->labelEx($model, 'date'); ?>
          <?php echo $form->textField($model,'date', array('size' => 60, 'maxlength' => 120,'value'=>Users::model()->currentDate())); ?>
          <?php echo $form->error($model, 'date'); */ ?>
    </div>
    <div class="row buttons">
        <input type="submit" class="btn btn-primary" value="Регистрация" />
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->


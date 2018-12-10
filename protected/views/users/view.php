<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List Users', 'url'=>array('index')),
	//array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->user_id)),
	//array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>Cтраница пользователя <?php echo $model->name; ?></h1>

 <?php $this->widget('CTreeView', array('data' => $my_data));?>
<p>Количество приглашенных участников - <?php echo $count; ?></p>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
                'programms' => array('label' => 'Программы пайщика', 'type'=>'html','value'=>Users::model()->getProgrammsUser($model->user_id)),
		'role'=>array('visible'=>false),
		'name',
		'surname',
		'password',
		'number_ticket',
		'email',
		'address',
		'city',
		'phone',
		'status_id'=>array('label'=>'Статус пользователя','value'=>$model->statusUser->name),
		'share',
		'parent_id'=>array('label'=>'Кто пригласил','value'=>$model->parentName),
		'date'=>array('label'=>'Дата регистрации','value'=>date("Y.m.d.  время регистрации  H.i",$model->date)),
	),
)); ?>

<hr/>
<p>Выборка приглашенных участников за определенный период </p>
<?php echo '<strong>'.'Внимание!!! Дату вводить в формате Y.m.d (год.месяц.день, например 2014.09.12)'.'</strong>';?>

<?php/* if ($ajax == 0) {*/?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm'); ?>

    <div class="row">
           <?php echo $form->label($model,'Дата с '); ?>
           <?php echo $form->textField($model,'startDate') ?>
    </div>
    
    <div class="row">
           <?php echo $form->label($model,'Дата по'); ?>
           <?php echo $form->textField($model,'endDate')?>
    </div>

    <div class="row submit">
       <?php echo CHtml::submitButton('Показать') ?>
    </div>
 
<?php $this->endWidget(); ?>
</div><!-- form -->
 <?php/* } else { */?>
  
 <div class="import-log" id="import-log">
        <p>Лог:</p>
        <p>Копирование файла. <span class="label label-success">Успех</span></p>

    </div>

<script>
      $(document).ready(function() {
    
    });
 function index() {
        $.ajax({
            type: "POST",
            url: "/users/index",
            data: "",
           
            beforeSend: function() {
                $("#import-log").html($("#import-log").html() + 'Определение кол-ва строк. ');
            },
            success: function(data) {
                var obj = $.parseJSON(data);
                alert(data);
                if (obj.error == 0) {
                    countLine = obj.str;
                    $("#import-log").html($("#import-log").html() + obj.str + ' стр. <span class="label label-success">Успех</span><br clear="all"/>');
                    $("#import-log").html($("#import-log").html() + ' Старт импорта <span class="label label-success">Успех</span><br clear="all"/>');
                    $(".bar").css("width", "10%");
                    importAjaxXLS(0);
                } else {
                    if (obj.message != '') {
                        alert(obj.message);
                    } else {
                        alert('упс..... ошибочка');
                    }
                    $("#import-log").html($("#import-log").html() + '<span class="label label-important">Ошибка</span><br clear="all"/>');
                }
            },
            error: function() {
                $("#import-log").html($("#import-log").html() + '<span class="label label-important">Ошибка</span><br clear="all"/>');
            },
        });
        return false;
    }
</script>
<?php
//}
?>
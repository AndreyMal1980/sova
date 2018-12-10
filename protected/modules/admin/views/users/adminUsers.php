<h1>Управление  пользователями</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">
<?php/* $this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'User-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'user_id',
		'role',
		'name',
		'surname',
		'password',
		'number_ticket',
		'email',
		'address',
		'city',
		'phone',
		'status_id',
		'share',
		'parent_id',
		'date'=>array('name'=>'date','value'=>'date("Y.m.d.  время регистрации  H.i",$data->date)'),
		array(
			'class'=>'CButtonColumn',
                        //'deleteButtonOptions'=>array('style'=>'display:none'),
                     'updateButtonUrl'=>'Yii::app()->createUrl("/admin/users/updateUser",array("id"=>$data->user_id))',
                     'deleteButtonUrl'=>'Yii::app()->createUrl("/admin/users/deleteUser",array("id"=>$data->user_id))',
		),
	),
)); ?>
<?php $this->widget('CTreeView', array('data' => $my_data));?>
<?php
Yii::app()->getClientScript()->registerScriptFile('/js/admin/lines/line.js');
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}
$this->breadcrumbs = array(
    'Линии',
);
?>
<h1>Линии</h1>

<table class="table table-hover">
    <tr>
        <td><a rel="tooltip" title="название"><i class="icon-th-list"></i></a></td>        
        <td></td><td></td> <td></td>
    </tr>
    <?php
    foreach ($model as $value) {
        ?>
        <tr id="tr-<?php echo $value->id; ?>">
            <td><a href="/index.php/admin/settingLines/edit/id/<?php echo $value->id; ?>" title="редактировать" rel="tooltip"><?php echo $value->line; ?></a></td>
            <td><a href="/index.php/admin/settingLines/edit/id/<?php echo $value->id; ?>" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;</td>          
            <td><a href="#" onclick="lineDelete(<?php echo $value->id; ?>, '<?php echo   ' ' . $value->line; ?>'); return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a></td>
            <td></td>
        </tr>          
        <?php
    }
    ?>
</table>
 
<div class="form">
<?php echo CHtml::beginForm(); ?>
 
<?php echo CHtml::errorSummary($model); ?>

 <div class="form-actions" style="text-align: right;">
<?php echo CHtml::submitButton('Добавить линию',array(
    'submit' => '/index.php/admin/settingLines/add',
    "class"=>"btn btn-primary"))?>
</div>
 
<?php echo CHtml::endForm(); ?>
</div><!-- form -->
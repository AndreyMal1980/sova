<?php
Yii::app()->getClientScript()->registerScriptFile('/js/admin/programms/programm.js');
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}
$this->breadcrumbs = array(
    'Программы',
);
?>
<h1>Программы</h1>

<table class="table table-hover">
    <tr>
        <td><a rel="tooltip" title="название"><i class="icon-th-list"></i></a></td>        
        <td><a rel="tooltip" title="дата создания"><i class="icon-calendar"></i></a></td>
        <td></td>
    </tr>
    <?php
    foreach ($model as $value) {
        ?>
        <tr id="tr-<?php echo $value->programm_id; ?>">
            <td><a href="/index.php/admin/programms/edit/id/<?php echo $value->programm_id; ?>" title="редактировать" rel="tooltip"><?php echo $value->name; ?></a></td>
           <td><small><?php echo date('d.m.Y', $value->date) . '<br />' . date('H:i:s', $value->date); ?></small></td>
            <td><a href="/index.php/admin/programms/edit/id/<?php echo $value->programm_id; ?>" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;</td>          
            <td><a href="#" onclick="programmDelete(<?php echo $value->programm_id; ?>, '<?php echo   ' ' . $value->name; ?>'); return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a></td>
     
        </tr>          
        <?php
    }
    ?>
</table>
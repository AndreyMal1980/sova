<?php
Yii::app()->getClientScript()->registerScriptFile('/js/admin/programms/programm.js');
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}
$this->breadcrumbs = array(
    'Настройки',
);
?>
<h1>Настройки</h1>

<table class="table table-hover">
    <tr>
        <td><a rel="tooltip" title="название"><i class="icon-th-list"></i></a></td>        
        <td></td>
    </tr>
    <?php
    foreach ($modelSettingAccount as $value) {
        ?>
        <tr id="tr-<?php echo $value->id; ?>">
            <td><a href="/index.php/admin/SettingAccount/edit/id/<?php echo $value->id; ?>" title="редактировать" rel="tooltip"><?php echo $value->name; ?></a></td>
            <td><a href="/index.php/admin/SettingAccount/edit/id/<?php echo $value->id; ?>" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;</td>          
            <td><a href="#" onclick="programmDelete(<?php echo $value->id; ?>, '<?php echo ' ' . $value->name; ?>');
                        return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a></td>

        </tr>          
        <?php
    }
    ?>

    <?php
    foreach ($modelLinesDescription as $value) {
        ?>
        <tr id="tr-<?php echo $value->id; ?>">
            <td><a href="/index.php/admin/settingLines/" title="редактировать" rel="tooltip"><?php echo $value->name; ?></a></td>
            <td><a href="/index.php/admin/settingLines/" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;</td>          
            <td><a href="#" onclick="lineDelete(<?php echo $value->id; ?>, '<?php echo ' ' . $value->name; ?>');
                        return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a></td>

        </tr>          
        <?php
    }
    ?>
        
        <?php
    foreach ($modelSettingSertificate as $value) {
        ?>
        <tr id="tr-<?php echo $value->id; ?>">
            <td><a href="/index.php/admin/SettingSertificate/edit/id/<?php echo $value->id; ?>" title="редактировать" rel="tooltip"><?php echo $value->name; ?></a></td>
            <td><a href="/index.php/admin/SettingSertificate/edit/id/<?php echo $value->id; ?>" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;</td>          
            <td><a href="#" onclick="programmDelete(<?php echo $value->id; ?>, '<?php echo ' ' . $value->name; ?>');
                        return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a></td>

        </tr>          
        <?php
    }
    ?>
</table>
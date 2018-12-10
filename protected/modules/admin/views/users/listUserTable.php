<?php
Yii::app()->getClientScript()->registerScriptFile('/js/admin/programms/programm.js');
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}
$this->breadcrumbs = array(
    'Список пользователей в табличном виде',
);
?>
<h1>Пользователи</h1>
<?php echo '<strong>'.'Всего пользователей - '.'<strong>'.$allCountUsers.'<hr/>';?>
<?php if ($model) { ?>
    <table class="table table-hover">
        <tr>
            <td><a rel="tooltip" title="Фамилия Имя"><i class="icon-user"></i></a></td>        
            <td><a rel="tooltip" title="Роль"><i class="icon-star"></i></a></td>
            <td><a rel="tooltip" title="билет"><i class="icon-book"></i></a></td>
            <td><a rel="tooltip" title="email"><i class="icon-envelope"></i></a></td>
            <td><a rel="tooltip" title="Город"><i class="icon-flag"></i></a></td>
            <td><a rel="tooltip" title="Телефон"><i class="icon-bell"></i></a></td>
            <td><a rel="tooltip" title="Сумма пая"><i class="icon-gift"></i></a></td>
            <td><a rel="tooltip" title="Дата регистрации"><i class="icon-calendar"></i></a></td>
            <td></td>
        </tr>
        <?php
        foreach ($model as $value) {
            ?>
            <tr id="tr-<?php echo $value->user_id; ?>">
                <td><a href="/index.php/admin/users/editUser/id/<?php echo $value->user_id; ?>" title="редактировать" rel="tooltip"><?php echo $value->surname; ?> <?php echo $value->name; ?></a></td>
                <td><?php echo $value->role ?></td>
                <td><?php echo $value->number_ticket ?></td>
                <td><small><?php echo $value->email ?></small></td>
                <td><small><?php echo $value->city ?></small></td>
                <td><small><?php echo $value->phone ?></small></td>
                <td><small><?php echo $value->share ?></small></td>
                <td><small><?php echo date('d.m.Y', $value->date) . '<br />' . date('H:i:s', $value->date); ?></small></td>
                <td><a href="/index.php/admin/users/editUser/id/<?php echo $value->user_id; ?>" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;</td>
                <td><a href="#" onclick="userDelete(<?php echo $value->user_id; ?>, '<?php echo ' ' . $value->name; ?>');
                      return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a></td>
                <td></td>
            </tr>
            <?php
        }
        ?>
    <?php
    } else {
        echo 'Нет пользователей';
    }
    ?>
</table>
<?php

foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}


$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'Редактирование', 'url' => array('update', 'id' => $model->user_id)),
    array('label' => 'Маркетинг план', 'url' => array('marketing/index', 'id' => $model->user_id)),
    array('label' => 'Программы кооператива', 'url' => array('/programms/')),
    array('label' => 'Мои паи', 'url' => array('/payToUser')),
);

?>

<h1>Cтраница пользователя <?php echo $model->surname.' '.$model->name; ?></h1>

<?php
if ($userRef != ' ')
    echo 'Ваша реферальная ссылка - ' . '<strong>' . $userRef . '<strong>' . '<hr/>';
else
    echo '<strong>' . 'Ваша реферальная ссылка еще не готова' . '<strong>' . '<hr/>';
?>

<?php $this->widget('CTreeView', array('data' => $my_data)); ?>
<p>Количество приглашенных участников - <?php echo $count; ?></p>
<?php
 foreach ($parentUserName as $value) {
 
  }
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'user_id',
        //'programms' => array('label' => 'Программы пайщика', 'type' => 'html', 'value' => Users::model()->getProgrammsUser($model->user_id)),
        'role' => array('visible' => false),
        'name',
        'surname',
        'password',
        'number_ticket',
        'email',
        'city',
        'phone',
       // 'share',
        'parent_id' => array('label' => 'Кто пригласил', 'value' => $value['surname'].' '.$value['name']),
        'date' => array('label' => 'Дата регистрации', 'value' => date("Y.m.d", $model->date)),
    ),
));
?>

<hr/>
<p>Выборка приглашенных участников за определенный период </p>
<?php echo '<strong>' . 'Внимание!!! Дату вводить в формате Y.m.d (год.месяц.день, например 2014.09.12)' . '</strong>'; ?>
<?php echo '<hr/>';?>
<form method="POST" id="form" action="javascript:void(null);" onsubmit="call()">
    <label for="name">Дата с:</label><input id="name" name="startDate" value="" type="text">
    <label for="email">Дата по:</label><input id="email" name="endDate" value="" type="text">
    <input type="hidden" name="id" size="2" value="<?php echo $model->user_id; ?>" />
    <input value="Обработать" type="submit" name="testAjax">
</form> 
<script type="text/javascript" language="javascript">

    function call() {
        var msg = $('#form').serialize();
        id =<?php echo $model->user_id ?>;
        $.ajax({
            type: 'POST',
            url: "/index.php/users/index/" + id,
            data: msg,
            success: function(data) {
                $('.results').html(data);
            },
            error: function(xhr, str) {
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });

    }
</script>
<div class="results"></div>


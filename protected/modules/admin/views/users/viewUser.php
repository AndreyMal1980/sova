<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}

$this->breadcrumbs = array(
    'Пользователи' => '/admin/users/',
    'Пользователь'
);
?>
<h1> Пользователь <?php echo $model->surname . '  ' . $model->name; ?></h1>
<h2><?php echo ' статус '.' - '.' '.$statusUser;?></h2>
<?php
if ($userRef != '')
    echo 'Ваша реферальная ссылка - ' . '<strong>' . $userRef . '<strong>' . '<hr/>';
else
    echo '<strong>' . 'Ваша реферальная ссылка еще не готова' . '<strong>' . '<hr/>';
?>
<?php
 
 $sumPayAllStructure=0;
$this->widget('CTreeView', array('data' => $my_data));
if (is_array($dataCountLineUsers2)) {
    foreach ($dataCountLineUsers2 as $key => $value) {
       // $sumPay=0;
       // for($i=0;$i<count($value);$i++){
           
         // $sumPay += $value[$i]['pay'];
          
      // }
        
          echo '</br>'; echo '</br>'; echo '</br>';
                    echo '<pre>';
                   //$sumPay += $val['pay_id'];
                    print_r($value);
                    echo '</pre>';
        
        
       $sumPayAllStructure+=$sumPay;
        echo '<pre>';
        //print_r($value);
        echo'На' . ' ' . $key . ' ' . 'линии' . '-' . ' ' . count($value) . ' ' . 'участников'.'    '.'Суммарный пай составляет - '.' '.'- '.$sumPay;
        echo '</pre>';
    }
}
?>
<p>Количество лично приглашенных участников - <?php echo $count; ?></p>
<p>Количество участников во всей структуре - <?php echo count($dataCountLineUsers); ?></p>
<p>Суммарный пай всей структуры - <?php echo $sumPayAllStructure; ?></p>
<?php
foreach ($parentUserName as $value) {
    
}
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'user_id',
       // 'programms' => array('label' => 'Программы пайщика', 'type' => 'html', 'value' => Users::model()->getProgrammsUser($model->user_id)),
        'role',
        'name',
        'surname',
        'password',
        'number_ticket',
        'number_ticket_change' => array('label' => 'Номер членского билета того кто пригласил', 'value' => $model->number_ticket_change),
        'email',
        'city',
        'phone',
       // 'share',
        'parent_id' => array('label' => 'Кто пригласил', 'value' => $value['surname'] . ' ' . $value['name']),
        'date' => array('label' => 'Зарегестрирован', 'value' => date("Y.m.d.", $model->date))
    ),
));
?>
<hr/>
<?php echo CHtml::link('Редактировать данные пользователя', array('/admin/users/editUser/id/' . $model->user_id)) ?>
<br/>
<?php echo CHtml::link('Удалить пользователя', array('users/deleteUser/id/' . $model->user_id)) ?>
<hr/>
<p>Выборка приглашенных участников за определенный период </p>
<?php echo '<strong>' . 'Внимание!!! Дату вводить в формате Y.m.d (год.месяц.день, например 2014.09.12)' . '</strong>'; ?>
<hr/>
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
            url: "/index.php/admin/users/index/" + id,
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
<?php
/* @var $this NewsController */
Yii::app()->getClientScript()->registerScriptFile('/js/admin/user/user.js');
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}
$this->breadcrumbs = array(
    'Пользователи',
);
?>
<h1>Пользователи</h1>

<?php
echo '<strong>'.'Всего пользователей - '.'<strong>'.$allCountUsers.'<hr/>';
/* @var $this ProgrammsController */
/* @var $dataProvider CActiveDataProvider */
   
       
$this->widget('CTreeView', array('data' => $my_data));

?>
<hr>
 Количество линий - <?php echo $dataMaxLines3; ?>
    <br>
      Задействовано - 


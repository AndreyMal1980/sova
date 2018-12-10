<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}
$this->breadcrumbs = array(
    'Пользователи' => '/index.php/admin/users/',
    'Добавление пользователя',
);
?>
<?php  Yii::app()->user->getId(); ?>
<div class="hero-unit">
  <p><?php echo $model['description'];?></p>
  <p>
      <?php 
      echo CHtml::beginForm('/index.php/paymentSystems');
      echo CHtml::submitButton('Оплатить',array('class' => 'btn btn-primary btn-large'));
      echo CHtml::endForm();
      ?>
  </p>
</div>


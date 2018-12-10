<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1>Страница оплаты пая</h1>
<p><strong>Выберите удобную Вам платежную систему ,чтобы внести пай и стать ассоциированным членом производственного кооператива СОВА </strong></p>
<hr>
<?php
echo CHtml::link('Оплатить через MoneXy','/index.php/paymentSystems/MoneXy');
echo '<hr>';
echo CHtml::link('Оплатить через PayPal','/index.php/paymentSystems/PayPal/PaymentPay/');
echo '<hr>';
?>

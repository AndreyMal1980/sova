<?php

foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}


$this->breadcrumbs=array(
	'Программы',
);
?>

<h1>Программы кооператива СОВА</h1>
<p>
    На этой странице Вы можете ознакомится со всеми программами производственного коопераива СОВА
    ,а также внести оплату по одной или нескольким программам
</p>

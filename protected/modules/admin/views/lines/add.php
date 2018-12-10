<?php
/* @var $this UserController */
$this->breadcrumbs = array(
    'Линии' => '/index.php/admin/lines/add',
    'Добавление линии',
);
?>
<h1>Добавить линию</h1>
<?php

$this->renderPartial('/lines/_form', array('model' => $model, 'lines' => $lines,'a' => $a));
?>
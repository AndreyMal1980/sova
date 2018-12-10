<?php
/* @var $this UserController */
$this->breadcrumbs = array(
    'Программы' => '/index.php/admin/programms',
    'Добавление программы',
);
?>
<h1>Добавить программу</h1>
<?php $this->renderPartial('/programms/_form', array('model' => $model)); ?>
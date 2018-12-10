<?php
/* @var $this UserController */
$this->breadcrumbs = array(
    'Маркетинг' => '/index.php/admin/marketing',
    'Добавление маркетинг плана',
);
?>
<h1>Добавить маркетинг план</h1>
<?php $this->renderPartial('/marketing/_form', array('model' => $model)); ?>
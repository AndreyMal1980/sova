
<div class="sog">
    <?php
    echo '<hr/>';
    echo $sogText;
    echo '<hr/>';
    ?>  
</div>
<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}
?>

<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'action' => Yii::app()->createUrl('/site/registrationRef2/'),
    'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
        )
);
echo $form->checkBoxList($model, 'sog', array('Ознакомился(лась) и принимаю условия соглашения'));
?>
<?php echo $form->errorSummary($model); ?>

<div class="form-actions_registration" style="text-align: left;">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => 'Далее',
        'htmlOptions' => array(
            'disabled' => true,
        )
    ));
    ?>
</div>
<?php $this->endWidget(); ?>


<script type="text/javascript">
    $(function() {
        $('#Sog_sog_0').bind('click', function() {
            var elem = $("#Sog_sog_0");
            if (elem.is(':checked')) {
                $('.btn-primary').removeAttr('disabled');
            }
            else {
                $('.btn-primary').attr('disabled', 'disabled');
            }
        });
    });
</script>
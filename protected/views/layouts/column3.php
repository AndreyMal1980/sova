<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
    <div id="content">

        <?php echo $content; ?>
    </div><!-- content -->
</div>
<div class="span-5 last">
    <div id="sidebar">
        
 <hr> 
        <ul class="nav nav-pills nav-stacked">
            <?php
            $programmsName = Programms::model()->findAll();
           
        
            foreach ($programmsName as $value) {
                ?>
                <li class="active"><a href="/index.php/programms/programmPay/id/<?php echo $value['programm_id']; ?>"> <?php echo $value['name']; ?> </a></li>
                <hr> 

            <?php } ?>
        </ul>
   </div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>
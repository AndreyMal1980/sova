<?php
Yii::app()->getClientScript()->registerScriptFile('/js/payToUser/countdown-1.0.1.js');
//echo $script;
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
<?php
//$dataPaymemt = date('Y:m:d', $value['pay']['date'] + 86400*$value['progtamm']['frequency_of_payments']);
//for($i=0;$i<)
//echo cal_days_in_month(CAL_GREGORIAN, 9, 2014);
//echo 
//echo mktime(0,0,0,0,31,2014);1410416746
?>

<table border="1" cellpadding="2" cellspacing="0">
    <tbody>
        <?php foreach ($model as $value) { ?>
            <?php if ($value['programm']['programm_id'] == 1) { ?>
                <tr style="background-color: #dddddd;">
                    <th rowspan="2" style="width: 200px;">Дата внесения пая</th>
                    <th rowspan="2" style="width: 200px;">сумма пая</th>
                    <th rowspan="2" style="width: 200px;">программа по этому паю</th>
                    <th colspan="3" style="width: 120px;">дивиденды</th>
                </tr>
                <tr style="background-color: #dddddd;">
                    <th  style="width: 60px;">дата начисления</th>
                    <th  style="width: 60px;">процент</th>
                    <th  style="width: 60px;">сумма</th>
                </tr>

            <td align='center' valign="middle" rowspan="<?php echo $value['programm']['period_of_payment'] - 1; ?>"><?php echo date('Y:m:d   -   H:i', $value['pay']['date']); ?></td>
            <td align='center' valign="middle" rowspan="<?php echo $value['programm']['period_of_payment'] - 1; ?>"><?php echo $value['pay']['pay']; ?></td>
            <td align='center' valign="middle" rowspan="<?php echo $value['programm']['period_of_payment'] - 1; ?>"><?php echo $value['programm']['name']; ?></td>
            <td align='center'><?php echo date('Y:m:d', $value['pay']['date'] + 86400 * $value['programm']['frequency_of_payments']); ?></td>
            <td align='center'><?php echo $value['programm']['percent']; ?></td> 
            <td align='center'><?php echo $value['pay']['pay'] * ($value['programm']['percent']) / 100; ?></td>           

            <?php for ($i = 1; $i < $value['programm']['period_of_payment']; $i++) { ?>
                <tr>
                    <?php if ($i == $value['programm']['period_of_payment'] - 1) { ?>
                        <td align='center' colspan='3' style="background-color:yellow;color: black"> Возврат тела пая </td>
                    <?php } ?>
                    <td <?php if ($i == $value['programm']['period_of_payment'] - 1) { ?> style="background-color:yellow;color: black" <?php } ?> align='center' >
                        <?php
                        if ($i == $value['programm']['period_of_payment'] - 1) {
                            $datePaymentPay = new DateAndTime($value['pay']['date'], $value['programm']['period_of_payment'], $value['programm']['frequency_of_payments']);
                            echo $datePaymentPay->getDateForPeriodInMonth();
                        } else {
                            echo date('Y:m:d', $value['pay']['date'] + 86400 * ($i + 1) * $value['programm']['frequency_of_payments']);
                        }
                        ?>
                    </td>
                    <td <?php if ($i == $value['programm']['period_of_payment'] - 1) { ?> style="background-color:yellow;color: black" <?php } ?> align='center' >
                        <?php if ($i == $value['programm']['period_of_payment'] - 1) { ?>
                            <?php echo 0; ?>
                            <?php
                        } else {
                            echo $pathPercent = $value['programm']['percent'];
                            ?>
                        <?php } ?>  
                    </td> 
                    <td <?php if ($i == $value['programm']['period_of_payment'] - 1) { ?> style="background-color:yellow;color: black" <?php } ?> align='center'> 
                        <?php if ($i == $value['programm']['period_of_payment'] - 1) { ?> 
                            <?php echo $value['pay']['pay'] = $value['pay']['pay']; ?>

                            <?
                        } else {
                            echo $pathPay = $value['pay']['pay'] * ($value['programm']['percent'] / 100);
                            ?>
                        <?php } ?>  
                    </td> 
                </tr>
            <?php } ?> 

            <td colspan="3" align='center' style="background-color:greenyellow;color: black">ИТОГО</td> 
            <td align='center' align='center' style="background-color:greenyellow;color: black"><?php
                $datePaymentPay = new DateAndTime($value['pay']['date'], $value['programm']['period_of_payment'], $value['programm']['frequency_of_payments']);
                echo $datePaymentPay->getDateForPeriodInMonth();
                ?></td>
            <td align='center' align='center' style="background-color:greenyellow;color: black"><?php echo $pathPercent * ($value['programm']['period_of_payment'] - 1); ?></td>
            <td align='center' align='center' style="background-color:greenyellow;color: black"><?php echo $pathPay * ($i - 1) + $value['pay']['pay']; ?></td>
            <tr><td align='center' colspan='6' style="background-color:cyan;color: black">Прибыль составляет <?php echo $pathPay * ($i - 1) + $value['pay']['pay'] - $value['pay']['pay']; ?></td></tr>
        <?php } ?> 
        <tr></tr>
    <?php } ?> 
</tbody>
</table>



<table border="1" cellpadding="2" cellspacing="0">
    <tbody>
        <?php foreach ($model as $value) { ?>
            <?php if ($value['programm']['programm_id'] == 2) { ?>
                <tr style="background-color: #dddddd;">
                    <th rowspan="2" style="width: 200px;">Дата внесения пая</th>
                    <th rowspan="2" style="width: 200px;">сумма пая</th>
                    <th rowspan="2" style="width: 200px;">программа по этому паю</th>
                    <th colspan="3" style="width: 120px;">дивиденды</th>
                </tr>
                <tr style="background-color: #dddddd;">
                    <th  style="width: 60px;">дата начисления</th>
                    <th  style="width: 60px;">процент</th>
                    <th  style="width: 60px;">сумма</th>
                </tr>
            <td align='center' valign="middle"><?php echo date('Y:m:d   -   H:i', $value['pay']['date']); ?></td>
            <td align='center' valign="middle" ><?php echo $value['pay']['pay']; ?></td>
            <td align='center' valign="middle"><?php echo $value['programm']['name']; ?></td> 

            <tr>
                <td colspan='3' align='center' style="background-color:yellow;color: black"> Возврат тела пая </td>  

                <td  align='center' style="background-color:yellow;color: black">
                    <?php
                    $datePaymentPay = new DateAndTime($value['pay']['date'], $value['programm']['period_of_payment'] - 1, $value['programm']['frequency_of_payments']);
                   // echo $datePaymentPay->getDateForPeriodInMonth();
                    ?>
                </td>    
                <td align='center' style="background-color:yellow;color: black"><?php echo 0; ?></td>
                <td align='center' style="background-color:yellow;color: black"><?php echo $value['pay']['pay']; ?></td>
            </tr>
            <tr>
                <td colspan='3' align='center' style="background-color:yellow;color: black">Получение процентов по паю</td>               
                <td align='center' style="background-color:yellow;color: black"><?php
                    $datePaymentPay = new DateAndTime($value['pay']['date'], $value['programm']['period_of_payment'], $value['programm']['frequency_of_payments']);
                  //  echo $datePaymentPay->getDateForPeriodInMonth()
                    ?> </td>
                <td align='center' style="background-color:yellow;color: black"><?php echo $value['programm']['percent']; ?></td>
                <td align='center' style="background-color:yellow;color: black"><?php echo $value['pay']['pay'] * ($value['programm']['percent']) / 100 ?> </td>
            </tr>
            <tr>
                <td colspan="3" align='center' style="background-color:greenyellow;color: black">ИТОГО</td>   
                <td align='center' style="background-color:greenyellow;color: black"> <?php
                    $datePaymentPay = new DateAndTime($value['pay']['date'], $value['programm']['period_of_payment'], $value['programm']['frequency_of_payments']);
                    echo $datePaymentPay->getDateForPeriodInMonth();
                    ?></td>
                <td align='center' style="background-color:greenyellow;color: black"><?php echo $value['programm']['percent']; ?></td>
                <td align='center' style="background-color:greenyellow;color: black"><?php echo $value['pay']['pay'] + $value['pay']['pay'] * ($value['programm']['percent']) / 100; ?></td>
            </tr>   
            <tr>
                <td align='center' colspan='6' style="background-color:cyan;color: black">Прибыль составляет <?php echo $value['pay']['pay'] + $value['pay']['pay'] * ($value['programm']['percent']) / 100 - $value['pay']['pay']; ?></td>
            </tr>  
            

        <?php } ?> 
        <tr></tr>
    <?php } ?> 
</tbody>
</table>




<table border="1" cellpadding="2" cellspacing="0">
    <tbody>
        <?php foreach ($model as $value) { ?>
            <?php if ($value['programm']['programm_id'] == 3) { ?>
                <tr style="background-color: #dddddd;">
                    <th rowspan="2" style="width: 200px;">Дата внесения пая</th>
                    <th rowspan="2" style="width: 200px;">сумма пая</th>
                    <th rowspan="2" style="width: 200px;">программа по этому паю</th>
                    <th colspan="3" style="width: 120px;">дивиденды</th>
                </tr>
                <tr style="background-color: #dddddd;">
                    <th  style="width: 60px;">дата начисления</th>
                    <th  style="width: 60px;">процент</th>
                    <th  style="width: 60px;">сумма</th>
                </tr>

            <td align='center' valign="middle" rowspan="<?php echo $value['programm']['period_of_payment']; ?>"><?php echo date('Y:m:d   -   H:i', $value['pay']['date']); ?></td>
            <td align='center' valign="middle" rowspan="<?php echo $value['programm']['period_of_payment']; ?>"><?php echo $value['pay']['pay']; ?></td>
            <td align='center' valign="middle" rowspan="<?php echo $value['programm']['period_of_payment']; ?>"><?php echo $value['programm']['name']; ?></td>


            <?php for ($i = 1; $i < $value['programm']['period_of_payment'] + 1; $i++) { ?>
                <tr>
                    <?php if ($i == $value['programm']['period_of_payment']) { ?>

                        <td align='center' colspan='3' style="background-color:yellow;color: black"> Возврат тела пая </td>

                    <?php } ?>

                    <?php if ($i == $value['programm']['period_of_payment']) { ?>
                        <td align='center' style="background-color:yellow;color: black">
                        <?php } else { ?>
                        <td align='center'>  
                        <?php } ?>

                        <?php
                        $currentMonth = date('m', $value['pay']['date']);
                        $month = $currentMonth + $i;
                        $days = mktime(0, 0, 0, $month, date('d', $value['pay']['date']), date('Y', $value['pay']['date']));
                        echo date('Y:m:d', $days);
                        ?>
                    </td>

                    <?php if ($i == $value['programm']['period_of_payment']) { ?>
                        <td align='center' style="background-color:yellow;color: black">
                        <?php } else { ?>
                        <td align='center'>  
                        <?php } ?>

                        <?php
                        if ($i == 3 || $i == 6 || $i == 9) {
                            echo $value['programm']['percent'];
                        } else {
                            echo 0;
                        }
                        ?>
                    </td>

                    <?php if ($i == $value['programm']['period_of_payment']) { ?>

                        <td align='center' style="background-color:yellow;color: black">

                            <?php echo $value['pay']['pay'] ?> 
                        <?php } else { ?>
                        <td align='center'>  
                        <?php } ?>
                        <?php
                        if ($i == 3 || $i == 6 || $i == 9) {
                            echo $value['pay']['pay'] * ($value['programm']['percent'] / 100);
                        }
                        echo 0;
                        ?>
                    </td>

                </tr> 

            <?php } ?>

            <tr>
                <td align='center' colspan='3'>Получение бонуса</td>
                <td align='center'> <?php
            $datePaymentPay = new DateAndTime($value['pay']['date'], $value['programm']['period_of_payment'], $value['programm']['frequency_of_payments']);
            echo $datePaymentPay->getDateForPeriodInMonth();
            ?></td>
                <td align='center'><?php echo $value['programm']['bonus'] ?></td>
                <td align='center'><?php echo $value['pay']['pay'] * ($value['programm']['bonus'] / 100) ?></td>


            </tr>

            <td colspan="3" align='center' style="background-color:greenyellow;color: black">ИТОГО</td> 
            <td align='center' align='center' style="background-color:greenyellow;color: black"><?php
                $datePaymentPay = new DateAndTime($value['pay']['date'], $value['programm']['period_of_payment'], $value['programm']['frequency_of_payments']);
                echo $datePaymentPay->getDateForPeriodInMonth();
                ?></td>
            <td align='center' align='center' style="background-color:greenyellow;color: black"><?php echo $value['programm']['percent'] * 3; ?></td>
            <td align='center' align='center' style="background-color:greenyellow;color: black"><?php echo ($value['programm']['percent'] * 3) / 100 * $value['pay']['pay'] + $value['pay']['pay'] + $value['pay']['pay'] * ($value['programm']['bonus'] / 100); ?></td>
            <tr><td align='center' colspan='6' style="background-color:cyan;color: black">Прибыль составляет <?php echo ($value['programm']['percent'] * 3) / 100 * $value['pay']['pay'] + $value['pay']['pay'] + $value['pay']['pay'] * ($value['programm']['bonus'] / 100) - $value['pay']['pay']; ?></td></tr>     
            <?php
          //  $timer = new DateAndTime;
           // $timer->addTimer();
            ?>;      












        <?php } ?>
        <tr></tr>
    <?php } ?>
</tbody>
</table>


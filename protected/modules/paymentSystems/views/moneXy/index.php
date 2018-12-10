<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  ' . $message . '
</div>';
}
?>
<h1>Оплата пая через платежную систему MoneXy </h1>
<p>Уважаемый пользователь 
    <?php
    if ($userName) {
        echo $userName;
    } else {
        $query = Yii::app()->db->createCommand('select name from users where user_id='. Yii::app()->user->getId());
        $result = $query->queryScalar();
        echo $result;
    }
        ?>
        На этой странице Вы можете уже сейчас оплатить пай  и начать получать дивиденды 
        согласно выбранной Вами программе </p>
    <p>Минимальная сумма взноса составляет 500 грн , максимальная 15000 грн</p>
    <hr>

    <p class="programm<?php echo $key; ?>">Введите сумму для оплаты пая по программе - 
        <?php
        $session = new CHttpSession;
        $session->open();
        if ($programm['name'])
            echo $programm['name'];
        else
            echo $session['programmName'];
        ?>
        <input type="text" class="sumPay">
    </p>
    <p class="percent"></p>
    <p class="totalPrice"></p>

    <?php
    $params = array();
    $params["myMonexyMerchantID"] = "104184160";
    $params["myMonexyMerchantShopName"] = "sova";
    $params["myMonexyMerchantCurrency"] = "UAH";
    $params["myMonexyMerchantSuccessUrl"] = "http://sova:8080/index.php/site/SucessPay";
    $params["myMonexyMerchantResultUrl"] = "http://sova:8080/index.php/site/registrationRef2";
    $params["myMonexyMerchantFailUrl"] = "http://sova:8080/index.php/site/FailPay";

    ksort($params);
//$MPASSWORD = 'SovaApiPaymentsob/\korova_14.07.12';
    $req_str = ''; // первоначальное значение строки данных для подписи
    foreach ($params AS $pkey => $pval)
        $req_str.=($pkey . '=' . $pval);
    $params["myMonexyMerchantHash"] = md5($req_str);
    /*
      echo '</br>';echo '</br>';
      echo '<pre>';
      print_r($programms);
      echo '</pre>';
     */
// хэш данных для отправки
    ?>

    <form id="payment_send" action="https://www.monexy.ua/merchant/merchant.php" method="post">
        <input type="hidden" name="myMonexyMerchantCurrency" value="UAH">
        <input type="hidden" name="myMonexyMerchantID" value="104184160">
        <input type="hidden" name="myMonexyMerchantShopName" value="sova">
        <input type="hidden" name="myMonexyMerchantSum" class ="myMonexyMerchantSum" value="1">
        <input type="hidden" name="myMonexyMerchantSuccessUrl" value="http://sova:8080/index.php/site/SucessPay">
        <input type="hidden" name="myMonexyMerchantResultUrl" value="http://sova:8080/index.php/site/registrationRef2">
        <input type="hidden" name="myMonexyMerchantFailUrl" value="http://sova:8080/index.php/site/FailPay">

        <input type="hidden" name="myMonexyMerchantHash" value="<?php echo $params['myMonexyMerchantHash'] ?>">
    <input type="hidden" name="myMonexyPaymentSimple" value="1">
    <input name="submit" type="submit" value="Оплатить" class="btn-primary" disabled="disabled"> 
</form>
<hr>

<script type="text/javascript">

    $(document).ready(function() {
        //var classPay;
        //var indexPay;
        //var idButtonPay;
        //var indexButtonPay;
        // var data;
        var programmToPay;

        //  $('input').click(function() {
        // classPay = ($(this).attr('class'));
        // indexPay = (parseInt(classPay.replace(/\D+/g, "")));

        // programm = ($('.' + classPay).parent('p').text().split('-')[1]);
        //  alert(classPay);
        getSumPay();

        //  });

        $('.btn-primary').click(function() {
            // idButtonPay = ($(this).attr('id'));
            // indexButtonPay = (parseInt(idButtonPay.replace(/\D+/g, "")));
            programmToPay = ($('.programm').text().split('-')[1]);
         //   alert(programmToPay);

            sendToPay(programmToPay);
        });

        function sendToPay(programmToPay) {
          //  alert(programmToPay);

            $.ajax({
                type: "POST",
                url: '/index.php/site/SucessPay',
                data: 'programmToPay=' + programmToPay,
                beforeSend: function() {
                    //alert(data);
                },
                success: function(data) {
                    // var obj = $.parseJSON(data);


                    //  if (obj.count != 0) {

                    //  $('.programm' + obj.indexButtonPay).remove();
                    // $('.percent' + obj.indexButtonPay).remove();
                    //  $('#btn-primary' + obj.indexButtonPay).remove();
                    // $('.sumPay' + obj.indexButtonPay).remove();
                    // window.location.href = "http://sova:8080/index.php/paymentSystems/MoneXy/";
                    $("p").append(data);
                    // }
                    // else if (obj.count = 0) {
                    // window.location.href = "http://sova:8080/index.php/site/registrationOk/";
                    // }
                },
                error: function() {
                },
            });
        }

        function check(txt) {
            var req = /^\d+$/gi;
            if (req.test(txt)) {

                if (parseFloat(txt) >= 500 && parseFloat(txt) <= 15000) {
                    $('.btn-primary').removeAttr('disabled');
                    var percent = parseFloat((txt / 100));
                    var totalPrice = percent + 99 + parseInt(txt);
                    $('.percent').empty();
                    $('.percent').append('1% Процент от введенной суммы составляет -  ' + percent);
                    $('.totalPrice').empty();
                    $('.totalPrice').append('Итого к оплате -  ' + totalPrice);
                    $('.myMonexyMerchantSum').attr({
                        "value": totalPrice
                    });
                }
                else {
                    $('.btn-primary').attr('disabled', 'disabled');
                    $('.percent').empty();
                    $('.totalPrice').empty();
                    // alert('Минимальная сумма должна быть не менее 500');
                }
            }
            else {
                alert("Некорректная сумма! Нужно вводить только цифры")
                $('.percent').empty();
                $('.totalPrice').empty();
            }
        }

        function getSumPay() {
            $('.sumPay').keyup(function() {
                $('.sumPay').val();
                // alert( $('.sumPay').val())
                check($('.sumPay').val());

            });
        }
    });

</script>


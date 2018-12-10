<h1>Внесение пая через платежную систему PayPal </h1>
<p>Уважаемый пользователь <?php echo $model->name; ?> На этой странице Вы можете уже сейчас оплатить пай  и начать получать проценты </p>
<p>Минимальная сумма пая составляет 400 грн , максимальная 15000 грн</p>
<?php print_r($data['email']);?>
 <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> <!--для реальной работы эту строчку изменить
                                                                              //   <form action="https://www.paypal.com/cgi-bin/webscr" method="post">-->     
        <input type="hidden" name="cmd" value="_xclick">  
        <input type="hidden" name="business" value="<?php echo $data['email']; ?>">  
        <input type="hidden" name="item_name" value="Donation">  
        <input type="hidden" name="item_number" value="<?php echo $model->user_id; ?>">  
        <input type="text" name="amount" value="">  
        <input type="hidden" name="no_shipping" value="0">  
        <input type="hidden" name="currency_code" value="USD"> 
        <input type="hidden" name="notify_url" value="http://sova:8080/index.php/paymentSystems/payPal/IPN">
        <input type="hidden" name="return" value="http://sova:8080/index.php/paymentSystems/payPal/IPN"> 
        <input type="hidden" name="cancel_return" value="http://sova:8080/index.php"> 
        <input type="submit" value="Оплатить PayPal">
    </form>
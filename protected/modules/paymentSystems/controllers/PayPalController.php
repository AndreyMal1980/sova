<?php

class PayPalController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

     public function actionPaymentPay() {
        $model = Users::model()->findByPk($id);
        $data['email'] = Yii::app()->params['PayPalEmail'];
        $this->render('index', array('model' => $model, 'data' => $data));
    }
    
    public function actionIPN() {
     
        //  Loger::addLogPayPal(array(), 'обращение к скрипту ipn', 0, 0, '');
        $header = null;
        //Пример взят https://cms.paypal.com/cms_content/GB/en_GB/files/developer/IPN_PHP_41.txt
        // PHP 4.1
        // читаем сообщение от PayPal системы и добавлять "CMD"
        $req = 'cmd=_notify-validate';

        foreach ($_POST as $key => $value) {

            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
        // post back to PayPal system to validate
        //post передача системе PayPal для проверки
        $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
        $header .= "Host: www.sandbox.paypal.com\r\n";//для реальной работы эту строчку изменить на   $header .= "Host: www.paypal.com\r\n"; или убрать
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
         echo '</br>';  echo '</br>';  echo '</br>';
         echo '<pre>';
          print_r($header);
         echo '</pre>';
        $fp = fsockopen('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);//для реальной работы эту строчку изменить
                                                                              //   на $fp = fsockopen('ssl://www.paypal.com', 443, $errno, $errstr, 30)    
     
        // assign posted variables to local variables
        //назначить переменные размещены на локальные переменные
        $payPal['itemName'] = $_POST['item_name'];
        $payPal['itemNumber'] = $_POST['item_number'];
        $payPal['paymentStatus'] = $_POST['payment_status'];
        $payPal['paymentAmount'] = $_POST['mc_gross'];
        $payPal['paymentCurrency'] = $_POST['mc_currency'];
        $payPal['txnId'] = $_POST['txn_id'];
        $payPal['receiverEmail'] = $_POST['receiver_email'];
        $payPal['payerEmail'] = $_POST['payer_email'];

        if (!$fp) {
            echo 'невозможно соединиться с PayPal';
            // HTTP ERROR
            // Loger::addLogPayPal($payPal, 'запрос не с PayPal.com', 1, 0, 'invalid');
        } else {
            $a = fputs($fp, $header . $req); //подсчет количества символов в строке
            while (!feof($fp)) {
                $res = fgets($fp, 1024);
                if (strcmp($res, "VERIFIED") == 0) {
                    echo 'Ура получилось';
                    $userPay = Users::model()->findByPk((int) ($payPal['itemNumber']));
                    
                  //  echo '</br>';  echo '</br>';  echo '</br>';
                  //  print_r($userPay);
                    
                    if ($userPay) {
                        $share = $userPay['share'];
                        echo $share;
                        if ($share == 0) {
                            $userPay->share = (int) $payPal['paymentAmount'];
                            $userPay->save();
                        } else if ($share != 0) {
                            $userPay->share = $userPay['share'] + (int)$payPal['paymentAmount'];
                            $userPay->save();
                        }
                        //$contentAccess-> = 1;
                        //$contentAccess->save();
                        // Loger::addLogPayPal($payPal, 'оплата выполнена успешно', 0, 0, 'verified');
                    } else {
                        echo 'запрос не прошел проверку, нет такого в БД';
                        // Loger::addLogPayPal($payPal, 'запрос не прошел проверку, нет такого в БД', 1, 0, 'invalid');
                    }

                    // check the payment_status is Completed
                    // check that txn_id has not been previously processed
                    // check that receiver_email is your Primary PayPal email
                    // check that payment_amount/payment_currency are correct
                    // process payment
                } else if (strcmp($res, "INVALID") == 0) {
                    // Loger::addLogPayPal($payPal, 'запрос не прошел проверку', 1, 0, 'invalid');
                    // log for manual investigation                    
                }
            }
            fclose($fp);
        }
    }

}
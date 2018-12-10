<?php

class Mailer {

    public function newMail($contacts, $theme, $bodyText) {
        $_SmtpHost = 'example.com';
        $_SmtpLogin = 'mailUserLogin';
        $_SmtpPassword = 'mailUserPwd'; //если нужно
        $_SmtpPort = 25; // порт
        $_From = array(
            'vasya@example.com' => 'Vasiliy Pupkin'  // формат контактов From: и To:
        );

        $SM = Yii::app()->swiftMailer;

        $Transport = $SM->smtpTransport($_SmtpHost, $_SmtpPort)
                ->setUsername($_SmtpLogin)
                ->setPassword($_SmtpPassword);

        $Mailer = $SM->mailer($Transport);

        $Message = $SM
                ->newMessage($theme)
                ->setFrom($_From)
                ->setTo($contacts)
                ->addPart($bodyText, 'text/html')
                ->setBody($bodyText);

        return $Mailer->send($Message);
    }
}
?>
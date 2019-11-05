<?php

namespace site\app\services;

use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    private $mail;

    public function __construct(){
        $this->mail = new PHPMailer();
        $this->Init();
        $this->mail->isSMTP();
    }

    public function Init(){
        $this->mail->Host = $_ENV['SMTP_HOST'];
        $this->mail->SMTPAuth = $_ENV['SMTP_AUTH'];
        $this->mail->Username = $_ENV['SMTP_USER'];
        $this->mail->Password = $_ENV['SMTP_PASSWORD'];
        $this->mail->SMTPSecure = $_ENV['SMTP_SECURE'];
        $this->mail->Port = $_ENV['SMTP_PORT'];
    }

    public function send($subject, $htmlMessage, $receiver, $sender = "SYSTEM@MY.MD", $replyTo="No-reply@my.md"){
        $this->mail->setFrom($sender, 'No-reply');
        $this->mail->addReplyTo($replyTo, 'No-reply');
        $this->mail->addAddress($receiver, 'Final User');

        $this->mail->Subject = $subject;
        $this->mail->isHTML(true);
        $this->mail->Body = $htmlMessage;
        $this->mail->msgHTML($htmlMessage);

        if($this->mail->send()){
            return true;
        }
        return false;
    }

}
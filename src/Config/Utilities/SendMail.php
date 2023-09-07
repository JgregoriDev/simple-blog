<?php

namespace App\Config\Utilities;

use App\Entities\User;
use Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;


class SendMail
{
  private $mailer;
  public function __construct()
  {
    $this->mailer = new PHPMailer();
  }

  public function send(string $user)
  {
    $json = json_decode(file_get_contents(__DIR__ . '/dataMail.json', true));
    try {
      $this->mailer->SMTPDebug = SMTP::DEBUG_OFF;
      $this->mailer->isSMTP();
      $this->mailer->Host = 'smtp.gmail.com';

      $this->mailer->SMTPAuth = true;
      $this->mailer->Username = $json->email;
      $this->mailer->Password = $json->password;
      $this->mailer->SMTPSecure = 'tls';
      $this->mailer->Port = 587;
      $this->mailer->setFrom('josepgb13@gmail.com', 'Your Name');
      $this->mailer->addAddress($user, 'Recipient Name');
      $this->mailer->Subject = 'Asunto: Registro en blog simple';
      $this->mailer->Body = 'Content of your email';
      echo "<pre>";
      $isSended = $this->mailer->send();
      echo "</pre>";
      $msg = $isSended ? 'Message has been sent' : 'Message could not be sent';
      echo $msg;
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
    }
  }
}

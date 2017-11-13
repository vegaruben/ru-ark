<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 03/11/17
 * Time: 10:12
 */

namespace Funnlz\Services;

use Pimple\Container;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Funnlz\Entities\Email;

class MailerService
{
    private $app;
    private $config;

    public function __construct(Container $app, $config)
    {
        $this->app = $app;
        $this->config = $config;
    }
    public function sendEmail(Email $email){
        //var_dump($this->config);exit(0);
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $this->config['host'];  // Specify main and backup SMTP servers
            $mail->SMTPAuth = $this->config['smtpauth'];                               // Enable SMTP authentication
            $mail->Username = $this->config['username'];                 // SMTP username
            $mail->Password = $this->config['password'];                           // SMTP password
            $mail->SMTPSecure = $this->config['smtpsecure'];                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $this->config['port'];                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($email->fromEmail, $email->fromName);
            $mail->addAddress($email->toEmail, $email->toName);     // Add a recipient
            //$mail->addReplyTo('aldo@vega10.com', 'Aldo');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $email->subject;
            $mail->Body    = $email->htmlMessage;
            $mail->AltBody = $email->plainTextMessage;


            return $mail->send();
        } catch (Exception $e) {
            throw new ServiceException('Mailer Error: ' . $mail->ErrorInfo);
        }
    }
}
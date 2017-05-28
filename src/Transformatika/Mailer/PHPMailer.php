<?php
namespace Transformatika\Mailer;

use Transformatika\Message\Message;
use Transformatika\Message\MessageConstant;
use Transformatika\Mailer\MailInterface;

class PHPMailer implements MailInterface
{
    protected $body;

    protected $recipient;

    protected $subject;

    protected $message;

    public function __construct()
    {
    }

    public function send()
    {
        $headers = 'From: no-reply@transformatika.ga' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
        if (is_array($this->recipient)) {
            $recipients = implode(',', $this->recipient);
        } else {
            $recipients = $this->recipients;
        }

        $sendMail = mail(
            $recipients,
            $this->getSubject(),
            wordwrap($this->getBody(), 70, "\r\n"),
            $headers
        );
        if (!$sendMail) {
            return [
                'error' => 'ERR_SEND_MAIL',
                'msg' => $msg->getMessage(
                    MessageConstant::ERR_SEND_MAIL
                ),
                'records' => []
            ];
        }

        return [
            'error' => null,
            'msg' => 'Mail successfully sent',
            'records' => $this->getRecipient()
        ];
    }

    /**
     * Get the value of Body
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the value of Body
     * @param mixed body
     * @return self
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the value of Recipient
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set the value of Recipient
     * @param mixed recipient
     * @return self
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get the value of Subject
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of Subject
     * @param mixed subject
     * @return self
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get the value of Message
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of Message
     * @param mixed message
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}

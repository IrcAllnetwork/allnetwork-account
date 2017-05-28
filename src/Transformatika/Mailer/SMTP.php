<?php

namespace Transformatika\Mailer;

use Transformatika\Config\Config;
use Transformatika\Message\Message;
use Transformatika\Message\MessageConstant;
use Transformatika\Mailer\MailInterface;

class SMTP implements MailInterface
{
    protected $config = array(
        'host' => 'smtp.gmail.com',
        'port' => 465,
        'encryption' => 'tls',
        'user' => '',
        'password' => '',
        'name' => 'Transformatika Mailer',
    );

    protected $mailer;

    protected $body;

    protected $recipient;

    protected $subject;

    protected $message;

    public function __construct()
    {
        $mailConfiguration = Config::getConfig('mail');
        $this->config = array_merge($this->config, $mailConfiguration);

        $transport = \Swift_SmtpTransport::newInstance(
            $this->config['host'],
            $this->config['port'],
            $this->config['encryption']
        );

        $transport->setUsername($this->config['user']);
        $transport->setPassword($this->config['password']);
        $this->mailer = \Swift_Mailer::newInstance($transport);

        $this->message = \Swift_Message::newInstance();

        return $this;
    }

    public function send()
    {
        $this->message->setSubject($this->getSubject());
        $this->message->setFrom(array(
            $this->config['user'] => $this->config['name']
        ));
        $this->message->setTo($this->getRecipient());
        $this->message->setBody($this->getBody());

        $msg = new Message();
        if (!$this->mailer->send($this->message)) {
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
     * Get the value of Body.
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the value of Body.
     * @param mixed body
     * @return self
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the value of Recipient.
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set the value of Recipient.
     * @param mixed recipient
     * @return self
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get the value of Subject.
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of Subject.
     * @param mixed subject
     * @return self
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }
}

<?php
namespace Transformatika\Mailer;

interface MailInterface
{

    public function send();

    /**
     * Get the value of Body.
     * @return mixed
     */
    public function getBody();

    /**
     * Set the value of Body.
     * @param mixed body
     * @return self
     */
    public function setBody($body);

    /**
     * Get the value of Recipient.
     * @return mixed
     */
    public function getRecipient();

    /**
     * Set the value of Recipient.
     * @param mixed recipient
     * @return self
     */
    public function setRecipient($recipients);

    /**
     * Get the value of Subject.
     * @return mixed
     */
    public function getSubject();

    /**
     * Set the value of Subject.
     * @param mixed subject
     * @return self
     */
    public function setSubject($subject);
}

<?php
namespace Transformatika\Message;

class Message implements MessageInterface
{
    public function getMessage($msg, $replacement = array())
    {
        foreach ($replacement as $key => $value) {
            $msg = str_replace("{" . $key . "}", $value, $msg);
        }
        return $msg;
    }
}

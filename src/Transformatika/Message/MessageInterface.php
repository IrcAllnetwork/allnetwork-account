<?php
namespace Transformatika\Message;

interface MessageInterface
{
    public function getMessage($msg, $replacement);
}

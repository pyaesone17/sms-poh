<?php

namespace pyaesone17\SmsPoh\Exceptions;

use Exception;

class AuthorizationException extends Exception
{
    public function __construct($message, $code)
    {
        $this->message = $message;
    }
}
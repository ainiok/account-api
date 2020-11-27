<?php

namespace App\Exceptions;

use Exception;

class LoginException extends Exception
{
    /**
     * @var string
     */
    protected $message;

    /**
     * @var array
     */
    protected $data;

    public function __construct($message = '', $data = [])
    {
        parent::__construct($message);
        $this->message = $message;
        $this->data    = $data;
    }

    public function message()
    {
        return $this->message;
    }

    public function data()
    {
        return $this->data;
    }
}

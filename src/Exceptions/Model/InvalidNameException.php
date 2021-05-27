<?php

namespace App\Exceptions\Model;

class InvalidNameException extends \Exception
{
    protected $message = 'The given name is invalid.';
}
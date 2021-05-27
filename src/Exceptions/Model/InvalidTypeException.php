<?php

namespace App\Exceptions\Model;

class InvalidTypeException extends \Exception
{
    protected $message = 'The given type is invalid.';
}

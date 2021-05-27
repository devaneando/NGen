<?php

namespace App\Exceptions\Model;

class InvalidGenderException extends \Exception
{
    protected $message = 'The given gender is invalid.';
}
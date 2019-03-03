<?php
namespace MiniFram;

class NotNullValidator extends Validator
{
    public function isValid($value)
    {
        return $value != '';
    }
}

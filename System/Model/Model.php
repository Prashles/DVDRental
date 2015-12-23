<?php

namespace System\Model;

interface Model
{
    /**
     * Every model should be responsible for validating
     * data that is to be stored
     *
     * @param array $data
     * @param array $rules
     * @return mixed
     */
    public static function validate(array $data);
}
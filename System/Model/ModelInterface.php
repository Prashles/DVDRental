<?php

namespace System\Model;

interface ModelInterface
{
    /**
     * Every model should be responsible for data
     * validating to be stored
     *
     * @param array $data
     * @return mixed
     */
    public function validate(array $data);
}
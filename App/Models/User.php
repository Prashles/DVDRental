<?php

namespace App\Models;

use System\Model\BaseModel;
use System\Model\ModelInterface;

class User extends BaseModel implements ModelInterface
{
    protected $table = 'users';

    public function validate(array $data)
    {

    }
}
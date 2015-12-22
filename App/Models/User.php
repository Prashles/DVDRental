<?php

namespace App\Models;

use System\Model\BaseModel;
use System\Model\ModelInterface;

class User extends BaseModel implements ModelInterface
{
    /**
     * @var string Table in DB
     */
    protected $table = 'users';

    /**
     * @var array Validation rules
     */
    protected static $rules = [
        'username' => 'required',
        'email' => 'email'
    ];
}
<?php

namespace App\Models;

use System\Model\BaseModel;
use System\Model\Model;

class Transaction extends BaseModel implements Model
{
    /**
     * @var string
     */
    protected $table = 'transactions';
}
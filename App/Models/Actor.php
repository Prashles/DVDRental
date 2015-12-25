<?php

namespace App\Models;

use System\Message\Message;
use System\Model\BaseModel;
use System\Model\Model;

class Actor extends BaseModel implements Model
{
    protected $table = 'actors';

    public static $rules = [
        'required' => 'name'
    ];

    public static function validate(array $data)
    {
        $validate = parent::validate($data);

        if ($validate !== true) {
            return $validate;
        }

        if (!(new Actor)->isUnique('name', $data['name'])) {
            return new Message(['That actor already exists']);
        }

        return true;
    }
}
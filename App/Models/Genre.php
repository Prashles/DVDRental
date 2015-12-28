<?php

namespace App\Models;

use System\Message\Message;
use System\Model\BaseModel;
use System\Model\Model;

class Genre extends BaseModel implements Model
{
    /**
     * @var string
     */
    protected $table = 'genres';

    /**
     * @var array
     */
    public static $rules = [
        'required' => 'name'
    ];

    /**
     * @param array $data
     * @return Message|bool
     */
    public static function validate(array $data)
    {
        $validate = parent::validate($data);

        if ($validate !== true) {
            return $validate;
        }

        if (!(new Genre)->isUnique('name', $data['name'])) {
            return new Message(['That genre already exists']);
        }

        return true;
    }
}
<?php

namespace App\Models;

use System\Model\BaseModel;
use System\Model\Model;

class Dvd extends BaseModel implements Model
{
    protected $table = 'dvds';

    public static $rules = [
        'required' => [['title'], ['genre'], ['director'], ['year'], ['synopsis'], ['cast'], ['price']],
        'integer' => [['genre'], ['year']],
        'min' => [['year', 1888]],
        'max' => [['year', 2020]],
        'in' => [['price', ['A', 'B', 'C']]]
    ];

    public static function validate(array $data)
    {
        return parent::validate($data); // TODO: Change the autogenerated stub
    }
}
<?php

namespace App\Models;

use System\Message\Message;
use System\Model\BaseModel;
use System\Model\Model;

class Dvd extends BaseModel implements Model
{
    protected $table = 'dvds';

    public static $rules = [
        'required' => [['title'], ['genre'], ['director'], ['year'], ['synopsis'], ['cast'], ['price']],
        'integer' => [['genre'], ['year']],
        'min' => [['year', 1888]],
        'max' => [['year', 2016]],
        'in' => [['price', ['A', 'B', 'C']]]
    ];

    public static function validate(array $data)
    {
        if (($validate = parent::validate($data)) !== true) {
            return $validate;
        }

        // Check the genre exists
        if ((new Genre)->existsById($data['genre']) === false) {
            return new Message(['Invalid genre']);
        }

        return true;
    }

    public function allWithGenre()
    {
        return self::fetchAll($this->query(
            'SELECT dvds.*, genres.name as genre FROM dvds, genres WHERE dvds.genre_id = genres.id',
            []));
    }
}
<?php

namespace App\Models;

use Symfony\Component\HttpFoundation\File\UploadedFile;
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

    /**
     * @return bool|Message
     */
    public static function validateImage()
    {
        $image = $_FILES['image'];

        if (!file_exists($image['tmp_name'])) {
            return new Message(['No image specified']);
        }

        // limit file size, calculation pre-done for 512kb to save computation
        if ($image['size'] > 524288) {
            return new Message(['Image must be no greater than 512kb']);
        }

        // check if actually an image
        if (($size = getimagesize($image['tmp_name'])) === 0) {
            return new Message(['You must upload and valid image file']);
        }

        // only allow jpegs and pngs
        $acceptedTypes = ['image/jpeg', 'image/png'];

        if (!in_array($size['mime'], $acceptedTypes)) {
            return new Message(['Only jpeg and png images are accepted']);
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
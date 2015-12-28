<?php

namespace App\Models;

use System\Message\Message;
use System\Model\BaseModel;
use System\Model\Model;

class Dvd extends BaseModel implements Model
{
    /**
     * @var string
     */
    protected $table = 'dvds';

    /**
     * @var array
     */
    public static $rules = [
        'required' => [['title'], ['genre'], ['director'], ['year'], ['synopsis'], ['cast'], ['price']],
        'integer' => [['genre'], ['year']],
        'min' => [['year', 1888]],
        'max' => [['year', 2016]],
        'in' => [['price', ['A', 'B', 'C']]]
    ];

    /**
     * @param array $data
     * @return Message|bool
     */
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

    /**
     * @param $id int
     * @return array
     */
    public function getById($id)
    {
        return self::fetch($this->query(
            'SELECT dvds.*, genres.name as genre FROM dvds, genres WHERE dvds.genre_id = genres.id AND dvds.id = ?',
            [$id]));
    }

    /**
     * @return array
     */
    public function allWithGenre()
    {
        return self::fetchAll($this->query(
            'SELECT dvds.*, genres.name as genre FROM dvds, genres WHERE dvds.genre_id = genres.id',
            []));
    }

    /**
     * @param array $input
     * @return array
     */
    public function search(array $input)
    {
        // Ensure form was submitted, all values present
        if (!isset($input['title'], $input['director'], $input['genre'])) {
            return [];
        }

        // If all filters empty, return all DVDs
        if (empty($input['title']) && empty($input['director']) && $input['genre'] == 'any') {
            return $this->allWithGenre();
        }

        $queryValues = [
            'title' => "%{$input['title']}%",
            'director' => "%{$input['director']}%"
        ];

        $genre = '';

        if ($input['genre'] !== 'any') {
            $genre = "AND genres.id = :genre";
            $queryValues['genre'] = $input['genre'];
        }

        $query = $this->query("SELECT dvds.*, genres.name as genre FROM dvds, genres WHERE dvds.genre_id = genres.id AND title LIKE :title {$genre} AND director LIKE :director", $queryValues);


        return $this->fetchAll($query);
    }

    /**
     * @param $dvdId
     * @param $userId
     * @return void
     */
    public function rent($dvdId, $userId)
    {
        // Create rental
        (new Rental)->create([
            'user_id' => $userId,
            'dvd_id' => $dvdId
        ]);

        // Mark dvd as rented
        $this->markRented($dvdId);
    }

    /**
     * @param $id
     * @return void
     */
    public function markRented($id)
    {
        $this->query(
            'UPDATE ' . $this->getTable() . ' SET rented = 1 WHERE id = ? LIMIT 1', [$id]
        );
    }
}
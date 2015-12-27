<?php

namespace App\Models;

use System\Auth\Authenticatable;
use System\Message\Message;
use System\Model\BaseModel;
use System\Model\Model;

class User extends BaseModel implements Authenticatable, Model
{
    /**
     * @var string Table in DB
     */
    protected $table = 'users';

    /**
     * @var string Which column is the username
     */
    protected $username = 'email';

    /**
     * @var array Validation rules
     */
    public static $rules = [
        'required' => [['email'], ['password'], ['phone'], ['address']],
        'email' => 'email',
        'lengthMin' => [['password', 5]],
        'numeric' => 'phone',
        'equals' => [['password', 'password_confirmation']]
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

        // Check if email exists
        if (auth()->checkUsername($data['email']) === false) {
            return new Message(['That email address is already in use']);
        }

        return true;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

}
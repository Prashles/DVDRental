<?php

namespace System\Auth;

class Auth
{
    /**
     * @var Authenticatable, Model
     */
    protected $model;

    public function __construct(Authenticatable $model)
    {
        $this->model = $model;
    }

    /**
     * Manually log current user in with ID
     *
     * @param $userID
     * @return void
     */
    public static function login($userID)
    {

    }

    /**
     * Validate credentials
     *
     * @param $username
     * @param $password
     * @return bool
     */
    public static function check($username, $password)
    {

    }

    /**
     * Is the user authenticated?
     *
     * @return bool
     */
    public static function is()
    {

    }
}
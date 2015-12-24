<?php

namespace System\Auth;

use System\Model\Model;

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
    public function login($userID)
    {
        session()->set('_auth_user_id', $userID);
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
    public function is()
    {
        return session()->has('_auth_user_id');
    }

    /**
     * Check if username exists
     *
     * @param $username
     * @return bool
     */
    public function checkUsername($username)
    {
        return $this->model->query('SELECT id FROM ' . $this->model->getTable() .
            ' WHERE ' . $this->model->getUsername() . ' = ?', [$username])
            ->rowCount() === 0;
    }

    /**
     * Return the authenticated user
     *
     * @return Object|null
     */
    public function user()
    {
        if (!$this->is()) {
            return null;
        }

        return $this->model->getById(session()->get('_auth_user_id'));
    }

    /**
     * @return void
     */
    public function logout()
    {
        session()->remove('_auth_user_id');
    }
}
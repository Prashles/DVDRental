<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\User;
use System\View\View;

class LoginController extends BaseController
{
    public function getLogin()
    {
        return $this->response->view(
            View::create('login.login', ['title' => 'Login'])
        );
    }

    public function postLogin()
    {

    }

    public function getRegister()
    {
        return $this->response->view(
            View::create('login.register', ['title' => 'Register'])
        );
    }

    public function postRegister()
    {
        // Validate the data
        if (($validator = User::validate($this->request->request->all())) !== true) {
            d($validator);
        }
        else {
            echo 'nice one';
        }
    }

}
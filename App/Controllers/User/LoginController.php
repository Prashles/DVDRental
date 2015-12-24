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
        $input = $this->request->request->all();

        // Validate the data
        if (($validator = User::validate($input)) !== true) {
            session()->addErrors($validator);
            session()->flashInput($input);
            redirect(l('register'));
        }

        // Create the user
        $user = new User;
        $user->create([
            'email' => $input['email'],
            'password' => password_hash($input['password'], PASSWORD_DEFAULT),
            'phone' => $input['phone']
        ]);
    }

}
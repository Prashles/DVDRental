<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\User;
use System\Message\Message;
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
        $input = $this->request->request->all();

        // Check login
        if (!($id = auth()->check($input['email'], $input['password']))) {
            session()->flashInput($input);
            session()->addErrors(new Message(['Invalid username/password combination']));
            return redirect(l('login'));
        }

        // Login successful
        auth()->login($id);
        return redirect(l('browse'));
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
            return redirect(l('register'));
        }

        // Create the user
        $user = new User;
        $id = $user->create([
            'email' => $input['email'],
            'password' => password_hash($input['password'], PASSWORD_DEFAULT),
            'phone' => $input['phone']
        ]);

        if (!is_int($id)) {
            session()->addErrors(new Message(['Something went wrong, please try again']));
            session()->flashInput($input);
            return redirect(l('register'));
        }

        // Log the user in
        auth()->login($id);

        // Flash success message, take the user to the browse page
        session()->addSuccess('You have successfully been registered!');
        return redirect(l('browse'));
    }

    public function getLogout()
    {
        auth()->logout();

        session()->addSuccess('You have been logged out');
        return redirect(l('/'));
    }

}
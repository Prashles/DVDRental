<?php

namespace App\Controllers;

use App\Models\User;
use System\View\View;

class TestController extends BaseController
{
    public function test()
    {
        return $this->response->view(
            View::create('test.test', ['users' => (new User)->all()])
        );
    }
}
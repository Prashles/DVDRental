<?php

namespace App\Controllers;

class TestController extends BaseController
{
    public function test()
    {
        d(session()->get('_auth_user_id'));
    }
}
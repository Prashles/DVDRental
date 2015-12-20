<?php

namespace App\Controllers;

use DVD\View\View;

class TestController extends BaseController
{
    public function test()
    {
        return View::create('test.test', ['test' => 'Prash is a beast']);
    }
}
<?php

namespace App\Controllers;

use System\Response\Response;
use System\View\View;

class TestController extends BaseController
{
    public function test()
    {
        return $this->response->view(
            View::create('test.test', ['test' => 'aslsdkf'])
        );
    }
}
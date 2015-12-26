<?php

namespace App\Controllers;

use System\Basket\Basket;
use System\View\View;

class TestController extends BaseController
{
    public function test()
    {
        $b = new Basket();
        $b->add(1, 2.5);
        $b->add(4, 1);
        $b->sum();
    }
}
<?php

namespace App\Controllers;

/*
 * The class that all controllers should extends
 */

use Symfony\Component\HttpFoundation\Request;

abstract class BaseController
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
    }
}
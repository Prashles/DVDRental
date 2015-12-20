<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;

/*
 * The class that all controllers should extends
 */

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
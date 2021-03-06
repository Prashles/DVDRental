<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use System\Response\Response;

/*
 * The class that all controllers should extends
 */

abstract class BaseController
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * @var \System\Response\Response
     */
    protected $response;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->response = new Response;
    }
}
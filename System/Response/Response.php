<?php

namespace System\Response;

use System\View\View;

class Response extends \Symfony\Component\HttpFoundation\Response
{
    /**
     * Return a view
     *
     * @param View $view
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function view(View $view)
    {
        $response = new Response;
        $response->create($view->render(), 200);

        return $response->send();
    }
}
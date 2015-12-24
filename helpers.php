<?php

/*
 * A series of helper functions
 */
use App\Models\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use System\Auth\Auth;
use System\Session\SessionSingleton;

/**
 * Return an escaped string for output
 *
 * @param $string
 * @return string
 */
function e($string)
{
    return htmlspecialchars($string);
}

/**
 * Helper to include sub-view in view
 *
 * @param $view
 * @return string
 * @throws Exception
 */
function view($view)
{
    $path = \System\View\View::path($view);

    if (!file_exists($path)) {
        throw new Exception('View: ' . $view . ' does not exist');
    }

    return $path;
}

/**
 * Return path to an asset
 *
 * @param $asset
 * @return string
 */
function asset($asset)
{
    return 'assets/' . $asset;
}

/**
 * Die and dump data
 *
 * @param $data mixed
 * @return void
 */
function d($data)
{
    echo '<pre>', var_dump($data), '</pre>';
    exit;
}

/**
 * Helper to generate a link to an internal URI
 *
 * @param $to
 * @return string
 */
function l($to)
{
    return $to;
}

/**
 * Return the Auth class with the User model
 *
 * @return Auth
 */
function auth()
{
    return new Auth(new User);
}

/**
 * @return \System\Session
 */
function session()
{
    return SessionSingleton::getInstance();
}

/**
 * @param $to string
 * @return RedirectResponse
 */
function redirect($to)
{
    return (new RedirectResponse($to))->send();
}
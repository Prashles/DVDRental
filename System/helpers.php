<?php

/*
 * A series of helper functions
 */
use App\Controllers\ErrorsController;
use App\Models\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use System\Auth\Auth;
use System\Basket\BasketSingleton;
use System\Session\SessionSingleton;
use System\View\View;

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
 * Helper function to throw a 404
 *
 * @return \Symfony\Component\HttpFoundation\Response
 */
function notfound()
{
    return (new ErrorsController)->show404();
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
    $path = View::path($view);

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
    return getenv('SITE_URL') . 'assets/' . $asset;
}

/**
 * Return path to an upload
 *
 * @param $name
 * @return string
 */
function upload($name)
{
    return getenv('SITE_URL') . 'uploads/' . $name;
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
    if ($to == '/') {
        return getenv('SITE_URL');
    }

    return getenv('SITE_URL') . $to;
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
 * @return \System\Session\Session
 */
function session()
{
    return SessionSingleton::getInstance();
}

/**
 * @return \System\Basket\Basket
 */
function basket()
{
    return BasketSingleton::getInstance();
}

/**
 * @param $to string
 * @return RedirectResponse
 */
function redirect($to)
{
    return (new RedirectResponse($to))->send();
}

/**
 * Helper function for old input data.
 *
 * @param $key string
 * @param $output bool
 * @return void|string
 */
function oldInput($key, $output = true)
{
    $value = session()->oldInput($key);

    if (is_string($value)) {
        if ($output === false) {
            return e($value);
        }

        echo 'value="' . e($value) . '"';
    }
}

/**
 * @param $band
 * @param bool $formatted
 * @return string
 * @throws Exception
 */
function band2price($band, $formatted = false)
{
    $band = strtoupper($band);

    $prices = [
        'A' => 3.5,
        'B' => 2.5,
        'C' => 1
    ];

    if (!in_array($band, array_keys($prices))) {
        throw new Exception('Invalid price band: ' . $band);
    }

    $price = $prices[$band];

    return ($formatted) ? money_format('%i', $price) : $price;
}
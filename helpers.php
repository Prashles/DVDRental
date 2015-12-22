<?php

/*
 * A series of helper functions
 */

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
 * Return path to view from dot notation name
 *
 * @param $name
 * @return string
 * @throws Exception
 */
function view($name)
{
    $path = str_replace('.', '/', $name);
    $view = APP_PATH . 'Views/' . $path . '.view.php';

    if (!file_exists($view)) {
        throw new \Exception('View: ' . $name . ' does not exist');
    }

    return $view;
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
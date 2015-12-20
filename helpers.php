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
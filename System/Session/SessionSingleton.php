<?php

namespace System\Session;

/**
 * Aim is to turn this into a singleton
 * Kinda "hacky", but a decent way of working for
 * simple MVC
 */

class SessionSingleton
{
    /**
     * @var null|Session
     */
    protected static $instance = null;

    /**
     * @return Session
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new Session;
        }

        return static::$instance;
    }

    protected function __construct()
    {

    }

    protected function __clone()
    {

    }
}
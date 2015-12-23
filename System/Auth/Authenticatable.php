<?php

namespace System\Auth;

/**
 * If a model is to be authenticated against,
 * it should implement this class
 */
interface Authenticatable
{
    /**
     * Column that holds the username
     *
     * @return string
     */
    public function getUsername();
}
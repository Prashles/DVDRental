<?php

namespace System\Session;

use System\Message\Message;

class Session extends \Symfony\Component\HttpFoundation\Session\Session
{
    /**
     * @param Message $errors
     */
    public function addErrors(Message $errors)
    {
        if ($this->hasErrors()) {
            $errors = new Message(array_merge($errors->all(), $this->getFlashBag()->get('_errors')));
        }

        $this->getFlashBag()->add('_errors', $errors);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->getFlashBag()->get('_errors')[0];
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return $this->getFlashBag()->has('_errors');
    }
}
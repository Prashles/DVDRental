<?php

namespace System\Session;

use System\Message\Message;

class Session extends \Symfony\Component\HttpFoundation\Session\Session
{
    /**
     * @param Message $errors
     * @return void
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

    /**
     * @param array $input
     * @return null
     */
    public function flashInput(array $input)
    {
        // Always remove password and confirmation from old input data
        unset($input['password'], $input['password_confirmation']);

        foreach ($input as $key => $value) {
            $this->getFlashBag()->add('_input_' . $key, $input);
        }
    }

    /**
     * @param $key
     * @return array|string
     */
    public function oldInput($key)
    {
        $input = $this->getFlashBag()->get('_input_' . $key);

        return empty($input) ? '' : $input[0][$key];
    }
}
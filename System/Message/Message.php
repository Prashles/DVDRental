<?php

namespace System\Message;

class Message
{
    /**
     * @var array
     */
    protected $messages;

    /*
     * @param array $errors
     */
    public function __construct(array $messages)
    {
        // Flatten messages and add to array
        $this->messages = (is_array(current($messages))) ? call_user_func_array('array_merge', $messages)
            : $messages;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->messages;
    }

    /**
     * @return string
     */
    public function first()
    {
        return current($this->messages);
    }
}
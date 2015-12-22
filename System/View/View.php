<?php

namespace System\View;

class View
{
    /**
     * @var string Name of the view
     */
    protected $name;

    /**
     * @var array Data to pass to the view
     */
    protected $data;

    /**
     * Create new view
     *
     * @param $name
     * @param array $data
     */
    public function __construct($name, array $data)
    {
        $this->name = str_replace('.', '/', $name);
        $this->data = $data;
    }

    /**
     * Create instance of own class
     *
     * @param $name
     * @param array $data
     * @return View
     */
    public static function create($name, array $data)
    {
        return new View($name, $data);
    }

    /**
     * Render view
     *
     * @throws \Exception
     * @return string
     */
    public function render()
    {
        $view = APP_PATH . 'Views/' . $this->name . '.view.php';

        if (!file_exists($view)) {
            throw new \Exception('View: ' . $this->name . ' does not exist');
        }

        extract($this->data, EXTR_OVERWRITE);

        ob_start();

        require $view;
        $contents = ob_get_contents();

        ob_flush();

        return $contents;
    }
}
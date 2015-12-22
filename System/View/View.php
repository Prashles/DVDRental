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
    public static function create($name, array $data = [])
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
        $view = self::path($this->name);

        if (!file_exists($view)) {
            throw new \Exception('View: ' . $this->name . ' does not exist');
        }

        extract($this->data, EXTR_OVERWRITE);

        ob_start();

        include $view;
        $contents = ob_get_contents();

        ob_flush();

        return $contents;
    }

    /**
     * Path to view from name
     *
     * @param $view
     * @return string
     */
    public static function path($view)
    {
        return APP_PATH . 'Views/' . str_replace('.', '/', $view) . '.view.php';
    }

}
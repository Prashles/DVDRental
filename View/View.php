<?php

namespace DVD\View;

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
     * @return void
     */
    public static function create($name, array $data)
    {
        $view = new View($name, $data);

        $view->render();
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

        require $view;
    }
}
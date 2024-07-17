<?php
class ApplicationController extends Controller
{
    public $view;

    public function __construct()
    {
        $this->view = new stdClass();
    }

    protected function render($viewName)
    {
        $viewFile = __DIR__ . '/../views/' . $viewName . '.phtml';

        if (file_exists($viewFile)) {
            include($viewFile);
        } else {
            throw new Exception("View file not found: $viewFile");
        }
    }

    protected function redirect($route)
    {
        header("Location: /" . WEB_ROOT . "/$route");
        exit();
    }
}

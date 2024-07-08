<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class ApplicationController extends Controller {
	protected $view;

    public function __construct(){
        $this->view = new stdClass();
    }

    protected function render($viewName){
        $viewFile = __DIR__ . '/../views/' . $viewName . '.phtml';
    
        if (file_exists($viewFile)) {
            include($viewFile);
        }
        else{
            throw new Exception("View file not found: $viewFile");        }
    }

    protected function redirect($route){
        header("Location: /$route");
        exit();
    }

    
}

<?php

class TaskController extends ApplicationController
{
	public function indexAction()
	{
		$this->view->message = "hello from task::index";
	}
	
	public function checkAction()
	{
		echo "hello from task::check";
	}

	public function createAction()
	{
		$this->view->message = "hello from task::create";
	}
	
}
?>
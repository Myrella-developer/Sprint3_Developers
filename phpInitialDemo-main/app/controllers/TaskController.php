<?php
require_once ROOT_PATH . '/app/models/ModelTask.class.php';
class TaskController extends ApplicationController
{
    public $taskModel;

    public function __construct()
    {
        parent::__construct();
        $this->taskModel = new ModelTask();
    }

    public function indexAction()
    {
		$tasks = $this->taskModel->get_all_data();
		$this->view->tasks = $tasks;
     
    }

    public function createAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'startDate' => $_POST['startDate'],
                'endDate' => $_POST['endDate'],
                'rank' => $_POST['rank']
            ];
            $this->taskModel->create($data);
            header("Location: /task");
        } 
    }
    public function editAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) 
            {$taskToUpdate = $this->taskModel->get_data($_POST['id']);  
            
            
                $_POST['name'] = $taskToUpdate['name'];
                $_POST['description'] = $taskToUpdate['description'];
                $_POST['startDate'] =  $taskToUpdate['startDate'];
                $_POST['endDate'] =  $taskToUpdate['endDate'];
                $_POST['rank'] =  $taskToUpdate['rank'];
        


                // $this->view->task = $taskToUpdate;
                // $this->render('scripts/task/edit');   
              
           
            $this->view->tasks;
            $this->redirect('task/edit');
         }// else {
        //     $task = $this->taskModel->get_data($id);
        //     $this->view->task = $task;
        //     $this->render('scripts/task/edit');
        // }

       
        
    }

    public function deleteAction($id)
    {
        $this->taskModel->delete_data($id);
        $this->redirect('task/index');
    }
}
?>


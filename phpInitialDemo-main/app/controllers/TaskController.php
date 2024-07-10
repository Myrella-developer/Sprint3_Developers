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
        $this->render('scripts/task/index', ['tasks' => $tasks]);
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
            $this->redirect('/task');
        } else {
            $this->render('scripts/task/create');
        }
    }

    public function editAction($id)
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'startDate' => $_POST['startDate'],
                'endDate' => $_POST['endDate'],
                'rank' => $_POST['rank']
            ];
            $this->taskModel->update_json_data($id, $data);
            $this->redirect('task/index');
        } else {
            $task = $this->taskModel->get_data($id);
            $this->view->task = $task;
            $this->render('scripts/task/edit');
        }
    }

    public function deleteAction($id)
    {
        $this->taskModel->delete_data($id);
        $this->redirect('task/index');
    }
}
?>


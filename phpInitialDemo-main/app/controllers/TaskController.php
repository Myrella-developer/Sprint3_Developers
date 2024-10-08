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

            try {
                $this->taskModel->create($data);
                header('Location: ' . WEB_ROOT . '/');
                exit();
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
                echo "<script>alert('$errorMessage');</script>";
            }
            
        }
    }

    public function editAction()
    {
        if ($this->getRequest()->isPost() && isset($_POST['id'])) {
            $taskId = $this->_getParam('id');
            $name = $this->_getParam('name');
            $description = $this->_getParam('description');
            $startDate = $this->_getParam('startDate');
            $endDate = $this->_getParam('endDate');
            $rank = $this->_getParam('rank');

            // Verificar si las fechas son válidas
            if (strtotime($endDate) < strtotime($startDate)) {
            echo "<script>alert('La fecha de fin no puede ser menor que la fecha de inicio.');</script>";
            echo "<script>setTimeout(function() { window.location.href = '" . WEB_ROOT . "/'; }, 3);</script>";
            return;  // Salir de la función sin procesar más
            }


            if (empty($taskId)) {
                echo "Esa tarea no existe";
                return;
            }

            $taskEdit = $this->taskModel->get_data($taskId);

            if (!$taskEdit) {
                echo "Tarea no encontrada.";
                return;
            }
            
            $updatedTask = [
                'id' => $taskId,
                'name' => $name,
                'description' => $description,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'rank' => $rank
            ];


            if ($this->taskModel->update_json_data($taskId, $updatedTask)) {
                echo "Tarea actualizada correctamente.";
                header('Location: ' . WEB_ROOT . '/');
                exit();
            } else {
                echo "Error al actualizar la tarea.";
            }
        } else {
            $id = $this->_getParam('id');
            $taskEdit = $this->taskModel->get_data($id);

            if ($taskEdit) {
                $this->view->taskEdit = $taskEdit;
            } else {
                echo "Tarea no encontrada.";
            }
        }
    }

    public function deleteAction()
    {
        $id = $this->_getParam('id');
        $this->taskModel->delete_data($id);
        header('Location: ' . WEB_ROOT . '/');
    }
}

<?php

    Class ModelTask{

        private $filePath;

        public function __construct() {
            $this->filePath = __DIR__ . '/../db/tasks.json';
            if (!file_exists($this->filePath)) {
                file_put_contents($this->filePath, json_encode([]));
            }
        }
    /**
     * Obtener todos los datos JSON
     */
    function get_all_data()
    {
        $json = (array) json_decode(file_get_contents($this->filePath));
        $tasks = [];
        foreach ($json as $row) {
            $tasks[$row->id] = $row;
        }
        return $tasks;

        
    }
    
 

    /**
     * Obtener datos JSON únicos
     */
    function get_data($id = '')
    {
        if (!empty($id)) {
            $tasks = $this->get_all_data();
            if (isset($tasks[$id])) {
                return $tasks[$id];
            }
        }
        return (object) [];
    }

    /**
     * Insertar datos en un archivo JSON
     */
    function create()
    {
        $name = addslashes($_POST['name']);
        $description = addslashes($_POST['description']);
        $startDate = addslashes($_POST['startDate']);
        $endDate = addslashes($_POST['endDate']);
        $rank  = addslashes($_POST['rank']);

        $tasks = $this->get_all_data();
        $id = array_key_last($tasks) + 1;
        $tasks[$id] = (object) [
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "startDate" => $startDate,
            "endDate" => $endDate,
            "rank" => $rank
        ];
        $json = json_encode(array_values($tasks), JSON_PRETTY_PRINT);
        $insert = file_put_contents($this->filePath, $json);
        if ($insert) {
            $resp['status'] = 'success';
        } else {
            $resp['failed'] = 'failed';
        }
        return $resp;
    }
    /**
     * Actualizar datos del archivo JSON
     */
    function update_json_data()
    {
        $id = $_POST['id'];
        $name = addslashes($_POST['name']);
        $description = addslashes($_POST['description']);
        $startDate = addslashes($_POST['startDate']);
        $endDate = addslashes($_POST['endDate']);
        $rank  = addslashes($_POST['rank']);

        $tasks = $this->get_all_data();
        $tasks[$id] = (object) [
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "startDate" => $startDate,
            "endDate" => $endDate,
            "rank" => $rank
        ];
        $json = json_encode(array_values($tasks), JSON_PRETTY_PRINT);
        $update = file_put_contents($this->filePath, $json);
        if ($update) {
            $resp['status'] = 'success';
        } else {
            $resp['failed'] = 'failed';
        }
        return $resp;
    }

    /**
     * Eliminar datos del archivo JSON
     */

    function delete_data($id = '')
    {
        if (empty($id)) {
            $resp['status'] = 'failed';
            $resp['error'] = 'El ID no existe.';
        } else {
            $tasks = $this->get_all_data();
            if (isset($tasks[$id])) {
                unset($tasks[$id]);
                $json = json_encode(array_values($tasks), JSON_PRETTY_PRINT);
                $update = file_put_contents($this->filePath, $json);
                if ($update) {
                    $resp['status'] = 'success';
                } else {
                    $resp['failed'] = 'failed';
                }
            } else {
                $resp['status'] = 'failed';
                $resp['error'] = 'El ID de tarea no existe en el archivo JSON.';
            }
        }
        return $resp;
    }

  

}
$taskModel = new ModelTask();

// Prueba obtener todos los datos
echo "<h2>All Tasks</h2>";
var_dump($taskModel->get_all_data());

?>
<?php

class ModelTask
{

    private $filePath;

    public function __construct()
    {
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
        $json = json_decode(file_get_contents($this->filePath), true);
        return $json ?: [];
    }

    /**
     * Obtener datos JSON únicos
     */
    function get_data($id)
    {
        $tasks = $this->get_all_data();
        foreach ($tasks as $task) {
            if ($task['id'] == $id) {
                return $task;
            }
        }
        return null;
    }

    /**
     * Insertar datos en un archivo JSON
     */
    function create($data)
    {
        $name = $this->sanitize($data['name']);
        $description = $this->sanitize($data['description']);
        $startDate = $this->sanitize($data['startDate']);
        $endDate = $this->sanitize($data['endDate']);
        $rank  = $this->sanitize($data['rank']);

        $tasks = $this->get_all_data();
        $id = $this->getNewId($tasks);
        $tasks[$id] = [
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "startDate" => $startDate,
            "endDate" => $endDate,
            "rank" => $rank
        ];
        return $this->saveTasks($tasks);
    }

    /**
     * Actualizar datos del archivo JSON
     */
    public function update_json_data($id, $data)
    {
        $name = $this->sanitize($data['name']);
        $description = $this->sanitize($data['description']);
        $startDate = $this->sanitize($data['startDate']);
        $endDate = $this->sanitize($data['endDate']);
        $rank = $this->sanitize($data['rank']);

        $tasks = $this->get_all_data();
        $taskUpdated = false;

        foreach ($tasks as &$task) {
            if ($task['id'] == $id) {
                $task = [
                    "id" => $id,
                    "name" => $name,
                    "description" => $description,
                    "startDate" => $startDate,
                    "endDate" => $endDate,
                    "rank" => $rank
                ];
                $taskUpdated = true;
                break;
            }
        }

        if ($taskUpdated) {
            return $this->saveTasks($tasks);
        }

        return false;
    }

    /**
     * Eliminar datos del archivo JSON
     */
    public function delete_data($id)
    {
        $tasks = $this->get_all_data();
        foreach ($tasks as $key => $task) {
            if ($task['id'] == $id) {
                unset($tasks[$key]);
                break;
            }
        }
        return $this->saveTasks($tasks);
    }

    /**
     * Función para limpiar datos
     */
    private function sanitize($data)
    {
        return htmlspecialchars(strip_tags($data));
    }

    /**
     * Funcion para guardar Task
     */
    private function saveTasks($tasks)
    {
        $json = json_encode(array_values($tasks), JSON_PRETTY_PRINT);
        return file_put_contents($this->filePath, $json) !== false;
    }

    /**
     * Funcion para Obtener un nuevo Id
     */
    private function getNewId($tasks)
    {
        if (empty($tasks)) {
            return 1;
        }
        $ids = array_keys($tasks);
        return max($ids) + 1;
    }
}

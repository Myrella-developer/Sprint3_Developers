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
        $json = json_decode(file_get_contents($this->filePath), true);  
        return $json ?: []; 
    }
    

    /**
     * Obtener datos JSON únicos
     */
    function get_data($id)
    {
        $tasks = $this->get_all_data();
        return $tasks[$id] ?? null;
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
    function update_json_data($id, $data)
    {
        $name = $this->sanitize($data['name']);
        $description = $this->sanitize($data['description']);
        $startDate = $this->sanitize($data['startDate']);
        $endDate = $this->sanitize($data['endDate']);
        $rank  = $this->sanitize($data['rank']);

        $tasks = $this->get_all_data();
        if(isset($tasks[$id])) {
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
        return false;
    }

    /**
     * Eliminar datos del archivo JSON
     */

    function delete_data($id)
    {
       $tasks = $this->get_all_data();
       if(isset($tasks[$id])) {
        unset($tasks[$id]);
        return $this->saveTasks($tasks);
       }
       return false;
    }

    /**
     * Funcion paara Sanitizar datos
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

       private function getNewId($tasks) {
        if(empty($tasks)) {
            return 1;
        }
        $ids = array_keys($tasks);
        return max($ids) + 1;
       }

}


?>
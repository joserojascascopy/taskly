<?php

namespace Models;

use PDO;

class Tareas extends Model {
    protected $table = 'tareas';

    public $id;
    public $titulo;
    public $descripcion;
    public $estado;
    public $user_id;
    
    // Array de alertas, se inicializa vacio para posteriormente hacer la validación
    public static $alertas = [];

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->estado = $args['estado'] ?? 'pendiente';
        $this->user_id = $args['user_id'] ?? '';
    }

    // Método para obtener todas las tareas (hereda de Model)
    public function getAllTasks() {
        return self::getAll($this->table);
    }

    // Metodo para obtener todas las tareas de un usuario

    public function getTaskByUserId($user_id) {
        return self::getByUserId($this->table, $user_id);
    }

    // Método para crear una tarea (hereda de Model)
    public function createTask($tarea) {
        return self::create($this->table, [
            'titulo' => $tarea->titulo,
            'descripcion' => $tarea->descripcion,
            'estado' => $tarea->estado ?? 'pendiente',
            'user_id' => $tarea->user_id
        ]);
    }

    // Método para eliminar una tarea
    public function deleteTask($id) {
        return self::delete($this->table, $id);
    }

    public static function getAlertas() {
        return self::$alertas;
    }

    public function validateTask() {
        if(!$this->titulo) {
            self::$alertas['error'] = 'El titulo es obligatorio';
        }

        return self::$alertas;
    }
}
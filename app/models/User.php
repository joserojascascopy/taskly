<?php

namespace Models;

class User extends Model {
    // Nombre de la tabla para la consulta a la DB
    private $table = 'users';

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $token;
    public $confirmado;

    // Array de alertas, se inicializa vacio para posteriormente hacer la validación

    public static $alertas = [];

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    // Método para obtener todos los usuarios (hereda de Model)
    public function getAllUsers() {
        return self::getAll($this->table);
    }

    // Método para obtener un usuario por ID (hereda de Model)
    public function getUserById($id) {
        return self::getById($this->table, $id);
    }

    // Método para obtener un usuario por Email (hereda de Model)
    public function getUserByEmail($email) {
        return self::getByEmail($this->table, $email);
    }

     // Método para obtener un usuario por Token (hereda de Model)
    public function getUserByToken($token) {
        return self::getByToken($this->table, $token);
    }

    // Método para crear un usuario (hereda de Model)
    public function createUser($user) {
        return self::create($this->table, [
            'nombre' => $user->nombre,
            'apellido' => $user->apellido,
            'email' => $user->email,
            'password' => password_hash($user->password, PASSWORD_DEFAULT),
            'confirmado' => $user->confirmado,
            'token' => $user->token
        ]);
    }

    // Método para actualizar un usuario
    public function updateUser($id, $name, $email, $password) {
        return self::update($this->table, $id, [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    // Método para actualizar el token de un usuario
    public function updateToken($id, $token) {
        return self::update($this->table, $id, [
            'token' => $token
        ]);
    }

    // Método para actualizar el password de un usuario
    public function updatePassword($id, $password) {
        return self::update($this->table, $id, [
            'password' => $password
        ]);
    }

    // Método para actualizar a confirmado un usuario
    public function updateConfirmado($id, $confirmado) {
        return self::update($this->table, $id, [
            'confirmado' => $confirmado
        ]);
    }

    // Método para eliminar un usuario
    public function deleteUser($id) {
        return self::delete($this->table, $id);
    }

    public static function getAlertas() {
        return self::$alertas;
    }

    public function validateUser() {
        $alerta = 'Debes completar todos los campos';

        if(!$this->nombre || !$this->apellido || !$this->email || !$this->password ) {
            self::$alertas['error'] = $alerta;
        }

        return self::$alertas;
    }
    
    public function validarReset() {
        if(!$this->email) {
            self::$alertas['error'] = 'Debes introducir un correo';
        }

        return self::$alertas;
    }

    public function validateLogin() {
        $mensaje = 'Debes completar todos los campos';

        if(!$this->email && !$this->password) {
            self::$alertas['error'] = $mensaje;
        }

        return self::$alertas;
    }

    public function generateToken() {
        $this->token = uniqid();
    }
}
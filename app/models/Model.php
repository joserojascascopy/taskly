<?php

namespace Models;

abstract class Model {
    protected static $db;

    // Método para establecer la conexión
    public static function setConnection($database) {
        static::$db = $database;
    }

    // Método genérico para obtener todos los registros
    public static function getAll($table) {
        $stmt = static::$db->query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }

    // Método genérico para obtener un registro por ID
    public static function getById($table, $id) {
        $stmt = static::$db->prepare("SELECT * FROM $table WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Método genérico para obtener un registro por EMAIL
    public static function getByEmail($table, $email) {
        $stmt = static::$db->prepare("SELECT * FROM $table WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);
        return $stmt->fetch();
    }

    // Método genérico para obtener un registro por su estado
    public static function getByUserId($table, $user_id) {
        $stmt = static::$db->prepare("SELECT * FROM $table WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);
        return $stmt->fetchAll();
    }

    // Método genérico para obtener un registro por su estado
    public static function getByStatus($table, $user_id, $status) {
        $stmt = static::$db->prepare("SELECT * FROM $table WHERE user_id = :user_id AND estado = :status");
        $stmt->execute(['user_id' => $user_id,
                        'status' => $status]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);
        return $stmt->fetchAll();
    }

    // Método genérico para obtener un registro por TOKEN
    public static function getByToken($table, $token) {
        $stmt = static::$db->prepare("SELECT * FROM $table WHERE token = :token");
        $stmt->execute(['token' => $token]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);
        return $stmt->fetch();
    }

    // Método para crear un nuevo registro
    public static function create($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_map(fn($key) => ":$key", array_keys($data)));
        $stmt = static::$db->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
        $success = $stmt->execute($data);

        return [
            'success' => $success,
            'id' => $success ? static::$db->lastInsertId() : null
        ];
    }

    // Método para actualizar un registro por ID
    public static function update($table, $id, $data) {
        $setClause = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $stmt = static::$db->prepare("UPDATE $table SET $setClause WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Método para eliminar un registro por ID
    public static function delete($table, $id) {
        $stmt = static::$db->prepare("DELETE FROM $table WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function actualizarEstado($id) {
        $sql = "UPDATE tareas SET estado = 'completado' WHERE id = :task_id";
        $stmt = static::$db->prepare($sql);
        return $stmt->execute([
            ':task_id' => $id
        ]);
    }
}
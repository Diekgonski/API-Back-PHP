<?php

include_once './Database/Database.php';

class Cliente extends Database {

    function listarCliente() {
        $query = $this->connect()->query('SELECT * FROM Clientes');

        return $query;
    }

    function obtenerCliente($cedula) {
        
    }

    function crearCliente($cliente) {
        
        $query = $this->connect()->prepare("INSERT INTO Clientes (Cedula, Nombre, Apellido, Ciudad, Telefono, Correo) VALUES (:cedula, :nombre, :apellido, :ciudad, :telefono, :correo)");

        $query->execute(['cedula' => $cliente['cedula'],
                         'nombre' => $cliente['nombre'],
                         'apellido' => $cliente['apellido'],
                         'ciudad' => $cliente['ciudad'],
                         'telefono' => $cliente['telefono'],
                         'correo' => $cliente['correo']]);
        
        return $query;
    }

}

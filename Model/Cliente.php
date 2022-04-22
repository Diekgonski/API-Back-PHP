<?php

include_once './Database/Database.php';

class Cliente extends Database {

    function listarCliente() {
        $query = $this->connect()->query('SELECT * FROM Clientes');

        return $query;
    }

    function obtenerCliente($cedula) {
        $query = $this->connect()->prepare('SELECT * FROM Clientes WHERE Cedula = :cedula');
        
        $query->execute(['cedula' => $cedula]);
        
        return $query;
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

    function editarCliente($cliente) {
        $query = $this->connect()->prepare("UPDATE Clientes SET Nombre = :nombre, "
                . "                                             Apellido = :apellido, "
                . "                                             Ciudad = :ciudad, "
                . "                                             Telefono = :telefono, "
                . "                                             Correo = :correo"
                . "                                         WHERE Cedula = :cedula");

        $query->execute(['cedula' => $cliente['cedula'],
            'nombre' => $cliente['nombre'],
            'apellido' => $cliente['apellido'],
            'ciudad' => $cliente['ciudad'],
            'telefono' => $cliente['telefono'],
            'correo' => $cliente['correo']]);
        
        return $query;
    }
    
    function eliminarCliente($cedula){
        $query = $this->connect()->prepare('DELETE FROM Clientes WHERE Cedula = :cedula');
        
        $query->execute(['cedula' => $cedula]);
        
        return $query;
    }

}

<?php

include_once './Model/Cliente.php';

class ApiClientes {

    function getAll() {
        $cliente = new Cliente();
        $clientes = array();
        $respuesta = $cliente->listarCliente();

        if ($respuesta->rowCount() > 0) {
            while ($row = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'Cedula' => $row['Cedula'],
                    'Nombre' => $row['Nombre'],
                    'Apellido' => $row['Apellido'],
                    'Ciudad' => $row['Ciudad'],
                    'Telefono' => $row['Telefono'],
                    'Correo' => $row['Correo'],
                );

                array_push($clientes, $item);
            }
            
            echo json_encode($clientes);
        } else {
            //echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->error('No hay elementos registrados');
        }
    }
    
    function getByCedula($cedula) {
        $cliente = new Cliente();
        $clientes = array();
        $respuesta = $cliente->obtenerCliente($cedula);

        if ($respuesta->rowCount() > 0) {
            while ($row = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'Cedula' => $row['Cedula'],
                    'Nombre' => $row['Nombre'],
                    'Apellido' => $row['Apellido'],
                    'Ciudad' => $row['Ciudad'],
                    'Telefono' => $row['Telefono'],
                    'Correo' => $row['Correo'],
                );

                array_push($clientes, $item);
            }
            
            echo json_encode($clientes);
        } else {
            //echo json_encode(array('mensaje' => 'No hay elementos registrados'));
            $this->error('No hay elementos registrados');
        }
    }

    function add($item) {

        $cliente = new Cliente();

        $resultado = $cliente->crearCliente($item);
        $this->exito('Nuevo Cliente Registrado');
    }
    
    function update($item){
        
        $cliente = new Cliente();
        
        $resultado = $cliente->editarCliente($item);
        $this->exito('El Cliente se modificó correctamente');
        
    }
    
    function delete($item){
        $cliente = new Cliente();
        
        $resultado = $cliente->eliminarCliente($item);
        $this->exito('El Cliente se eliminó correctamente');
    }

    function exito($mensaje) {
        echo json_encode(array('mensaje' => $mensaje, 'status' => 'Ok'));
    }

    function error($mensaje) {
        echo json_encode(array('mensaje' => $mensaje, 'status' => 'Error'));
    }

}

<?php

require_once('../config/db.php');

class Proveedores
{
    private $con;

    // TODO: Establecer conexión a la base de datos en el constructor
    public function __construct()
    {
        $this->con = (new ClaseConectar())->conectar();
    }

    // TODO: Obtener todos los proveedores de la base de datos
    public function todos()
    {
        try {
            $query = "SELECT * FROM proveedores";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->get_result();
        } catch (Exception $th) {
            throw new Exception("Error al obtener proveedores: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Obtener un proveedor por ID de la base de datos
    public function uno($proveedor_id)
    {
        try {
            $query = "SELECT * FROM proveedores WHERE proveedor_id = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("i", $proveedor_id);
            $stmt->execute();
            return $stmt->get_result();
        } catch (Exception $th) {
            throw new Exception("Error al obtener proveedor: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Insertar un nuevo proveedor en la base de datos
    public function insertar($dni, $nombre, $direccion, $telefono, $email, $estado)
    {
        try {
            $query = "INSERT INTO proveedores (dni, nombre, direccion, telefono, email, estado) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("sssss", $dni, $nombre, $direccion, $telefono, $email, $estado);
            $stmt->execute();
            return $this->con->insert_id;
        } catch (Exception $th) {
            throw new Exception("Error al insertar proveedor: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Actualizar un proveedor existente en la base de datos
    public function actualizar($proveedor_id, $dni, $nombre, $direccion, $telefono, $email, $estado)
    {
        try {
            $query = "UPDATE proveedores SET dni = ?, nombre = ?, direccion = ?, telefono = ?, email = ?, estado = ? WHERE proveedor_id = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("sssssi", $dni, $nombre, $direccion, $telefono, $email, $estado, $proveedor_id);
            $stmt->execute();
            return $proveedor_id;
        } catch (Exception $th) {
            throw new Exception("Error al actualizar proveedor: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Eliminar un proveedor de la base de datos
    public function eliminar($proveedor_id)
    {
        try {
            $query = "DELETE FROM proveedores WHERE proveedor_id = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("i", $proveedor_id);
            $stmt->execute();
            return 1;
        } catch (Exception $th) {
            throw new Exception("Error al eliminar proveedor: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }
}
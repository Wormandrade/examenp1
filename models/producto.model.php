<?php

require_once('../config/db.php');

class Productos
{
    private $con;

    // TODO: Establecer conexión a la base de datos en el constructor
    public function __construct()
    {
        $this->con = (new ClaseConectar())->conectar();
    }

    // TODO: Obtener todos los productos de la base de datos
    public function todos()
    {
        try {
            $query = "SELECT * FROM productos";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->get_result();
        } catch (Exception $th) {
            throw new Exception("Error al obtener productos: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Obtener un producto por ID de la base de datos
    public function uno($producto_id)
    {
        try {
            $query = "SELECT * FROM productos WHERE producto_id = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("i", $producto_id);
            $stmt->execute();
            return $stmt->get_result();
        } catch (Exception $th) {
            throw new Exception("Error al obtener producto: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Insertar un nuevo producto en la base de datos
    public function insertar($nombre, $descripcion, $precioProm, $precioUltCompra, $stock, $estado)
    {
        try {
            $query = "INSERT INTO productos (nombre, descripcion, precioProm, precioUltCompra, stock, estado) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("ssi", $nombre, $descripcion, $precioProm, $precioUltCompra, $stock, $estado);
            $stmt->execute();
            return $this->con->insert_id;
        } catch (Exception $th) {
            throw new Exception("Error al insertar producto: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Actualizar un producto existente en la base de datos
    public function actualizar($producto_id, $nombre, $descripcion, $precioProm, $precioUltCompra, $stock, $estado)
    {
        try {
            $query = "UPDATE productos SET nombre= ?, descripcion= ?, precioProm= ?, precioUltCompra= ?, stock= ?, estado = ? WHERE producto_id = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("ssii", $nombre, $descripcion, $precioProm, $precioUltCompra, $stock, $estado, $idProductos);
            $stmt->execute();
            return $producto_id;
        } catch (Exception $th) {
            throw new Exception("Error al actualizar producto: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Eliminar un producto de la base de datos
    public function eliminar($producto_id)
    {
        try {
            $query = "DELETE FROM productos WHERE producto_id = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("i", $producto_id);
            $stmt->execute();
            return 1;
        } catch (Exception $th) {
            throw new Exception("Error al eliminar producto: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }
}
<?php

require_once('../config/db.php');

class ocDetalle
{
    private $con;

    // TODO: Establecer conexión a la base de datos en el constructor
    public function __construct()
    {
        $this->con = (new ClaseConectar())->conectar();
    }

    // TODO: Obtener una OC por ID de la base de datos
    public function todos($orden_id)
    {
        try {
            $query = "SELECT * FROM oc_detalle WHERE orden_id = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("i", $orden_id);
            $stmt->execute();
            return $stmt->get_result();
        } catch (Exception $th) {
            throw new Exception("Error al obtener el detalle de la OC: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Insertar detalle de una nueva OC en la base de datos
    public function insertar($orden_id, $producto_id, $cantidad, $precio, $impuestoLinea, $totalLinea)
    {
        try {
            $query = "INSERT INTO oc_detalle (orden_id, producto_id, cantidad, precio, impuestoLinea, totalLinea) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("ssi", $orden_id, $producto_id, $cantidad, $precio, $impuestoLinea, $totalLinea);
            $stmt->execute();
            return $this->con->insert_id;
        } catch (Exception $th) {
            throw new Exception("Error al insertar el detalle de OC: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Actualizar el detalle de una OC existente en la base de datos
    public function actualizar($numEntry, $orden_id, $producto_id, $cantidad, $precio, $impuestoLinea, $totalLinea)
    {
        try {
            $query = "UPDATE oc_detalle SET orden_id=?, producto_id=?, cantidad=?, precio=?, impuestoLinea=?, itotalLinea=? WHERE numEntry = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("ssii", $orden_id, $producto_id, $cantidad, $precio, $impuestoLinea, $totalLinea, $numEntry);
            $stmt->execute();
            return $oc_id;
        } catch (Exception $th) {
            throw new Exception("Error al actualizar detalle de la OC: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

}
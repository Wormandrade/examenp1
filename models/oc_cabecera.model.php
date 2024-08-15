<?php

require_once('../config/db.php');

class ocCabecera
{
    private $con;

    // TODO: Establecer conexión a la base de datos en el constructor
    public function __construct()
    {
        $this->con = (new ClaseConectar())->conectar();
    }

    // TODO: Obtener todos las ordenes de compra de la base de datos
    public function todos()
    {
        try {
            $query = "SELECT * FROM oc_cabecera";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->get_result();
        } catch (Exception $th) {
            throw new Exception("Error al obtener ordenes de compra: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Obtener una OC por ID de la base de datos
    public function uno($oc_id)
    {
        try {
            $query = "SELECT * FROM oc_cabecera WHERE oc_id = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("i", $oc_id);
            $stmt->execute();
            return $stmt->get_result();
        } catch (Exception $th) {
            throw new Exception("Error al obtener la OC: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Insertar una nueva OC en la base de datos
    public function insertar($proveedor_id, $oc_fecha, $oc_subtotal, $oc_impuesto, $oc_total)
    {
        try {
            $query = "INSERT INTO oc_cabecera (proveedor_id, oc_fecha, oc_subtotal, oc_impuesto, oc_total) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("ssi", $proveedor_id, $oc_fecha, $oc_subtotal, $oc_impuesto, $oc_total);
            $stmt->execute();
            return $this->con->insert_id;
        } catch (Exception $th) {
            throw new Exception("Error al insertar OC: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Actualizar una OC existente en la base de datos
    public function actualizar($oc_id, $proveedor_id, $oc_fecha, $oc_subtotal, $oc_impuesto, $oc_total)
    {
        try {
            $query = "UPDATE oc_cabecera SET proveedor_id=?, oc_fecha=?, oc_subtotal=?, oc_impuesto=?, oc_total=? WHERE oc_id = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("ssii", $proveedor_id, $oc_fecha, $oc_subtotal, $oc_impuesto, $oc_total, $oc_id);
            $stmt->execute();
            return $oc_id;
        } catch (Exception $th) {
            throw new Exception("Error al actualizar OC: " . $th->getMessage());
        } finally {
            $this->con->close();
        }
    }

    // TODO: Eliminar una OC de la base de datos
    public function eliminar($oc_id)
    {
        try {
            $query = "DELETE FROM oc_detalle WHERE orden_id = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("i", $oc_id);
            $stmt->execute();
            return 1;
        } catch (Exception $th) {
            throw new Exception("Error al eliminar detalle de la OC: " . $th->getMessage());
        } finally {
            $this->con->close();
        }

        try {
            $query = "DELETE FROM oc_cabecera WHERE oc_id = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("i", $oc_id);
            $stmt->execute();
            return 1;
        } catch (Exception $th) {
            throw new Exception("Error al eliminar OC: " . $th->getMessage());
        } finally {
            $this->con->close();
        }


    }
}
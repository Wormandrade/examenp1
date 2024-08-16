<?php
require_once('../config/config.php');

class Prestamos
{
    public function todos() //select * from prestamos
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `prestamos`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($prestamo_id) //select * from prestamos where prestamo_id = $prestamo_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `prestamos` WHERE `prestamo_id` = $prestamo_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($libro_id, $miembro_id, $fecha_prestamo, $fecha_devolucion) //insert into prestamos
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `prestamos`(`libro_id`, `miembro_id`, `fecha_prestamo`, `fecha_devolucion`) VALUES ('$libro_id','$miembro_id','$fecha_prestamo','$fecha_devolucion')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function actualizar($prestamo_id, $libro_id, $miembro_id, $fecha_prestamo, $fecha_devolucion) //update prestamos
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `prestamos` SET `libro_id`='$libro_id',`miembro_id`='$miembro_id',`fecha_prestamo`='$fecha_prestamo',`fecha_devolucion`='$fecha_devolucion' WHERE `prestamo_id` = $prestamo_id";
            if (mysqli_query($con, $cadena)) {
                return $prestamo_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($prestamo_id) //delete from prestamos
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `prestamos` WHERE `prestamo_id` = $prestamo_id";
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}

<?php
require_once('../config/config.php');

class Miembros
{
    public function todos() //select * from miembros
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `miembros`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($miembro_id) //select * from miembros where miembro_id = $miembro_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `miembros` WHERE `miembro_id` = $miembro_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($nombre, $apellido, $email, $fecha_suscripcion) //insert into miembros
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `miembros`(`nombre`, `apellido`, `email`, `fecha_suscripcion`) VALUES ('$nombre','$apellido','$email','$fecha_suscripcion')";
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

    public function actualizar($miembro_id, $nombre, $apellido, $email, $fecha_suscripcion) //update miembros
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `miembros` SET `nombre`='$nombre',`apellido`='$apellido',`email`='$email',`fecha_suscripcion`='$fecha_suscripcion' WHERE `miembro_id` = $miembro_id";
            if (mysqli_query($con, $cadena)) {
                return $miembro_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($miembro_id) //delete from miembros
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `miembros` WHERE `miembro_id` = $miembro_id";
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

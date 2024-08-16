<?php
require_once('../config/config.php');

class Libros
{
    public function todos() //select * from libros
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `libros`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($libro_id) //select * from libros where libro_id = $libro_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `libros` WHERE `libro_id` = $libro_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($titulo, $autor, $genero, $anio_publicacion) //insert into libros
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `libros`(`titulo`, `autor`, `genero`, `anio_publicacion`) VALUES ('$titulo','$autor','$genero','$anio_publicacion')";
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

    public function actualizar($libro_id, $titulo, $autor, $genero, $anio_publicacion) //update libros
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `libros` SET `titulo`='$titulo',`autor`='$autor',`genero`='$genero',`anio_publicacion`='$anio_publicacion' WHERE `libro_id` = $libro_id";
            if (mysqli_query($con, $cadena)) {
                return $libro_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($libro_id) //delete from libros
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `libros` WHERE `libro_id` = $libro_id";
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

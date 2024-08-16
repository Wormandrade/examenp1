<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

require_once('../models/prestamos.model.php');
error_reporting(0);
$prestamos = new Prestamos;

switch ($_GET["op"]) {
    case 'todos':
        $datos = array();
        $datos = $prestamos->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $prestamo_id = $_POST["prestamo_id"];
        $datos = array();
        $datos = $prestamos->uno($prestamo_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        $libro_id = $_POST["libro_id"];
        $miembro_id = $_POST["miembro_id"];
        $fecha_prestamo = $_POST["fecha_prestamo"];
        $fecha_devolucion = $_POST["fecha_devolucion"];
        
        $datos = array();
        $datos = $prestamos->insertar($libro_id, $miembro_id, $fecha_prestamo, $fecha_devolucion);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $prestamo_id = $_POST["prestamo_id"];
        $libro_id = $_POST["libro_id"];
        $miembro_id = $_POST["miembro_id"];
        $fecha_prestamo = $_POST["fecha_prestamo"];
        $fecha_devolucion = $_POST["fecha_devolucion"];
        
        $datos = array();
        $datos = $prestamos->actualizar($prestamo_id, $libro_id, $miembro_id, $fecha_prestamo, $fecha_devolucion);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $prestamo_id = $_POST["prestamo_id"];
        $datos = array();
        $datos = $prestamos->eliminar($prestamo_id);
        echo json_encode($datos);
        break;
}


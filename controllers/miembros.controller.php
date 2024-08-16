<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

require_once('../models/miembros.model.php');
error_reporting(0);
$miembros = new Miembros;

switch ($_GET["op"]) {
    case 'todos':
        $datos = array();
        $datos = $miembros->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $miembro_id = $_POST["miembro_id"];
        $datos = array();
        $datos = $miembros->uno($miembro_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $fecha_suscripcion = $_POST["fecha_suscripcion"];
        
        $datos = array();
        $datos = $miembros->insertar($nombre, $apellido, $email, $fecha_suscripcion);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $miembro_id = $_POST["miembro_id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $fecha_suscripcion = $_POST["fecha_suscripcion"];
        
        $datos = array();
        $datos = $miembros->actualizar($miembro_id, $nombre, $apellido, $email, $fecha_suscripcion);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $miembro_id = $_POST["miembro_id"];
        $datos = array();
        $datos = $miembros->eliminar($miembro_id);
        echo json_encode($datos);
        break;
}


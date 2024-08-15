<?php

// TODO: Configuración de cabeceras CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

// TODO: Función para manejar errores
function handle_error($message) {
    http_response_code(500);
    echo json_encode(['error' => $message]);
    exit;
}

// TODO: Función para validar datos
function validate_data($data, $required_fields) {
    foreach ($required_fields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            handle_error("Campo '$field' es requerido");
        }
    }
}

// TODO: Inclusión del modelo de OC Cabecera
require_once('../models/oc_detalle.model.php');

// TODO: Creación de instancia de OC detalle
$oc_detalle = new ocDetalle();

// TODO: Obtención del método de solicitud
$method = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : null;

// TODO: Manejo de la solicitud OPTIONS
if ($method === "OPTIONS") {
    die();
}

// TODO: Obtención de la operación
$op = isset($_GET["op"]) ? $_GET["op"] : null;

// TODO: Manejo de operaciones CRUD
switch ($op) {
    case 'todos':
        try {
            // TODO: Obtener una OC por ID
            validate_data($_POST, ['orden_id']);
            $oc_detalle = $_POST["orden_id"];
            $datos = $oc_detalle->todos($orden_id);
            echo json_encode($datos->fetch_assoc());
        } catch (Exception $e) {
            handle_error($e->getMessage());
        }
        break;

    case 'insertar':
        try {
            // TODO: Insertar una nueva OC
            validate_data($_POST, ['orden_id', 'producto_id', 'cantidad', 'precio', 'impuestoLinea', 'totalLinea']);
            $datos = $oc_detalle->insertar(
                $_POST["orden_id"],
                $_POST["producto_id"],
                $_POST["cantidad"],
                $_POST["precio"],
                $_POST["impuestoLinea"],
                $_POST["totalLinea"],
            );
            echo json_encode($datos);
        } catch (Exception $e) {
            handle_error($e->getMessage());
        }
        break;

    case 'actualizar':
        try {
            // TODO: Actualizar una OC existente
            validate_data($_POST, ['numEntry','orden_id', 'producto_id', 'cantidad', 'precio', 'impuestoLinea', 'totalLinea']);
            $datos = $oc_detalle->actualizar(
                $_POST["numEntry"],
                $_POST["orden_id"],
                $_POST["producto_id"],
                $_POST["cantidad"],
                $_POST["precio"],
                $_POST["impuestoLinea"],
                $_POST["totalLinea"],
            );
            echo json_encode($datos);
        } catch (Exception $e) {
            handle_error($e->getMessage());
        }
        break;

    default:
        handle_error("Operación no válida");
        break;
}
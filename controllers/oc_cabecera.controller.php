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
require_once('../models/oc_cabecera.model.php');

// TODO: Creación de instancia de OC Cabcecera
$oc_cabecera = new ocCabecera();

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
            // TODO: Obtener todos las OC
            $datos = $oc_cabecera->todos();
            echo json_encode($datos->fetch_all(MYSQLI_ASSOC));
        } catch (Exception $e) {
            handle_error($e->getMessage());
        }
        break;

    case 'uno':
        try {
            // TODO: Obtener una OC por ID
            validate_data($_POST, ['oc_id']);
            $oc_id = $_POST["oc_id"];
            $datos = $oc_cabecera->uno($oc_id);
            echo json_encode($datos->fetch_assoc());
        } catch (Exception $e) {
            handle_error($e->getMessage());
        }
        break;

    case 'insertar':
        try {
            // TODO: Insertar una nueva OC
            validate_data($_POST, ['proveedor_id', 'oc_fecha', 'oc_subtotal', 'oc_impuesto', 'oc_total']);
            $datos = $oc_cabecera->insertar(
                $_POST["proveedor_id"],
                $_POST["oc_fecha"],
                $_POST["oc_subtotal"],
                $_POST["oc_impuesto"],
                $_POST["oc_total"],
            );
            echo json_encode($datos);
        } catch (Exception $e) {
            handle_error($e->getMessage());
        }
        break;

    case 'actualizar':
        try {
            // TODO: Actualizar una OC existente
            validate_data($_POST, ['oc_id', 'proveedor_id', 'oc_fecha', 'oc_subtotal', 'oc_impuesto', 'oc_total']);
            $datos = $oc_cabecera->actualizar(
                $_POST["oc_id"],
                $_POST["proveedor_id"],
                $_POST["oc_fecha"],
                $_POST["oc_subtotal"],
                $_POST["oc_impuesto"],
                $_POST["oc_total"],
            );
            echo json_encode($datos);
        } catch (Exception $e) {
            handle_error($e->getMessage());
        }
        break;

    case 'eliminar':
        try {
            // TODO: Eliminar un producto
            validate_data($_POST, ['oc_id']);
            $datos = $oc_cabecera->eliminar($_POST["oc_id"]);
            echo json_encode($datos);
        } catch (Exception $e) {
            handle_error($e->getMessage());
        }
        break;

    default:
        handle_error("Operación no válida");
        break;
}
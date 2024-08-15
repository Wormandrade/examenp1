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

// TODO: Inclusión del modelo de Proveedor
require_once('../models/proveedores.model.php');

// TODO: Creación de instancia de Proveedor
$proveedores = new Proveedores();

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
            // TODO: Obtener todos los proveedores
            $datos = $proveedores->todos();
            echo json_encode($datos->fetch_all(MYSQLI_ASSOC));
        } catch (Exception $e) {
            handle_error($e->getMessage());
        }
        break;

    case 'uno':
        try {
            // TODO: Obtener un proveedor por ID
            validate_data($_POST, ['proveedor_id']);
            $proveedor_id = $_POST["proveedor_id"];
            $datos = $proveedores->uno($proveedor_id);
            echo json_encode($datos->fetch_assoc());
        } catch (Exception $e) {
            handle_error($e->getMessage());
        }
        break;

    case 'insertar':
        try {
            // TODO: Insertar un nuevo proveedor
            validate_data($_POST, ['dni', 'nombre', 'direccion', 'telefono', 'email', 'estado']);
            $datos = $proveedores->insertar(
                $_POST["dni"],
                $_POST["nombre"],
                $_POST["direccion"],
                $_POST["telefono"],
                $_POST["email"],
                $_POST["estado"]
            );
            echo json_encode($datos);
        } catch (Exception $e) {
            handle_error($e->getMessage());
        }
        break;

    case 'actualizar':
        try {
            // TODO: Actualizar un proveedor existente
            validate_data($_POST, ['proveedor_id', 'dni', 'nombre', 'direccion', 'telefono', 'email', 'estado']);
            $datos = $proveedores->actualizar(
                $_POST["proveedor_id"],
                $_POST["dni"],
                $_POST["nombre"],
                $_POST["direccion"],
                $_POST["telefono"],
                $_POST["email"],
                $_POST["estado"]
            );
            echo json_encode($datos);
        } catch (Exception $e) {
            handle_error($e->getMessage());
        }
        break;

    case 'eliminar':
        try {
            // TODO: Eliminar un proveedor
            validate_data($_POST, ['proveedor_id']);
            $datos = $proveedores->eliminar($_POST["proveedor_id"]);
            echo json_encode($datos);
        } catch (Exception $e) {
            handle_error($e->getMessage());
        }
        break;

    default:
        handle_error("Operación no válida");
        break;
}
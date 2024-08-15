<?php

# Variables globales: se evita y devuelvo la conexion como objeto
# POO: En lugar de mysqli_query se usa clase mysqli.
# Manejo de errores: excepciones para manejar los errores mas específicos.
# Ccredenciales BD:  constantes en lugar de variables privadas.

class ClaseConectar
{
    private const HOST = "localhost";
    private const USUARIO = "root";
    private const PASS = "";
    private const BASE = "inventarios";

    public function conectar()
    {
        $conexion = new mysqli(self::HOST, self::USUARIO, self::PASS, self::BASE);
        if ($conexion->connect_error) {
            if (strpos($conexion->connect_error, "Accesso denegado") !== false) {
                throw new Exception("Error de credenciales: Verifique el nombre de usuario y contraseña.");
            } elseif (strpos($conexion->connect_error, "Base de datos desconocida") !== false) {
                throw new Exception("Error de base de datos no encontrada: Verifique el nombre de la base de datos.");
            } else {
                throw new Exception("Error al conectar con el servidor: " . $conexion->connect_error);
            }
        }
        $conexion->set_charset("utf8");
        return $conexion;
    }
}
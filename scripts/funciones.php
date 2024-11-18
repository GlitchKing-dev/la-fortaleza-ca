<?php

// Incluir el archivo de conexión a la base de datos
require_once '../db/conexion.php';

// Función para calcular la ganancia o pérdida
function calcularResultado($conexion) {
    // Obtener ingresos totales en USD
    $ingresosStmt = $conexion->prepare("SELECT SUM(monto_usd) AS total_ingresos FROM ingresos");
    $ingresosStmt->execute();
    $total_ingresos = $ingresosStmt->fetch(PDO::FETCH_ASSOC)['total_ingresos'];

    // Obtener egresos totales en USD
    $egresosStmt = $conexion->prepare("SELECT SUM(monto_usd) AS total_egresos FROM egresos");
    $egresosStmt->execute();
    $total_egresos = $egresosStmt->fetch(PDO::FETCH_ASSOC)['total_egresos'];

    // Calcular ganancia o pérdida
    $resultado = $total_ingresos - $total_egresos;

    return [
        'total_ingresos' => $total_ingresos,
        'total_egresos' => $total_egresos,
        'resultado' => $resultado
    ];
}

// Función para validar si un usuario está autenticado
function verificarAutenticacion() {
    session_start();
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ../login.php'); // Redirige al login si no está autenticado
        exit();
    }
}

// Función para sanitizar entradas
function sanitizarEntrada($data) {
    return htmlspecialchars(trim($data));
}
?>
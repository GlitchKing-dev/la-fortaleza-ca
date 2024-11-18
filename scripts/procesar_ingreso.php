<?php
include '../db/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = $_POST['fecha'];
    $tasa_bcv = $_POST['tasa_bcv'];
    $monto_bs = $_POST['monto_bs'];
    $monto_usd = $_POST['monto_usd'];
    $tipo_ingreso = $_POST['tipo_ingreso'];
    $usuario_id = 1; // Cambiar según la sesión del usuario

    // Validar los montos y realizar cálculos si es necesario
    if (empty($monto_bs) && !empty($monto_usd)) {
        $monto_bs = $monto_usd * $tasa_bcv;
    } elseif (empty($monto_usd) && !empty($monto_bs)) {
        $monto_usd = $monto_bs / $tasa_bcv;
    }

    $sql = "INSERT INTO ingresos (fecha, monto_bs, tasa_bcv, monto_usd, tipo_ingreso, usuario_id) 
            VALUES (:fecha, :monto_bs, :tasa_bcv, :monto_usd, :tipo_ingreso, :usuario_id)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ':fecha' => $fecha,
        ':monto_bs' => $monto_bs,
        ':tasa_bcv' => $tasa_bcv,
        ':monto_usd' => $monto_usd,
        ':tipo_ingreso' => $tipo_ingreso,
        ':usuario_id' => $usuario_id
    ]);

    header('Location: ../pages/ingresos.php?success=1');
}
?>
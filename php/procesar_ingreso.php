<!-- php/procesar_ingreso.php -->
<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = $_POST['fecha'];
    $monto_bs = $_POST['monto_bs'];
    $tasa_bcv = $_POST['tasa_bcv'];
    $monto_usd = $_POST['monto_usd'];
    $tipo_ingreso = $_POST['tipo_ingreso'];
    $usuario_id = 1; // Cambiar según la sesión del usuario

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

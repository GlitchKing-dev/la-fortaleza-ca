<!-- php/procesar_egreso.php -->
<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = $_POST['fecha'];
    $monto_bs = $_POST['monto_bs'];
    $tasa_bcv = $_POST['tasa_bcv'];
    $monto_usd = $_POST['monto_usd'];
    $tipo_pago = $_POST['tipo_pago'];
    $descripcion = $_POST['descripcion'];
    $usuario_id = 1; // Cambiar según la sesión del usuario

    $sql = "INSERT INTO egresos (fecha, monto_bs, tasa_bcv, monto_usd, tipo_pago, descripcion, usuario_id) 
            VALUES (:fecha, :monto_bs, :tasa_bcv, :monto_usd, :tipo_pago, :descripcion, :usuario_id)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ':fecha' => $fecha,
        ':monto_bs' => $monto_bs,
        ':tasa_bcv' => $tasa_bcv,
        ':monto_usd' => $monto_usd,
        ':tipo_pago' => $tipo_pago,
        ':descripcion' => $descripcion,
        ':usuario_id' => $usuario_id
    ]);

    header('Location: ../pages/egresos.php?success=1');
}
?>

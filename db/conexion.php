<?php
$host = 'sql104.infinityfree.com';
$db = 'if0_37647117_la_fortaleza';
$user = 'if0_37647117';
$password = 'M0MsJvwu0Pm';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
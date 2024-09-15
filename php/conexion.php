<?php
// php/conexion.php
$host = 'sql111.infinityfree.com';
$db = 'if0_37285952_script';
$user = 'if0_37285952';
$password = 'AcT8MhtX20x4';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}
?>
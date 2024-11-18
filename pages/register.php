<?php
// Incluir el archivo de conexión
require_once('../db/conexion.php');

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y validar los datos del formulario
    $nombre = trim($_POST['nombre']);
    $usuario = trim($_POST['usuario']);
    $contrasena = password_hash(trim($_POST['contrasena']), PASSWORD_DEFAULT);

    try {
        // Verificar si el usuario ya existe
        $checkUserSQL = "SELECT COUNT(*) FROM usuarios WHERE usuario = :usuario";
        $stmt = $conexion->prepare($checkUserSQL);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->execute();
        $userExists = $stmt->fetchColumn();

        if ($userExists > 0) {
            $error = "Lo sentimos, el Nombre de Usuario ya ha sido registrado!";
        } else {
            // Preparar la consulta SQL para el registro
            $sql = "INSERT INTO usuarios (nombre, usuario, contrasena) VALUES (:nombre, :usuario, :contrasena)";
            $stmt = $conexion->prepare($sql);

            // Asignar los valores a los parámetros
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $message = "Registro exitoso. Intenta iniciar sesión!";
            } else {
                $message = "Error al registrar el usuario!";
            }
        }
    } catch (PDOException $e) {
        echo "<p>Error en la base de datos: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Registrarse para acceder a las funciones de La Fortaleza C.A.">
    <meta name="keywords" content="La Fortaleza C.A., sing up, registrarse">
    <meta name="author" content="Miguel Bethancourt, Sugeidy Manzanilla, Saúl Ramírez, Frank Delgadillo">
    
    <!-- Open graph -->
    <meta property="og:title" content="Registrarse - La Fortaleza C.A.">
    <meta property="og:image" content="/assets/img/image-preview.png">
    <meta property="og:image:alt" content="Logotipo de La Fortaleza C.A.">
    <meta property="og:description" content="Registrarse en el sistema de La Fortaleza C.A.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="La Fortaleza C.A.">
    <meta property="og:locale" content="es_ES">
    <meta property="og:url" content="https://fortaleza-ca.rf.gd/pages/register.php">
    
    <!-- Estilos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Iconos de la biblioteca de Font Awesome -->
    <link rel="stylesheet" href="/assets/css/register-styles.css">
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="icon" href="/assets/img/favicon.png">

    <title>Registro</title>
</head>
<body>
    <header>
        <h1>La Fortaleza C.A.</h1>
        <p class="rif">RIF: J-090345234</p>
        <nav>
            <a class= "nav__link" href="/index.php"> Volver al Inicio </a>
        </nav>
    </header>

    <main>
        <div class="session-card">
            <h2> Registrarse </h2>
            <form action="register.php" method="POST">
                <label for="nombre">Nombre y Apellido </label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="usuario">Nombre de Usuario</label>
                <input type="text" id="usuario" name="usuario" required>

                <label for="contrasena">Contraseña</label>
                <div class="password-container">
                    <input type="password" id="contrasena" name="contrasena" required>
                    <span id="togglePassword" class="toggle-password">
                        <i class="fas fa-eye-slash"></i> <!-- Ícono del ojo -->
                    </span>
                </div>

                <button type="submit">Enviar</button>
            </form>
        
            <!-- Mostrar mensajes de registro exitoso o error -->
            <?php if (!empty($message)): ?>
                <div class="message"><?= $message ?></div>
            <?php elseif (!empty($error)): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
        </div>
    </main>
    
    <footer>
        <p>&copy; 2024 La Fortaleza C.A. Todos los derechos reservados.</p>
    </footer>

    <script src="/assets/js/login.js"></script> <!-- Enlazar archivo JavaScript -->
</body>
</html>
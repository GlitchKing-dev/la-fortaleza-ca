<?php
session_start();
require '../db/conexion.php';  // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Verificar si el usuario y la contraseña están presentes
    if (empty($usuario) || empty($contrasena)) {
        $error = "Usuario y contraseña son obligatorios.";
    } else {
        // Consulta para verificar el usuario y la contraseña
        $stmt = $conexion->prepare("SELECT id, nombre, usuario, contrasena, rol FROM usuarios WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        $usuarioDB = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioDB && password_verify($contrasena, $usuarioDB['contrasena'])) {
            // Verificar si el rol está definido
            if (is_null($usuarioDB['rol']) || $usuarioDB['rol'] === '') {
                $error = "Lo sentimos, el Administrador no ha aprobado su rol para nuestra plataforma.";
            } else {
                // Autenticación exitosa
                $_SESSION['user_id'] = $usuarioDB['id'];
                $_SESSION['nombre'] = $usuarioDB['nombre'];
                $_SESSION['rol'] = $usuarioDB['rol'];

                // Redirigir según el rol
                if ($_SESSION['rol'] == 'ingresos') {
                    header("Location: /index.php");
                } elseif ($_SESSION['rol'] == 'egresos') {
                    header("Location: /index.php");
                } elseif ($_SESSION['rol'] == 'gerente') {
                    header("Location: /index.php");
                } else {
                    $error = "No tiene un rol válido.";
                }
            }
        } else {
            $error = "Usuario o Contraseña incorrectos!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Inicia sesión para acceder a las funciones de La Fortaleza C.A.">
    <meta name="keywords" content="La Fortaleza C.A., login, sesión, ingreso, reporte, egreso">
    <meta name="author" content="Miguel Bethancourt, Sugeidy Manzanilla, Saúl Ramírez, Frank Delgadillo">
    
    <!-- Open graph -->
    <meta property="og:title" content="Iniciar sesión - La Fortaleza C.A.">
    <meta property="og:image" content="/assets/img/image-preview.png">
    <meta property="og:image:alt" content="Logotipo de La Fortaleza C.A.">
    <meta property="og:description" content="Iniciar sesión en el sistema de La Fortaleza C.A.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="La Fortaleza C.A.">
    <meta property="og:locale" content="es_ES">
    <meta property="og:url" content="https://fortaleza-ca.rf.gd/pages/login.php">

    <!-- Estilos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Iconos de la biblioteca de Font Awesome -->
    <link rel="stylesheet" href="/assets/css/login-styles.css">
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="icon" href="/assets/img/favicon.png">
    
    <title>Iniciar sesión</title>
</head>
<body>
    <header>
        <h1>La Fortaleza C.A.</h1>
        <p class="rif">RIF: J-090345234</p>
        <nav>
            <a class="nav__link" href="/index.php">Volver al Inicio</a>
        </nav>
    </header>

    <main>
        <div class="session-card">
            <h2>Iniciar sesión</h2>
            <form action="login.php" method="POST">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required>

                <label for="contrasena">Contraseña</label>
                <div class="password-container">
                    <input type="password" id="contrasena" name="contrasena" required>
                    <span id="togglePassword" class="toggle-password">
                        <i class="fas fa-eye-slash"></i> <!-- Ícono del ojo -->
                    </span>
                </div>

                <button type="submit">Entrar</button>
            </form>
            
            <!-- Mostrar mensaje de error si existe -->
            <?php if (!empty($error)): ?>
                <div class="error-message"><?= $error ?></div>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 La Fortaleza C.A. Todos los derechos reservados.</p>
    </footer>

    <script src="/assets/js/login.js"></script> <!-- Enlazar archivo JavaScript -->
</body>
</html>
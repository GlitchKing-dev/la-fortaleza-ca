<?php
// Inicio de sesión
session_start();

// Verificar si el usuario está autenticado y tiene el rol adecuado
if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] != 'egresos' && $_SESSION['rol'] != 'gerente')) {
    // Redirigir al login si no está autenticado o no tiene el rol adecuado
    header("Location: ../pages/login.php");
    exit;  // Detener la ejecución después de la redirección
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Registro de egresos monetarios de la empresa de productos de construcción La Fortaleza C.A." >
    <meta name="keywords" content="La Fortaleza C.A., The Fortress, Registro de egresos, Control de egresos">
    <meta name="author" content="Miguel Bethancourt, Sugeidy Manzanilla, Saúl Ramírez, Frank Delgadillo">
    
    <!-- Open graph -->
    <meta property="og:title" content="Egresos de La Fortaleza C.A.">
    <meta property="og:image" content="/assets/img/image-preview.png">
    <meta property="og:image:alt" content="Logo de La Fortaleza C.A.">
    <meta property="og:description" content="Registro de egresos de la empresa La Fortaleza C.A.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="La Fortaleza C.A.">
    <meta property="og:locale" content="es_ES">
    <meta property="og:url" content="https://fortaleza-ca.rf.gd/pages/egresos.php">
    
    <!-- Estilos -->
    <link rel="stylesheet" href="/assets/css/egresos-styles.css">
    <link rel=stylesheet href="/assets/css/fonts.css">
    <link rel=icon href="/assets/img/favicon.png">

    <title>Egresos</title>
    
</head>
<body>
    <header>
        <h1>La Fortaleza C.A.</h1>
        <p class="rif">RIF: J-090345234</p>
        <nav>
            <a class="nav__link" href="/index.php">Inicio</a>
            <?php if ($_SESSION['rol'] == 'gerente'): ?>
                <a class="nav__link" href="egresos.php">Registrar Ingreso</a>
                <a class="nav__link" href="reporte.php">Ver Reporte</a>
            <?php endif; ?>
            <a class="nav__link" href="../scripts/logout.php">Cerrar Sesión</a>
        </nav>
    </header>

    <main>

    <form class="form" action="/scripts/procesar_egreso.php" method="POST">
        <h2 class="form__title">Registro de Egresos</h2>

        <label class="form__label" for="fecha">Fecha</label>
        <input type="date" id="fecha" name="fecha" required>

        <label class="form__label" for="tasa_bcv">Tasa BCV</label>
        <input class="form__input" type="number" id="tasa_bcv" name="tasa_bcv" step="0.01" placeholder="Ej: 37" required>

        <label class="form__label" for="monto_bs">Monto Bs</label>
        <input class="form__input" type="number" id="monto_bs" name="monto_bs" step="0.01" placeholder="Ej: 100">

        <label class="form__label" for="monto_usd">Monto $</label>
        <input class="form__input" type="number" id="monto_usd" name="monto_usd" step="0.01" placeholder="Ej: 40">

        <label class="form__label" for="tipo_pago">Tipo de Pago</label>
        <select class="form__input" id="tipo_pago" name="tipo_pago" required>
            <option value="" disabled selected>Selecciona una opción</option>
            <option value="Pago Móvil Banesco">Pago Móvil Banesco</option>
            <option value="Transferencia Bancaria">Transferencia Bancaria</option>
            <option value="Efectivo">Efectivo</option>
            <option value="Zelle">Zelle</option>
            <option value="Otros">Otros</option>
        </select>

        <label class="form__label" for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="6" placeholder="Ej: Pago de servicios" maxlength="200" title="Máximo 200 caracteres" required></textarea>

        <button class="form__buttom" type="submit">Registrar</button>
    </form>

        <script src="/assets/js/calculo_montos.js"></script>

        <?php if (isset($_GET['success'])): ?>
            <p class="message">Egreso registrado exitosamente.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 La Fortaleza C.A. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
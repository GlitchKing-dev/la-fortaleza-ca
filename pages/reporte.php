<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Resultado neto mensual de la empresa de productos de construcción la Fortaleza C.A.">
    <meta name="keywords" content="La Fortaleza C.A., The Fortress, Reporte, Resultados netos">
    <meta name="author" content="Miguel Bethancourt, Sugeidy Manzanilla, Saúl Ramírez, Frank Delgadillo">

    <!-- Open graph -->
    <meta property="og:title" content="Reporte de La Fortaleza C.A.">
    <meta property="og:image" content="/assets/img/image-preview.png">
    <meta property="og:image:alt" content="Logotipo de La Fortaleza C.A.">
    <meta property="og:description" content="Registro de egresos de la empresa la Fortaleza C.A.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="La Fortaleza C.A.">
    <meta property="og:locale" content="es_ES">
    <meta property="og:url" content="https://la-fortaleza-ca.free.nf/pages/reporte.php">
    
    <!-- Estilos -->
    <link rel="stylesheet" href="/assets/css/reporte-styles.css">
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel=icon href="/assets/img/favicon.png">
    
    <title>Reporte</title>
    
</head>
<body>
    <header>
        <h1>La Fortaleza C.A.</h1>
        <p class="rif">RIF: J-090345234</p>
        <nav>
            <a class="nav__link" href="../index.php">. Inicio .</a>
            <a class="nav__link" href="ingresos.php">. Registrar Ingreso .</a>
            <a class="nav__link" href="egresos.php">. Registrar Egreso .</a>
        </nav>
    </header>
    <main>
        <form class="form" method="GET" action="reporte.php">
            <h2 class="form__title">Resultado neto</h2>
        
            <label class="form__label" for="mes">Seleccione el mes</label>
            <input class="form__input" type="month" name="mes" id="mes" required>
        
            <button class="form__buttom" type="submit">Generar</button>
        </form>

    <?php 
    include '../php/conexion.php'; 

    if (isset($_GET['mes'])) {
        $mesSeleccionado = $_GET['mes'];
        list($year, $month) = explode('-', $mesSeleccionado);
        
        // obtener el nombre del mes en español
        setlocale(LC_TIME, 'es_ES.UTF-8');
        
        // Crear un objeto DateTime y formatear el nombre del mes
        $dateObj = DateTime::createFromFormat('!m', $month);
        $nombreMes = $dateObj->format('F'); // Obtenemos el nombre del mes en inglés
        
        // Convertir el nombre del mes al español usando strftime 
        $nombreMes = strftime('%B', $dateObj->getTimestamp()); // Si funciona (pero puede quedar obsoleto con nuevas versiones de PHP)
        $ingresosStmt = $conexion->prepare("SELECT SUM(monto_usd) AS total_ingresos FROM ingresos WHERE YEAR(fecha) = :year AND MONTH(fecha) = :month");
        $ingresosStmt->execute([':year' => $year, ':month' => $month]);
        $total_ingresos = $ingresosStmt->fetch(PDO::FETCH_ASSOC)['total_ingresos'] ?? 0;

        $egresosStmt = $conexion->prepare("SELECT SUM(monto_usd) AS total_egresos FROM egresos WHERE YEAR(fecha) = :year AND MONTH(fecha) = :month");
        $egresosStmt->execute([':year' => $year, ':month' => $month]);
        $total_egresos = $egresosStmt->fetch(PDO::FETCH_ASSOC)['total_egresos'] ?? 0;

        $resultado = $total_ingresos - $total_egresos;
    ?>

        <section class="result">
            <!-- Mostrar el nombre del mes seleccionado -->
            <h2 class="result__title">Reporte de <?php echo ucfirst($nombreMes) . " " . $year; ?></h2>
            <p class="result__total">Total Ingresos: $<?php echo number_format($total_ingresos, 2); ?></p>
            <p class="result__total">Total Egresos: $<?php echo number_format($total_egresos, 2); ?></p>
            <p class="result__total"><?php echo $resultado >= 0 ? 'Ganancia' : 'Pérdida'; ?>: $<?php echo number_format(abs($resultado), 2); ?></p>
        </section>
    <?php 
    } else {
        echo '<p class="message">Por favor, seleccione un mes para generar el reporte!</p>';
    } 
    ?>

    </main>
    <footer>
        <p>&copy; 2024 La Fortaleza C.A. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
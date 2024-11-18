# the-fortress

Este proyecto es una aplicación web para la empresa La Fortaleza C.A. (Ficticia) de RIF: J-090345234, que permite generar un reporte mensual de los ingresos y egresos de la empresa, mostrando el resultado neto (ganancias o pérdidas) para el mes seleccionado.

## Características

- Registro de ingresos y egresos.
- Generación de reportes mensuales.
- Diferenciación entre ganancias y pérdidas.
- Diseño responsivo para su visualización en distintos dispositivos.
- Meta Tags Open Graph para mejor visualización de la plataforma en las redes sociles.
- Control de usuario con tres roles: ingresos, egresos y gerente.

## Tecnologías utilizadas

- **PHP** para la estructura de las páginas, conexión a la base de datos y procesamiento.
- **CSS** para los estilos y el diseño responsivo.
- **MySQL** como base de datos para almacenar los registros de ingresos y egresos.
- **JavaScript** para actualizaciones de las páginas en tiempo real.

## Instalación

1. Clonar este repositorio:

   ```bash
   git clone https://github.com/tu-usuario/la-fortaleza-reporte.git

## Servicio de Hosting

El proyecto se encuentra subido al servicio de hosting de InfinityFree. Puedes acceder a la aplicación por medio del siguiente enlace:

[La Fortaleza C.A.](https://fortaleza-ca.rf.gd/index.php)

## Estructura de los directorios

LA-FORTALEZA-CA/
├── README.md
├── .gitignore
├── index.php
├── assets/
│   ├── css/
│   │   ├── egresos-styles.css
│   │   ├── fonts.css
│   │   ├── index-styles.css
│   │   ├── ingresos-styles.css
│   │   ├── login-styles.css
│   │   ├── register-styles.css
│   │   └── reporte-styles.css
│   ├── fonts/
│   │   └── Montserrat/
│   │       ├── Montserrat-Black.ttf
│   │       ├── Montserrat-BlackItalic.ttf
│   │       ├── Montserrat-Bold.ttf
│   │       ├── Montserrat-BoldItalic.ttf
│   │       ├── Montserrat-ExtraBold.ttf
│   │       ├── Montserrat-ExtraBoldItalic.ttf
│   │       ├── Montserrat-ExtraLight.ttf
│   │       ├── Montserrat-ExtraLightItalic.ttf
│   │       ├── Montserrat-Italic.ttf
│   │       ├── Montserrat-Light.ttf
│   │       ├── Montserrat-LightItalic.ttf
│   │       ├── Montserrat-Medium.ttf
│   │       ├── Montserrat-MediumItalic.ttf
│   │       ├── Montserrat-Regular.ttf
│   │       ├── Montserrat-SemiBold.ttf
│   │       ├── Montserrat-SemiBoldItalic.ttf
│   │       ├── Montserrat-Thin.ttf
│   │       └── Montserrat-ThinItalic.ttf
│   ├── img/
│   │   ├── background-2.jfif
│   │   ├── background-3.jfif
│   │   ├── background.png
│   │   ├── cliente.jpg
│   │   ├── favicon.png
│   │   └── image-preview.png
│   └── js/
│       ├── calculo_montos.js
│       └── login.js
├── db/
│   └── conexion.php
├── pages/
│   ├── egresos.php
│   ├── ingresos.php
│   ├── login.php
│   ├── register.php
│   └── reporte.php
├── private/
│   └── la_fortaleza.sql
└── scripts/
    ├── funciones.php
    ├── logout.php
    ├── procesar_egreso.php
    └── procesar_ingreso.php
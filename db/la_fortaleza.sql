-- script.sql
/* Creación de la base de datos <la_fortaleza>
    y las tablas <usuarios>, <ingresos> y <egresos>
*/
CREATE DATABASE la_fortaleza;
USE la_fortaleza;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    usuario VARCHAR(50) UNIQUE,
    contrasena VARCHAR(255),
    rol ENUM('admin', 'usuario')
);

CREATE TABLE ingresos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE,
    monto_bs DECIMAL(10, 2),
    tasa_bcv DECIMAL(5, 2),
    monto_usd DECIMAL(10, 2),
    tipo_ingreso VARCHAR(50),
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE egresos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE,
    monto_bs DECIMAL(10, 2),
    tasa_bcv DECIMAL(5, 2),
    monto_usd DECIMAL(10, 2),
    tipo_pago VARCHAR(50),
    descripcion TEXT,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Crear la base de datos tienda01
CREATE DATABASE IF NOT EXISTS tienda01;

-- Usar la base de datos tienda01
USE tienda01;

-- Crear la tabla Imagen
CREATE TABLE imagen (
    id_img INT AUTO_INCREMENT PRIMARY KEY,
    img VARCHAR(255),
    descripcion TEXT
);

-- Crear la tabla Categoria
CREATE TABLE categoria (
    id_cat INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(255),
    img_cat VARCHAR(255)
);

-- Crear la tabla Producto
CREATE TABLE producto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    descripcion TEXT,
    talla VARCHAR(50),
    estilo VARCHAR(50),
    f_img INT,
    f_cat INT,
    FOREIGN KEY (f_img) REFERENCES imagen(id_img),
    FOREIGN KEY (f_cat) REFERENCES categoria(id_cat)
);



CREATE DATABASE danzakuduro;
use danzakuduro;

create table gestor (
    `dni` VARCHAR(10) NOT NULL PRIMARY KEY,
    `nombre` VARCHAR(50) NOT NULL,
    `apellidos` VARCHAR(50) NOT NULL,
    `contrasenia` VARCHAR(100) NOT NULL,
    `baja` VARCHAR(2) check (baja in('si','no'))
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE eventos(
	`id` INT AUTO_INCREMENT PRIMARY KEY,
    `dia` date NOT NULL,
    `hora` time NOT NULL,
    `precio` VARCHAR(50) NOT NULL,
    `lugar` VARCHAR(50) NOT NULL,
    `especialidad` VARCHAR(50) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

create table tarifas (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(50) NOT NULL,
    `descuento` INT NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

create table grupo (
    `codigo` VARCHAR(10) NOT NULL PRIMARY KEY,
    `especialidad` VARCHAR(50) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

create table monitor (
    `dni` VARCHAR(10) NOT NULL,
    `dni_gestor` VARCHAR(10) NOT NULL,
    `nombre` VARCHAR(50) NOT NULL,
    `apellidos` VARCHAR(50) NOT NULL,
    `contrasenia` VARCHAR(100) NOT NULL,
    `especialidad` VARCHAR(100) NOT NULL,
    `baja` VARCHAR(2) check (baja in('si','no')),
    `fecha_alta` DATE,
    primary key(dni,dni_gestor),
    CONSTRAINT dni_gestor FOREIGN KEY (dni_gestor) REFERENCES gestor(dni) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

create table clases (
    `cod_grupo` VARCHAR(10) NOT NULL,
    `dni_monitor` VARCHAR(10) NOT NULL,
    `hora_inicio` time NOT NULL,
    `hora_fin` time NOT NULL,
    `dia` date NOT NULL,
    PRIMARY KEY (cod_grupo, dni_monitor,hora_inicio,dia),
    CONSTRAINT dni_monitor FOREIGN KEY (dni_monitor) REFERENCES monitor(dni) ON DELETE CASCADE,
    CONSTRAINT cod_grupo FOREIGN KEY (cod_grupo) REFERENCES grupo(codigo) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;	


create table cliente (
    `dni` VARCHAR(10) NOT NULL PRIMARY KEY,
    `id_tarifa` INT NOT NULL,
    `cod_grupo` VARCHAR(10) NOT NULL,
    `dni_gestorC` VARCHAR(10) NOT NULL,
    `nombre` VARCHAR(50) NOT NULL,
    `apellidos` VARCHAR(50) NOT NULL,
    `contrasenia` VARCHAR(100) NOT NULL,
    `baja` VARCHAR(2) check (baja in('si','no')),
    `fecha_alta` DATE,
    `fecha_pago_tarifa` DATE,
    CONSTRAINT dni_gestorC FOREIGN KEY (dni_gestorC) REFERENCES gestor(dni) ON DELETE CASCADE,
    CONSTRAINT id_tarifa FOREIGN KEY (id_tarifa) REFERENCES tarifas(id) ON DELETE CASCADE,
    CONSTRAINT cod_grupoC FOREIGN KEY (cod_grupo) REFERENCES grupo(codigo) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

create table inscrito (
    `id_evento` int NOT NULL,
    `dni_cliente` VARCHAR(10) NOT NULL,
    `precio` int NOT NULL,
    `fecha_pago` DATE,
    PRIMARY key(id_evento,dni_cliente),
    CONSTRAINT dni_cliente FOREIGN KEY (dni_cliente) REFERENCES cliente(dni) ON DELETE CASCADE,
    CONSTRAINT id_evento FOREIGN KEY (id_evento) REFERENCES eventos(id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
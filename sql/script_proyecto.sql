CREATE DATABASE Proyecto;
USE Proyecto;

CREATE TABLE Cuestionario(
	nombre VARCHAR(100) NOT NULL,
    creado DATETIME DEFAULT NOW(),
    clave VARCHAR(10) PRIMARY KEY
);

CREATE TABLE Pregunta(
	pregunta VARCHAR(255) NOT NULL,
    numero INT NOT NULL,
    claveCuestionario VARCHAR(10),
    PRIMARY KEY( numero, claveCuestionario)
);

CREATE TABLE Opcion(
	opcion VARCHAR(255) NOT NULL,
	esCorrecta BOOLEAN,
    inciso VARCHAR(1),
    claveCuestionario VARCHAR(10),
    numeroPregunta INT,
    PRIMARY KEY( inciso, claveCuestionario, numeroPregunta)
);

ALTER TABLE Pregunta
ADD CONSTRAINT 
FOREIGN KEY( claveCuestionario ) REFERENCES Cuestionario( clave ) ON UPDATE CASCADE;

ALTER TABLE Opcion
ADD CONSTRAINT 
FOREIGN KEY( claveCuestionario, numeroPregunta ) REFERENCES Pregunta( claveCuestionario, numero );

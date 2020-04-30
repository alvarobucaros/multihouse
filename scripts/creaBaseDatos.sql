-- MySQL dbcreate database for multihouse
--
-- Host: localhost
-- Database:atominge_ncr123
-- Script date Monday,Apr 27, 2020 10:22:19
-- by AtomIngenieria sas

--
-- Crea el usuario
--
CREATE USER IF NOT EXISTS  root@localhost IDENTIFIED BY 'admin123' ;
--
-- Crea Base de datos
--
CREATE DATABASE atominge_ncr123 CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE atominge_ncr123; 
--
-- Le da privilegios sobre la base de datos 
--
GRANT ALL PRIVILEGES ON atominge_ncr123.* TO root@localhost; 

<?php

//Controllers

require_once "controlador/plantillaControlador.php";
require_once "controlador/usuarioControlador.php";
require_once "controlador/clienteControlador.php";
require_once "controlador/productoControlador.php";
//require_once "controlador/facturaControlador.php";

//Models

require_once "modelo/usuarioModelo.php";
require_once "modelo/clienteModelo.php";
//require_once "modelo/facturaModelo.php";
require_once "modelo/productoModelo.php";

$plantilla = new controladorPlantilla();
$plantilla->ctrPlantilla();
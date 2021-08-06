<?php
session_start();
error_reporting(0);
include '../model/Horario.php';
$objHorario = new Horario();

$descripcion = trim($_POST['descripcion']);

$objHorario->addHorario($descripcion);

$_SESSION['code']='success';
header('location: ../tienda');

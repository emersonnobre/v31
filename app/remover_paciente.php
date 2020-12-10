<?php
require_once("config.php");
$paciente = new Paciente();
$paciente->loadbyId($_SESSION["idpaciente"]);
$paciente->autoRemove();
session_destroy();
header('Location: tela_pacientes_nutri.php');
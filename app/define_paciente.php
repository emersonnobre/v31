<?php
require_once("config.php");

$_SESSION["idpaciente"] = $_GET["idpaciente"];

echo $_SESSION["idpaciente"];

header("Location: tela_plano_nutri.php");

die();

?>
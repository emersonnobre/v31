<?php
require_once("config.php");
header('Location: tela_plano_historico_2.php');
$_SESSION["inicial"] = $_POST["dat_inic"];
$_SESSION["final"] = $_POST["dat_fin"];
<?php
require_once("config.php");
header("Location: tela_remover_dica.php");
$dica = $_GET["dica"];
echo $dica;
Nutricionista::deleteDica($dica);
die();
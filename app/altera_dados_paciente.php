<?php

require_once("config.php");
$sql = new Sql();
$user = new Paciente();
$user->loadbyId($_SESSION["id"]);

echo $user;

if ($_GET["name"]){
    $user->setNome($_GET["name"]);
    $user->updatePaciente();

} if ($_GET["email"]){
    $user->setEmail($_GET["email"]);
    $user->updatePaciente();
} if ($_GET["tel"]){
    $user->setTelefone($_GET["tel"]);
    $user->updatePaciente();
} if ($_GET["password"]){
    $user->setSenha(password_hash($_GET["password"], PASSWORD_DEFAULT));
    $user->updatePaciente();
} if ($_GET["date"]){
    $ts = strtotime($_GET["date"]);
    $date = date("Y-m-d", $ts);
    $user->setdt_nascimento($date);
    $user->updatePaciente();
}

header("Location: tela_perfil_usuario.php")




?>
<?php

require_once("config.php");



?>

<?php 

 if(isset($_GET["id"])){
    $_SESSION["id"]=$_GET["id"];
    header("Location: tela_refeicoes_paciente.php");
    die();
}else{
?>
<form action="" method="get">
    <select name="id" id="">
        <option value="1">Arthur</option>
        <option value="2">Vinicius</option>
        <option value="3">Maressa</option>
        <option value="4">Mariana</option>
    </select>
    <input type="submit" value="Escolher">
</form>

<?php } ?>

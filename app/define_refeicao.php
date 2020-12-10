<?php


// if ($_GET["ref"]){
//     $_SESSION["ref"] = $_GET["ref"];
//     $_SESSION["refeicao"] = $_SESSION["ref"];
//     //  
// }



$_SESSION["refeicao"] = $_GET["ref"];
echo $_POST["refeicao"];
header("Location: tela_amostra_refeicao_paciente.php?ref=".$_GET["ref"]);
?>
<script>
alert("Alimento removido!");
</script>

<?php
require_once("config.php");
header("Location: tela_remover_alimento.php");
$name = $_GET["name"];
echo $name;
Alimento::removerAlimentoDoBanco($name);
?>
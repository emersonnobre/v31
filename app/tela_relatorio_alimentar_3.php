<?php

require_once("config.php");
$user = new Paciente();
$user->loadbyId($_SESSION["idpaciente"]);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório alimentar</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/estilo.php">
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
      rel="stylesheet"
    />
</head>
<body class="bodyA">
    <header class="cabecalho">
        <img src="imagens\usuario.png" alt="usuario" width="100px" height="100px">
    	<a href="tela_perfil_paciente_nutri.php"><p class="text-little"><?php echo $user->getNome();?></p></a>
        <h1 class="text-xl">Relatório alimentar</h1>
    </header>
    <div class="box-md text-md text-left">
        <p class="important-text text-little">Máximo de calorias ingeridas(cal):<p class="text-min"><?php  echo number_format($user->MaxCaloriasByDate($_POST['dat_inic'],$_POST['dat_fin']), 2); ?></p></p>
        <p class="important-text text-little">Mínimo de calorias ingeridas(cal):<p class="text-min"><?php echo number_format($user->MinCaloriasByDate($_POST['dat_inic'],$_POST['dat_fin']), 2);?></p></p>
        <p class="important-text text-little">Média de calorias ingeridas(cal): <p class="text-min"><?php  echo number_format($user->MediaCaloriasByDate($_POST['dat_inic'],$_POST['dat_fin']), 2); ?></p></p>
        <p class="important-text text-little">Média de carboidratos ingeridos(g):<p class="text-min"><?php  echo number_format($user->MediaCarboidratosByDate($_POST['dat_inic'],$_POST['dat_fin']), 2);?></p></p>
        <p class="important-text text-little">Média de proteínas ingeridas(g):<p class="text-min"><?php echo number_format($user->MediaProteinasByDate($_POST['dat_inic'],$_POST['dat_fin']), 2); ?></p></p>
        <p class="important-text text-little">Média de gorduras ingeridas(g):<p class="text-min"><?php   echo number_format($user->MediaGordurasByDate($_POST['dat_inic'],$_POST['dat_fin']), 2);?></p></p>
    </div>
    <button class="btn btnAbsolute" onclick="document.location='tela_relatorio_alimentar.php'">Voltar</button>
</body>
</html>
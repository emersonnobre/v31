<?php

require_once("config.php");


$sql = new Sql();
$id = $_SESSION["id"];
$user = new Paciente();
$user->loadbyId($id);

$results = $user->returnRefeicoes();


?>


<!DOCTYPE html>
<html>
  <head>
    <title>Página inicial</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="css/estilo.php" />
    <link
      href="https://fonts.googleapis.com/css2?family=Lobster&display=swap"
      rel="stylesheet"
    />
  </head>
  <body class="bodyA">
    <header class="cabecalho animate__animated animate__shakeX animate__fadeIn animate__rotateIn">
    	<img   src="imagens\usuario.png" alt="usuario" style="width: 100px; height: 100px;" />
    	<a href="tela_perfil_usuario.php"><p class="text-little"><?php echo $user->getNome();?></p></a>
      <h1 class="text-xl animate__animated animate__rotateIn">O que você comeu hoje?</h1>
    </header>
    <div class="containerCaixas animate__animated animate__shakeX">
     
      <?php
      $i = 0;
      $lista = array();
      foreach ($results as $result) {
        foreach ($result as $key => $value) {
            
          array_push($lista, $value);
          $html = "<a class='button-false' href='define_refeicao.php?ref=".str_replace("%20", "+", $lista[$i])."'>";
            
          $html .= "<div class='grid-item green'><p>".$lista[$i]."</p>";
            
          $html .= "</div></a>";
          
          echo $html;
          $i++;
        }
      }
      ?>

      <a href="tela_dicas_nutri_paciente.php"> <div class="grid-item green"><p>Dicas do nutri</p></div></a>
      <a href="tela_plano_paciente.php"> <div class="grid-item green"><p>Plano alimentar</p></div></a> 
    </div>
    <a href="tela_pacientes_nutri.php">Telas do nutri (experimental)</a>
  </body>

  
</html>
<!-- <script>
  
  function redirect(value) {
    document.location='define_refeicao.php?ref=value';
  }
  
</script> -->


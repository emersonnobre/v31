<?php

require_once("config.php");
$user = new Paciente();
$user->loadbyId($_SESSION["id"]);
$refeicoes = Paciente::returnRefeicoes();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Plano alimentar</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
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
	<header class="cabecalho">
		<img src="imagens\usuario.png" alt="usuario" width="100px" height="100px">
		<a href="tela_perfil_usuario.php"><p class="text-little"><?php echo $user->getNome();?></p></a>
      	<h1 class="text-xl">Plano alimentar</h1>
	</header>
	<section class="box-xl">

		<?php
		
		foreach ($refeicoes as $refeicao) {
			foreach ($refeicao as $value) {
				echo "<div class = 'box-col'>";
				echo "<h1 class='text-little text-bold'>".$value."</h1>";
				$alimentos = Alimento::alimentosPlano($_SESSION["id"], $value);
				foreach ($alimentos as $alimento) {
					foreach ($alimento as $key => $value) {
						echo "<p class='text-little'>".$value."</p>";
					}
				}
				echo "</div>";
				
			}
			
		}


		?>
		<!-- <div class="box-col">
			<h1>Título</h1>
			<p>eaaaaaaaaa</p>
			<p>eaaaaaaaaa</p>
			<p>eaaaaaaaaa</p>
		</div>
		<div class="box-col">
			<h1>Título</h1>
			<p>eaaaaaaaaa</p>
			<p>eaaaaaaaaa</p>
			<p>eaaaaaaaaa</p>
		</div>
		<div class="box-col">
			<h1>Título</h1>
			<p>eaaaaaaaaa</p>
			<p>eaaaaaaaaa</p>
			<p>eaaaaaaaaa</p>
		</div>
		<div class="box-col">
			<h1>Título</h1>
			<p>eaaaaaaaaa</p>
			<p>eaaaaaaaaa</p>
			<p>eaaaaaaaaa</p>
		</div>
		<div class="box-col">
			<h1>Título</h1>
			<p>eaaaaaaaaa</p>
			<p>eaaaaaaaaa</p>
			<p>eaaaaaaaaa</p>
		</div>
		<div class="box-col">
			<h1>Título</h1>
			<p>eaaaaaaaaa</p>
			<p>eaaaaaaaaa</p>
			<p>eaaaaaaaaa</p>
		</div> -->
	</section>
	<button class="btn btnAbsolute" onclick="document.location='tela_refeicoes_paciente.php'">Voltar</button>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutri</title>
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
    	<a href="tela_perfil_paciente_nutri.php"><p class="text-little">Emerson</p></a>
        <h1 class="text-xl">Relatório alimentar</h1>
    </header>
    <div class="box-md text-md text-left">
        <p class="important-text">Máximo de colorias ingeridas(cal):</p>
        <p class="important-text">Mínimo de calorias ingeridas(cal):</p>
        <p class="important-text">Média de calorias ingeridas(cal):</p>
        <p class="important-text">Média de carboidratos ingeridos(g):</p>
        <p class="important-text">Média de proteínas ingeridas(g):</p>
        <p class="important-text">Média de gorduras ingeridas(g):</p>
    </div>
    <button class="btn btnAbsolute" onclick="document.location='tela_relatorio_alimentar.php'">Voltar</button>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.php" />
    <link
      href="https://fonts.googleapis.com/css2?family=Lobster&display=swap"
      rel="stylesheet"
    />
  </head>
  <body class="bodyA">
    <header>
      <div class="box-md">
        <h1 class="text-xl"><strong>Login</strong></h1>
        <form class="form" method="POST" action="logar.php">
          <div class="inputBox">
            <input type="text" name="email" placeholder="" required="" />
            <label for="email">E-mail</label>
          </div>
          <div class="inputBox">
            <input
              type="password"
              name="senha"
              placeholder="" required=""
            />
            <label for="senha">Senha</label>
          </div>
          <strong><input type="submit" value="LOGIN"/></strong>
        </form>
        <a class="text-little"
          href="tela_esqueci_senha.html"
          style="color: yellow; text-decoration: none;"
          ><strong>Esqueci minha senha</strong></a
        >
        <p class="text-little">Não tem uma conta?</p>
        <a class="text-little" href="tela_cadastro.html" style="color: yellow; text-decoration: none;"
          ><strong>Cadastre-se</br></strong></a
        >
        <a class="text-little" href="session.php" style="color: yellow; text-decoration: none;"><strong>Entrar(experimental)</strong></a>
      </div>
    </header>
  </body>
</html>

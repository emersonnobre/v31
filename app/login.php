
<?php 
include("classe/conexao.php");

if(isset($_POST['email']) && strlen($_POST['email'])>0 ){
    if(!isset($_SESSION))
      session_start();

      $_SESSION['email']= $mysqli->escape_string($_POST['email']);
      $_SESSION['senha']=md5(md5($_POST['senha']));


      $sql_code= "SELECT senha,codigo FROM usuario WHERE email='$_SESSION[email]'";

      $sql_query=$mysqli->query($sql_code) or die ($mysqli->error);
      $dado=$sql_query->fetch_assoc();
      $total=$sql_query->num_rows;

      if($total==0){
        $erro[]="Este email não pertence a nenhum usuário";
      } else{
          if   ($dado['senha']==$_SESSION['senha']){

            $_SESSION['usuario']=$dado['codigo'];
          }else{
            $erro[]="Senha incorreta";
          }
      }

      if(count($erro)==0 || isset($erro)){
        echo "<script>alert('Login efetuado com sucesso');location.href='refeicoesPaciente.php';</script>";
      }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Nutri</title>
    <meta charset="utf-8" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="reset.css">
    <link rel="stylesheet" type="text/css" href="estilo.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Lobster&display=swap"
      rel="stylesheet"
    />
  </head>
  <body class="bodyA">
  <?php 
  if(count($erro)>0)
  foreach($erro as $msg){
     echo "<p>$msg</p>";
  }
  ?>
    <header>
      <div class="login">
        <h1 style="text-align: center;"><strong>Login</strong><br /></h1>
        <br/>
        <br/>
        <br/>
        <form method="POST" action="">
          <div class="inputBox">
            <input value="" name="email" placeholder="" required="" type ="text "/>
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
          <strong><input class="botao" type="submit" value="LOGIN"/></strong>
        </form>
        <br/>
        <a
          href="esqueciasenha.html"
          style="color: yellow; text-decoration: none;"
          ><strong>Esqueci minha senha</strong></a
        >
        <p>Não tem uma conta?</p>
        <a href="cadastro.html" style="color: yellow; text-decoration: none;"
          ><strong>Cadastre-se</strong></a
        >
        <a href="refeicoesPaciente.html" style="color: yellow; text-decoration: none;"><strong>Entrar(experimental)</strong></a>

          <!----<button onclick="alert('Dantas corno')">Enviar</button>-->
        </p>
      </div>
    </header>
  </body>
</html>

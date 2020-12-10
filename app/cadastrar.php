


<?php

require_once("config.php");
$user=new Paciente();
$sql=new Sql();
$nome=$_POST['nome'];

$dataNascimento=$_POST['DataDeNascimento'];
$telefone=$_POST['telefone'];
$email=$_POST['email'];
$senha=$_POST['senha'];
$cpf=$_POST['cpf'];

if ($user->ValidaNumero($telefone)==true || $user->ValidaEmail($email)==true || $user->ValidaCpf($cpf)==true ){

    ?>
    <script>
        alert("Telefone, email ou cpf já cadastrados!");
    </script>
    <?php
    header("location:tela_cadastro.html");
}else {
    $user=$sql->query("insert into pacientes (nome,telefone,dataNascimento,email,senha,cpf) values('$nome','$telefone','$dataNascimento','$email','$senha','$cpf')");
    ?>
    <script>
        alert("Cadastrado com sucesso, agora faça seu log in!");
    </script>
    <?php
    header("location:tela_login.php");
}

/*
$verificaCpf=$sql->select("select * from pacientes where cpf=:CPF ",array(
    ':CPF'=>$cpf


//FAZER AS CONDIÇÕES PARA IMPEDIR CPF,TELEFONE E EMAIL IGUAIS NO BANCO


 
    $user=$sql->query("insert into pacientes(nome,telefone,dataNascimento,email,senha,cpf) values('$nome','$telefone','$dataNascimento','$email','$senha','$cpf')");
    header("location:tela_login.php");
*/


?>
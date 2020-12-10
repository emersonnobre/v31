<?php 

class Sql extends PDO {
    private $conn;

    // Construtor da classe, irá conectar com o banco sempre que chamada
    public function __construct (){
        $this->conn = new PDO("mysql:dbname=nutri;host=localhost", "root", "56642202Egr.");
    }

    // Função de loop para configuração de todos os parâmetros.
    private function setParams($statment, $parameters = array()) {
        foreach ($parameters as $key => $value) {
            $this->setParam($statment, $key, $value);
        }
    }

    // Função que define e configura cada um dos parâmetros passados para o statment
    private function setParam($statment, $key, $value) {
        $statment->bindParam($key, $value);
    }


    // Função que executa a query e retorna seu resultado
    public function query($rawQuery, $params = array()) {

        //linha do prepare
        $stmt = $this->conn->prepare($rawQuery);

        //configurando os parâmetros utilizando a outra função
        $this->setParams($stmt, $params);
        
        //executa e retorna  a execução
        $stmt->execute();

        return $stmt;

    }


    // Função de select
    public function select($rawQuery, $params = array()):array
    {
        $stmt = $this->query($rawQuery, $params);
        //retorna os dados coletados 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}





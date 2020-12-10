<?php

require_once("config.php");

class Nutricionista {

    private $nome;
    private $email;
    private $senha;

    public function getNome(){
        return $this->nome;
    }
    public function setNome($value){
        $this->nome = $value;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($value){
        $this->email = $value;
    }

    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($value){
        $this->senha = $value;
    }

    // Função que altera os dados do objeto de acordo com o array passado;
    public function setData($data){
        $row = $data[0];

        $this->setNome($row['nome']);
        $this->setEmail($row['email']);
        $this->setSenha($row['senha']);
    }

    //loadbyId
    public function loadbyId(){
        $sql = new Sql();
        $results = $sql->select("select * from tb_nutricionista");

        if(count($results) > 0){
            $this->setData($results);
        }
    }

    // Função que atualiza no banco as informações de acordo com os dados do objeto
    public function  updateNutri(){
        $sql = new Sql();
        $sql->query("
        update tb_nutricionista set
        nome = :NAME,
        senha = :SENHA,
        email = :EMAIL
        ", array(
            ':NAME'=>$this->getNome(),
            ':EMAIL'=>$this->getEmail(),
            ':SENHA'=>$this->getSenha()
        ));
    }

    // Função que retorna um array com os nomes de todos os pacientes
    public static function returnPacientes(){
        $sql = new Sql();
        $results = $sql->select("select id from pacientes order by id");
        return $results;
    }

    // Função que busca pacientes de acordo com o search
    public static function searchPacientes($search){
        $sql = new Sql();
        $results = $sql->select("select nome from pacientes where lower(nome) like :SEARCH ", array(
            ':SEARCH'=>'%'.$search.'%'
        ));

        return $results;
    }

    
    // Função que altera os dados do paciente a partir do array recebido.
    public static function updatePaciente($dados = array()){
        $sql = new Sql();
        $sql->query("
        update pacientes set
        peso = :PESO,
        inicio_acompanhamento = :DATE,
        objetivo = :OBJETIVO,
        anotacoes = :ANOTACOES
        where id = :ID  
        ", array(
            ':PESO'=>$dados[0],
            ':DATE'=>$dados[1],
            ':OBJETIVO'=>$dados[2],
            ':ANOTACOES'=>$dados[3],
            ':ID'=>$dados[4]
        ));
    }

    public static function getAllDicas(){
        $sql = new Sql();
        $results = $sql->select("
        select dica from tb_dicas
        ");

        return $results;
    }

    public static function deleteDica($dica){
        $sql = new Sql();
        $sql->query("
        delete from tb_dicas where 
        dica = :DICA
        ", array(
            ':DICA'=>$dica
        ));
    }

    public static function insertDica($dica){
        $sql = new Sql();
        $sql->query("
        insert into tb_dicas (dica) values 
        (:DICA)
        ", array(
            ':DICA'=>$dica
        ));
    }

    public static function insertAlimentoPlano($idAlimento, $idPlano, $idRefeicao, $qtd) {
        $sql = new Sql();
        $sql->query("
        insert into tb_refeicoes_alimentos (id_alimento, id_refeicao, id_plano, qtd) values
        (:IDALIMENTO, :IDREFEICAO, :IDPLANO, :QTD)
        ", array(
            ':IDALIMENTO'=>$idAlimento,
            ':IDREFEICAO'=>$idRefeicao, 
            ':IDPLANO'=>$idPlano,
            ':QTD'=>$qtd
        ));
    }

    public static function deleteAlimentoPlano($idAlimento, $idPlano, $idRefeicao, $qtd) {
        $sql = new Sql();
        $sql->query("
        delete from tb_refeicoes_alimentos where
        id_alimento = :IDALIMENTO and 
        id_plano = :IDPLANO and
        id_refeicao = :IDREFEICAO and
        qtd = :QTD
        ", array(
            ':IDALIMENTO'=>$idAlimento,
            ':IDREFEICAO'=>$idRefeicao, 
            ':IDPLANO'=>$idPlano,
            ':QTD'=>$qtd
        ));
    }

    public static function updateAlimentoPlano($idAlimento, $idPlano, $idRefeicao, $qtd){
        $sql = new Sql();
        $sql->query("
        update tb_refeicoes_alimentos set qtd = :QTD where
        id_alimento = :IDALIMENTO and
        id_plano = :IDPLANO and
        id_refeicao = :IDREFEICAO
        ", array(
            ':QTD'=>$qtd
        ));
    }

}

?>
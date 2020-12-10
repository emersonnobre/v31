<?php

class Alimento{

    private $nome;
    private $codigo;
    private $qtdGorduras;
    private $qtdCarboidratos;
    private $qtdProteinas;
    private $qtdCalorias;

    // Começo gets and sets
    public function getNome(){
        return $this->nome;
    }
    public function setNome($value){
        $this->nome = $value;
    }

    public function getCodigo(){
        return $this->codigo;
    }
    public function setCodigo($value){
        $this->codigo=$value;
    }

    public function getQtdGorduras(){
        return $this->qtdGorduras;
    }
    public function setQtdGorduras($value){
        $this->qtdGorduras=$value;
    }

    public function getQtdCarboidratos(){
        return $this->qtdCarboidratos;
    }
    public function setQtdCarboidratos($value){
        $this->qtdCarboidratos=$value;
    }

    public function getQtdProteinas(){
        return $this->qtdProteinas;
    }
    public function setQtdProteinas($value){
        $this->qtdProteinas=$value;
    }
    
    public function getQtdCalorias(){
        return $this->qtdCalorias;
    }
    public function setQtdCalorias($value){
        $this->qtdCalorias=$value;
    }
    // Fim gets and sets

    // Coleta os dados passados por array e atribui aos atributos do objeto.
    public function setData($data){
        $row = $data[0];

        $this->setCodigo($row['id']);
        $this->setNome($row['nome']);
        $this->setQtdGorduras($row['gorduras']);
        $this->setQtdCarboidratos($row['carboidratos']);
        $this->setQtdProteinas($row['proteinas']);
        $this->setQtdCalorias($row['calorias']);
    }

    // Busca uma linha a partir do ID no banco e atribui os dados dela ao objeto.
    public function loadbyId($codigo){
        $sql= new Sql();
        $results=$sql->select("SELECT * FROM alimentos WHERE id=:ID",array(
            ":ID"=>$codigo
        ));
        if (count ($results)>0) {
           $this->setData($results); 
        }

    }

    public function loadbyName($nome){
        $sql = new Sql();
        $ids = $sql->select("
        select id from alimentos where 
        nome = :NOME
        ", array(
            ':NOME'=>$nome
        ));

        foreach ($ids as $id) {
            foreach ($id as $key => $value) {
                $this->loadbyId($value);
            }
        }

        
    }

    // Função que retorna um array com o nome de todos os alimentos
    public static function list(){
        $sql = new Sql();
        return $sql->select("select nome from alimentos");
    }

    // Pesquisa se um alimento existe
    public static function validaAlimento($nome){
        $sql = new Sql();
        $results = $sql->select("select nome from alimentos where lower(nome) = :NOME", array(
            ':NOME'=>strtolower($nome)
        ));
        if (count($results) > 0){
            return 1;
        } else{
            return 0;
        }
    }

    public static function insereAlimento($nome, $cal, $carb, $prot, $gord){
        $sql = new Sql();
        $sql->query("
        insert into alimentos (nome, calorias, proteinas, carboidratos, gorduras) values 
        (:NOME, :CAL, :PROT, :CARB, :GORD)
        ", array(
        ':NOME'=>$nome,
        ':CAL'=>$cal,
        ':PROT'=>$prot,
        ':CARB'=>$carb,
        ':GORD'=>$gord
        ));
    }

    public static function removerAlimentoDoBanco($name) {
        $sql = new Sql();
        $sql->query("
        delete from alimentos_consumidos, alimentos where
        alimentos_consumidos.id_alimento = alimentos.id and
        alimentos.nome = :NOME
        ", array(
            ':NOME'=>$name
        ));

        $sql->query("
        delete from tb_refeicoes_alimentos, alimentos where
        tb_refeicoes_alimentos.id_alimento = alimentos.id and
        alimentos.nome = :NOME
        ", array(
            ':NOME'=>$name
        ));

        $sql->query("
        delete from alimentos where
        alimentos.nome = :NOME
        ", array(
            ':NOME'=>$name
        ));
    }

    // Busca os alimentos do plano alimentar de um paciente especificado pelo id;
    public static function alimentosPlano($id, $ref){
        $sql = new Sql();
        $results = $sql->select("
        select alimentos.nome from 
        alimentos, pacientes, tb_refeicoes, tb_planos, tb_planos_refeicoes, tb_refeicoes_alimentos where
        tb_refeicoes_alimentos.id_alimento = alimentos.id and
        tb_refeicoes_alimentos.id_refeicao = tb_refeicoes.id and
        tb_refeicoes_alimentos.id_plano = tb_planos.id and
        tb_planos_refeicoes.id_plano = tb_planos.id and
        tb_planos_refeicoes.id_refeicao = tb_refeicoes.id and
        tb_planos.id_paciente = pacientes.id and
        pacientes. id = :ID AND
        tb_refeicoes.nome = :REF
        ", array(
            ':REF'=> $ref,
            ':ID'=> $id
        ));

        return $results;
    }

    public function inserirAlimentoConsumido($idpaciente, $data, $idrefeicao, $qtd) {
        $sql = new Sql();

        $results = $this->validarAlimentoConsumido($idpaciente, $data, $idrefeicao);

        if (count($results) > 0){
            $sql->query("
            update alimentos_consumidos set quantidade = quantidade + :QUANT where
            id_alimento = :IDAL and
            id_refeicao = :IDRE and
            id_paciente = :IDPA and
            data = :DATA
            ", array(
                ':IDAL'=>$this->getCodigo(),
                ':IDRE'=>$idrefeicao,
                ':IDPA'=>$idpaciente,
                ':DATA'=>$data,
                ':QUANT'=>$qtd
            ));
        } else {
            $sql->query("
            insert into alimentos_consumidos (id_alimento, id_paciente, data, id_refeicao, quantidade) values
            (:IDALIMENTO, :IDPACIENTE, :DATA, :IDREF, :QTD)
            ", array(
                ':IDALIMENTO'=>$this->getCodigo(),
                ':IDPACIENTE'=>$idpaciente,
                ':DATA'=>$data,
                ':IDREF'=>$idrefeicao,
                ':QTD'=>$qtd
            ));
        }
    }

    public function excluirAlimentoConsumido($idpaciente, $idrefeicao, $data) {
        $sql = new Sql();
        $sql->query("
        delete from alimentos_consumidos where
        id_paciente = :IDPA and
        id_refeicao = :IDRE and
        id_alimento = :IDAL and
        data = :DATA
        ", array(
            ':IDPA'=>$idpaciente,
            ':IDRE'=>$idrefeicao,
            ':IDAL'=>$this->getCodigo(),
            ':DATA'=>$data
        ));
    }

    public function atualizarAlimentoConsumido($idpaciente, $idrefeicao, $data, $qtd) {
        $sql = new Sql();
        $sql->query("
        update alimentos_consumidos set quantidade = :QTD where
        id_paciente = :IDPA and
        id_refeicao = :IDRE and
        id_alimento = :IDAL and 
        data = :DATA
        ", array(
            ':QTD'=>$qtd, 
            ':IDPA'=>$idpaciente,
            ':IDRE'=>$idrefeicao,
            ':IDAL'=>$this->getCodigo(),
            ':DATA'=>$data
        ));
    }

    // Verifica se o alimento consumido a ser inserido já foi registrado no banco
    private function validarAlimentoConsumido($idpaciente, $data, $idrefeicao) {
        $sql = new Sql();
        $results = $sql->select("
        select * from alimentos_consumidos where
        id_alimento = :IDAL and
        id_refeicao = :IDRE and
        id_paciente = :IDPA and
        data = :DATA
        ", array(
            ':IDAL'=>$this->getCodigo(),
            ':IDRE'=>$idrefeicao,
            ':IDPA'=>$idpaciente,
            ':DATA'=>$data
        ));

        return $results;
    }


    public function __toString (){
        return json_encode(array(
            "codigo"=>$this->getCodigo(),
            "nome"=>$this->getNome(),
            "qtdGorduras"=>$this->getQtdGorduras(),
            "qtdCarboidratos"=>$this->getQtdCarboidratos(),
            "qtdProteinas"=>$this->getQtdProteinas(),
            "qtdCalorias"=>$this->getQtdCalorias()
        ));
    }

    // Retorna a quantidade de um alimento ingerido seguindo: o nome dele, a refeicao, o paciente e a data;
    public static function returnQuantidade($nomealimento, $idpaciente, $idrefeicao, $data){
        $sql = new Sql();

        $quantidade = $sql->select("
        select quantidade from alimentos_consumidos, alimentos, pacientes, tb_refeicoes where
        alimentos_consumidos.id_alimento = alimentos.id and
        alimentos.nome = :NOME and 
        alimentos_consumidos.id_paciente = pacientes.id and
        pacientes.id = :ID and 
        alimentos_consumidos.id_refeicao = tb_refeicoes.id and
        tb_refeicoes.id = :IDREF and 
        data = :DATA
        ", array(
            ':NOME'=>$nomealimento, 
            ':ID'=>$idpaciente, 
            ':IDREF'=>$idrefeicao, 
            ':DATA'=>$data
        ));

        return $quantidade;
    }

    public function calculaCalorias($quantidade) {
        return $this->getQtdCalorias() * $quantidade;
    }

    public function calculaCarboidratos($quantidade) {
        return $this->getQtdCarboidratos() * $quantidade;
    }

    public function calculaProteinas($quantidade) {
        return $this->getQtdProteinas() * $quantidade;
    }

    public function calculaGorduras($quantidade) {
        return $this->getQtdGorduras() * $quantidade;
    }
}

?>
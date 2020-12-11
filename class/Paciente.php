<?php
require_once("../app/config.php");

class Paciente {

    
    private $nome;
    private $dt_nascimento;
    private $dt_acompanhamento;
    private $cpf;
    private $id;
    private $peso;
    private $anotacoes;
    private $email;
    private $telefone;
    private $senha;
    private $objetivo;
    private $idPlano;

    public function getNome(){
        return $this->nome;
    }
    public function setNome($value){
        $this->nome = $value;
    }

    public function getTelefone(){
        return $this->telefone;
    }
    public function setTelefone($value){
        $this->telefone = $value;
    }

    public function getObjetivo(){
        return $this->objetivo;
    }
    public function setObjetivo($value){
        $this->objetivo = $value;
    }

    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($value){
        $this->senha = $value;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($value){
        $this->email = $value;
    }

    public function getdt_nascimento(){
        return $this->dt_nascimento;
    }
    public function setdt_nascimento($value){
        $this->dt_nascimento = $value;
    }
    public function showdt_nascimento(){
        $ts = strtotime($this->getdt_nascimento());
        return date("d/m/Y", $ts);
    }

    public function getdt_acompanhamento(){
        return $this->dt_acompanhamento;
    }
    public function setdt_acompanhamento($value){
        $this->dt_acompanhamento = $value;
    }
    public function showdt_acompanhamento(){
        $ts = strtotime($this->getdt_acompanhamento());
        return date("d/m/Y", $ts);
    }

    public function getAnotacoes(){
        return $this->anotacoes;
    }
    public function setAnotacoes($value){
        $this->anotacoes = $value;
    }

    public function getPeso(){
        return $this->peso;
    }
    public function setPeso($value){
        $this->peso = $value;
    }

    public function getCpf(){
        return $this->Cpf;
    }
    public function setCpf($value){
        $this->cpf = $value;
    }

    public function getId():int {
        return $this->id;
    }
    public function setId($value){
        $this->id = $value;
    }

    public function getPlanoId() {
        return $this->idPlano;
    }

    public function setPlanoId($value) {
        $this->idPlano = $value;
    }

    public function setData($data){
        $row = $data[0];

        $this->setId($row['id']);
        $this->setNome($row['nome']);
        $this->setCpf($row['cpf']);
        $this->setEmail($row['email']);
        $this->setSenha($row['senha']);
        $this->setTelefone($row['telefone']);
        $this->setdt_nascimento($row['dataNascimento']);
        $this->setPeso($row['peso']);
        $this->setObjetivo($row['objetivo']);
        $this->setAnotacoes($row['anotacoes']);
        $this->setdt_acompanhamento($row['inicio_acompanhamento']);
    }

    // public function retornaRefeicoes(){
    //     $sql = new Sql();
    //     $results = $sql->select("select pacientes_alimentos.nome fro");
    // }

    public function loadbyId($id){
        $sql= new Sql();
        $results=$sql->select("SELECT * FROM pacientes WHERE id=:ID",array(
            ":ID"=>$id
        ));
        if (count ($results)>0) {
           $this->setData($results); 
        }

    }

    // Função que retorna o array com dicas do nutri
    public function returnDicas(){
        $sql = new Sql();
        $results = $sql->select(
            "select tb_dicas.dica 
            from tb_dicas, tb_dicas_pacientes, pacientes
            where id_paciente = pacientes.id AND
            id_dica = tb_dicas.id AND
            pacientes.id = :ID"
            , array(
                ':ID'=>$this->getId()
            ));
        
            return $results;
        
    }

    //Função que atualiza no banco os dados presentes no objeto;
    public function updatePaciente(){
        $sql = new Sql();
        $sql->query("
        update pacientes set
        nome =  :NOME,
        email = :EMAIL,
        senha = :SENHA,
        dataNascimento = :DATA,
        telefone = :TEL
        where id = :ID
        ", array(
            ':NOME'=>$this->getNome(),
            ':EMAIL'=>$this->getEmail(),
            ':SENHA'=>$this->getSenha(),
            ':TEL'=>$this->getTelefone(),
            ':DATA'=>$this->getdt_nascimento(),
            ':ID'=>$this->getId()
        )
        );
    }

    // Função que retorna as refeições.
    public static function returnRefeicoes(){
        $sql = new Sql();
        $results = $sql->select("select nome from tb_refeicoes");
        return $results;
    }

    public function __toString(){
        return "<strong>Dados do usuário: </strong><br>
        Nome: ".$this->getNome()."<br>
        Email: ".$this->getEmail()."<br>
        Senha: ".$this->getSenha()."<br>";
    }

    // Retorna o id da refeição a partir do nome
    public static function returnIdbyName($name){
        $sql = new Sql();
        $results = $sql->select("
        select id from tb_refeicoes where
        nome = :NAME 
        ", array(
            ':NAME'=>$name
        ));

        foreach ($results as $result) {
            foreach ($result as $key => $value) {
                $idref = $value;
            }
        }

        return $idref;
    }

    // Retorna todas as datas em que alimentos foram registrados
    public function getAllDateByRef($ref){
        $sql = new Sql();
        $dates = $sql->select("
        select data from alimentos_consumidos, tb_refeicoes where 
        id_paciente = :IDPACIENTE and
        id_refeicao = tb_refeicoes.id and
        tb_refeicoes.nome = :NOME
        group by data
        ", array(
            ':IDPACIENTE'=>$this->getId(),
            ':NOME'=>$ref
        ));

        return $dates;
    }

    public function getPersonalizeDateByRef($inic, $fin, $ref){
        $sql = new Sql();
        $dates = $sql->select("
        select data from alimentos_consumidos, tb_refeicoes where 
        id_paciente = :IDPACIENTE and
        id_refeicao = tb_refeicoes.id and
        tb_refeicoes.nome = :NOME and
        data between cast(:INICIAL as date) and cast(:FINAL as date)
        group by data
        ", array(
            ':IDPACIENTE'=>$this->getId(),
            ':NOME'=>$ref,
            ':INICIAL'=>$inic,
            ':FINAL'=>$fin
        ));

        return $dates;
    }

    // Retorna os nomes dos alimentos consumidos de acordo com a data
    public function getAlimentosByDate($date, $idrefeicao){
        $sql = new Sql();
        $alimentos = $sql->select("
        select alimentos.nome from alimentos, alimentos_consumidos, pacientes, tb_refeicoes where
        alimentos_consumidos.id_alimento = alimentos.id and
        alimentos_consumidos.id_paciente = :IDPACIENTE and
        alimentos_consumidos.id_refeicao = :IDREFEICAO and
        data = :DATA group by alimentos.nome
        ", array(
            ':IDPACIENTE'=>$this->getId(),
            ':IDREFEICAO'=>$idrefeicao,
            ':DATA'=>$date
        ));

        return $alimentos;
    }

    public function insertDica($dica) {
        $iddica = $this->getIdDicabyName($dica);

        $sql = new Sql();
        $sql->query("
        insert into tb_dicas_pacientes (id_dica, id_paciente) values
        (:IDDICA, :IDPACIENTE)
        ", array(
            ':IDDICA'=>$iddica,
            ':IDPACIENTE'=>$this->getId()
        ));
    } 

    public function removeDica($dica) {
        $iddica = $this->getIdDicabyName($dica);

        $sql = new Sql();
        $sql->query("
        delete from tb_dicas_pacientes where
        id_dica = :IDDICA and
        id_paciente = :IDPACIENTE
        ", array(
            ':IDDICA'=>$iddica, 
            ':IDPACIENTE'=>$this->getId()
        ));
    }

    public function getIdDicabyName($dica) {
        $sql = new Sql();
        $results = $sql->select("
        select id from tb_dicas where
        dica = :DICA
        ", array(
            ':DICA'=>$dica
        ));

        echo $dica;

        foreach ($results as $row) {
            foreach ($row as $key => $value) {
                $id = $value;
            }
        }

        return $id;
    }

    public function login($email,$senha){
        global $pdo;
        
        $sql="SELECT id, senha FROM pacientes where email=:email";
            
        $sql=$pdo->prepare($sql);
        $sql->bindValue("email",$email);
        $sql->execute();
    
        if($sql->rowCount()>0){
            $dado = $sql->fetch();
            if (password_verify($senha, $dado["senha"])){
                $_SESSION["id"]= $dado["id"];
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }


    public function InserirPaciente($nome,$telefone,$email,$senha,$dataNascimento,$cpf){
        $sql=new Sql();
        $sql->query("insert into pacientes(nome,telefone,dataNascimento,email,senha,cpf) values(:NOME,:TELEFONE,:DATANASCIMENTO,:EMAIL,:SENHA,:CPF",array(
            ':NOME'=>$nome,
            ':TELEFONE'=>$telefone,
            ':DATANASCIMENTO'=>$dataNascimento,
            ':EMAIL'=>$email,
            ':SENHA'=>$senha,
            ':CPF'=>$cpf
        ));
        header("location:tela_login.php");

    }

    public function ValidaNumero($telefone){

        $sql=new Sql();

        $results=$sql->select("select * from pacientes where telefone=:telefone ",array(
            ':telefone'=>$telefone
        ));

        if (count($results)>0){
        return true;

    }
    }
    public function ValidaEmail($email){

        $sql=new Sql();

        $results=$sql->select("select * from pacientes where email=:email ",array(
            ':email'=>$email
        ));

        if (count($results)>0){
        return true;

    }
    }
    public function ValidaCpf($cpf){

        $sql=new Sql();

        $results=$sql->select("select * from pacientes where cpf=:cpf ",array(
            ':cpf'=>$cpf
        ));

        if (count($results)>0){
        return true;

         }
    }

    public function autoRemove(){
        $sql = new Sql();
        $sql->query("
        delete from tb_dicas_pacientes where
        id_paciente = :ID
        ",  array(
            ':ID'=>$this->getId()
        ));

        $sql->query("
        delete from alimentos_consumidos where
        id_paciente = :ID
        ",  array(
            ':ID'=>$this->getId()
        ));

        $sql->query("
        delete from tb_refeicoes_alimentos, tb_planos where
        id_plano = tb_planos.id and
        tb_planos.id_paciente = :ID
        ",  array(
            ':ID'=>$this->getId()
        ));

        $sql->query("
        delete from tb_planos_refeicoes, tb_planos where
        id_plano = tb_planos.id and
        tb_planos.id_paciente = :ID
        ",  array(
            ':ID'=>$this->getId()
        ));

        $sql->query("
        delete from tb_planos where
        id_paciente = :ID
        ",  array(
            ':ID'=>$this->getId()
        ));

        $sql->query("
        delete from pacientes where
        id = :ID
        ",  array(
            ':ID'=>$this->getId()
        ));

    }

    public function insertPlanoId(){
        $sql = new Sql();
        $results = $sql->select("
        select id from tb_planos where id_paciente = :ID
        ", array(
            ':ID'=>$this->getId()
        ));

        foreach ($results as $result) {
            foreach($result as $key => $value){
                $idPlano = $value;
            }
        }

        $sql->query("update pacientes set id_plano = :ID where id = :IDPA", array(
            ':ID'=>$idPlano,
            ':IDPA'=>$this->getId()
        ));
    }

    public function loadPlanoId(){
        $sql = new Sql();
        $ids = $sql->select("
        select id from tb_planos where
        id_paciente = :IDPACIENTE
        ", array(
            ':IDPACIENTE'=>$this->getId()
        ));

        foreach ($ids as $id) {
            foreach ($id as $key => $value) {
                $this->setPlanoId($value);
            }
        }
    }

    public function MediaCalorias(){
        $sql=new Sql();
        $results= $sql->query("
        select avg(calorias) from alimentos,alimentos_consumidos,pacientes
        where  alimentos_consumidos.id_paciente = :ID and
        pacientes.id = alimentos_consumidos.id_paciente
        ", array(
            'ID'=>$this->getId()
            
        ));
        
        foreach ($results as $result) {
            foreach ($result as $key => $value) {
                return $value;
            }
        }
       
    }
   

    public function MaxCalorias(){
        $sql=new Sql();
        $results= $sql->query("
        select max(calorias) from alimentos,alimentos_consumidos,pacientes
        where  alimentos_consumidos.id_paciente = :ID and
        pacientes.id = alimentos_consumidos.id_paciente
        ", array(
            'ID'=>$this->getId()
            
        ));
        
        foreach ($results as $result) {
            foreach ($result as $key => $value) {
                return $value;
            }
        }
       
    }

    public function MinCalorias(){
        $sql=new Sql();
        $results= $sql->query("
        select min(calorias) from alimentos,alimentos_consumidos,pacientes
        where  alimentos_consumidos.id_paciente = :ID and
        pacientes.id = alimentos_consumidos.id_paciente
        ", array(
            'ID'=>$this->getId()
            
        ));
        
        foreach ($results as $result) {
            foreach ($result as $key => $value) {
                return $value;
            }
        }
       
    }
    public function MediaCarboidratos(){
        $sql=new Sql();
        $results= $sql->query("
        select avg(carboidratos) from alimentos,alimentos_consumidos,pacientes
        where  alimentos_consumidos.id_paciente = :ID and
        pacientes.id = alimentos_consumidos.id_paciente
        ", array(
            'ID'=>$this->getId()
            
        ));
        
        foreach ($results as $result) {
            foreach ($result as $key => $value) {
                return $value;
            }
        }
       
    }

    public function MediaProteinas(){
        $sql=new Sql();
        $results= $sql->query("
        select avg(proteinas) from alimentos,alimentos_consumidos,pacientes
        where  alimentos_consumidos.id_paciente = :ID and
        pacientes.id = alimentos_consumidos.id_paciente
        ", array(
            'ID'=>$this->getId()
            
        ));
        
        foreach ($results as $result) {
            foreach ($result as $key => $value) {
                return $value;
            }
        }
       
    }

    public function MediaGorduras(){
        $sql=new Sql();
        $results= $sql->query("
        select avg(gorduras) from alimentos,alimentos_consumidos,pacientes
        where  alimentos_consumidos.id_paciente = :ID and
        pacientes.id = alimentos_consumidos.id_paciente
        ", array(
            'ID'=>$this->getId()
            
        ));
        
        foreach ($results as $result) {
            foreach ($result as $key => $value) {
                return $value;
            }
        }
       
    }

 
    public function MaxCaloriasByDate($inicio,$fim){
        $sql=new Sql();
        $results= $sql->query("
        select max(calorias) from alimentos,alimentos_consumidos,pacientes
        where  alimentos_consumidos.id_paciente = :ID and
        data between cast(:data_ini as date) and  cast(:data_fim as date)
        ", array(
            'ID'=>$this->getId(),
            ':data_ini'=>$inicio,
            ':data_fim'=>$fim
            
        ));
        
        foreach ($results as $result) {
            foreach ($result as $key => $value) {
                return $value;
            }
        }
       
    }
    public function MinCaloriasByDate($inicio,$fim){
        $sql=new Sql();
        $results= $sql->query("
        select min(calorias) from alimentos,alimentos_consumidos,pacientes
        where  alimentos_consumidos.id_paciente = :ID and
        pacientes.id = alimentos_consumidos.id_paciente and
        data between cast(:data_ini as date) and  cast(:data_fim as date)
        ", array(
            'ID'=>$this->getId(),
            ':data_ini'=>$inicio,
            ':data_fim'=>$fim
            
        ));
        
        foreach ($results as $result) {
            foreach ($result as $key => $value) {
                return $value;
            }
  }
       
    }
    public function MediaCaloriasByDate($inicio,$fim){
        $sql=new Sql();
        $results= $sql->query("
        select avg(calorias) from alimentos,alimentos_consumidos,pacientes
        where  alimentos_consumidos.id_paciente = :ID and
        pacientes.id = alimentos_consumidos.id_paciente and
        data between cast(:data_ini as date) and  cast(:data_fim as date)
        ", array(
            'ID'=>$this->getId(),
            ':data_ini'=>$inicio,
            ':data_fim'=>$fim
            
        ));
        
        foreach ($results as $result) {
            foreach ($result as $key => $value) {
                return $value;
            }
        }
       
    }
    public function MediaCarboidratosByDate($inicio,$fim){
        $sql=new Sql();
        $results= $sql->query("
        select avg(carboidratos) from alimentos,alimentos_consumidos,pacientes
        where  alimentos_consumidos.id_paciente = :ID and
        pacientes.id = alimentos_consumidos.id_paciente and
        data between cast(:data_ini as date) and  cast(:data_fim as date)
        ", array(
            'ID'=>$this->getId(),
            ':data_ini'=>$inicio,
            ':data_fim'=>$fim
            
        ));
        
        foreach ($results as $result) {
            foreach ($result as $key => $value) {
                return $value;
            }
        }
       
    }
    public function MediaProteinasByDate($inicio,$fim){
        $sql=new Sql();
        $results= $sql->query("
        select avg(proteinas) from alimentos,alimentos_consumidos,pacientes
        where  alimentos_consumidos.id_paciente = :ID and
        pacientes.id = alimentos_consumidos.id_paciente and
        data between cast(:data_ini as date) and  cast(:data_fim as date)
        ", array(
            'ID'=>$this->getId(),
            ':data_ini'=>$inicio,
            ':data_fim'=>$fim
            
        ));
        
        foreach ($results as $result) {
            foreach ($result as $key => $value) {
                return $value;
            }
        }
       
    }
    public function MediaGordurasByDate($inicio,$fim){
        $sql=new Sql();
        $results= $sql->query("
        select avg(gorduras) from alimentos,alimentos_consumidos,pacientes
        where  alimentos_consumidos.id_paciente = :ID and
        pacientes.id = alimentos_consumidos.id_paciente and
        data between cast(:data_ini as date) and  cast(:data_fim as date)
        ", array(
            'ID'=>$this->getId(),
            ':data_ini'=>$inicio,
            ':data_fim'=>$fim
            
        ));
        
        foreach ($results as $result) {
            foreach ($result as $key => $value) {
                return $value;
            }
        }
       
    }
}

?>
<?php
        
/*  Classe de interação do banco da subcategoria
    Autor: Vinicius Domiciano
    Data de Criação: 07/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class SubcategoriaDAO{
    private $conexaoMysql;
    private $conexao;
    
    //construtor
    public function __construct(){
        require_once("conexaoMysql.php");
        require_once('model/subcategoriaClass.php');
        //instancia da conexao com o banco
        $this->conexaoMysql = new ConexaoMysql();
        //criando a conexao
        $this->conexao = $this->conexaoMysql->conectDataBase();
        
    }
    
    //insert
    public function insertSubcategoria(SubcategoriaClass $subcategoria){
        $sql = "insert into tblsubcategoria (nome_subcategoria,status) value(?,?)";
        
        $statement = $this->conexao->prepare($sql);
        $statementDados = array(
            $subcategoria->getNome(),
            1
        );
        
        if($statement->execute($statementDados)){
            return true;
        }else{
            return false;
        }
        
    }
    
    //Update
    public function updateSubcategoria(SubcategoriaClass $subcategoria){
        $sql= 'update tblsubcategoria set nome_subcategoria =? where id_subcategoria =?';
        $statement= $this->conexao->prepare($sql);
        $statementDados = array(
            $subcategoria->getNome(),
            $subcategoria->getCodigo()
        );
        
        if($statement->execute($statementDados)){
            return true;
        }else{
            return false;
        }
    }
    
    //Delete
    public function deleteSubcategoria($idSubcategoria){
        $sql = 'delete from tblsubcategoria where id_subcategoria ='.$idSubcategoria;
        if($this->conexao->query($sql)){
            return true;
        }else{
            return false;
        }
    }
    
    //Select all
    public function selectAllSubcategoria(){
        $sql= 'select * from tblsubcategoria';
        $select = $this->conexao->query($sql);
        //contador
        $cont = 0;
        while($rs = $select->fetch(PDO::FETCH_ASSOC)){
            //CRIANDO COLEÇÃO DE OBJETOS
            $listSubcategoria[] = new SubcategoriaClass();
            $listSubcategoria[$cont]->setCodigo($rs['id_subcategoria']);
            $listSubcategoria[$cont]->setNome($rs['nome_subcategoria']);
            $listSubcategoria[$cont]->setStatus($rs['status']);
            $cont ++;
        }
        
        if(isset($listSubcategoria)){
            return  $listSubcategoria;
        }else{
            return false;
        }
        
    }
    
    //Select by id
    public function selectByIdSubcategoria($id){
        $sql='select * from tblsubcategoria where id_subcategoria = '.$id;
        $select = $this->conexao->query($sql);
        
        if($rs = $select->fetch(PDO::FETCH_ASSOC)){
            $listSubcategoria = new SubcategoriaClass();
            $listSubcategoria->setCodigo($rs['id_subcategoria']);
            $listSubcategoria->setNome($rs['nome_subcategoria']);
        }
        
        return $listSubcategoria;
        
    }
    
    //update status By id
    public function updateStatus($codigo, $status){
        $sql = 'update tblsubcategoria set status = ? where id_subcategoria = ?';
        
        $statement = $this->conexao->prepare($sql);
        $statementDados = array(
            $status,
            $codigo
        );
        
        if($statement->execute($statementDados)){
            return true;
        }else{
            return false;
        }
        
    }
    
    //select status by id
    public function selectByStatus(){
        $sql = 'select * from tblsubcategoria where status = 1';
        
        $select = $this->conexao->query($sql);
        $cont = 0;
        while($rs = $select->fetch(PDO::FETCH_ASSOC)){
            $listSubcategoria[] = new SubcategoriaClass();
            $listSubcategoria[$cont]->setCodigo($rs['id_subcategoria']);
            $listSubcategoria[$cont]->setNome($rs['nome_subcategoria']);
            $listSubcategoria[$cont]->setStatus($rs['status']);
            $cont ++;
        }
        
        if(isset($listSubcategoria)){
            return $listSubcategoria;
        }else{
            return false;
        }
        
    }
    
    //desativar status produto by id
    public function desativarProduto($codigo){
        $sql = "update tblproduto set status = 0 where codigo_subcategoria = ?";
        
        $statement = $this->conexao->prepare($sql);
        $statementDados = array(
            $codigo
        );
        
        if($statement->execute($statementDados)){
            return true;
        }else{
            return false;
        }
        
    }
    
    
}

?>
<?php

/*  Classe com interação com os bancos da categoria
    Autor: Vinicius Domiciano
    Data de Criação: 08/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class CategoriaDAO {
    private $conexaoMysql;
    private $conexao;
    
    
    //construtor
    public function __construct(){
        require_once("conexaoMysql.php");
        require_once("model/categoriaClass.php");
        //instancia a classe de conexao;
        $this->conexaoMysql = new ConexaoMysql();
        //criando conexao
        $this->conexao = $this->conexaoMysql->conectDataBase();
    }
    
    //insert
    public function insertCategoria(CategoriaClass $categoria){
        $sql = 'insert into tblcategoria (nome_categoria,status) value(?,?)';
        $statement = $this->conexao->prepare($sql);
        $statementDados = array(
            $categoria->getNome(),
            1
        );
        
        if($statement->execute($statementDados)){
            return true;
        }else{
            return false;
        }
        
    }
    
    //update
    public function updateCategoria(CategoriaClass $categoria){
        $sql = "update tblcategoria set nome_categoria = ? where id_categoria = ?";
        $statement = $this->conexao->prepare($sql);
        $statementDados = array(
            $categoria->getNome(),
            $categoria->getCodigo()
        );
        
        if($statement->execute($statementDados)){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function updateStatus($codigo, $status){
        $sql = 'update tblcategoria set status = ? where id_categoria = ?';
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
    
    //desativar status produto by id
    public function desativarProduto($idcategoria){
        $sql = "update tblproduto set status = 0 where codigo_categoria = ?";
        
        $statement = $this->conexao->prepare($sql);
        $statementDados = array(
            $idcategoria
        );
        
        if($statement->execute($statementDados)){
            return true;
        }else{
            return false;
        }
        
    }
    
    
    //delete
    public function deleteCategoria($idcategoria){
        $sql = 'delete from tblcategoria where id_categoria ='.$idcategoria;
        if($this->conexao->query($sql)){
            return true;
        }else{
            return false;
        }
    }
    
    //select All
    public function selectAllCategoria(){
        $sql= 'select * from tblcategoria';
        $select = $this->conexao->query($sql);
        //contador
        $cont = 0;
        while($rs = $select->fetch(PDO::FETCH_ASSOC)){
            //CRIANDO COLEÇÃO DE OBJETOS
            $listcategoria[] = new CategoriaClass();
            $listcategoria[$cont]->setCodigo($rs['id_categoria']);
            $listcategoria[$cont]->setNome($rs['nome_categoria']);
            $listcategoria[$cont]->setStatus($rs['status']);
            
            $cont ++;
        }
        
        if(isset($listcategoria)){
            return $listcategoria;
        }else{
            return false;
        }
    }
    
    //select by status
    public function selectCategoriaByStatus(){
        $sql= 'select * from tblcategoria where status = 1';
        $select = $this->conexao->query($sql);
        //contador
        $cont = 0;
        while($rs = $select->fetch(PDO::FETCH_ASSOC)){
            //CRIANDO COLEÇÃO DE OBJETOS
            $listcategoria[] = new CategoriaClass();
            $listcategoria[$cont]->setCodigo($rs['id_categoria']);
            $listcategoria[$cont]->setNome($rs['nome_categoria']);
            $listcategoria[$cont]->setStatus($rs['status']);
            
            $cont ++;
        }
        
        if(isset($listcategoria)){
            return $listcategoria;
        }else{
            return false;
        }
    }
    
    //select by id
    public function selectByIDCategoria($id){
        $sql='select * from tblcategoria where id_categoria = '.$id;
        $select = $this->conexao->query($sql);
        
        if($rs = $select->fetch(PDO::FETCH_ASSOC)){
            $listCategoria = new CategoriaClass();
            $listCategoria->setCodigo($rs['id_categoria']);
            $listCategoria->setNome($rs['nome_categoria']);
        }
        
        return $listCategoria;
    }
}

?>
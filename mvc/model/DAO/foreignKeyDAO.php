<?php
/*  Classe com interação com os bancos da fk categoria
    Autor: Vinicius Domiciano
    Data de Criação: 08/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class ForeignKeyDAO{
    
    //construtor
    public function __construct(){
        require_once("conexaoMysql.php");
        require_once("model/categoriaClass.php");
        
        //instancia a classe de conexao;
        $this->conexaoMysql = new ConexaoMysql();
        //criando conexao
        $this->conexao = $this->conexaoMysql->conectDataBase();
    }
    
    //select na categoria inserida
    public function selectUltimaCategoria(){
        $sql = "select * from tblcategoria ORDER BY id_categoria DESC LIMIT 1";
        $select = $this->conexao->query($sql);
        
        if($rs = $select->fetch(PDO::FETCH_ASSOC)){
            $codigo = $rs['id_categoria'];
        }
        
        if(isset($codigo)){
            return $codigo;
        }
    }
    
    //insert na tabela de ralacionameto de categoria e subcategoria
    public function insertFKCategoria(CategoriaClass $categoria){
        $subcategoria = $categoria->getCodigoSubcategoria();
        
        $cont = 0;
        while($cont < count($subcategoria)){
            $sql = "insert into categoria_subcategoria (id_categoria, id_subcategoria) 
            values (".$categoria->getCodigo().",".$subcategoria[$cont].")";
            $this->conexao->query($sql);
            $cont ++;
            
        }
    }
    
    //select da categorias relacionadas
    public function selectWhereCategoria($idCategoria){
        $sql = 'select categoria_subcategoria.*, tblsubcategoria.* from categoria_subcategoria inner join tblsubcategoria
        on categoria_subcategoria.id_subcategoria = tblsubcategoria.id_subcategoria
        where tblsubcategoria.status = 1 and categoria_subcategoria.id_categoria = '.$idCategoria;
        $select = $this->conexao->query($sql);
        
        //contador
        $cont = 0;
        while($rs = $select->fetch(PDO::FETCH_ASSOC)){
            //CRIANDO COLEÇÃO DE OBJETOS
            $listFk[] = new CategoriaClass();
            $listFk[$cont]->setCodigo($rs['id_categoria']);
            $listFk[$cont]->setNome($rs['nome_subcategoria']);
            
            $cont ++;
        }
        
        if(isset($listFk)){
            return $listFk;
        }else{
            return false;
        }
    }
    
    //select subcategorias fk
    public function selectFkCategoria($idCategoria){
        $sql = "select tblsubcategoria.*, categoria_subcategoria.id_categoria from tblsubcategoria inner join categoria_subcategoria on tblsubcategoria.id_subcategoria = categoria_subcategoria.id_subcategoria where tblsubcategoria.status = 1 and categoria_subcategoria.id_categoria =".$idCategoria;
        $select = $this->conexao->query($sql);
        
        //contador
        $cont = 0;
        while($rs = $select->fetch(PDO::FETCH_ASSOC)){
            
            $arraySubcategoria[$cont] = $rs['id_subcategoria'];
            
            $cont ++;
        }
        
        if(isset($arraySubcategoria)){
            return $arraySubcategoria;
        }else{
            return false;
        }
    }
    
    //delete
    public function deleteFkCategoria($idCategoria){
        $sql = 'delete from categoria_subcategoria where id_categoria ='.$idCategoria;
        if($this->conexao->query($sql)){
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteSubcategoria($idSubcategoria){
        $sql = 'delete from categoria_subcategoria where id_subcategoria ='.$idSubcategoria;
        if($this->conexao->query($sql)){
            return true;
        }else{
            return false;
        }
    }
    
    
    public function selectBySubcategoria($id){
        $sql = "select categoria_subcategoria.*,tblsubcategoria.nome_subcategoria,
                tblsubcategoria.id_subcategoria as codigo 
                from tblsubcategoria
                inner join 
                categoria_subcategoria on tblsubcategoria.id_subcategoria = categoria_subcategoria.id_subcategoria
                where tblsubcategoria.status = 1 and categoria_subcategoria.id_categoria =".$id;
        
        $select = $this->conexao->query($sql);
        
        //contador
        $cont = 0;
        while($rs = $select->fetch(PDO::FETCH_ASSOC)){
            //CRIANDO COLEÇÃO DE OBJETOS
            $list[] = new SubcategoriaClass();
            $list[$cont]->setCodigo($rs['codigo']);
            $list[$cont]->setNome($rs['nome_subcategoria']);
            
            $cont ++;
        }
        
        if(isset($list)){
            return $list;
        }else{
            return false;
        }
        
    }
    
    public function selectCategoriaBySubcategoria($id){
        $sql = "select categoria_subcategoria.*,tblsubcategoria.nome_subcategoria,
                tblsubcategoria.id_subcategoria as codigo
                from tblsubcategoria
                inner join
                categoria_subcategoria on tblsubcategoria.id_subcategoria = categoria_subcategoria.id_subcategoria
                where tblsubcategoria.status = 1 and categoria_subcategoria.id_subcategoria =".$id;
        
        $select = $this->conexao->query($sql);
        
        //contador
        $cont = 0;
        while($rs = $select->fetch(PDO::FETCH_ASSOC)){
            //CRIANDO COLEÇÃO DE OBJETOS
            $list[] = new SubcategoriaClass();
            $list[$cont]->setCodigo($rs['codigo']);
            $list[$cont]->setNome($rs['nome_subcategoria']);
            
            $cont ++;
        }
        
        if(isset($list)){
            return $list;
        }else{
            return false;
        }
        
    }
    
}

?>
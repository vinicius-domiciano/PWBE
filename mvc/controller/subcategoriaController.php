<?php
    
/*  Classe controller da subcategoria
    Autor: Vinicius Domiciano
    Data de Criação: 07/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class SubcategoriaController{
    
    private $subcategoria;
    
    public function __construct(){
        require_once("model/subcategoriaClass.php");
        require_once('model/DAO/subcategoriaDAO.php');
        require_once('model/DAO/foreignKeyDAO.php');

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnSalvar'])){
            //instancia da subcategoriaClass
            $this->subcategoria = new SubcategoriaClass();
            
            $this->subcategoria->setNome($_POST['txtnome']);                
            
        }
        
    }
    
    //Adicionar uma nova Subcategoria
    public function novaSubcategoria(){
        $subcategoriaDAO = new SubcategoriaDAO();
        //enviando o objeto para o insert
        if($subcategoriaDAO->insertSubcategoria($this->subcategoria)){
            echo("
            <script>
                window.location = 'index.php?location=subcategoria';
            </script>
            ");
        }else{
            echo('erro ao inserir no banco');
        }
        
        
    }
    
    //Atualiza a subcategoria
    public function atualizarSubcategoria($idSubcategoria){
        $this->subcategoria->setCodigo($idSubcategoria);
        $subcategoriaDAO = new SubcategoriaDAO();
        if($subcategoriaDAO->updateSubcategoria($this->subcategoria)){
            echo("
            <script>
               window.location = 'index.php?location=subcategoria';
            </script>
            ");
        }else{
            echo('Não foi possivel Atualizar o Registro');
        }
        
    }
    
    //exclui uma subcategoria
    public function deletarSubcategoria($idSubcategoria){
        //instancia da DAO
        $foreignKeyDAO = new ForeignKeyDAO();
        $subcategoriaDAO = new SubcategoriaDAO();
        if($foreignKeyDAO->deleteSubcategoria($idSubcategoria)){
            if($subcategoriaDAO->desativarProduto($idSubcategoria) && $subcategoriaDAO->deleteSubcategoria($idSubcategoria)){
                echo("
            <script>
                window.location = 'index.php?location=subcategoria';
            </script>
            ");
            }  
        }else{
            echo('Não foi possivel Deletar o Reginstro');
        }
    }
    
    //lista todas subcategoria
    public function listarSubcategoria(){
        //instancia da subcategoriaDAO
        $subcategoriaDAO = new SubcategoriaDAO();
        //Metodo para obter todos registros
        $list = $subcategoriaDAO->selectAllSubcategoria();
        
        if($list){
            return $list;
        }else{
            die();
        }
    }
    
    //busca uma subcategoria pelo id
    public function buscarSubcategoria($id){
            //instancia da classe
            $subcategoriaDAO = new SubcategoriaDAO();
            $dadosSubcategoria = $subcategoriaDAO->selectByIdSubcategoria($id);
            require_once('index.php');
        
    }
    
    //busca uma subcategoria pelo id para modal
    public function buscarSubcategoriaModal($id){
            //instancia da classe
            $subcategoriaDAO = new SubcategoriaDAO();
            $dadosSubcategoria = $subcategoriaDAO->selectByIdSubcategoria($id);
            return $dadosSubcategoria;
        
    }
    
    public function selectForeignKey($id){
        $foreignKeyDAO = new ForeignKeyDAO();
        $list = $foreignKeyDAO->selectBySubcategoria($id);
        
        if($list){
            return $list;
        }else{
            die();
        }
    }
    
//    buscar as subcategoria com status 1
    public function buscarStatusSubcategoria(){
        //instancia do DAO
        $subcategoriaDAO = new SubcategoriaDAO();
        $list = $subcategoriaDAO->selectByStatus();
        
        if($list){
            return $list;
        }else{
            return false;
        }
        
    }
    
    
    //atualizar o status
    public function atualizarStatus($codigo, $status){
        //instancia do DAO
        $subcategoriaDAO = new SubcategoriaDAO();
        if($status == 0){
            $subcategoriaDAO->desativarProduto($codigo);
        }
        if($subcategoriaDAO->updateStatus($codigo, $status)){
            echo("
            <script>
                window.location = 'index.php?location=subcategoria';
            </script>
            ");
        }else{
            echo('Não foi possivel Atualizar o Registro');
        }
        
    }
    
}

?>
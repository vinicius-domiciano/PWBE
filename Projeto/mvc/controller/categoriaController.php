<?php
/*  Classe controller da categoria
    Autor: Vinicius Domiciano
    Data de Criação: 08/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class CategoriaController{
    private $categoria;

    public function __construct(){
        require_once('model/categoriaClass.php');
        require_once('model/DAO/categoriaDAO.php');
        require_once('model/DAO/foreignKeyDAO.php');
        
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnSalvar'])){
            //instancia da classe categoriaClass;
            $this->categoria = new CategoriaClass();
            //gardando atributos
            $this->categoria->setNome($_POST['txtnome']);
            $this->categoria->setCodigoSubcategoria($_POST['chkConteudo']);
        }
        
    }
    
    //adicionar nova categoria
    public function novaCategoria(){
        //instancia da classe de interação com o banco
        $categoriaDAO = new CategoriaDAO();
        $foreignKeyDAO = new ForeignKeyDAO();
        
        if($categoriaDAO->insertCategoria($this->categoria)){
            $dados= $foreignKeyDAO->selectUltimaCategoria();
            $this->categoria->setCodigo($dados);
            $foreignKeyDAO->insertFKCategoria($this->categoria);
            echo("
            <script>
                window.location = 'index.php?location=categoria';
            </script>
            ");
        }
    }
    
    //Atuliza a categoria
    public function atualizarCategoria($idcategoria){
        //instancia do metodo de chave relacionada
        $foreignKeyDAO = new ForeignKeyDAO();
        //instancia da classe DAO
        $categoriaDAO = new CategoriaDAO();
        //adicionado o codigo no atributos
        $this->categoria->setCodigo($idcategoria);
        //deletando os Foreign keys
        $foreignKeyDAO->deleteFkCategoria($idcategoria);
        //inserindo os dados na tabela de relacionamento dos dados
        $foreignKeyDAO->insertFKCategoria($this->categoria);
        if($categoriaDAO->updateCategoria($this->categoria)){
            echo("
            <script>
                window.location = 'index.php?location=categoria';
            </script>
            ");
        }else{
            echo("nao foi possivel atualizar o registro");
        }
        
        
    }
    
    //deletar categoria
    public function deletarCategoria($idcategoria){
        $categoriaDAO = new CategoriaDAO();
        $foreignKeyDAO = new ForeignKeyDAO();
        
        if($foreignKeyDAO->deleteFkCategoria($idcategoria)){
            if($categoriaDAO->desativarProduto($idcategoria) && $categoriaDAO->deleteCategoria($idcategoria))
            echo("
            <script>
                window.location = 'index.php?location=categoria';
            </script>
            ");
        }else{
            echo('Não foi possivel Deletar o Reginstro');
        }
    }
    
    //listar todas categorias
    public function listarCategoria(){
        //instancia da subcategoriaDAO
        $categoriaDAO = new CategoriaDAO();
        //Metodo para obter todos registros
        $list = $categoriaDAO->selectAllCategoria();
        
        if($list){
            return $list;
        }else{
            die();
        }
    }
    
    //busca categorias pelo id
    public function buscarCategoria($id){
         //instancia da classe
        $CategoriaDAO = new CategoriaDAO();
        $dadosCategoria = $CategoriaDAO->selectByIdCategoria($id);
            require_once('index.php');
    }
    
    //buscar categiria pelo id
    public function buscarCategoriaModal($id){
         //instancia da classe
        $CategoriaDAO = new CategoriaDAO();
        $dadosCategoria = $CategoriaDAO->selectByIdCategoria($id);
         
        return $dadosCategoria;
    }
    
    //buscar categoria pelo status
    public function buscarStatusCategoria(){
        //instancia da subcategoriaDAO
        $categoriaDAO = new CategoriaDAO();
        //Metodo para obter todos registros
        $list = $categoriaDAO->selectCategoriaByStatus();
        
        if($list){
            return $list;
        }else{
            return false;
        }
    }
    
    //atualizar status da categoria
    public function atualizarStatus($id, $status){
        //instancia da classe
        $categoriaDAO = new CategoriaDAO();
        if($status == 0){
            $categoriaDAO->desativarProduto($id);
        }
        if($categoriaDAO->updateStatus($id, $status)){
            echo("
            <script>
                window.location = 'index.php?location=categoria';
            </script>
            ");
        }else{
            echo('Não foi possivel Deletar o Reginstro');
        }
    }
    
    
}

?>
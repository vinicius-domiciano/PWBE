<?php
    /*Ativando a variavel de sessaõ*/
    if( !isset($_SESSION)){
        session_start();
        /* ativando o recurso de variaveis de sessão */
    }
/*  Classe controller da produtos
    Autor: Vinicius Domiciano
    Data de Criação: 08/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class ProdutoController{
    private $produto;

    public function __construct(){
        //importando class de geter e seter e DAO
        require_once('model/produtoClass.php');
        require_once('model/DAO/produtoDAO.php');
        require_once('model/DAO/foreignKeyDAO.php');
        //varificando se  existe um requisito Post
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnSalvar'])){
            //instancia da subcategoriaClass
            $this->produto = new ProdutoClass();
            $this->produto->setNome($_POST['txtNome']);
            $this->produto->setPreco($_POST['txtPreco']);
            $this->produto->setCodigoCategoria($_POST['sltCategoria']);
            $this->produto->setCodigoSubcategoria($_POST['sltSubcategoria']);
            if(isset($_POST['chkPromocao'])){
                $this->produto->setPromocao($_POST['chkPromocao']);
                $this->produto->setValor($_POST['numValor']);
                $data_validade = explode("/", $_POST['txtValidade']);
                $data_validade = $data_validade[2]."-".$data_validade[1]."-".$data_validade[0];
                $this->produto->setValidade($data_validade);
            }else{
                $this->produto->setPromocao(0);
            }
            $this->produto->setDescricao($_POST['txtDescricao']);
            if(isset($_POST['chkProdutoMes'])){
                $this->produto->setProdutoDoMes($_POST['chkProdutoMes']);
            }else{
                $this->produto->setProdutoDoMes(0);
            }
            if(isset($_SESSION['previewFoto'])){
                $this->produto->setImagem($_SESSION['previewFoto']);
                unset($_SESSION['previewFoto']);
            }else{
                $this->produto->setImagem($_SESSION['foto']);
                unset($_SESSION['foto']);
            }

        }

    }

    //adicionar novo produto
    public function novoProduto(){
        //instancia da classe DAO e metodo de Insert
        $produtoDAO = new ProdutoDAO();
        if($produtoDAO->insertProduto($this->produto)){
           echo("
            <script>
                window.location = 'index.php?location=produtos';
            </script>
            ");
        }else{
            echo('erro ao inserir no banco');
        }
    }

    //editar
    public function atualizarProduto($codigo){
        $this->produto->setCodigo($codigo);
        //instancia da classe DAO e metodo de Insert
        $produtoDAO = new ProdutoDAO();
        if($produtoDAO->updateProduto($this->produto)){
           echo("
            <script>
                 window.location = 'index.php?location=produtos';
            </script>
            ");
        }else{
            echo('erro ao Atulizar o produto');
        }
    }

    //atualizar status
    public function atualizarStatus($codigo, $status){
        $produtoDAO = new ProdutoDAO();
        if($produtoDAO->updateStatus($codigo, $status)){
           echo("
            <script>
                 window.location = 'index.php?location=produtos';
            </script>
            ");
        }else{
            echo('erro ao Atulizar o status');
        }
    }

    //deletar
    public function deletarProduto($codigo, $imagem){
        $produtoDAO = new ProdutoDAO;
        if($produtoDAO->deleteProduto($codigo, $imagem)){
            echo("
            <script>
                 window.location = 'index.php?location=produtos';
            </script>
            ");
        }else{
            echo('erro ao deletar produto');
        }
    }

    //buscar todos produtos
    public function listarProdutos(){
        $produtoDAO = new ProdutoDAO();
        $list = $produtoDAO->selectAllProdutos();

        if($list){
            return $list;
        }

    }

    //buscar um unico produto
    public  function buscarProduto($codigo){
        $produtoDAO = new ProdutoDAO();
        $buscaDado = $produtoDAO->selectByIdProduto($codigo);

        require_once("index.php");

    }

    //buscar um unico produto para a modal
    public  function buscarProdutoModal($codigo){
        $produtoDAO = new ProdutoDAO();
        $buscaDado = $produtoDAO->selectByIdProduto($codigo);

        return $buscaDado;

    }

}

?>

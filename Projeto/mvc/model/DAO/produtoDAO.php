<?php

/*  Classe DAO do Produtos com interação com DB
    Autor: Vinicius Domiciano
    Data de Criação: 08/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/
class produtoDAO{
    
    private $conexaoMysql;
    private $conexao;
    
    public function __construct(){
        require_once('conexaoMysql.php');
        require_once('model/produtoClass.php');
        //instancia da classe do banco
        $this->conexaoMysql = new ConexaoMysql();
        //utlizando o metodo de conexao
        $this->conexao = $this->conexaoMysql->conectDataBase();
        
    }
    
    //insert
    public function insertProduto(ProdutoClass $produto){
        $sql = "insert into tblproduto (nome,codigo_categoria,preco,codigo_subcategoria,promocao,porcentagem,validade_promocao,descricao,produto_do_mes,imagem,status)
        values(?,?,?,?,?,?,?,?,?,?,?)";
        
        $statement = $this->conexao->prepare($sql);
        $statementDados = array(
            $produto->getNome(),
            $produto->getCodigoCategoria(),
            $produto->getPreco(),
            $produto->getCodigoSubcategoria(),
            $produto->getPromocao(),
            $produto->getValor(),
            $produto->getValidade(),
            $produto->getDescricao(),
            $produto->getProdutoDoMes(),
            $produto->getImagem(),
            1
        );
        
        if($statement->execute($statementDados)){
            return true;
        }else{var_dump($statementDados);
            return false;
        }
        
    }
    
    //update
    public function updateProduto(ProdutoClass $produto){
        $sql = 'update tblproduto set nome = ?,codigo_categoria=?,preco=?,codigo_subcategoria=?,promocao=?,porcentagem=?,validade_promocao=?,descricao=?,produto_do_mes=?,imagem=? where codigo =?';
        
        $statement = $this->conexao->prepare($sql);
        $statementDados = array(
            $produto->getNome(),
            $produto->getCodigoCategoria(),
            $produto->getPreco(),
            $produto->getCodigoSubcategoria(),
            $produto->getPromocao(),
            $produto->getValor(),
            $produto->getValidade(),
            $produto->getDescricao(),
            $produto->getProdutoDoMes(),
            $produto->getImagem(),
            $produto->getCodigo()
        
        );
        
        if($statement->execute($statementDados)){
            return true;
        }else{
            return false;
        }
        
    }
    
    //update status by id
    public function updateStatus($codigo, $status){
        $sql = "update tblproduto set status = ? where codigo = ?";
        
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
    
    //delete
    public function deleteProduto($codigo, $imagem){
        unlink('../imagens/'.$imagem);
        $sql = 'delete from tblproduto where codigo ='.$codigo;
        if($this->conexao->query($sql)){
            return true;
        }else{
            return false;
        }
        
    }
    
    //selectALL(*)
    public function selectAllProdutos(){
        $sql= 'select * from tblproduto';
        $select = $this->conexao->query($sql);
        //contador
        $cont = 0;
        while($rs = $select->fetch(PDO::FETCH_ASSOC)){
            //CRIANDO COLEÇÃO DE OBJETOS
            $listproduto[] = new ProdutoClass();
            $listproduto[$cont]->setCodigo($rs['codigo']);
            $listproduto[$cont]->setNome($rs['nome']);
            $listproduto[$cont]->setCodigoCategoria($rs['codigo_categoria']);
            $listproduto[$cont]->setCodigoSubcategoria($rs['codigo_subcategoria']);
            $listproduto[$cont]->setPreco($rs['preco']);
            $listproduto[$cont]->setPromocao($rs['promocao']);
            $listproduto[$cont]->setValor($rs['porcentagem']);
            $listproduto[$cont]->setDescricao($rs['descricao']);
            $listproduto[$cont]->setProdutoDoMes($rs['produto_do_mes']);
            $listproduto[$cont]->setImagem($rs['imagem']);
            $listproduto[$cont]->setStatus($rs['status']);
            $listproduto[$cont]->setDetalhes($rs['visualizacoes']);
            
            $cont ++;
        }
        
        if(isset($listproduto)){
            return $listproduto;
        }else{
            return false;
        }
    }
    
    //select by id (where)
    public function selectByIdProduto($codigo){
        $sql = 'select * from tblproduto where codigo='.$codigo;
        $select = $this->conexao->query($sql);
        //obtendo os dados
        if($rs = $select->fetch(PDO::FETCH_ASSOC)){
            //CRIANDO OBJETO PARA A BUSCA PELO ID
            $listproduto = new ProdutoClass();
            $listproduto->setCodigo($rs['codigo']);
            $listproduto->setNome($rs['nome']);
            $listproduto->setCodigoCategoria($rs['codigo_categoria']);
            $listproduto->setCodigoSubcategoria($rs['codigo_subcategoria']);
            $listproduto->setPreco($rs['preco']);
            $listproduto->setPromocao($rs['promocao']);
            $listproduto->setValor($rs['porcentagem']);
            $listproduto->setValidade($rs['validade_promocao']);
            $listproduto->setDescricao($rs['descricao']);
            $listproduto->setProdutoDoMes($rs['produto_do_mes']);
            $listproduto->setImagem($rs['imagem']);
        }
        
        return $listproduto;
        
    }
    
    
}


?>
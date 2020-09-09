<?php

        
/*  Classe de get e set do produtos
    Autor: Vinicius Domiciano
    Data de Criação: 10/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class ProdutoClass {
    
    private $codigo;
    private $nome;
    private $imagem;
    private $preco;
    private $promocao;
    private $valor;
    private $validade;
    private $codigoCategoria;
    private $codigoSubcategoria;
    private $descricao;
    private $produtoDoMes;
    private $status;
    private $detalhes;
    
    public function __construct(){
        
    }
    
    /***Geters e Seters***/
    
    public function getCodigo(){
        return $this->codigo;
    }
    
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    
    public function getNome(){
        return $this->nome;
    }
    
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    public function getImagem(){
        return $this->imagem;
    }
    
    public function setImagem($imagem){
        $this->imagem = $imagem;
    }
    
    public function getPreco(){
        return $this->preco;
    }
    
    public function setPreco($preco){
        $this->preco = $preco;
    }
    
    public function getPromocao(){
        return $this->promocao;
    }
    
    public function setPromocao($promocao){
        $this->promocao = $promocao;
    }
    
    public function getValor(){
        return $this->valor;
    }
    
    public function setValor($valor){
        $this->valor = $valor;
    }
    
    public function getValidade(){
        return $this->validade;
    }
    
    public function setValidade($validade){
        $this->validade = $validade;
    }
    
    public function getCodigoCategoria(){
        return $this->codigoCategoria;
    }
    
    public function setCodigoCategoria($codigoCategoria){
        $this->codigoCategoria = $codigoCategoria;
    }
    
    public function getCodigoSubcategoria(){
        return $this->codigoSubcategoria;
    }
    
    public function setCodigoSubcategoria($codigoSubcategoria){
        $this->codigoSubcategoria = $codigoSubcategoria;
    }
    
    public function getDescricao(){
        return $this->descricao;
    }
    
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    
    public function getProdutoDoMes(){
        return $this->produtoDoMes;
    }
    
    public function setProdutoDoMes($produtoDoMes){
        $this->produtoDoMes = $produtoDoMes;
    }
    
    public function getStatus(){
        return $this->status;
    }
    
    public function setStatus($status){
        $this->status = $status;
    }
    
    public function getDetalhes() {
        return $this->detalhes;
    }
    
    public function setDetalhes($detalhes) {
        $this->detalhes = $detalhes;
    }
}

?>
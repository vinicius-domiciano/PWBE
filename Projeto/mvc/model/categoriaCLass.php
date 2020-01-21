<?php
/*  Classe da categoria
    Autor: Vinicius Domiciano
    Data de Criação: 08/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class CategoriaClass {
    private $nome;
    private $codigo;
    private $codigoSubcategoria;
    private $status;
    //construtor
    public function __construct(){
        
    }
    
    /*Getters e Seters*/
    
    public function getNome(){
        return $this->nome;
    }
    
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    public function getCodigo(){
        return $this->codigo;
    }
    
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    
    public function getCodigoSubcategoria(){
        return $this->codigoSubcategoria; 
    }
    
    public function setCodigoSubcategoria($codigoSubcategoria){
        $this->codigoSubcategoria = $codigoSubcategoria;
    }
    
    public function getStatus(){
        return $this->status;
    }
    
    public function setStatus($status){
        $this->status = $status;
    }
    
}

?>
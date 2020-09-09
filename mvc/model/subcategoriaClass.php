<?php
        
/*  Classe de get e set da subcategoria
    Autor: Vinicius Domiciano
    Data de Criação: 07/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class SubcategoriaClass{
    private $nome;
    private $codigo;
    private $status;
    //construtor
    public function __construct(){
        
    }
    
    /*Geters e Seters*/
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
    
    public function getStatus(){
        return $this->status;
    }    
    
    public function setStatus($status){
        $this->status = $status;
    }
}

?>
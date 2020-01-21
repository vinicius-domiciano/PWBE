<?php

/*  Classe Get e set da imagem
    Autor: Vinicius Domiciano
    Data de Criação: 07/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class UploadClass{
    
    private $imagem;
    
    public function __construct(){
        
    }
    
    public function getImagem(){
        return $this->imagem;
    }
    
    public function setImagem($imagem){
        $this->imagem = $imagem;
    }
    
}
?>
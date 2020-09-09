<?php

/*  Classe controller das Foreign Key categoria e subcategoria
    Autor: Vinicius Domiciano
    Data de Criação: 08/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class ForeignKeyController{
    
    public function __construct(){
        require_once('model/DAO/foreignKeyDAO.php');
    }
    
     //lista categoria e subcategoria
    public function listarFkCategoria($id){
        $foreignKeyDAO = new ForeignKeyDAO();
        
        $list = $foreignKeyDAO->selectWhereCategoria($id);
        
        if($list){
            return $list;
        }else{
            false;
        }
        
    }
    
    //lista os relacionamento de tabelas
    public function listarCategoriaRelacionada($id){
        $foreignKeyDAO = new ForeignKeyDAO();
        
        $list = $foreignKeyDAO->selectFkCategoria($id);
        
        if($list){
            return $list;
        }else{
           return false;
        }
    }
    
    
}

?>
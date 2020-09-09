<?php
/* Class Object Login
    Autor: Vinicius Domiciano
    Date of Creat: 07/12/2019
    Modificações:
        Date:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class LoginClass {
    private $user;
    private $password;
    
    //construtor
    public function __construct(){
        
    }
    
    /**//** Geters and Seters **//**/
    public function getUser(){
        return $this->user;
    }
    
    public function setUser($user){
        $this->user = $user;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
}

?>
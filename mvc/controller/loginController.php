<?php
    
/*  Classe de gerenciameto de login
    Autor: Vinicius Domiciano
    Data de Criação: 07/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class LoginController{
    private $login;
    
    //construtor
    public function __construct(){
        require_once("model/loginClass.php");
        require_once("model/DAO/loginDAO.php");
        
        if(!isset($_SESSION)){
            session_start();
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Criptografando senha
        $password = MD5($_POST['txtuser'].$_POST['txtpassword']);
        //instanciando a classe
        $this->login = new LoginClass();
        //gardando nos atributos da classe o POST
        $this->login->setUser($_POST['txtuser']);
        $this->login->setPassword($password);
        }
    }
    
    public function validarLogin(){
        $loginDAO = new LoginDAO();
        //enviando o objeto
        $dadoLogin = $loginDAO->buscarUser($this->login);
        if($dadoLogin){
            $_SESSION['login'] = true;
            header('location:index.php');
        }else{
            echo('<script>
                    alert("Usuario ou Senha invalido. Tente Novamente!!");
                    window.location = "index.php";
                </script>');
        }
        
    }
    
    public function logout(){
        unset($_SESSION['login']);
        header('location:../index.php');
    }
    
}

?>
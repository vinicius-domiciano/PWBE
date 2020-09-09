<?php
    /*Ativando a variavel de sessaõ*/
    if( !isset($_SESSION)){
        session_start();
        /* ativando o recurso de variaveis de sessão */
    }
    /* importações */
    require_once("conexao.php");
    require_once('../modulos/erros.php');
    /* Variaveis */
    $modoUser = (string) "nome";
    if(isset($_POST['btnLogin'])){
        $conexao = conexaoMysql();
        $senha = $_POST['txtsenha'];
        $loginUser = $_POST['txtusuario'];
        $senha = MD5($loginUser.$senha);
        $sql = "select * from tblusuario where usuario = '".$loginUser."' and senha = '".$senha."' and status = 1";
        /*select para verificar */
        $select = mysqli_query($conexao, $sql);
        if($rsConsulta = mysqli_fetch_array($select)){
            if($rsConsulta['usuario'] == $loginUser && $rsConsulta['senha'] == $senha && $rsConsulta['status'] = 1){
                /*vaiaveis de sessão*/
                $_SESSION['nomeUsuario'] = $rsConsulta['nome'];
                $_SESSION['codigoNivel'] = $rsConsulta['codigo_nivel'];
                //enviando para o cms
                header("location:../cms/index.php");
            }else{
               header("location:../index.php?erro=invalido"); 
            }
        }else{
            header("location:../index.php?erro=invalido"); 
        }
        
    } 

?>
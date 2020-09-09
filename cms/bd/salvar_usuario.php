<?php
    if( !isset($_SESSION)){
        session_start();
        /* ativando o recurso de variaveis de sessão */
    }

    require_once('conexao.php');
    require_once('../modulos/erros.php');
    $conexao = conexaoMysql();

    if(isset($_POST['btnUsuario'])){
        $nome = $_POST['txtNome'];
        $usuario = $_POST['txtUsuario'];
        $nivel = $_POST['sltNivel'];
        
        if(strtoupper($_POST['btnUsuario']) == "CRIAR"){
            $senha = $_POST['txtSenha'];
            $senha = MD5($usuario.$senha);
            $sql = "insert into tblusuario (nome, usuario, senha, codigo_nivel, status)
                    value ('".$nome."','".$usuario."', '".$senha."', ".$nivel.", true)";
        }elseif(strtoupper($_POST['btnUsuario']) == "EDITAR" ){
            $sql = "update tblusuario set nome ='".$nome."',
                                          usuario = '".$usuario."',
                                          codigo_nivel = ".$nivel."
                                      where codigo =".$_SESSION['codigo'];
        }
        
        if(mysqli_query($conexao, $sql)){
            if(isset($_SESSION['codigo'])){
                unset($_SESSION['codigo']);
            }
            header("location:../adm_users.php");
        }else{
            echo(ERRO_DE_CONEXAO);
        }
        
    }
?>
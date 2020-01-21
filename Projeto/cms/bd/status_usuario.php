<?php
    require_once('../modulos/erros.php');
    require_once('conexao.php');
    $conexao = conexaoMysql();


    if(isset($_GET['modo'])){
        $codigo = $_GET['codigo'];
        $local = $_GET['local'];
        if(strtoupper($_GET['modo']) == "ATIVAR"){
            if(strtoupper($local) == "USER"){
                $sql = "update tblusuario set status = true where codigo =".$codigo;
                $caminho = "../adm_users.php";
            }elseif(strtoupper($local) == "NIVEL"){
                $sql = "update tblniveis set status = true where codigo =".$codigo;
                $caminho = "../adm_niveis.php";
            }           
        }elseif(strtoupper($_GET['modo']) == "DESATIVAR"){
            if(strtoupper($local) == "USER"){
                $sql = "update tblusuario set status = false where codigo =".$codigo;
                $caminho = "../adm_users.php";
            }elseif(strtoupper($local) == "NIVEL"){
                $sql = "update tblniveis set status = false where codigo =".$codigo;
                $caminho = "../adm_niveis.php";
            } 
        } 
        
        if(mysqli_query($conexao, $sql)){
            header("location:".$caminho);
        }else{
            echo(ERRO_DE_CONEXAO);
        }
    }
?>
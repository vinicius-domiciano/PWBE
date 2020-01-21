<?php
    if( !isset($_SESSION)){
        session_start();
        /* ativando o recurso de variaveis de sessão */
    }

    require_once('conexao.php');
    require_once('../modulos/erros.php');
    $conexao = conexaoMysql();
    
    if(isset($_POST['btnSalvar'])){
        
        /*Variaveis*/
        $titulo = $_POST['txtTitulo'];
        $texto = $_POST['txtDescricao'];
        
        if(strtoupper($_POST['btnSalvar']) == "CRIAR"){
            $sql = "insert into tblmissao_visao_valores
                        (titulo,descricao,status)
                    value ('".$titulo."','".$texto."',true)";
        }elseif(strtoupper($_POST['btnSalvar']) == "EDITAR"){
            $sql = "update tblmissao_visao_valores set titulo ='".$titulo."',
                                                        descricao = '".$texto."'
                    where codigo = ".$_SESSION['codigo'];
        }
        
        if(mysqli_query($conexao,$sql)){
            if(isset($_SESSION['codigo'])){
                unset($_SESSION['codigo']);
            }
            header("location:../cms_mi_vi_va.php");
        }else{
            echo(ERRO_DE_CONEXAO);
        }
    }

?>
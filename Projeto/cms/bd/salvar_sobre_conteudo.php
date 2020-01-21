<?php
    if( !isset($_SESSION)){
        session_start();
        /* ativando o recurso de variaveis de sessão */
    }

    /*importações*/
    require_once('conexao.php');
    require_once('../modulos/erros.php');
    $conexao = conexaoMysql();

    if(isset($_POST['btnSalvar'])){
        $titulo = $_POST['txtTitulo'];
        $texto = $_POST['textDescricao'];
        if(isset($_SESSION['previewFoto'])){
            $foto = $_SESSION['previewFoto'];
        }else{
            $foto = $_SESSION['nomeFoto'];
             unset($_SESSION['nomeFoto']);
        }
        
        if(strtoupper($_POST['btnSalvar']) == "CRIAR"){
            $sql = "insert into tblsessoes_sobre 
                        (titulo,imagem,descricao,status)
                    value('".$titulo."','".$foto."','".$texto."',true);    
                        ";
        }elseif(strtoupper($_POST['btnSalvar']) == "EDITAR"){
            $sql = "update tblsessoes_sobre set titulo = '".$titulo."',
                                                imagem = '".$foto."',
                                                descricao = '".$texto."'
                                                where codigo =".$_SESSION['codigo'];
        }
        
        if(mysqli_query($conexao, $sql)){
            if(isset($_SESSION['previewFoto'])){
                unset($_SESSION['previewFoto']);
            }
            if(isset($_SESSION['codigo'])){
                unset($_SESSION['codigo']);
            }
            if(isset($_SESSION['nomeFoto'])){
                unlink("imagens/".$_SESSION['nomeFoto']);
                unset($_SESSION['nomeFoto']);
            }
            
            header("location:../cms_sobre_sessoes.php");
        }
    }
?>
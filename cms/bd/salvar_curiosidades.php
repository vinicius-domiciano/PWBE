<?php
    if( !isset($_SESSION)){
        session_start();
        /* ativando o recurso de variaveis de sessão */
    }

    require_once('conexao.php');
    require_once('../modulos/erros.php');
    $conexao = conexaoMysql();

    if(isset($_POST['btnSalvar'])){
        //variaveis
        $titulo = $_POST['txtTitulo'];
        $descricao = $_POST['textDesc'];
        $codigoLayout = $_POST['sltLayout'];
        if(isset($_SESSION['previewFoto'])){
            $foto = $_SESSION['previewFoto'];
        }else{
            $foto = $_SESSION['nomeFoto'];
             unset($_SESSION['nomeFoto']);
        }
        if(isset($_SESSION['previewBackground'])){
            $background = $_SESSION['previewBackground'];
        }else{
            $background = $_SESSION['nomeBk'];
            unset($_SESSION['nomeBk']);
        }
        
        if(strtoupper($_POST['btnSalvar']) == "CRIAR"){
            $sql = "insert into tblcuriosidades (titulo,imagem,descricao,fundo,codigo_layout,status)
                    value ('".$titulo."','".$foto."','".$descricao."','".$background."',".$codigoLayout.",true)";
        }elseif(strtoupper($_POST['btnSalvar']) == "EDITAR"){
            $sql = "update tblcuriosidades set titulo ='".$titulo."',
                                                descricao = '".$descricao."',
                                                imagem = '".$foto."',
                                                fundo = '".$background."',
                                                codigo_layout = ".$codigoLayout."
                                                where codigo = ".$_SESSION['codigo'];
        }
        
        if(mysqli_query($conexao, $sql)){
            if(isset($_SESSION['previewFoto'])){
                unset($_SESSION['previewFoto']);
            }
            if(isset($_SESSION['previewBackground'])){
                unset($_SESSION['previewBackground']);
            }
            if(isset($_SESSION['codigo'])){
                unset($_SESSION['codigo']);
            }
            if(isset($_SESSION['nomeFoto'])){
                unlink("imagens/".$_SESSION['nomeFoto']);
                unset($_SESSION['nomeFoto']);
            }
            if(isset($_SESSION['nomeBk'])){
                unlink("imagens/".$_SESSION['nomeBk']);
                unset($_SESSION['nomeBk']);
            }
            
            header("location:../cms_curiosidades.php");
        }
    }
    
?>
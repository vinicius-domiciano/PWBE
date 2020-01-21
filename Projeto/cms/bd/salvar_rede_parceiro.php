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
        if($_POST['sltPertence'] == 'P'){
            $tipo = 'Parceiros';
        }else{
            $tipo = 'Rede Sociais';
        }
        if(isset($_SESSION['previewFoto'])){
            $foto = $_SESSION['previewFoto'];
        }else{
            $foto = $_SESSION['nomeFoto'];
             unset($_SESSION['nomeFoto']);
        }
        
        if(strtoupper($_POST['btnSalvar']) == "CRIAR"){
            $sql = "insert into tblredes_parceiro (tipo,imagem,status)
                    value ('".$tipo."','".$foto."',true)";
        }elseif(strtoupper($_POST['btnSalvar']) == "EDITAR"){
            $sql = "update tblredes_parceiro set tipo ='".$tipo."',
                                                imagem = '".$foto."'
                                                where codigo = ".$_SESSION['codigo'];
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
            
            header("location:../cms_rede_parceiro.php");
        }
    }
    
?>
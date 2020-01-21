<?php
    require_once('../modulos/erros.php');
    require_once('conexao.php');
    $conexao = conexaoMysql();
    
    if(isset($_GET['modo'])){
        if(isset($_GET['modo']) == 'excluir'){
            $codigo = $_GET['codigo'];
            $nomeFoto = $_GET['nomeFoto'];
            $nomeFundo = $_GET['nomeFundo'];
            //script
            $sql = "delete from tblcuriosidades where codigo =".$codigo;
            //exe. script
            if(mysqli_query($conexao, $sql)){
                //deletando a imagens
                unlink("imagens/".$nomeFoto);
                unlink("imagens/".$nomeFundo);
                header("location:../cms_curiosidades.php");
            }else{
                echo(ERRO_DE_CONEXAO);
            }
        }
    }

?>
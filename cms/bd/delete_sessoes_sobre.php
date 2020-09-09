<?php
    require_once('../modulos/erros.php');
    require_once('conexao.php');
    $conexao = conexaoMysql();
    
    if(isset($_GET['modo'])){
        if(isset($_GET['modo']) == 'excluir'){
            $codigo = $_GET['codigo'];
            $nomeFoto = $_GET['nomeFoto'];
            //script
            $sql = "delete from tblsessoes_sobre where codigo =".$codigo;
            //exe. script
            if(mysqli_query($conexao, $sql)){
                //deletando a imagens
                unlink("imagens/".$nomeFoto);
                header("location:../cms_sobre_sessoes.php");
            }else{
                echo(ERRO_DE_CONEXAO);
            }
        }
    }

?>
<?php
    require_once('../modulos/erros.php');
    require_once('conexao.php');
    $conexao = conexaoMysql();
    
    if(isset($_GET['modo'])){
        if(isset($_GET['modo']) == 'excluir'){
            $codigo = $_GET['codigo'];
            $nomeFoto = $_GET['nomeFoto'];
            //script
            $sql = "delete from tblredes_parceiro where codigo =".$codigo;
            //exe. script
            if(mysqli_query($conexao, $sql)){
                //deletando a imagens
                unlink("imagens/".$nomeFoto);
                header("location:../cms_rede_parceiro.php");
            }else{
                echo(ERRO_DE_CONEXAO);
            }
        }
    }

?>
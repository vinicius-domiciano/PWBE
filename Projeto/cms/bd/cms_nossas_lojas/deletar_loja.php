<?php
    /*importações*/
    require_once('../conexao.php');
    require_once('../../modulos/erros.php');
    $conexao = conexaoMysql();

    if(isset($_GET['modo'])){
        $codigo = $_GET['codigo'];
        /*script*/
        $sql = 'delete from tblnossas_lojas where codigo = '.$codigo;
        /*Execultando o script*/
        if(mysqli_query($conexao, $sql)){
            header("location:../../cms_nossas_loja.php");
        }else{
            echo(ERRO_DE_CONEXAO);
        }
    }

?>
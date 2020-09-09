<?php
    /*importações*/
    require_once('../conexao.php');
    require_once('../../modulos/erros.php');
    $conexao = conexaoMysql();

    if(isset($_GET['modo'])){
        $codigo = $_GET['codigo'];
        if(strtoupper($_GET['modo']) == "ATIVAR"){
           $sql = 'update tblnossas_lojas set status = true where codigo ='.$codigo; 
        }elseif(strtoupper($_GET['modo']) == "DESATIVAR"){
            $sql = 'update tblnossas_lojas set status = false where codigo ='.$codigo; 
        }
        
        if(mysqli_query($conexao, $sql)){
            header("location:../../cms_nossas_loja.php");
        }else{
            echo(ERRO_DE_CONEXAO);
        }
    }


?>
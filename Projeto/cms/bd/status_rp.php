<?php
    /*importações*/
    require_once('conexao.php');
    require_once('../modulos/erros.php');
    $conexao = conexaoMysql();

    if(isset($_GET['modo'])){
        $codigo = $_GET['codigo'];
        if(strtoupper($_GET['modo']) == "ATIVAR"){
            $sql = 'update tblredes_parceiro set status = true where codigo ='.$codigo; 
        }elseif(strtoupper($_GET['modo']) == "DESATIVAR"){
            $sql = 'update tblredes_parceiro set status = false where codigo ='.$codigo; 
        }
        
        if(mysqli_query($conexao, $sql)){
            header("location:../cms_rede_parceiro.php");
        }else{
            echo(ERRO_DE_CONEXAO);
        }
    }


?>
<?php
    /*importações*/
    require_once('conexao.php');
    require_once('../modulos/erros.php');
    $conexao = conexaoMysql();

    if(isset($_GET['modo'])){
        $codigo = $_GET['codigo'];
        if(strtoupper($_GET['modo']) == "ATIVAR"){
            $sql = 'update tblmissao_visao_valores set status = true where codigo ='.$codigo; 
        }elseif(strtoupper($_GET['modo']) == "DESATIVAR"){
            $sql = 'update tblmissao_visao_valores set status = false where codigo ='.$codigo; 
        }
        
        if(mysqli_query($conexao, $sql)){
            header("location:../cms_mi_vi_va.php");
        }else{
            echo(ERRO_DE_CONEXAO);
        }
    }


?>
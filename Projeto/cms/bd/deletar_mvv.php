<?php
    require_once('../modulos/erros.php');
    /*Verificar se foi clicado*/
    if(isset($_GET['modo'])){
        if($_GET['modo'] == "deletar"){
            require_once("conexao.php");
            $conexao = conexaoMysql();
            
            $codigo = $_GET['codigo'];
            
            $sql = "delete from tblmissao_visao_valores where codigo=".$codigo;
            
            if(mysqli_query($conexao, $sql)){
                header("location:../cms_mi_vi_va.php");     
            }else{
                echo(ERRO_DE_CONEXAO);
            }
            
        }
    }
?>
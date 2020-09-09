<?php
    require_once('../modulos/erros.php');
    /*Verificar se foi clicado*/
    if(isset($_GET['opcao'])){
        if($_GET['opcao'] == "excluir"){
            require_once("conexao.php");
            $conexao = conexaoMysql();
            
            $codigo = $_GET['codigo'];
            
            $sql = "delete from tblcontatenos where codigo_contato=".$codigo;
            
            if(mysqli_query($conexao, $sql)){
                header("location:../cms_fale_conosco.php");     
            }else{
                echo(ERRO_DE_CONEXAO);
            }
            
        }
    }
?>
<?php
    require_once('../modulos/erros.php');
    require_once("conexao.php");
    $conexao = conexaoMysql();

    if(isset($_GET['modo'])){
            
        $codigo = $_GET['codigo'];
        
        if($_GET['modo'] == 'deletar_nivel'){
            $sql = "delete from tblniveis where codigo=".$codigo;
            $pagina = "../adm_niveis.php";
        }elseif($_GET['modo'] == 'deletar_user'){
            $sql = "delete from tblusuario where codigo=".$codigo;
            $pagina = "../adm_users.php";
        }

        if(mysqli_query($conexao, $sql)){
            header("location:".$pagina);
        }else{
            echo(ERRO_DE_CONEXAO);
        }
    }
?>
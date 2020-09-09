<?php
    //verificando se esta desativada e ativando a variavel
    if( !isset($_SESSION) ){
        session_start();
    }

    /*importações*/
    require_once('../conexao.php');
    require_once('../../modulos/erros.php');
    $conexao = conexaoMysql();

    if(isset($_POST['btnLojas'])){
        $endereco = $_POST['txtEnd'];
        $numeroEnd = $_POST['txtNumero'];
        $cep = $_POST['txtCep'];
        $telefone = $_POST['txtTelefone'];
        
        if(strtoupper($_POST['btnLojas']) == "CRIAR"){
            $sql = "insert into tblnossas_lojas 
                            (local,num_loja,cep,telefone,status)
                    value
                            ('".$endereco."',".$numeroEnd.",'".$cep."','".$telefone."',true);
            ";
        }elseif(strtoupper($_POST['btnLojas']) == "EDITAR"){
            $sql = "update tblnossas_lojas set
                                        local ='".$endereco."',
                                        num_loja =".$numeroEnd.",
                                        cep = '".$cep."',
                                        telefone = '".$telefone."'
                                        
                                        where codigo =".$_SESSION['codigo'];
        }
        
        if(mysqli_query($conexao, $sql)){
            if(isset($_SESSION['codigo'])){
                unset($_SESSION['codigo']);
            }
            header("location:../../cms_nossas_loja.php");
        }else{
            echo(ERRO_DE_CONEXAO);
            echo($sql);
        }
        
    }
    
?>
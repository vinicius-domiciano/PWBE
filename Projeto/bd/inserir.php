<?php
    require_once('../modulos/erros.php');


    if(isset($_POST['btnEnviar'])){
        /*Importações*/
        require_once('conexao.php');
        $conexao = conexaoMysql();
        
        /*Dados do Formulario*/
        $nome = $_POST['txtNome'];
        $email = $_POST['txtEmail'];
        $telefone = $_POST['txtTel'];
        $celular = $_POST['txtCel'];
        $homePage = $_POST['txtPage'];
        $linkFacebook = $_POST['txtFacebook'];
        /*tipoMensagem - uma escolha se é critica ou sugestão*/
        $tipoMensagem = $_POST['rdoOpiniao'];
        $mensagem = $_POST['txtMensagem'];
        $sexo = $_POST['rdoSexo'];
        $profissao = $_POST['txtProfissao'];
        
        $sql = "insert into tblcontatenos (nome, telefone, celular, email, home_page, facebook, tipo_mensagem, mensagem, sexo, profissao)
                values ('".$nome."','".$telefone."','".$celular."','".$email."','".$homePage."','".$linkFacebook."','".$tipoMensagem."','".$mensagem."','".$sexo."','".$profissao."')  
                ";
        
        if(mysqli_query($conexao, $sql)){
            header("location:../contatenos.php");
        }else{
            echo(ERRO_DE_CONEXAO);
        }
        
    }


?>
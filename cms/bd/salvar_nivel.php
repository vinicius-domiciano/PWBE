<?php
    if( !isset($_SESSION)){
        session_start();
        /* ativando o recurso de variaveis de sessão */
    }

    require_once('conexao.php');
    require_once('../modulos/erros.php');
    $conexao = conexaoMysql();
    
    

    if(isset($_POST['btnNivel'])){
        $nomeNivel = strtolower($_POST['txtNome']);
            if(isset($_POST['chkConteudo'])){
                 $menu_adm_conteudo = $_POST['chkConteudo'];
            }else{
                $menu_adm_conteudo = "false";
            }
            if(isset($_POST['chkContatos'])){
                $menu_adm_contatos = $_POST['chkContatos'];   
            }else{
                $menu_adm_contatos = "false";
            }
            if(isset($_POST['chkUsers'])){
                $menu_adm_user = $_POST['chkUsers'];
            }else{
                $menu_adm_user = "false";
            }
        
            if(strtoupper($_POST['btnNivel']) == "CRIAR" ){
                $sql = "insert into tblniveis (nome_nivel, adm_user, adm_fale_conosco, adm_conteudo,status)
                        value ('".$nomeNivel."',".$menu_adm_user.",".$menu_adm_contatos.",".$menu_adm_conteudo.",true);";
            }elseif(strtoupper($_POST['btnNivel']) == "EDITAR" ){
                $sql = "UPDATE tblniveis set nome_nivel ='".$nomeNivel."',
                                             adm_user =".$menu_adm_user.",
                                             adm_fale_conosco =".$menu_adm_contatos.",
                                             adm_conteudo =".$menu_adm_conteudo."
                        WHERE codigo =".$_SESSION['codigo'];
                
            }
            
            if(mysqli_query($conexao, $sql)){
                if(isset($_SESSION['codigo'])){
                    unset($_SESSION['codigo']);
                } 
                header("location:../adm_niveis.php");  
            }else{
                echo($sql);
                echo(ERRO_DE_CONEXAO);
            }
    }
    

?>
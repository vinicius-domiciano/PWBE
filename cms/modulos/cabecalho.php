<?php
    /*ativando variavel de sessão */
    if( !isset($_SESSION)){
        session_start();
        /* ativando o recurso de variaveis de sessão */
    }
    /*Importações*/
    require_once('bd/conexao.php');
    require_once('modulos/erros.php');
    $conexao = conexaoMysql();
    /*verificando essistencia da variavel de sessão*/
    if(isset($_SESSION['nomeUsuario']) && isset($_SESSION['codigoNivel'])){
        $nomeUsuario = $_SESSION['nomeUsuario'];
        $codigoPermissaoNivel = $_SESSION['codigoNivel'];
    }else{
        header("location:../index.php");
    }
    
?>

<!--Cabeçalho - Header-->
        <div class="conteudo center">
            <header class="shadow">
                <div id="logo_cabecalho">
                    <div id="titulo_pagina">
                        <h2 id="titulo">CMS</h2>
                        <h3 id="subtitulo"> - Sistema de Gerenciamendo do Site</h3>
                    </div>
                    <div id="img_cabecalho">
                        <img src="../img/logo.png" alt="logo">
                    </div>
                </div>
                <?php
                $sql = "select * from tblniveis where codigo = ".$codigoPermissaoNivel;
                $select = mysqli_query($conexao,$sql);

                /*execultando script*/
                if($rsNivel = mysqli_fetch_array($select)){
                ?>
                <nav id="menu">
                    <?php
                    if($rsNivel['adm_conteudo'] == 1){
                    ?>
                    <div class="caixa_menu">
                        <div class="imagen_menu center">
                            <img src="icons/conteudo.png" alt="Caregando...">
                        </div>
                        <a href="adm_conteudo.php">
                            <p style="text-align:center">
                                Adm. Conteudo
                            </p>                            
                        </a>
                    </div>
                    <?php
                    }
                    if($rsNivel['adm_fale_conosco'] == 1){
                    ?>
                    <div class="caixa_menu">
                        <div class="imagen_menu center">
                            <img src="icons/fale-conosco.png" alt="Caregando...">
                        </div>
                        <a href="cms_fale_conosco.php">
                            <p style="text-align:center">
                                Adm. Fale Conosco
                            </p>                            
                        </a>
                    </div>
                    <?php
                    }
                    if($rsNivel['adm_user'] == 1){
                    ?>
                    <div class="caixa_menu">
                        <div class="imagen_menu center">
                            <img src="icons/usuarios.png" alt="Caregando...">
                        </div>
                        <a href="cms_adm_usuario.php">
                            <p style="text-align:center">
                                Adm. Usuarios
                            </p>                            
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                </nav>
                <?php
                }
                ?>
                <div id="saudacao_usuario">
                    <p>
                        Bem vindo, <?=$nomeUsuario?>
                    </p>
                    <div id="logout">
                        <a href="../index.php">
                            <p>Logout</p>
                        </a>
                    </div>
                </div>
            </header>            
        </div>

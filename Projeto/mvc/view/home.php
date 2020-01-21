<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $verificacao = false;
    $header = (string) '/login/login.php';
    if(isset($_SESSION['login'])){
        $verificacao = true;
        $header = '/home.php';
        if(isset($_GET['location'])){
            if(strtoupper($_GET['location']) == "SUBCATEGORIA" ){
                $header = '/subcategoria/subcategoria.php'; 
            }elseif(strtoupper($_GET['location']) == "CATEGORIA"){
                $header = '/categoria/categoria.php'; 
            }elseif(strtoupper($_GET['location']) == "PRODUTOS" ){
                $header = '/produto/produtos.php'; 
            }elseif(strtoupper($_GET['location']) == 'CONTROLE_ESTATISTICO'){
                $header = '/controle_estatistico/controle_estatistico.php';
            }
        }
    }
    
?>

<!DOCTYPE html>
<html lang="PT-BR">
    <head>
        <title>Sistema Interno - Delicia Gelada</title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <script src="view/js/trocaPagina.js"></script>
        
        <script src="view/js/jquery.js"></script>
        <script src="view/js/jquery.form.js"></script>
        <script src="view/js/modulo.js"></script>
        <link rel="stylesheet" type="text/css" href="view/css/style.css">
        <link rel="stylesheet" type="text/css" href="view/css/estilizacoes.css">
         <script>
             //fução para capturar uma option selecionada
            function selectOption(elemento){;
                $sltSubcategoria = document.getElementById('subcategoria');
                $sltSubcategoria.disabled = false;
                url = `router.php?controller=produtos&modo=buscarsubcategoria&selected=`;
                buscarDados(elemento.value, url);
            }
            /*Exibir os dados no modal*/
            function buscarDados(idItem, url){
                $.ajax({
                    type:"POST",
                    url: url,
                    data:{modo:'buscar',codigo:idItem},
                    success: function(dados){
                        $('#subcategoria').html(dados);
                    }
                    
                });
            }
             //upload de imagem
              $('#fileFoto').live('change', function(){
                $('#formFoto').ajaxForm({
                    target:'#foto'
                }).submit();
            });
        </script>
        <!--Modal-->
        <script>
            $(document).ready(function(){
               
                //execultando o modal
                $('.visualizar').click(function(){
                    $('.container').fadeIn(1000);
                });
                
                $('#fechar').click(function(){
                    $('.container').fadeOut(1000);
                });
            });
            
            /*Exibir os dados no modal*/
            function visualizarDados(idItem){
                $.ajax({
                    type:"POST",
                    url:"router.php?controller=produtos&modo=modal",
                    data:{modo:'visualizar',codigo:idItem},
                    success: function(dados){
                        $('#modalDados').html(dados);
                    }
                    
                });
            }
        </script>
    </head>
    <body>
        <!--Modal-->
        <div class="container">
            <div class="modal center">
                <div id="fechar">Fechar</div>
                <div id="modalDados"></div>
            </div>
        </div>
        
        <?php
            if($verificacao){
        ?>
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
                <nav id="menu">
                    <div class="caixa_menu">
                        <div class="imagen_menu center">
                            <img src="view/imagem/produto.png" alt="Caregando...">
                        </div>
                            <p style="text-align:center" onClick="trocapagina('produtos')">
                                Adm. Produtos
                            </p>  
                    </div>
                    <div class="caixa_menu">
                        <div class="imagen_menu center">
                            <img src="view/imagem/categoria.png" alt="Caregando...">
                        </div>
                            <p style="text-align:center" onClick="trocapagina('categoria')">
                                Adm. Categorias
                            </p>  
                    </div>
                    <div class="caixa_menu">
                        <div class="imagen_menu center">
                            <img src="view/imagem/subcategoria.png" alt="Caregando...">
                        </div>
                            <p style="text-align:center" onClick="trocapagina('subcategoria')">
                                Adm. Subcategorias
                            </p>
                    </div>
                    <div class="caixa_menu">
                        <div class="imagen_menu center">
                            <img src="view/imagem/grafico.png" alt="Caregando...">
                        </div>
                            <p style="text-align:center" onClick="trocapagina('controle_estatistico')">
                                Controle Estat�stico
                            </p>
                    </div>
                </nav>
                <div id="saudacao_usuario">
                    <p>
                        Bem vindo
                    </p>
                    <div id="logout">
                        <a href="router.php?controller=login&modo=logout">
                            <p>Logout</p>
                        </a>
                    </div>
                </div>
            </header>            
        </div>
        <div class="conteudo center shadow">
        <?php
            }
            if($header != ''){
                require_once('view'.$header);
            }
            
            if($verificacao){
        ?>
        </div>
        <div class="conteudo center">
            <footer class="shadow">
                <p>
                    Desenvolvido por: Vinicius Domiciano Alexandrino
                </p>
            </footer>
        </div>
        <?php
            }
        ?>
        <script src="view/js/status.js"></script>
    </body>
</html>
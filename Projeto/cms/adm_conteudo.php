<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>
            CMS - Sistema de Gerenciamendo do Site
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/estilizacoes.css">
    </head>
    <body>
        <?php
            /**Importando cabecalho*/
            require_once("modulos/cabecalho.php");
        ?>
        <!-- sessao de conteudo -->
        <div class="conteudo center shadow">
            <section id="caixa_adm_conteudo" class="center">
                <div class="linha_adm_conteudo">
                    <div class="coluna_adm_conteudo">
                        <a href="cms_nossas_loja.php">
                            <img src="icons/edit.png" alt="">
                            <p>
                                Nossas Lojas
                            </p>
                        </a>
                    </div>
                     <div class="coluna_adm_conteudo">
                        <a href="cms_curiosidades.php">
                            <img src="icons/edit.png" alt="">
                            <p>
                                Curiosidades
                            </p>
                        </a>
                    </div>
                     <div class="coluna_adm_conteudo">
                        <a href="cms_sobre.php">
                            <img src="icons/edit.png" alt="">
                            <p>
                                Sobre a Empresa
                            </p>
                        </a>
                    </div>
                </div>
            </section>
        </div>
        <?php 
            /**Importando cabecalho*/
            require_once("modulos/rodape.php");
        ?>
    </body>
</html>
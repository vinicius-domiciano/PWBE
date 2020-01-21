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
            require_once("modulos/cabecalho.php");
        ?>
        <div class="conteudo center shadow">
            <section id="cms_usuario">
                <div id="usuario" class="center">
                    <div class="caixa_opcao">
                        <div id="op_usuario" class="center">
                            <a href="adm_users.php">
                                <img src="icons/iconfinder_group2_309041.png" alt="Caregando..." class="shadow">
                                <p>
                                    ADM. Usuario
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="caixa_opcao">
                        <div id="op_nivel" class="center">
                            <a href="adm_niveis.php">
                                <img src="icons/adm_nivel.png" alt="Caregando..." class="shadow">
                                <p>
                                    ADM. Nivel
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php 
            require_once("modulos/rodape.php");
        ?>
    </body>
</html>
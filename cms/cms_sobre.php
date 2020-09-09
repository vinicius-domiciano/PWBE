<?php
    require_once("bd/conexao.php");
    $conexao = conexaoMysql();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Promocões</title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/estilizacoes.css">
    </head>
    <body>
        <?php
            /**Importando cabecalho*/
            require_once("modulos/cabecalho.php");
        ?>
        <!-- sessao de conteudo -->
        <div class="conteudo center shadow">
            <section id="sobre" class="center">
                <div class="selecionar_edicao">
                    <div class="caixa_selecionar">
                        <!--LINK PARA AJUSTAR MISSAO VISAO E VALORES-->
                        <a href="cms_mi_vi_va.php">
                            <p>Missão,Visão,Valores</p>
                        </a>
                    </div>
                    <div class="caixa_selecionar">
                        <a href="cms_rede_parceiro.php">
                            <p>Redes Sociais e Parceiros</p>
                        </a>
                    </div>
                    <div class="caixa_selecionar">
                        <a href="cms_sobre_sessoes.php">
                            <p>Conteudo</p>
                        </a>
                    </div>
                </div>
                <div class="visualizar_crud">
                    <div class="linha_visualizar_crud_header sobre">
                        <div class="header_visualizar_crud nome_nivel">Nome</div>
                        <div class="header_visualizar_crud">Ativar/Desativar</div>
                    </div>
                    <?php
                        $sql = "select * from tblsobre";
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rsSobre = mysqli_fetch_array($select)){
                    ?>
                    <div class="linha_visualizar_crud sobre">
                        <div class="coluna_visualizar_crud"><?=$rsSobre['nome_sessao']?></div>
                        <div class="coluna_visualizar_crud">
                            <a href="bd/status_sobre.php?modo=ativar&codigo=<?=$rsSobre['codigo']?>">
                                <img  src="icons/true.png" alt="">
                            </a>
                            <a href="bd/status_sobre.php?modo=desativar&codigo=<?=$rsSobre['codigo']?>">
                                <img src="icons/false.png" alt="">
                            </a>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </section>
        </div>
        <?php 
            /**Importando cabecalho*/
            require_once("modulos/rodape.php");
        ?>
    </body>
</html>
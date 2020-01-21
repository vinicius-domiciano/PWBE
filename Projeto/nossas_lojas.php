<?php
    require_once('modulos/erros.php');
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Delicia Gelada - Nossas Lojas</title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/estilizacoes.css">
        <link rel="stylesheet" type="text/css" href="css/cabecalho_rodape.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <!--    Cabeçalho    -->
        <?php
            require_once('modulos/cabecalho.php');
        ?>
        <!--    nossas lojas seção   -->
        <section id="nossa_lojas">
            <div class="conteudo center">
                <!-- titulo da pagina -->
                <div id="caixa_titulo">
                    <h2 id="titulo">
                        Nossas Lojas:
                    </h2>
                </div>
                <!-- conteudos da seção -->
                <div id="conteudo_nossas_lojas">
                    <table>
                        <!--  Um cabeçalho para fazer uma lista, contendo endereço e telefoene  -->
                        <tr>
                            <th>Endereços</th>
                            <th id="th_tel">Telefones</th>
                        </tr>
                        <!--  conteudo comforme oque esta escrito no cabeçalho (endereço e telefone)  -->
                        <!-- 1° end e tel -->
                        <?php
                            /* script */
                            $sql = 'select * from tblnossas_lojas where status = 1';
                            $select = mysqli_query($conexao, $sql);
                        
                            /*execultando script*/
                            while($rsExibir = mysqli_fetch_array($select)){
                        ?>
                        <tr class="cor_um">
                            <td class="endereco">
                                <p>
                                    <span class="span">
                                        <?=$rsExibir['local']?>
                                    </span>,
                                    <span class="span">
                                        nº <?=$rsExibir['num_loja']?>
                                    </span>,
                                    <span class="span">
                                        CEP: <?=$rsExibir['cep']?>
                                    </span>
                                </p>
                            </td>
                            <td class="tel">
                                <p>
                                    <span class="span">
                                        <?=$rsExibir['telefone']?>
                                    </span>
                                </p>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
        </section>
        <!--    Rodapé    -->
        <?php
            require_once('modulos/rodape.php');
        ?>
    </body>
</html>
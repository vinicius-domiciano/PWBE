<?php
    //verificando se esta desativada e ativando a variavel
    if(!isset($_SESSION)){
        session_start();
    }

    /*Importações*/
    require_once('bd/conexao.php');
    require_once('modulos/erros.php');
    $conexao = conexaoMysql();
    /*Variaveis*/
    $btnNome = (string) "Criar";
    $endereco = (string) "";
    $numEnd = (string) "";
    $cep = (string) "";
    $telefone = (string) "";

    if(isset($_GET['modo'])){
        $btnNome = $_GET['modo'];
        $codigo = $_GET['codigo'];
        $_SESSION['codigo'] = $codigo;
        //script
        $sql = "select * from tblnossas_lojas where codigo =".$codigo;
        $select = mysqli_query($conexao, $sql);
        //verificação
        if($rsVisualizar = mysqli_fetch_array($select)){
            $endereco = $rsVisualizar['local'];
            $numEnd = $rsVisualizar['num_loja'];
            $cep = $rsVisualizar['cep'];
            $telefone = $rsVisualizar['telefone'];
        }
    }
?>

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
        <script src="js/modulos.js"></script>
    </head>
    <body>
        <?php
            /**Importando cabecalho*/
            require_once("modulos/cabecalho.php");
        ?>
        <div class="conteudo center shadow">
            <section id="adm_nossas_lojas" class="center">
                <div class="adicionar">
                    <form name="frmLojas" action="bd/cms_nossas_lojas/salvar_lojas.php" method="post">
                        <div class="caixa_preencher">
                            <p>Endereço:</p><input class="txt_preencher" name="txtEnd" type="text" value="<?=$endereco?>" maxlength="500" required>
                        </div>
                        <div class="caixa_preencher">
                            <p>Numero:</p><input class="txt_preencher" name="txtNumero" type="text" value="<?=$numEnd?>" maxlength="5" required>
                        </div>
                        <div class="caixa_preencher">
                            <p>CEP:</p><input class="txt_preencher" name="txtCep" type="text" value="<?=$cep?>" maxlength="15" required>
                        </div>
                        <div class="caixa_preencher">
                            <p>Telefone</p><input id="telefone" class="txt_preencher" name="txtTelefone" type="text" value="<?=$telefone?>" maxlength="15" minlength="15" placeholder="Digite Seu Telefone" onkeypress="return mascaraFone(this, event, 'tel')"  required>
                        </div>
                        <div class="botoes">
                            <input class="btn_adm_user" name="btnLojas" type="submit" value="<?=$btnNome?>">
                        </div>
                    </form>
                </div>
                <div class="visualizar_crud">
                    <div class="linha_visualizar_crud_header loja">
                        <div class="header_visualizar_crud">Endereço</div>
                        <div class="header_visualizar_crud">CEP</div>
                        <div class="header_visualizar_crud">Telefone</div>
                        <div class="header_visualizar_crud">Editar/Excluir</div>
                        <div class="header_visualizar_crud">Ativar/Desativar</div>
                    </div>
                    <?php
                        /*criando script*/
                        $sql = 'select * from tblnossas_lojas';
                        $select = mysqli_query($conexao, $sql);
                        /*mostrando script na tela */
                        while($rsLoja = mysqli_fetch_array($select)){
                    ?>
                    <div class="linha_visualizar_crud loja">
                        <div class="coluna_visualizar_crud"><?=$rsLoja['local'].", N°".$rsLoja['num_loja']?></div>
                        <div class="coluna_visualizar_crud"><?=$rsLoja['cep']?></div>
                        <div class="coluna_visualizar_crud"><?=$rsLoja['telefone']?></div>
                        <div class="coluna_visualizar_crud">
                            <a href="cms_nossas_loja.php?modo=Editar&codigo=<?=$rsLoja['codigo']?>">
                                <img src="icons/edit.png" alt="">
                            </a>
                            <a href="bd/cms_nossas_lojas/deletar_loja.php?modo=deletar&codigo=<?=$rsLoja['codigo']?>">
                                <img src="icons/delete.png" alt="">
                            </a>
                        </div>
                        <div class="coluna_visualizar_crud">
                            <a href="bd/cms_nossas_lojas/status_loja.php?modo=ativar&codigo=<?=$rsLoja['codigo']?>">
                                <img src="icons/true.png" alt="">
                            </a>
                            <a href="bd/cms_nossas_lojas/status_loja.php?modo=desativar&codigo=<?=$rsLoja['codigo']?>">
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
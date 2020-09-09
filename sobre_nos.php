<?php
    /*importações*/
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();
    /*variaveis*/
    $mvv = (string) "";
    $redesS = (string) "";
    /*script*/
    $sql = "select * from tblsobre where status = 1";
    $select = mysqli_query($conexao, $sql);
    while($rsSobre = mysqli_fetch_array($select)){
        if($rsSobre['codigo'] == 1){
            $mvv = $rsSobre['nome_sessao'];
        }elseif($rsSobre['codigo'] == 2){
            $redesS = $rsSobre['nome_sessao'];
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Delícia Gelada - Sobre a Empresa</title>
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
        <!--  titulo pagina Sobre Nos(sobre a empresa)  -->
        <section id="titulo_pg" class="bkground">
            <div id="fundo">
                <div class="conteudo center">
                    <h1>
                        Sobre a Empresa
                    </h1>
                </div>
            </div>
        </section>
        <?php
            $sql = "select * from tblsessoes_sobre where status = 1";
            $select = mysqli_query($conexao,$sql);
        
            while($rsSessoes = mysqli_fetch_array($select)){
        ?>
        
        <!-- seção porque Delícia Gelada -->
        <section class="section">
            <div class="conteudo center">
                <h2><?=$rsSessoes['titulo']?></h2>
                <div class="texto_1">
                    <p class="txt">
                        <?=$rsSessoes['descricao']?>
                    </p>
                </div>
                <div class="inverso_img">
                    <img src="cms/bd/imagens/<?=$rsSessoes['imagem']?>" alt="Carregando...">
                </div>
            </div>
        </section>
        <?php
            }
                
            if($mvv != ""){
        
        ?>
        
        <section id="m_vi_va" class="bkground">
            <div class="conteudo center">
                
                <h2><?=$mvv?></h2>
                <?php
                    $sql = "select * from tblmissao_visao_valores where status = 1";
                    $select = mysqli_query($conexao, $sql);
                    /*execultado script*/
                    while($rsmvv = mysqli_fetch_array($select)){
                        
                ?>
                
                <!-- <?=$rsmvv['titulo']?> -->
                <div class="sobre_conteudo">
                    <h2><?=$rsmvv['titulo']?></h2>
                    <p><?=$rsmvv['descricao']?></p>
                </div>
                <?php
                    }
                ?>
                
            </div>
        </section>
        <?php
            }
        
            if($redesS != ""){
        ?>
        
        <!--  Seção siga nos e parceiros  -->
        <section id="siga_nos_parceiros">
            <div class="conteudo center">
                <div class="siga_parceiro">
                    <h2>Siga Nos</h2>
                    <?php 
                        $sql = "select * from tblredes_parceiro
                                where status = 1 and tipo like '%Rede Sociais%' ";
                    
                        $select = mysqli_query($conexao,$sql);
                        while($rsSiga = mysqli_fetch_array($select)){
                    ?>
                    <div class="siga_parceiro_img">
                        <img src="cms/bd/imagens/<?=$rsSiga['imagem']?>" alt="">
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="siga_parceiro">
                    <h2>Parceiros</h2>
                    <?php 
                        $sql = "select * from tblredes_parceiro
                                where status = 1 and tipo like '%Parceiros%' ";
                    
                        $select = mysqli_query($conexao,$sql);
                        while($rsParceiros = mysqli_fetch_array($select)){
                    ?>
                    <div class="siga_parceiro_img">
                        <img src="cms/bd/imagens/<?=$rsParceiros['imagem']?>" alt="">
                    </div>
                    <?php
                        }
                    ?>
                    
                </div>
            </div>
        </section>
        
        <?php
            }
        ?>
        <!--    Rodapé    -->
        <?php
            require_once('modulos/rodape.php');
        ?>
    </body>
</html>
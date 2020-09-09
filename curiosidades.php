<?php
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Delícia Gelada - Curiosidades</title>
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
        <!--  Titulo da pagina  -->
        <section id="curiosidades_titulo" class="bkground">
            <div id="subcaixa">
                <h1>
                    Curiosidades
                </h1>
            </div>
        </section>
        <!--  seção: nossos produtos  -->
        <?php
            $sql = "select tblcuriosidades.*,tblconteudo_layout.layout
                    from tblcuriosidades inner join tblconteudo_layout
                    on tblcuriosidades.codigo_layout = tblconteudo_layout.codigo
                    where status = 1";
            $select = mysqli_query($conexao, $sql);

            while($rsCuriosidade = mysqli_fetch_array($select)){
                $background =  "";
                $caixa_rgba =  "inherit";
                $classBk = "";
                if($rsCuriosidade['fundo'] != ""){
                    $background = " style='background-image: url(cms/bd/imagens/".$rsCuriosidade['fundo'].");'";
                    $caixa_rgba = "fundo_escuro";
                    $classBk = "bkground";
                }
                
                //verifica se o layout escolhido é simple
                if($rsCuriosidade['layout'] == "simples"){
                /*layout simple: uma imagem na esquerda e um texto a direita*/
        ?>
            
        <section class="section <?=$classBk?>" <?=$background?>>
            <div class="<?=$caixa_rgba?>">
                <div class="conteudo center">
                    <!-- essa seção tera um imagem e um texto dizendo sobre os produtos da impresa -->
                    <!--titulo-->
                    <h2><?=$rsCuriosidade['titulo']?></h2>
                    <div class="simples_img">
                        <!--imagem-->
                        <img src="cms/bd/imagens/<?=$rsCuriosidade['imagem']?>" alt="Carregando...">
                    </div>
                    <div class="texto_1">
                        <p class="txt">
                            <?=$rsCuriosidade['descricao']?>
                            
                        </p>
                    </div>

                </div>
            </div>
        </section>
        
        <?php
                //verifica se o layout escolhido tem lista
                }elseif($rsCuriosidade['layout'] == "lista"){
                /*layout lista: tem uma imagem na esquerda uma lista no meio e um texto a direita*/
                $lista = explode(";", $rsCuriosidade['descricao']);
        ?>
        <section class="section <?=$classBk?>" <?=$background?>>
            <div class="<?=$caixa_rgba?>">
                <div class="conteudo center">
                    <div class="beneficios_img" >
                        <!--imagem da seção-->
                        <img src="cms/bd/imagens/<?=$rsCuriosidade['imagem']?>" alt="Carregando...">
                    </div>
                    <!--Titulo-->
                    <h2><?=$rsCuriosidade['titulo']?>:</h2>
                    <div class="caixa_texto">
                        <!--lista-->
                        <ol>
                            <?php
                                for($i = 0; $i < count($lista) - 1; $i++){
                                    echo("<li>".$lista[$i]."</li> ");
                                }
                            ?>
                            
                        </ol>
                    </div>
                    <div class="caixa_texto">
                        <p class="txt"><?=$lista[count($lista) -1]?></p>
                    </div>
                </div>
            </div>
        </section> 
        <?php
                //verifica se o layout escolhido é invertido
                }elseif($rsCuriosidade['layout'] == "inversa"){
                /*layout inversa: contem um texto na esquerda e uma imagem na direita*/
        ?>   
        <section class="section bkground" <?=$background?>>
            <div class="<?=$caixa_rgba?>">
                <div class="conteudo center">
                    <!--titulo da sessão-->
                    <h2><?=$rsCuriosidade['titulo']?></h2>
                    <div class="texto_1">
                        <p class="txt">
                            <?=$rsCuriosidade['descricao']?>
                            
                        </p>
                    </div>
                    <div class="inverso_img">
                        <!--imagem da seção-->
                        <img src="cms/bd/imagens/<?=$rsCuriosidade['imagem']?>" alt="Carregando...">
                    </div>
                </div>
            </div>
        </section>
        <?php            
                }elseif($rsCuriosidade['layout'] == "unica"){
                /*layout unico: comtem somente titulo e texto*/
        ?>
        <section class="section <?=$classBk?>" <?=$background?>>
            <div class="<?=$caixa_rgba?>">
                <div class="conteudo center">
                    <!--titulo-->
                    <h2><?=$rsCuriosidade['titulo']?>:</h2>
                    <div class="caixa_dica">
                        <p class="txt">
                            <!--TEXTO-->
                            <?=$rsCuriosidade['descricao']?>
                        </p>
                    </div>
                </div>
            </div>    
        </section>
        
        <?php
                }
            }
        ?>
        <!--    Rodapé    -->
        <?php
            require_once('modulos/rodape.php');
        ?>
    </body>
</html>
<?php
    require_once("bd/conexao.php");
    $conexao = conexaoMysql();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Delicia Gelada - Produtos do Mês</title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/estilizacoes.css">
        <link rel="stylesheet" type="text/css" href="css/cabecalho_rodape.css">
        <script src="js/modulos.js"></script>
        <script src="js/jquery.js"></script>
         <!--Modal-->
        <script>
            $(document).ready(function(){
               
                //execultando o modal
                $('.btn_detalhes').click(function(){
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
                    url:"modalProduto.php",
                    data:{modo:'visualizar',codigo:idItem},
                    success: function(dados){
                        $('#modal').html(dados);
                        contProduto();
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
                <div id="modal"></div>
            </div>
        </div>
        <!--    Cabeçalho    -->
        <?php
            require_once('modulos/cabecalho.php');
        ?>
        <!-- titulo pagina -->
        <section id="titulo_site" class="bg bkground">
            <div class="fundo">
                <div id="titulo">
                    <h1>
                        Produtos do Mês
                    </h1>
                </div>
            </div>
        </section>
        <!-- seções caixa_conteudo  == cada uma possui um produto de um tipo ou categoria-->
        
        <?php
            $sql = "SELECT tblproduto.*,tblcategoria.*,tblsubcategoria.* FROM tblproduto 
                    INNER JOIN tblcategoria ON tblproduto.codigo_categoria = tblcategoria.id_categoria
                    INNER JOIN tblsubcategoria ON tblproduto.codigo_subcategoria = tblsubcategoria.id_subcategoria
                    WHERE tblproduto.status = 1 AND tblcategoria.status = 1 AND tblsubcategoria.status = 1 AND
                    tblproduto.produto_do_mes = 1";
            $select = mysqli_query($conexao,$sql);
        
            while($rsProdutoMes = mysqli_fetch_array($select)){
     
        ?>
        
        <section class="mes_conteudo">
            <div class="conteudo center">
                <!-- cada seção contem catigoria suco - tipo
                     nome,preço,avaliação,qtd de vendas no mes e em botao para soliciar o produto -->
                <h2> 
                    <?=$rsProdutoMes['nome_categoria']?>
                </h2>
                <div class="produto_img">
                    <img src="imagens/<?=$rsProdutoMes['imagem']?>" alt="Caregando...">
                </div>
                <div class="informacoes">
                    <p>
                        Nome:
                        <br>
                        <span class="span">
                            <?=$rsProdutoMes['nome']?>
                        </span>
                    </p>
                    
                    <?php
                        if($rsProdutoMes['promocao'] == 1){
                        $Promocao = $rsProdutoMes['preco'] * $rsProdutoMes['porcentagem'];
                        $valor = $Promocao / 100;
                        $valor  =   $rsProdutoMes['preco'] -   $valor; 
                    ?>

                    <p>
                        Preço:
                        <br>
                        <span class="span">
                            <span class="risco">
                                R$<?=$rsProdutoMes['preco']?>
                            </span>
                            <br>
                            R$ <?=$valor?>
                        </span>
                    </p>

                    <?php

                        }else{
                    ?>

                    <p>
                        Preço:
                        <br>
                        <span class="span">
                            R$ <?=$rsProdutoMes['preco']?>
                        </span>
                    </p>

                    <?php

                        }
                    ?>
                    
                    <p class="desc">
                        Descrição:
                        <br>
                        <span class="span">
                            <?=$rsProdutoMes['descricao']?>
                        </span>
                    </p>
                </div>
                <div class="btn_detalhes" onclick="visualizarDados(<?=$rsProdutoMes['codigo']?>)">
                    Detalhes
                </div>
            </div>
        </section>
        <?php
                }
        
        ?>
        <?php
            require_once('modulos/rodape.php');
        ?> 
    </body>
</html>
<?php
require_once("bd/conexao.php");
$conexao = conexaoMysql();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Delicia Gelada -  Promocões</title>
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
        <!--  titulo da pagina  -->
        <section id="inicio" class="bkground">
            <div class="fundo">
                <div id="caixa_promocao_titulo" class="center">
                    <h1>Promoções</h1>
                </div>
            </div>
        </section>
        <!-- conteudo da seção -->
        <section class="produtos_promocoes">
            <div class="conteudo center">
                <!-- caixa_produto == cada caixa tem uma imagen com valor antigo e novo validade e um botao de detalhes -->
                
                <?php
                    $sql = "SELECT tblproduto.*,tblcategoria.*,tblsubcategoria.* FROM tblproduto 
                            INNER JOIN tblcategoria ON tblproduto.codigo_categoria = tblcategoria.id_categoria
                            INNER JOIN tblsubcategoria ON tblproduto.codigo_subcategoria = tblsubcategoria.id_subcategoria
                            WHERE tblproduto.status = 1 AND tblcategoria.status = 1 AND tblsubcategoria.status = 1 AND 
                            tblproduto.promocao = 1";
                    $select = mysqli_query($conexao,$sql);
                
                    while($rsPromocao = mysqli_fetch_array($select)){
                ?>
                
                <div class="caixa_produto sombra">
                    <div class="img_produto imagens center_mobile">
                        <img src="imagens/<?=$rsPromocao['imagem']?>" alt="Caregando...">
                    </div>
                    <div class="info_produto">
                        <h3> <?=$rsPromocao['nome']?> </h3>
                        <div class="text_info" >
                            <p>
                                <span class="valor">
                                    Valor antigo: 
                                </span>
                                <span class="span risco">
                                    R$ <?=$rsPromocao['preco']?>
                                </span>
                            </p>
                            
                            <?php
                                $Promocao = $rsPromocao['preco'] * $rsPromocao['porcentagem'];
                                $valor = $Promocao / 100;
                                $valor = $rsPromocao['preco'] - $valor;
                            ?>
                            
                            <p>
                                <span class="valor">
                                    Valor novo:
                                </span> 
                                <span class="span">
                                    R$ <?=$valor?>
                                </span>
                            </p>
                        </div>
                        <div class="text_validade">
                            
                            <?php
                                $data_validade = explode("-", $rsPromocao['validade_promocao']);
                                $data_validade = $data_validade[2]."/".$data_validade[1]."/".$data_validade[0];
                            ?>
                            
                            <p>
                                Valido até: <?=$data_validade?>
                            </p>
                        </div>
                    </div>
                    <div class="btn_detalhes" onclick="visualizarDados(<?=$rsPromocao['codigo']?>)">
                        Detalhes
                    </div>
                </div>
                
                <?php
                        }
                ?>
                
            </div>
        </section>
        <!--    Rodapé    -->
        <?php
            require_once('modulos/rodape.php');
        ?> 
    </body>
</html>
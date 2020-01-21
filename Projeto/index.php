<?php
require_once("bd/conexao.php");
$conexao = conexaoMysql();

   if(isset($_GET['erro'])){
        echo("
            <script>
                alert('Usuario ou Senha invalido');
            </script>
        ");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>
            Delicia Gelada
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/slide.css">
        <link rel="stylesheet" type="text/css" href="css/cabecalho_rodape.css">
        <link rel="stylesheet" type="text/css" href="css/estilizacoes.css">
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
        <!--    Slider    -->
        <section id="slider">
            <div class="conteudo center">
                <div class="slideshow-container">

                    <div class="mySlides fade">
                      <img src="img/img_slide1.jpg" alt=" Carregando...">

                    </div>

                    <div class="mySlides fade">
                      <img src="img/img_slide2.jpg" alt=" Carregando...">
                    </div>

                    <div class="mySlides fade">
                      <img src="img/img_slide3.jpg" alt=" Carregando...">
                    </div>
                    
                    <div class="mySlides fade">
                      <img src="img/img_slide4.jpg" alt=" Carregando...">
                    </div>

                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    
                </div>
                <div class="caixa_dot center" style="text-align:center">
                      <span class="dot" onclick="currentSlide(1)"></span> 
                      <span class="dot" onclick="currentSlide(2)"></span> 
                      <span class="dot" onclick="currentSlide(3)"></span>
                      <span class="dot" onclick="currentSlide(4)"></span> 
                </div>
            </div>
        </section>
        <!--    Conteudos    -->
        <section id="area_itens" class="bkground">
            <div class="conteudo center">
                <!--caixa de pesquisa-->
                <div class="caixa_search center_mobile">
                    <form name="frmSearch" method="post" action="index.php">
                        <div>
                            <input class="txt_search" name="txtSearch" type="text" >
                        </div>
                        <div>
                            <input id="bnt_search" name="btnSearch" type="submit" value="">
                        </div>
                    </form>
                </div>
                <!--    Menu Secundario    -->
                <div id="menu_secundario">
                    <ul id="caixa_menu_secundario">
                        <?php
                        /*script*/
                        $sql = "select * from tblcategoria where status = 1";
                        $select = mysqli_query($conexao,$sql);
                        while($rsCategoria = mysqli_fetch_array($select)){
                        ?>
                        <li class="menu_secundario_itens"> 
                            <?=$rsCategoria['nome_categoria']?>
                            <ul class="submenu_secundario">
                                <?php
                                    $sql2 = "select categoria_subcategoria.*,tblsubcategoria.* from tblsubcategoria inner join categoria_subcategoria on tblsubcategoria.id_subcategoria = categoria_subcategoria.id_subcategoria where categoria_subcategoria.id_categoria =".$rsCategoria['id_categoria']." and tblsubcategoria.status = 1";
                                    $select2 = mysqli_query($conexao,$sql2);
                                    while($rsSubcategoria = mysqli_fetch_array($select2)){
                                ?>
                                <li class="submenu_secundario_itens">
                                    <a href="index.php?codigo_categoria=<?=$rsCategoria['id_categoria']?>&codigo_subcategoria=<?=$rsSubcategoria['id_subcategoria']?>">
                                        <?=$rsSubcategoria['nome_subcategoria']?>
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                
                <!--    Area de itens    -->
                <div id="itens">
                    
                    <?php
                    if(isset($_GET['codigo_subcategoria']) && isset($_GET['codigo_categoria'])){
                        $sql = 'select * from tblproduto where status = 1 and codigo_categoria ='.$_GET['codigo_categoria'].' and codigo_subcategoria ='.$_GET['codigo_subcategoria'];
                    }elseif(isset($_POST['btnSearch'])){
                        $sql = "SELECT * FROM tblproduto WHERE status = 1 and nome LIKE '%".$_POST['txtSearch']."%' OR status = 1 and descricao LIKE '%".$_POST['txtSearch']."%' ;";
                    }else{
                        //script
                        $sql = "SELECT tblproduto.*,tblcategoria.*,tblsubcategoria.* FROM tblproduto 
                                INNER JOIN tblcategoria ON tblproduto.codigo_categoria = tblcategoria.id_categoria
                                INNER JOIN tblsubcategoria ON tblproduto.codigo_subcategoria = tblsubcategoria.id_subcategoria
                                WHERE tblproduto.status = 1 AND tblcategoria.status = 1 AND tblsubcategoria.status = 1
                                ORDER BY RAND() LIMIT 6 ";
                    }
                    $select = mysqli_query($conexao,$sql);
                    
                    while($rsProduto = mysqli_fetch_array($select)){
                    ?>
                    
                    <div class="caixa_conteudo center_mobile">
                        <div class="caixa_img center">
                            <img src="imagens/<?=$rsProduto['imagem']?>" alt="<?=$rsProduto['nome']?>">
                        </div>
                        <p class="info_basicas">Nome:<span class="span"><?=$rsProduto['nome']?></span></p>
                        <p class="info_basicas ">Descrição:<span class="span"><?=$rsProduto['descricao']?></span></p>
                        
                        <?php
                            if($rsProduto['promocao'] == 1){
                            $Promocao = $rsProduto['preco'] * $rsProduto['porcentagem'];
                            $valor = $Promocao / 100;
                            $valor = $rsProduto['preco'] - $valor;
                        ?>
                        
                        <p class="info_basicas">Preço:<span class="span"> <span class="risco">R$<?=$rsProduto['preco']?></span>R$<?=$valor?></span></p>
                        
                        <?php
                        
                            }else{
                        ?>
                        
                        <p class="info_basicas">Preço:<span class="span">R$ <?=$rsProduto['preco']?></span></p>
                        
                        <?php
                        
                            }
                        ?>
                        
                        <div class="btn_detalhes"  onclick="visualizarDados(<?=$rsProduto['codigo']?>);">
                            Detalhes
                        </div>
                    </div>
                    
                    <?php
                        
                    }
                    
                    ?>
                    
                </div>
            </div>
        </section>
        <!--    Rodapé    -->
        <?php
            require_once('modulos/rodape.php');
        ?>   
        <script src="js/slide.js"></script>
    </body>
</html>
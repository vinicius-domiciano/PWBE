<?php
    require_once("bd/conexao.php");
    $conexao = conexaoMysql();

    if(isset($_POST['modo'])){
        if($_POST['modo'] == 'visualizar'){
            $sql = 'select tblproduto.*,tblcategoria.*,tblsubcategoria.* from tblproduto inner join tblcategoria on tblproduto.codigo_categoria = tblcategoria.id_categoria inner join tblsubcategoria on tblproduto.codigo_subcategoria = tblsubcategoria.id_subcategoria where tblproduto.codigo = '.$_POST['codigo'];
            $select = mysqli_query($conexao, $sql);
            
            if($rsModal = mysqli_fetch_array($select)){
                $nome = $rsModal['nome'];
                $imagem = $rsModal['imagem'];
                $descricao = $rsModal['descricao'];
                $preco = $rsModal['preco'];
                $categoria = $rsModal['nome_categoria'];
                $subcategoria = $rsModal['nome_subcategoria'];
                if($rsModal['promocao'] == 1){
                    $preco = $preco * $rsModal['porcentagem'];
                    $preco =  $rsModal['preco'] - $preco / 100;
                }
                $visualizacoes = $rsModal['visualizacoes'];
                $visualizacoes = $visualizacoes + 1;
                $query = 'update tblproduto set visualizacoes ='.$visualizacoes.' where codigo ='.$_POST['codigo'];
                mysqli_query($conexao, $query);
                
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Promocões</title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="container_modal">
            <div class="imagem_modal">
                <img src="imagens/<?=$imagem?>">
            </div>
            <div class="caixa_dados">
                <div class="modal_dados">
                    <p>Nome: <?=$nome?></p>                    
                </div>
                <div class="modal_dados">
                    <p>Preço: R$ <?=$preco?></p>
                </div>
                <div class="modal_dados">
                    <p>Categoria:</p>
                    <div class="caixa_catsub">
                        <?=$categoria?>
                    </div>
                </div>
                <div class="modal_dados">
                    <p>Subategoria:</p>
                    <div class="caixa_catsub">
                        <?=$subcategoria?>
                    </div>
                </div>
                <p>
                    Descrição:
                </p>
                <div class="modal_dados">
                    <p>
                        <?=$descricao?>
                    </p>
                </div>
            </div>
            <div class="caixa_compra">
                <div class="compra_itens">
                    <div class="modal_dados">
                        <p>Quantidades:</p>
                        <div class="caixa_qtd ">
                            <p id="menos">-</p>
                            <div id="cont">1</div>
                            <p id="mais">+</p>
                        </div>
                    </div>
                    <br>
                    <div class="modal_dados">
                        <div class="btn_detalhes">
                            Adicionar ao Carrinho
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
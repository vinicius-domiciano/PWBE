<?php
    if(isset($_POST['modo'])){
        //Resgata o id
        $id = $_POST['codigo'];

        $produtoController = new ProdutoController();
        //Metodo para buscar
        $modalDado = $produtoController->buscarProdutoModal($id);
        //ajustando formatação da data
        if($modalDado->getValidade() != ""){
            $validade = $modalDado->getValidade();
            $validade = explode("-", $validade);
            $validade = $validade[2]."/".$validade[1]."/".$validade[0];
        }
        
        if($modalDado->getPromocao() == 1){
            $Promocao = $modalDado->getPreco() * $modalDado->getValor();
            $valor = $modalDado->getPreco() - $Promocao / 100;
        }
        
        if($modalDado->getProdutoDoMes() == 1){
            $produtoMes = "Ativado";
        }else{
            $produtoMes = "Desativado";
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Promocões</title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <link rel="stylesheet" type="text/css" href="view/css/style.css">
        <link rel="stylesheet" type="text/css" href="view/css/estilizacoes.css">
    </head>
    <body>
        <div class="modal_container">
            <div class="modal_imagem">
                <img src="../imagens/<?=$modalDado->getImagem()?>">
            </div>
            <div class="caixa_modal">
                <div class="caixa_preencher">
                    <p>Nome: <?=$modalDado->getNome()?></p>
                </div>
                <div class="caixa_preencher">
                    <p>Preço: R$ <?=$modalDado->getPreco()?></p>
                </div>
                <?php
                    if($modalDado->getPromocao() == 1){
                
                ?>
                <div class="caixa_preencher">
                    <p>Promoção: <?=$modalDado->getValor()?>%</p>
                </div>
                <div class="caixa_preencher">
                    <p>Valor Novo: R$ <?=$valor?></p>
                </div>
                <div class="caixa_preencher">
                    <p>Validade: <?=$validade?></p>
                    
                </div>
                <?php
                    }
                ?>
                <div class="caixa_preencher">
                    <p>Categoria:</p>
                    <br>
                    <div class="caixa_catsub">
                        <?php
                            $categoria = $modalDado->getCodigoCategoria();
                            //importação da classe controller da categoria
                            require_once('controller/categoriaController.php');
                            //Instancia da classe controller;
                            $categoriaController = new CategoriaController();
                            //chamando o metodo de exibir categorias
                            $listDados = $categoriaController->buscarCategoriaModal($categoria);
                            if($listDados){
                        ?>
                                <?=$listDados->getNome()?>

                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="caixa_preencher">
                    <p>Subcategoria:</p>
                    <br>
                    <div class="caixa_catsub">
                        <?php
                            $subcategoria = $modalDado->getCodigoSubcategoria();
                            //importação da classe controller da categoria
                            require_once('controller/subcategoriaController.php');
                            //Instancia da classe controller;
                            $categoriaController = new SubcategoriaController();
                            //chamando o metodo de exibir categorias
                            $listDados = $categoriaController->buscarSubcategoriaModal($subcategoria);
                            if($listDados){
                        ?>
                                <?=$listDados->getNome()?>

                        <?php
                            }
                        ?>
                        
                    </div>
                </div>
                <div class="caixa_preencher">
                    <p>Produtos do Mês: <?=$produtoMes?></p>
                </div>
            </div>
            <div id="caixa_descricao">
                <p>Descrição:</p>
                <br>
                <p><?=$modalDado->getDescricao()?></p>
            </div>
        </div>
    </body>
</html>
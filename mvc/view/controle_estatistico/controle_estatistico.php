<?php


?>

<div class="section center">
    <div class="adicionar">
 		<div class="caixa_grafico">
 			<div class="linha_grafico">
 				<div class="col_produto">Produto</div>
 				<div class="col_qtd">visualização</div>
 				<div class="col_grafico"></div>
 				<div class="col_porcentagem">%</div>
 			</div>
            
            <?php
                require_once("controller/produtoController.php");
                $produtoController = new ProdutoController();
                $listaDados = $produtoController->listarProdutos();

                $cont = 0;
                while($cont < count($listaDados)){
                    if($listaDados[$cont]->getStatus() == 1){
            ?>
                <div class="linha_grafico">
                    <div class="col_produto"><?=$listaDados[$cont]->getNome()?></div>
                    <div class="col_qtd view"><?=$listaDados[$cont]->getDetalhes()?></div>
                    <div class="col_grafico">
                        <div class="grafico"></div>
                    </div>
                    <div class="col_porcentagem porcentagem">%</div>
                </div>
            <?php 
                    }
                $cont ++;
                }
            ?>
            
        </div>
 		
    </div>
</div>
<script>
    dadosGrafico();
</script>
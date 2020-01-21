<?php
    $nome = (string) "";
    $codigo = "0";
    $preco = "";
    $valor = "";
    $validade = "";
    $categoria = 0;
    $subcategoria = 0;
    $descricao = "";
    $chkProdutoMes = "";
    $chkPromocao = "";
    $foto = "";



    $action = (string) 'router.php?controller=produtos&modo=insert';

    if(isset($_GET['modo'])){
        if(strtoupper($_GET['modo']) == "BUSCAR"){
            $nome = $buscaDado->getNome();
            $codigo = $buscaDado->getCodigo();
            $preco = $buscaDado->getPreco();
            $valor = $buscaDado->getValor();
            //ajustando formatação da data
            if($buscaDado->getValidade() != ""){
                $validade = $buscaDado->getValidade();
                $validade = explode("-", $validade);
                $validade = $validade[2]."/".$validade[1]."/".$validade[0];
            }
            $categoria = $buscaDado->getCodigoCategoria();
            $subcategoria = $buscaDado->getCodigoSubcategoria();
            $descricao = $buscaDado->getDescricao();
            //verificando os checkbox
            if($buscaDado->getPromocao() == 1){
                $chkPromocao = 'checked';
            }
            if($buscaDado->getProdutoDoMes() == 1){
                $chkProdutoMes = 'checked';
            }
            
            $foto = $buscaDado->getImagem();
            $_SESSION['foto'] = $foto;
            
            $action = 'router.php?controller=produtos&modo=update&id='.$codigo;
        }
    }

?>

<div class="section center">
    <div class="adicionar">
        <div id="foto" class="caixa_imagem">
            <img src="../imagens/<?=$foto?>" alt=""> 
        </div>
        <form id="formFoto" name="frmImage" method="post" action="router.php?controller=produtos&modo=upload" enctype="multipart/form-data">
            <div class="caixa_preencher">
                <p>Imagem:</p>
                <input id="fileFoto" class="fle_img" type="file" value="" name="fleImage" required>
            </div>
        </form>
        <form name="frmSubCategoria" method="post" action="<?=$action?>">
            <div class="caixa_preencher">
                <p>Nome:</p>
                <input class="txt_preencher" name="txtNome" type="text" value="<?=$nome?>" required>
            </div>
            <div class="caixa_preencher">
                <p>Preço:</p>
                <input class="txt_preencher" name="txtPreco" type="text" value="<?=$preco?>" required>
            </div>
            <div class="caixa_preencher">
                <p>Promoção:</p>
                <input id="chk_promocao" class="chk_nivel" name="chkPromocao" type="checkbox" value="1" <?=$chkPromocao?>>
            </div>
            <div class="caixa_preencher">
                <p>Valor(%):</p>
                <input class="txt_preencher inputChecked" name="numValor" min="0" max="100" type="number" value="<?=$valor?>" disabled>
            </div>
            <div class="caixa_preencher">
                <p>Validade:</p>
                <input id="Date" class="txt_preencher inputChecked" name="txtValidade" type="text" value="<?=$validade?>" onkeypress="return mascaraDate(this, event)" disabled>
            </div>
            <div class="caixa_preencher">
                <p>Categoria:</p>
                <select id="sltCategoria" name="sltCategoria" class="caixa_selecionar" onchange="selectOption(this)" required>
                    <?php
                    if(isset($_GET['modo'])){
                        
                    ?>
                    <?php   
                    }else{
                    ?>
                    <option value="">Selecione uma categoria</option>
                    
                    <?php
                    }
                        //importação da classe controller da categoria
                        require_once('controller/categoriaController.php');
                        //Instancia da classe controller;
                        $categoriaController = new CategoriaController();
                        //chamando o metodo de exibir categorias
                        $listDados = $categoriaController->buscarStatusCategoria();
                        $cont = 0;
                        if($listDados){
                             while($cont < count($listDados)){
                    
                            if(isset($_GET['modo']) && $listDados[$cont]->getCodigo() == $categoria){
                    ?>
                        <option value="<?=$listDados[$cont]->getCodigo()?>" selected ><?=$listDados[$cont]->getNome()?></option>
                    
                    <?php
                            }else{
                    ?>
                    
                        <option value="<?=$listDados[$cont]->getCodigo()?>" ><?=$listDados[$cont]->getNome()?></option>
                    
                    <?php
                            }
                            $cont ++;
                            }
                        }
                    ?>
                </select>
                <p>Subcategoria:</p>
                <select id="subcategoria" name="sltSubcategoria" class="caixa_selecionar" disabled required>
                </select>
            </div>
            <div class="caixa_preencher">
                <p>Descrição:</p>
                <textarea name="txtDescricao" maxlength="500" required><?=$descricao?></textarea>
            </div>
            <div class="caixa_preencher">
                <p>Produtos do Mês:</p>
                <input class="chk_nivel" name="chkProdutoMes" type="checkbox" value="1" <?=$chkProdutoMes?>>
            </div>
            <div class="botoes">
                <input class="btn_adm_user" name="btnSalvar" type="submit" value="Salvar">
            </div>
        </form>
    </div>
    <div class="visualizar_crud">
        <div class="linha_visualizar_crud_header cinco_coluna">
            <div class="header_visualizar_crud">Nome</div>
            <div class="header_visualizar_crud">Preco</div>
            <div class="header_visualizar_crud">Visualizar</div>
            <div class="header_visualizar_crud">Editar/Deletar</div>
            <div class="header_visualizar_crud">Ativar/Desativar</div>
        </div>
        
        <?php
            require_once("controller/produtoController.php");
            $produtoController = new ProdutoController();
            $listaDados = $produtoController->listarProdutos();
        
            $cont = 0;
            while($cont < count($listaDados)){
                if($listaDados[$cont]->getStatus() == 1){
                    $ativar = "true";
                    $desativar = "false";
                }else{
                    $ativar = "false";
                    $desativar = "true";
                }
        ?>
        
        <div class="linha_visualizar_crud cinco_coluna">
            <div class="coluna_visualizar_crud"><?=$listaDados[$cont]->getNome()?></div>
            <div class="coluna_visualizar_crud">R$ <?=$listaDados[$cont]->getPreco()?></div>
            <div class="coluna_visualizar_crud">
                <a class="visualizar" onclick="visualizarDados(<?=$listaDados[$cont]->getCodigo()?>);">
                    <img src="view/imagem/lupa.png" alt="">
                </a>
            </div>
            <div class="coluna_visualizar_crud">
                <a href="router.php?location=produtos&controller=produtos&modo=buscar&id=<?=$listaDados[$cont]->getCodigo()?>">
                    <img src="view/imagem/edit.png" alt="">
                </a>
                <a href="router.php?location=produtos&controller=produtos&modo=delete&id=<?=$listaDados[$cont]->getCodigo()?>&imagem=<?=$listaDados[$cont]->getImagem()?>">
                    <img src="view/imagem/delete.png" alt="">
                </a>
            </div>
            <div class="coluna_visualizar_crud">
                <a href="router.php?location=produtos&controller=produtos&modo=status&id=<?=$listaDados[$cont]->getCodigo()?>&status=1">
                    <img class="ativa" src="" alt="<?=$ativar?>">
                </a>
                <a href="router.php?location=produtos&controller=produtos&modo=status&id=<?=$listaDados[$cont]->getCodigo()?>&status=0">
                    <img class="desativa" src="" alt="<?=$desativar?>">
                </a>
            </div>
        </div>
        
        <?php
            $cont ++;
            }
        ?>
        
    </div>
</div>

<?php
 if(isset($_GET['modo'])){
?>
    <script>
        $sltSubcategoria = document.getElementById('subcategoria');
        $sltSubcategoria.disabled = false;
        window.onload = function (){
            verificaStatus();
            url = `router.php?controller=produtos&modo=buscarsubcategoria&selected=<?=$subcategoria?>`;
            buscarDados(<?=$categoria?>, url);
        }
    </script>
<?php
 }
?>

<script src="view/js/checkbox.js"></script>
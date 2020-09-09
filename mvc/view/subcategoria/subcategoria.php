<?php
    $nome = (string) "";
    $action = (string) 'router.php?controller=subcategoria&modo=insert';

    if(isset($_GET['modo'])){
        if(strtoupper($_GET['modo']) == "BUSCAR"){
            $nome = $dadosSubcategoria->getNome();
            $codigo = $dadosSubcategoria->getCodigo();
            $action = 'router.php?controller=subcategoria&modo=update&id='.$codigo;
        }
    }

?>

<div class="section center">
    <div class="adicionar">
        <form name="frmSubCategoria" method="post" action="<?=$action?>">
            <div class="caixa_preencher">
                <p>Nome:</p>
                <input class="txt_preencher" name="txtnome" type="text" value="<?=$nome?>" required>
            </div>
            <div class="botoes">
                <input class="btn_adm_user" name="btnSalvar" type="submit" value="Salvar">
            </div>
        </form>
    </div>
    <div class="visualizar_crud">
        <div class="linha_visualizar_crud_header tres_colunas">
            <div class="header_visualizar_crud">Nome</div>
            <div class="header_visualizar_crud">Editar/Deletar</div>
            <div class="header_visualizar_crud">Ativar/Desativar</div>
        </div>
        <?php
            require_once('controller/subcategoriaController.php');
            $subcategoriaController = new SubcategoriaController();
            
            $listDados = $subcategoriaController->listarSubcategoria();
            $cont = 0;
            while($cont < count($listDados)){
                if($listDados[$cont]->getStatus() == 1){
                    $ativar = "true";
                    $deletar = "false";
                }else{
                    $ativar = "false";
                    $desativar = "true";
                }
                
        ?>
        <div class="linha_visualizar_crud tres_colunas">
            <div class="coluna_visualizar_crud"><?=$listDados[$cont]->getNome()?></div>
            <div class="coluna_visualizar_crud">
                <a href="router.php?location=subcategoria&controller=subcategoria&modo=buscar&id=<?=$listDados[$cont]->getCodigo()?>">
                    <img src="view/imagem/edit.png" alt="">
                </a>
                <a href="router.php?location=subcategoria&controller=subcategoria&modo=delete&id=<?=$listDados[$cont]->getCodigo()?>">
                    <img src="view/imagem/delete.png" alt="">
                </a>
            </div>
            <div class="coluna_visualizar_crud">
                <a href="router.php?location=subcategoria&controller=subcategoria&modo=status&id=<?=$listDados[$cont]->getCodigo()?>&status=1">
                    <img class="ativa" src="" alt="<?=$ativar?>" > 
                </a>
                <a href="router.php?location=subcategoria&controller=subcategoria&modo=status&id=<?=$listDados[$cont]->getCodigo()?>&status=0">
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
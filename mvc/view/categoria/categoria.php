<?php
    $nome = (string) "";
    $action = (string) 'router.php?location=categoria&controller=categoria&modo=insert';
    $required = (string) "";

    if(isset($_GET['modo'])){
        if(strtoupper($_GET['modo']) == "BUSCAR"){
            $nome = $dadosCategoria->getNome();
            $codigo = $dadosCategoria->getCodigo();
            $action = 'router.php?controller=categoria&modo=update&id='.$codigo;
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
            <div class="caixa_preencher">
                <p>Subcategorias:</p>
                <?php
                require_once('controller/subcategoriaController.php');
                require_once('controller/categoriaController.php');
                require_once('controller/foreignKeyController.php');
                $subcategoriaController = new SubcategoriaController();
                $categoriaController = new CategoriaController();
                $foreignKeyController = new ForeignKeyController();
              
                $listDados = $subcategoriaController->buscarStatusSubcategoria();
                
                $i = 0;
                $cont = 0;
                if($listDados){
                    while($cont < count($listDados)){
                        $checked = (string) "";
                        if(isset($_GET['modo'])){
                            if(strtoupper($_GET['modo']) == 'BUSCAR'){
                                $arraySubcategoria = $foreignKeyController->listarCategoriaRelacionada($_GET['id']);
                                if($i < count($arraySubcategoria)){
                                    if($listDados[$cont]->getCodigo() == $arraySubcategoria[$i]){
                                        $checked = "checked";
                                        $i++;
                                    }
                                }
                            }
                        }
                ?>
                <div class="chk_caixa">
                    <input class="chk_nivel" name="chkConteudo[]" type="checkbox" value="<?=$listDados[$cont]->getCodigo()?>" <?=$checked?> ><span class="chk_txt"><?=$listDados[$cont]->getNome()?></span>
                </div>
                <?php
                        $cont++;
                    }
                }
                ?>
            </div>
            <div class="botoes">
                <input class="btn_adm_user" name="btnSalvar" type="submit" value="Salvar">
            </div>
        </form>
    </div>
    <div class="visualizar_crud">
        <div class="linha_visualizar_crud_header">
            <div class="header_visualizar_crud">Nome</div>
            <div class="header_visualizar_crud">Subcategorias</div>
            <div class="header_visualizar_crud">Editar/Deletar</div>
            <div class="header_visualizar_crud">Ativar/Desativar</div>
        </div>
        <?php
            require_once('controller/categoriaController.php');
            require_once('controller/foreignKeyController.php');
            $categoriaController = new CategoriaController();
            
            $listDados = $categoriaController->listarCategoria();
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
        <div class="linha_visualizar_crud">
            <div class="coluna_visualizar_crud"><?=$listDados[$cont]->getNome()?></div>
            <div class="coluna_visualizar_crud">
                
                <?php
                    $foreignKeyController = new ForeignKeyController();
                    $listSub = $foreignKeyController->listarFkCategoria($listDados[$cont]->getCodigo());
                
                    $i = 0;
                    if($listSub){
                        while($i < count($listSub)){
                            echo($listSub[$i]->getNome());
                            echo('<br>');
                            $i++;
                        }
                    }
                ?>
                
            </div>
            <div class="coluna_visualizar_crud">
                <a href="router.php?location=categoria&controller=categoria&modo=buscar&id=<?=$listDados[$cont]->getCodigo()?>">
                    <img src="view/imagem/edit.png" alt="">
                </a>
                <a href="router.php?location=categoria&controller=categoria&modo=delete&id=<?=$listDados[$cont]->getCodigo()?>">
                    <img src="view/imagem/delete.png" alt="">
                </a>
            </div>
            <div class="coluna_visualizar_crud">
               <a href="router.php?location=categoria&controller=categoria&modo=status&id=<?=$listDados[$cont]->getCodigo()?>&status=1">
                    <img class="ativa" src="" alt="<?=$ativar?>">
                </a>
                <a href="router.php?location=categoria&controller=categoria&modo=status&id=<?=$listDados[$cont]->getCodigo()?>&status=0">
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
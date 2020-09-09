<?php
    if(($_GET['selected']) != ""){
        $codigoSubcategoria = $_GET['selected'];
    }else{
        $codigoSubcategoria = 0;
?>

<option value="">Selecione uma Subcategoria</option>
<?php
    }
    $idSelect = $_POST['codigo'];
    require_once('controller/subcategoriaController.php');
    $subcategoriaController = new SubcategoriaController();
    $listDados = $subcategoriaController->selectForeignKey($idSelect);
    //contado
    $cont = 0;
    while($cont < count($listDados)){

        if(isset($_GET['selected']) && $listDados[$cont]->getCodigo() == $codigoSubcategoria){
?>
    <option value="<?=$listDados[$cont]->getCodigo()?>" selected ><?=$listDados[$cont]->getNome()?></option>

<?php
        }else{
?>
    <option value="<?=$listDados[$cont]->getCodigo()?>"><?=$listDados[$cont]->getNome()?></option>

<?php
     }
    $cont ++;
    }
?>
<?php
    /*Importaçoes*/
    require_once("bd/conexao.php");
    $conexao = conexaoMysql();

    if(isset($_POST['modo'])){
        if(strtoupper($_POST['modo']) == "VISUALIZAR"){
            $codigo = $_POST['codigo'];
            /*script*/
            $sql = "select * from tblcuriosidades where codigo =".$codigo;
            $select = mysqli_query($conexao, $sql);
            
            if($rsVisualizar = mysqli_fetch_array($select)){
                $titulo = $rsVisualizar['titulo'];
                $foto = $rsVisualizar['imagem'];
                $fotoFundo = $rsVisualizar['fundo'];
                $texto = $rsVisualizar['descricao'];
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>
            CMS - Sistema de Gerenciamendo do Site
        </title>
        <meta charset="utf-8">
    </head>
    <body>
        <!--Exibição do dados para visualizar na modal-->
        <div id="caixa_modal">
            <!--Nome-->
            <div class="linha_modal center">
                <div class="coluna_modal">
                    Titulo:
                </div>
                <div class="coluna_modal">
                    <?=$titulo?>
                </div>
            </div>
            <!--Foto-->
            <div class="linha_modal center">
                <div class="coluna_modal">
                    Foto:
                </div>
                <div class="coluna_modal">
                    <div class="modal_imagem">
                        <?php
                            if($foto != ""){
                                echo('<img src="bd/imagens/'.$foto.'" alt="">');
                            }
                        ?>
                    </div>
                </div>
            </div>
             <div class="linha_modal center">
                <div class="coluna_modal">
                    Foto de Fundo:
                </div>
                <div class="coluna_modal">
                    <div class="modal_imagem">
                        <?php
                            if($fotoFundo != ""){
                                echo('<img src="bd/imagens/'.$fotoFundo.'" alt="">');
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="caixa_mensagem">
            <!--MENSAGEM-->
            <div class="linha_mensagem center">
                <div class="coluna_mensagem">
                    Descricao(Texto):
                </div>
                <div class="coluna_mensagem">
                    <?=$texto?>
                </div>
            </div>
        </div>
    </body>
</html>
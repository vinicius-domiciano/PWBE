<?php
    if( !isset($_SESSION)){
        session_start();
        /* ativando o recurso de variaveis de sessão */
    }

    require_once('bd/conexao.php');
    require_once('modulos/erros.php');
    $conexao = conexaoMysql();

    /*Variaveis*/
    $btnName = (string) "Criar";
    $titulo = (string) "";
    $texto = (string) "";

    if(isset($_GET['modo'])){
        $btnName = $_GET['modo'];
        $codigo = $_GET['codigo'];
        $_SESSION['codigo'] = $codigo;
        /*script*/
        $sql = "select * from tblmissao_visao_valores";
        $select = mysqli_query($conexao, $sql);
        
        if($rsEditar =mysqli_fetch_array($select)){
            $titulo = $rsEditar['titulo'];
            $texto = $rsEditar['descricao'];
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
        <link rel="stylesheet" type="text/css" href="css/estilizacoes.css">
    </head>
    <body>
        <?php
            /**Importando cabecalho*/
            require_once("modulos/cabecalho.php");
        ?>
        <div class="conteudo center shadow">
            <section class="section center">
                <div class="adicionar">
                    <form name="frmMvv" method="post" action="bd/salvar_mvv.php">
                        <div class="caixa_preencher">
                            <p>Titulo:</p>
                            <input maxlength="50" type="text" name="txtTitulo" value="<?=$titulo?>" class="txt_preencher" required/>
                        </div>
                        <div class="caixa_preencher">
                            <p>Descrição:</p>
                            <textarea name="txtDescricao" maxlength="100" required><?=$texto?></textarea>
                        </div>
                        <div class="botoes">
                            <input class="btn_adm_user" name="btnSalvar" type="submit" value="<?=$btnName?>">
                        </div>
                    </form> 
                </div>
                <div class="visualizar_crud">
                    <div class="linha_visualizar_crud_header">
                        <div class="header_visualizar_crud">Titulo</div>
                        <div class="header_visualizar_crud">Descricao</div>
                        <div class="header_visualizar_crud">Editar/Deletar</div>
                        <div class="header_visualizar_crud">Ativado/Desativado</div>
                    </div>
                    <?php
                        $sql = "select * from tblmissao_visao_valores";
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rsMvv = mysqli_fetch_array($select)){
                    ?>
                    
                    <div class="linha_visualizar_crud">
                        <div class="coluna_visualizar_crud"><?=$rsMvv['titulo']?></div>
                        <div class="coluna_visualizar_crud crud_text"><?=$rsMvv['descricao']?></div>
                        <div class="coluna_visualizar_crud">
                           <a href="cms_mi_vi_va.php?modo=Editar&codigo=<?=$rsMvv['codigo']?>">
                                <img src="icons/edit.png" alt="">
                           </a>
                            <a href="bd/deletar_mvv.php?modo=deletar&codigo=<?=$rsMvv['codigo']?>">
                                <img src="icons/delete.png" alt="">
                            </a>
                        </div>
                        <div class="coluna_visualizar_crud">
                            <a href="bd/status_mvv.php?modo=ativar&codigo=<?=$rsMvv['codigo']?>">
                                <img src="icons/true.png" alt="">
                            </a>
                            <a href="bd/status_mvv.php?modo=desativar&codigo=<?=$rsMvv['codigo']?>">
                                <img src="icons/false.png" alt="">
                            </a>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    
                </div>            
            </section>
        </div>
        <?php 
            /**Importando cabecalho*/
            require_once("modulos/rodape.php");
        ?>
    </body>
</html>
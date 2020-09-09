<?php
    if( !isset($_SESSION)){
        session_start();
        /* ativando o recurso de variaveis de sessão */
    }

    require_once("bd/conexao.php");
    $conexao = conexaoMysql();

    /*variaveis*/
    $btnName = (string) "Criar";
    $titulo = (string) "";
    $foto = (string) "";
    $texto = (string) "";

    if(isset($_GET['modo'])){
        $btnName = $_GET['modo'];
        $codigo = $_GET['codigo'];
        $_SESSION['codigo'] = $codigo;
        /*script*/
        $sql = "select * from tblsessoes_sobre where codigo =".$codigo;
        $select = mysqli_query($conexao, $sql);
        if($rsEditar = mysqli_fetch_array($select)){
            $titulo = $rsEditar['titulo'];
            $texto = $rsEditar['descricao'];
            $foto = $rsEditar['imagem'];
            $_SESSION['nomeFoto'] = $foto;
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
        <script src="js/jquery.js"></script>
        <script src="js/jquery.form.js"></script>
        <script>
            //upload e preview da imagem
            $('#fileFoto').live('change', function(){
                $('#formFoto').ajaxForm({
                    target:'#foto'
                }).submit();
            });
        </script>
    </head>
    <body>
        <?php
            /**Importando cabecalho*/
            require_once("modulos/cabecalho.php");
        ?>
        <!-- sessao de conteudo -->
        <div class="conteudo center shadow">
            <section class="section center">
                <div class="adicionar">
                    <div id="foto" class="caixa_imagem" >
                        <img src="bd/imagens/<?=$foto?>" alt="">
                    </div>
                    <form id="formFoto" name="frmFoto" method="post" action="bd/upload.php" enctype="multipart/form-data">
                        <div class="caixa_preencher">
                            <p>Imagem:</p>
                            <input id="fileFoto" class="fle_img" type="file" name="fleImage" >
                        </div>
                    </form>
                    <form name="frmSessoe" method="post" action="bd/salvar_sobre_conteudo.php">
                        <div class="caixa_preencher">
                            <p>Titulo:</p>
                            <input class="txt_preencher" name="txtTitulo" type="text" value="<?=$titulo?>" maxlength="50" required>
                        </div>
                        <div class="caixa_preencher">
                            <p>Descrição:</p>
                            <textarea name="textDescricao" maxlength="2000" required><?=$texto?></textarea>
                        </div>
                        <div class="botoes">
                            <input class="btn_adm_user" name="btnSalvar" type="submit" value="<?=$btnName?>">
                        </div>
                    </form>
                </div>
                <div class="visualizar_crud">
                    <div class="linha_visualizar_crud_header loja">
                        <div class="header_visualizar_crud nome_nivel">Titulo</div>
                        <div class="header_visualizar_crud nome_nivel">imagem</div>
                        <div class="header_visualizar_crud nome_nivel">descricao</div>
                        <div class="header_visualizar_crud nome_nivel">Editar/Deletar</div>
                        <div class="header_visualizar_crud">Ativar/Desativar</div>
                    </div>
                    <?php
                        $sql = "select * from tblsessoes_sobre";
                        $select = mysqli_query($conexao,$sql);
                        while($rsSobre = mysqli_fetch_array($select)){
                    ?>
                    <div class="linha_visualizar_crud loja">
                        <div class="coluna_visualizar_crud"><?=$rsSobre['titulo']?></div>
                        <div class="coluna_visualizar_crud">
                            <img src="bd/imagens/<?=$rsSobre['imagem']?>" alt="">
                        </div>
                        <div class="coluna_visualizar_crud crud_text"><?=$rsSobre['descricao']?></div>
                        <div class="coluna_visualizar_crud">
                            <a href="cms_sobre_sessoes.php?modo=editar&codigo=<?=$rsSobre['codigo']?>">
                                <img src="icons/edit.png" alt="">
                            </a>
                            <a onclick="return confirm('deseja realmente deletar esse registro?')" href="bd/delete_sessoes_sobre.php?modo=excluir&codigo=<?=$rsSobre['codigo']?>&nomeFoto=<?=$rsSobre['imagem']?>">
                                <img src="icons/delete.png" alt="">
                            </a>
                        </div>
                        <div class="coluna_visualizar_crud">
                            <a href="bd/status_sessoes_sobre.php?modo=ativar&codigo=<?=$rsSobre['codigo']?>">
                                <img  src="icons/true.png" alt="">
                            </a>
                            <a href="bd/status_sessoes_sobre.php?modo=desativar&codigo=<?=$rsSobre['codigo']?>">
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
<?php
    if( !isset($_SESSION)){
        session_start();
        /* ativando o recurso de variaveis de sessão */
    }
    
    require_once("bd/conexao.php");
    $conexao = conexaoMysql();
    
    /*variaveis*/
    $btnName = (string) "Criar";
    $sltParceiro = (string) "";
    $sltRedeSocial = (string) "";
    $imagem = (string) "";
    if(isset($_GET['modo'])){
        $btnName = $_GET['modo'];
        $codigo = $_GET['codigo'];
        $_SESSION['codigo'] = $codigo;
        /*script*/
        $sql = "select * from tblredes_parceiro
                where codigo =".$codigo;
        $select = mysqli_query($conexao, $sql);
        if($rsEditar = mysqli_fetch_array($select)){
            if($rsEditar['tipo'] == "Rede Sociais"){
                $sltRedeSocial = "selected";
            }elseif($rsEditar['tipo'] == "Parceiros"){
                $sltParceiro = "selected";
            }
            $imagem = $rsEditar['imagem'];
            $_SESSION['nomeFoto'] = $imagem; 
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
                        <img src="bd/imagens/<?=$imagem?>" alt="">
                    </div>
                    <form id="formFoto" name="frmFoto" method="post" action="bd/upload.php" enctype="multipart/form-data">
                        <div class="caixa_preencher">
                            <p>Imagem:</p>
                            <input id="fileFoto" class="fle_img" type="file" name="fleImage" >
                        </div>
                    </form>
                    <form name="frmRP" method="post" action="bd/salvar_rede_parceiro.php">
                        <div class="caixa_preencher">
                            <p>Rede/Parceiro</p>
                            <select class="caixa_selecionar" name="sltPertence" required>
                                <option value="">Selecione o tipo</option>
                                <option value="Rs" <?=$sltRedeSocial?>>Redes_sociais</option>
                                <option value="P" <?=$sltParceiro?>>Parceiro</option>
                            </select>
                        </div>
                        <div class="botoes">
                            <input class="btn_adm_user" name="btnSalvar" type="submit" value="<?=$btnName?>">
                        </div>
                        
                    </form>
                </div>
                <div class="visualizar_crud">
                    <div class="linha_visualizar_crud_header">
                        <div class="header_visualizar_crud nome_nivel">Imagem</div>
                        <div class="header_visualizar_crud nome_nivel">Rede Sociais/Parceiros</div>
                        <div class="header_visualizar_crud">Editar/Excluir</div>
                        <div class="header_visualizar_crud">Ativar/Desativar</div>
                    </div>
                    <?php
                        $sql = "select * from tblredes_parceiro";
                        $select = mysqli_query($conexao, $sql);
                        
                        /*execução*/
                        while($rsRsP = mysqli_fetch_array($select)){
                    ?>
                    <div class="linha_visualizar_crud ">
                        <div class="coluna_visualizar_crud">
                            <img src="bd/imagens/<?=$rsRsP['imagem']?>" alt="">
                        </div>
                        <div class="coluna_visualizar_crud"><?=$rsRsP['tipo']?></div>
                        <div class="coluna_visualizar_crud">
                            <a href="cms_rede_parceiro.php?modo=Editar&codigo=<?=$rsRsP['codigo']?>">
                                <img src="icons/edit.png" alt="">
                            </a>
                            <a onclick="return confirm('deseja realmente deletar esse registro?')" href="bd/delete_rs_p.php?modo=excluir&codigo=<?=$rsRsP['codigo']?>&nomeFoto=<?=$rsRsP['imagem']?>">
                                <img src="icons/delete.png" alt="">
                            </a>
                        </div>
                        <div class="coluna_visualizar_crud">
                            <a href="bd/status_rp.php?modo=ativar&codigo=<?=$rsRsP['codigo']?>">
                                <img  src="icons/true.png" alt="">
                            </a>
                            <a href="bd/status_rp.php?modo=desativar&codigo=<?=$rsRsP['codigo']?>">
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
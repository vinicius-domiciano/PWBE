<?php
    if( !isset($_SESSION)){
        session_start();
        /* ativando o recurso de variaveis de sessão */
    }

    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

    //variaveis
    $titulo = (string) "";
    $descricao = (string) "";
    $foto = (string) "";
    $background = (string) "";
    $btnName = (string) "Criar";
    $codigoLayout = (int) 0;
    $nomeLayout = (string) "";

    if(isset($_GET['modo'])){
        $btnName = "Editar";
        $codigo = $_GET['codigo'];
        $_SESSION['codigo'] = $codigo;
        
        $sql = "select tblcuriosidades.*, tblconteudo_layout.layout 
                from tblcuriosidades inner join tblconteudo_layout
                on tblcuriosidades.codigo_layout = tblconteudo_layout.codigo 
                where tblcuriosidades.codigo =".$codigo;
        $select = mysqli_query($conexao, $sql);
        
        if($rsEditar = mysqli_fetch_array($select)){
            $titulo = $rsEditar['titulo'];
            $descricao = $rsEditar['descricao'];
            $codigoLayout = $rsEditar['codigo_layout'];
            $nomeLayout = $rsEditar['layout'];
            $foto = $rsEditar['imagem'];
            $background = $rsEditar['fundo'];
            $_SESSION['nomeFoto'] = $foto;
            $_SESSION['nomeBk'] = $background;
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
            //modal de sessoes cadastradas
            $(document).ready(function(){
               
                //execultando o modal
                $('.visualizar').click(function(){
                    $('.container').fadeIn(1000);
                });
                
                $('#fechar').click(function(){
                    $('.container').fadeOut(1000);
                });
            });
            
            /*Exibir os dados no modal*/
            function visualizarDados(idItem){
                $.ajax({
                    type:"POST",
                    url:"modalCuriosidades.php",
                    data:{modo:'visualizar',codigo:idItem},
                    success: function(dados){
                        $('#modalDados').html(dados);
                    }
                    
                });
            }
            
            //upload e preview da imagem
            $('#fileFoto').live('change', function(){
                $('#formFoto').ajaxForm({
                    target:'#foto'
                }).submit();
            });
            
            //upload e preview da background
            $('#fileBackground').live('change', function(){
                $('#formBackground').ajaxForm({
                    target:'#imagen_fundo'
                }).submit();
            });
        </script>
    </head>
    <body>
        <!--Modal-->
        <div class="container">
            <div class="modal center">
                <div id="fechar">Fechar</div>
                <div id="modalDados"></div>
            </div>
        </div>
        <?php
            /**Importando cabecalho*/
            require_once("modulos/cabecalho.php");
        ?>
        <div class="conteudo center shadow">
            <!-- CMS CRIANDO O CRUD DA PAGINA CURIOSIDADES -->
            <section id="cms_curiosidades" class="center">
                <div class="adicionar">
                    <!--caixa upload imagem-->
                    <div id="foto" class="caixa_imagem">
                        <img src="bd/imagens/<?=$foto?>" alt=""> 
                    </div>
                    <form id="formFoto" name="frmImage" method="post" action="bd/upload.php" enctype="multipart/form-data">
                        <div class="caixa_preencher">
                            <p>Imagem:</p>
                            <input id="fileFoto" class="fle_img" type="file" name="fleImage" >
                        </div>
                    </form>
                    <!--caixa_uploadBackground-->
                    <div id="imagen_fundo" class="caixa_imagem_fundo">
                        <img src="bd/imagens/<?=$background?>" alt=""> 
                    </div>
                    <form id="formBackground" name="frmFundo" method="post" action="bd/upload_fundo.php" enctype="multipart/form-data">
                        <div class="caixa_preencher">
                            <p>Img. Fundo:</p>
                            <input id="fileBackground" class="fle_img" type="file" name="fleImage" >
                        </div>
                    </form>
                    <!--formulario de titulo e descricao-->
                    <form name="frmCuriosidades" method="post" action="bd/salvar_curiosidades.php">
                        <div class="caixa_preencher">
                            <p>Titulo:</p>
                            <input class="txt_preencher" name="txtTitulo" type="text" value="<?=$titulo?>" required>
                        </div>
                        <div class="caixa_preencher">
                            <p> Descriçao </p>
                            <textarea name="textDesc" required><?=$descricao?></textarea>
                        </div>
                        <div class="caixa_preencher">
                            <p>Layout:</p>
                            <select class="caixa_selecionar" name="sltLayout" required>
                                <?php
                                    //Verificando se existe a variavel modo
                                    if(isset($_GET['modo'])){
                                        if(strtoupper($_GET['modo'])  =='EDITAR'){
                                ?>
                                    <option value="<?=$codigoLayout?>"><?=$nomeLayout?></option>
                                <?php
                                        }
                                    }else{
                                ?>
                                    <option value="">Selecione um nivel</option>
                                <?php
                                    }
                                    //fazendo um select no banco de relacionamento com tabelas
                                    $sql = "SELECT * FROM  tblconteudo_layout WHERE codigo <>".$codigoLayout;
                                    $select = mysqli_query($conexao,$sql);
                                    //trazendo o resultado do script
                                    while($rsLayout = mysqli_fetch_array($select)){
                                ?>
                                    <option value="<?=$rsLayout['codigo']?>"><?=$rsLayout['layout']?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="botoes">
                            <input class="btn_adm_user" name="btnSalvar" type="submit" value="<?=$btnName?>">
                        </div>
                    </form>
                </div>
                <div class="visualizar_crud">
                    <div class="linha_visualizar_crud_header">
                        <div class="header_visualizar_crud nome_nivel">Titulo</div>
                        <div class="header_visualizar_crud">Visualizar</div>
                        <div class="header_visualizar_crud">Editar/Excluir</div>
                        <div class="header_visualizar_crud">Ativar/Desativar</div>
                    </div>
                    <?php
                        $sql = "select * from tblcuriosidades";
                        $select = mysqli_query($conexao, $sql);
                            
                        /*Execultando o script*/ 
                        while($rsVisualizar = mysqli_fetch_array($select)){
                    ?>
                    <div class="linha_visualizar_crud">
                        <div class="coluna_visualizar_crud"><?=$rsVisualizar['titulo']?></div>
                        <div class="coluna_visualizar_crud">
                            <a href="#" class="visualizar" onclick="visualizarDados(<?=$rsVisualizar['codigo']?>);">
                                <img src="icons/lupa.png" alt="">
                            </a>
                        </div>
                        <div class="coluna_visualizar_crud">
                            <a href="cms_curiosidades.php?modo=editar&codigo=<?=$rsVisualizar['codigo']?>">
                                <img src="icons/edit.png" alt="">
                            </a>
                            <a onclick="return confirm('deseja realmente deletar esse registro?')" href="bd/delete_curiosidade.php?modo=excluir&codigo=<?=$rsVisualizar['codigo']?>&nomeFoto=<?=$rsVisualizar['imagem']?>&nomeFundo=<?=$rsVisualizar['fundo']?>">
                                <img src="icons/delete.png" alt="">
                            </a>
                        </div>
                        <div class="coluna_visualizar_crud">
                            <a href="bd/status_curiosidades.php?modo=ativar&codigo=<?=$rsVisualizar['codigo']?>">
                                <img src="icons/true.png" alt="">
                            </a>
                            <a href="bd/status_curiosidades.php?modo=desativar&codigo=<?=$rsVisualizar['codigo']?>">
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
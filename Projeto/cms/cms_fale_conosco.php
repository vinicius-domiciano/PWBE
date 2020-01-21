<?php
    require_once("bd/conexao.php");
    $conexao = conexaoMysql();
    
    $verificaFiltro = true;
    $todosFiltros = (string)"Selecione um filtro";
    $filtroCritica = (string) "";
    $filtroSugestao = (string) "";
    $filtro = (string) "";

    if(isset($_POST['btnFiltro'])){
        $filtro = $_POST['sltFiltro'];
        
        if($verificaFiltro == true){
            $todosFiltros = "Todas Mensagens";
            $verificaFiltro = false;
        }else{
            $todosFiltros = "Selecione um filtro";
            $verificaFiltro = true;
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
        <meta name="viewport" content="initial-scale=1">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/estilizacoes.css">
        <script src="js/jquery.js"></script>
        <script>
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
                    url:"modalFaleConosco.php",
                    data:{modo:'visualizar',codigo:idItem},
                    success: function(dados){
                        $('#modalDados').html(dados);
                    }
                    
                });
            }
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
            require_once("modulos/cabecalho.php");
        ?>
        <!--Tabela de formularios-->
        <div class="conteudo center shadow">
            <section id="conteudo">
                <div id="filtragem">
                    <form name="fmrFiltragem" method="post" action="cms_fale_conosco.php">
                        <div id="caixa_filtro">
                            <select name="sltFiltro">
                                <option value=""><?=$todosFiltros?></option>
                                <option value="C" <?=$filtroCritica?> >Critica</option>
                                <option value="S" <?=$filtroSugestao?> >Sugestão</option>
                            </select>
                            <input type="submit" name="btnFiltro" value="Filtrar">
                        </div>
                    </form>
                </div>
                <table>
                    <!-- cabeçalho do que ira aparecer na tabela -->
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Sugestão/Critica</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = 'select * from tblcontatenos';
                            if( $filtro == "C" ){
                                $sql = "select * from tblcontatenos where tipo_mensagem = 'critica'";
                                $filtroCritica = "selected";
                            }elseif( $filtro == "S"){
                                $sql = "select * from tblcontatenos where tipo_mensagem = 'sugestao'";
                                $filtroSugestao = "selected";
                            }        
                            $select = mysqli_query($conexao, $sql);
                        
                            while( $rsContatos = mysqli_fetch_array($select)){
                        ?>
                        
                        <tr class="info_usuario">
                            <td><?=$rsContatos['nome']?></td>
                            <td><?=$rsContatos['celular']?></td>
                            <td><?=$rsContatos['email'];?></td>
                            <td>
                                <?php   
                                    // Verificação para ajustar a escrita
                                    if($rsContatos['tipo_mensagem'] == "critica"){
                                        echo("Critica");
                                    }elseif($rsContatos['tipo_mensagem'] == "sugestao"){
                                        echo("Sugestão");
                                    }
                                ?>
                                
                            </td>
                            <td>
                                <a href="#" class="visualizar" onclick="visualizarDados(<?=$rsContatos['codigo_contato']?>);">
                                    <img src="icons/lupa.png" alt="Carregar">
                                </a>
                                <a onclick="return confirm('Deseja realmente deletar esse registro?')" href="bd/delete.php?opcao=excluir&codigo=<?=$rsContatos['codigo_contato']?>">
                                    <img src="icons/delete.png" alt="Carregar">
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        
                    </tbody>
                </table>
            </section>
        </div>    
        <?php 
            require_once("modulos/rodape.php");
        ?>
    </body>
</html>
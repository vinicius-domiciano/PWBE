<?php
    if( !isset($_SESSION))
    /*ativando o recurso de variaveis de sessão no servidor*/
    session_start();

    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

    $btnValue = (string) "Criar";
    $nomeNivel = (string) "";
    $chkContatos = (string) "";
    $chkConteudo = (string) "";
    $chkUsuarios = (string) "";

    if(isset($_GET['modo'])){
        $btnValue = $_GET['modo'];
        $codigo = $_GET['codigo'];
        $_SESSION['codigo'] = $codigo;
        $sql = "SELECT * FROM tblniveis WHERE codigo =".$codigo;
        $select = mysqli_query($conexao, $sql);
        if($rsEditar = mysqli_fetch_array($select)){
            $nomeNivel = $rsEditar['nome_nivel'];
            if($rsEditar['adm_conteudo'] == 1){
                $chkConteudo = "checked";
            }
            if($rsEditar['adm_fale_conosco'] == 1){
                $chkContatos = "checked";
            }
            if($rsEditar['adm_user'] == 1){
                $chkUsuarios = "checked";
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
        <meta name="viewport" content="initial-scale=1">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/estilizacoes.css">
    </head>
    <body>
        <?php 
            require_once("modulos/cabecalho.php");
        ?>
        <div class="conteudo center shadow">
            <section id="adm_nivel">
                <div id="nivel" class="center">
                    <h2>Adm. dos niveis</h2>
                    <div id="niveis_criar">
                        <form name="fmrNivel" method="post" action="bd/salvar_nivel.php">
                            <div class="caixa_preencher">
                                <p>Nome Nivel:</p>
                                <input class="txt_preencher" name="txtNome" type="text" value="<?=$nomeNivel?>" maxlength="27" required>
                            </div>
                            <div class="caixa_preencher">
                                <p>Permissões:</p>
                                <input class="chk_nivel" name="chkConteudo" type="checkbox" value="true" <?=$chkConteudo?>><p class="chk_txt">1° -  ADM.Conteudo</p>
                                <input class="chk_nivel" name="chkContatos" type="checkbox" value="true" <?=$chkContatos?>><p class="chk_txt">2° - ADM.Fale Conosco</p>
                                <input class="chk_nivel" name="chkUsers" type="checkbox" value="true" <?=$chkUsuarios?>><p class="chk_txt">3° - ADM.Usuarios</p>
                            </div>
                            <div class="botoes">
                                <input class="btn_adm_user" name="btnNivel" type="submit" value="<?=$btnValue?>">
                            </div>
                        </form>
                    </div>
                    <div class="visualizar_crud">
                        <div class="linha_visualizar_crud_header">
                            <div class="header_visualizar_crud nome_nivel">Nome</div>
                            <div class="header_visualizar_crud">Permissões</div>
                            <div class="header_visualizar_crud">Editar/Excluir</div>
                            <div class="header_visualizar_crud">Ativar/Desativar</div>
                        </div>
                        <?php 
                            $sql = "SELECT * FROM tblniveis";
                            $select = mysqli_query($conexao, $sql);
                        
                            while($rsNivel = mysqli_fetch_array($select)){
                        ?>
                        
                        <div class="linha_visualizar_crud">
                            <div class="coluna_visualizar_crud nome_nivel"><?=$rsNivel['nome_nivel'];?></div>
                            <div class="coluna_visualizar_crud">
                                <?php
                                    if($rsNivel['adm_user'] == 1 && $rsNivel['adm_fale_conosco'] == 1 && $rsNivel['adm_conteudo'] == 1){
                                        echo("Todas");
                                    }else{
                                        $virgula = "";
                                        if($rsNivel['adm_conteudo'] == 1){
                                            echo("1°");
                                            $virgula = ", ";
                                        }
                                        if($rsNivel['adm_fale_conosco'] == 1){
                                            echo($virgula."2°");
                                            $virgula = ", ";
                                        }
                                        if($rsNivel['adm_user'] == 1){
                                            echo($virgula."3°");
                                        }
                                    }
                                ?>
                                
                            </div>
                            <div class="coluna_visualizar_crud">
                                <a href="adm_niveis.php?modo=Editar&codigo=<?=$rsNivel['codigo']?>">
                                    <img src="icons/edit.png" alt="editar">
                                </a>
                                <a href="bd/adm_users_delete.php?modo=deletar_nivel&codigo=<?=$rsNivel['codigo']?>" onclick="return confirm('Deseja realmente deletar esse nivel?')">
                                    <img src="icons/delete.png" alt="Deletar">
                                </a>
                            </div>
                            <div class="coluna_visualizar_crud">
                                <a href="bd/status_usuario.php?modo=ativar&local=nivel&codigo=<?=$rsNivel['codigo']?>">
                                    <img  src="icons/true.png" alt="">
                                </a>
                                <a href="bd/status_usuario.php?modo=desativar&local=nivel&codigo=<?=$rsNivel['codigo']?>">
                                    <img src="icons/false.png" alt="">
                                </a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        
                    </div>
                </div>
            </section>
        </div>
        <?php 
            require_once("modulos/rodape.php");
        ?>
    </body>
</html>
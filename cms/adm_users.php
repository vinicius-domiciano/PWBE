<?php
    if( !isset($_SESSION)){
        session_start();
        /* ativando o recurso de variaveis de sessão */
    }

    require_once('bd/conexao.php');
    $conexao = conexaoMysql();
    
    //variaveis
    $codigoNivel = (integer) 0;
    $btnValue = (string) 'Criar';
    $nome = (string) "";
    $nomeNivel = (string) "";
    $usuario = (string) "";
    $disabled = (string) "";

    if(isset($_GET['modo'])){
        $btnValue = $_GET['modo'];
        $codigo = $_GET['codigo'];
        //enviando o codigo por uma variavel de sessão
        $_SESSION['codigo'] = $codigo;
        /*select no banco*/
        $sql = "select tblusuario.*, tblniveis.nome_nivel 
                from tblusuario 
                inner join tblniveis on 
                tblusuario.codigo_nivel = tblniveis.codigo 
                where tblusuario.codigo = ".$codigo;
        $select = mysqli_query($conexao, $sql);
        
        if($rsEditar = mysqli_fetch_array($select)){
            $codigoNivel = $rsEditar['codigo_nivel']; 
            $nome = $rsEditar['nome'];
            $nomeNivel = $rsEditar['nome_nivel'];
            $usuario = $rsEditar['usuario'];
            $disabled = "disabled";
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
            <section id="adm_usuario">
                <div id="usuario" class="center">
                    <h2>ADM. Usuarios</h2>
                    <div id="adicionar_usuario">
                        <form name="fmrUsuario" method="post" action="bd/salvar_usuario.php">
                            <div class="caixa_preencher">
                                <p> Nome: </p>
                                <input class="txt_preencher" name="txtNome" type="text" value="<?=$nome?>" maxlength="120" required>
                            </div>
                            <div class="caixa_preencher">
                                <p> Usuario: </p>
                                <input class="txt_preencher" name="txtUsuario" type="text" value="<?=$usuario?>" maxlength="50" required>
                            </div>
                            <div class="caixa_preencher">
                                <p> Senha: </p>
                                <input class="txt_preencher" name="txtSenha" type="text" value="" maxlength="30" required <?=$disabled?>>
                            </div>
                            <div class="caixa_preencher">
                                <p> Nivel </p>
                                <select class="caixa_selecionar" name="sltNivel" required>
                                    
                                <?php
                                    //Verificando se existe a variavel modo
                                    if(isset($_GET['modo'])){
                                        if(strtoupper($_GET['modo']) =='EDITAR'){
                                ?>
                                    <option value="<?=$codigoNivel?>"><?=$nomeNivel?></option>
                                <?php
                                        }
                                    }else{
                                ?>
                                    <option value="">Selecione um nivel</option>
                                <?php
                                    }
                                       
                                    //fazendo um select no banco de relacionamento com tabelas
                                    $sql = "SELECT * FROM tblniveis WHERE codigo <>".$codigoNivel." and status = 1 ";
                                    $select = mysqli_query($conexao,$sql);
                                    //trazendo o resultado do script
                                    while($rsNivel = mysqli_fetch_array($select)){
                                ?>
                                    <option value="<?=$rsNivel['codigo']?>"><?=$rsNivel['nome_nivel']?></option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="botoes">
                                <input class="btn_adm_user" name="btnUsuario" type="submit" value="<?=$btnValue?>">
                            </div>
                        </form>
                    </div>
                    <div class="visualizar_crud ">
                        <div class="linha_visualizar_crud_header crud_usuario user">
                            <div class="header_visualizar_crud nome_nivel">Nome</div>
                            <div class="header_visualizar_crud">Usuario</div>
                            <div class="header_visualizar_crud">Nivel</div>
                            <div class="header_visualizar_crud">Editar/Excluir</div>
                            <div class="header_visualizar_crud">Ativar/Desativar</div>
                        </div>
                        <?php
                            $sql = "SELECT tblniveis.nome_nivel, tblusuario.* 
                            FROM tblusuario INNER JOIN tblniveis on 
                            tblusuario.codigo_nivel = tblniveis.codigo
                            order by codigo asc" ;
                        
                            $select = mysqli_query($conexao, $sql);
                            //select para trazer todos o cadastros
                            while($rsVisualizar = mysqli_fetch_array($select)){
                        ?>
                        <div class="linha_visualizar_crud crud_usuario user">
                            <div class="coluna_visualizar_crud nome_nivel"><?=$rsVisualizar['nome']?></div>
                            <div class="coluna_visualizar_crud"><?=$rsVisualizar['usuario']?></div>
                            <div class="coluna_visualizar_crud"><?=$rsVisualizar['nome_nivel']?></div>
                            <div class="coluna_visualizar_crud">
                                <a href="adm_users.php?modo=Editar&codigo=<?=$rsVisualizar['codigo']?>">
                                    <img src="icons/edit.png" alt="editar">
                                </a>
                                <a href="bd/adm_users_delete.php?modo=deletar_user&codigo=<?=$rsVisualizar['codigo']?>" onclick="return confirm('Deseja realmente deletar esse usuario?')">
                                    <img src="icons/delete.png" alt="deletar">
                                </a>
                            </div>
                            <div class="coluna_visualizar_crud">
                                <a href="bd/status_usuario.php?modo=ativar&local=user&codigo=<?=$rsVisualizar['codigo']?>">
                                    <img src="icons/true.png" alt="">
                                </a>
                                <a href="bd/status_usuario.php?modo=desativar&local=user&codigo=<?=$rsVisualizar['codigo']?>">
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
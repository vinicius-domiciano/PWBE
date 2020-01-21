<?php
    
    if(isset($_POST['modo'])){
        if(strtoupper($_POST['modo']) == "VISUALIZAR"){
            $codigo = $_POST['codigo'];
            /*importando o DB*/
            require_once("bd/conexao.php");
            $conexao = conexaoMysql();
            
            $sql = "select * from tblcontatenos where codigo_contato =".$codigo;
            //utilizando o script no DB
            $select = mysqli_query($conexao, $sql);
            
            if($rsVisualizar = mysqli_fetch_array($select)){
                $nome = $rsVisualizar['nome'];
                $email = $rsVisualizar['email'];
                $telefone = $rsVisualizar['telefone'];
                $celular = $rsVisualizar['celular'];
                $homePage = $rsVisualizar['home_page'];
                $facebook = $rsVisualizar['facebook'];
                //Verificação para arrumar a escrita do Susgetão ou Critica
                if($rsVisualizar['tipo_mensagem'] == "critica"){
                    $tipoMensagem = "Critica";
                }elseif($rsVisualizar['tipo_mensagem'] == "sugestao"){
                    $tipoMensagem = "Sugestão";
                }
                // Verificação de Feminino e Masculino
                if($rsVisualizar['sexo'] == "F"){
                    $sexo = "Feminino";
                }else{
                    $sexo = "Masculino";
                }
                $profissao = $rsVisualizar['profissao'];
                $mensagem = $rsVisualizar['mensagem'];
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
                    Nome:
                </div>
                <div class="coluna_modal">
                    <?=$nome?>
                </div>
            </div>
            <!--Email-->
            <div class="linha_modal center">
                <div class="coluna_modal">
                    Email:
                </div>
                <div class="coluna_modal">
                    <?=$email?>
                </div>
            </div>
            <!--Telefone-->
            <div class="linha_modal center">
                <div class="coluna_modal">
                    Telefone:
                </div>
                <div class="coluna_modal">
                    <?=$telefone?>
                </div>
            </div>
            <!--CELULAR-->
            <div class="linha_modal center">
                <div class="coluna_modal">
                    Celular:
                </div>
                <div class="coluna_modal">
                    <?=$celular?>
                </div>
            </div>
            <!--HOME PAGE-->
            <div class="linha_modal center">
                <div class="coluna_modal">
                    Home Page:
                </div>
                <div class="coluna_modal">
                    <?=$homePage?>
                </div>
            </div>
            <!--FACEBOOK-->
            <div class="linha_modal center">
                <div class="coluna_modal">
                    Facebook:
                </div>
                <div class="coluna_modal">
                    <?=$facebook?>
                </div>
            </div>
            <!--CRITICA/SUGESTÃO-->
            <div class="linha_modal center">
                <div class="coluna_modal">
                    Critica/Sugestão:
                </div>
                <div class="coluna_modal">
                    <?=$tipoMensagem?>
                </div>
            </div>
            <!--SEXO-->
            <div class="linha_modal center">
                <div class="coluna_modal">
                    Sexo:
                </div>
                <div class="coluna_modal">
                    <?=$sexo?>
                </div>
            </div>
            <!--PROFISSÃO-->
            <div class="linha_modal center">
                <div class="coluna_modal">
                    Profissão:
                </div>
                <div class="coluna_modal">
                    <?=$profissao?>
                </div>
            </div>
        </div>
        <div id="caixa_mensagem">
            <!--MENSAGEM-->
            <div class="linha_mensagem center">
                <div class="coluna_mensagem">
                    Mensagem:
                </div>
                <div class="coluna_mensagem">
                    <?=$mensagem?>
                </div>
            </div>
        </div>
    </body>
</html>
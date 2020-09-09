<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Delicia Gelada - Entre em Contato</title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/estilizacoes.css">
        <link rel="stylesheet" type="text/css" href="css/cabecalho_rodape.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/modulos.js"></script>
    </head>
    <body>
        <!--    Cabeçalho    -->
        <?php
            require_once('modulos/cabecalho.php');
        ?>
        <section id="contate">
            <div class="conteudo center">
                <!-- Titulo pg -->
                <div id="titulo_contate">
                    <h2>
                        Entre em contato:
                    </h2>
                </div>
                <!-- Formulario -->
                <form name="frmContateNos" method="post" action="bd/inserir.php">
                    <!--Nome-->
                    <div class="caixa_inserir">
                        <p class="txt">
                            Nome: *
                        </p>
                        <br>
                        <input type="text" name="txtNome" value="" class="input_inserir" placeholder="Digite Seu nome" onkeypress="return validarEntrada(event, 'numeric')" required/>
                    </div>
                    <!--Email-->
                    <div class="caixa_inserir">
                        <p class="txt">
                            Email: *
                        </p>
                        <br>
                        <input type="email" name="txtEmail" value="" class="input_inserir" placeholder="Digite Seu Email" required>
                    </div>
                    <!--Telefone e Celular-->
                    <div class="caixa_inserir">
                        <!--Telefone-->
                        <div class="col">
                            <p class="txt">
                                Telefone:
                            </p>
                            <br>
                            <input id="telefone" type="text" name="txtTel" value="" class="input_inserir" maxlength="15" minlength="15" placeholder="Digite Seu Telefone" onkeypress="return mascaraFone(this, event, 'tel')"/>
                        </div>
                        <!--Celular-->
                        <div class="col">
                            <p class="txt">
                                Celular: *
                            </p>
                            <br>
                            <input id="celular" type="text" name="txtCel" value="" class="input_inserir" placeholder="DDD 0000-0000" minlength="16" maxlength="16" onkeypress="return mascaraFone(this, event, 'cel')" required>
                        </div>
                    </div>
                    <!--Home Page-->
                    <div class="caixa_inserir">
                        <p class="txt">
                            Home Page:
                        </p>
                        <br>
                        <input type="url" name="txtPage" value="" class="input_inserir" placeholder="Digite Seu Home Page">
                    </div>
                    <!--Link Facebook-->
                    <div class="caixa_inserir">
                        <p class="txt">
                            Link Facebook:
                        </p>
                        <br>
                        <input type="url" name="txtFacebook" value="" class="input_inserir" placeholder="Digite Seu Facebook">
                    </div>
                    <!--Sugestão ou Critica-->
                    <div class="caixa_inserir">
                        <p class="txt">
                            Sugestão/Crítica:
                        </p>
                        <br>
                        <input type="radio" name="rdoOpiniao" value="sugestao" class="input_rdo"> Sugestão
                        <input type="radio" name="rdoOpiniao" value="critica" class="input_rdo"> Crítica
                    </div>
                    <!--Mensagem-->
                    <div id="caixa_mensagem">
                        <p class="txt">
                            Mensagem: *
                        </p>
                        <br>
                        <textarea name="txtMensagem" required></textarea>
                    </div>
                    <!--Sexo-->
                    <div class="caixa_inserir">
                        <p class="txt">
                            Sexo: *
                        </p>
                        <br>
                        <input type="radio" name="rdoSexo" value="F" class="input_rdo" required> Feminino
                        <input type="radio" name="rdoSexo" value="M" class="input_rdo" required> Masculino
                    </div>
                    <!--Profissão-->
                    <div class="caixa_inserir">
                        <p class="txt">
                            Profissão: *
                        </p>
                        <br>
                        <input type="text" name="txtProfissao" value="" class="input_inserir" placeholder="Digite Sua Profissão" onkeypress="return validarEntrada(event, 'numeric')" required>
                    </div>
                    <div id="caixa_button">
                        <p class="txt">
                            OBS: Prencher os Campos marcados com *
                        </p>
                        <input type="submit" name="btnEnviar" value="Enviar" class="input_btn">
                        <div class="input_btn_limpar">
                            <a href="contatenos.php">
                                Limpar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </section>    
        <!--    Rodapé    -->
        <?php
            require_once('modulos/rodape.php');
        ?>
    </body>
</html>
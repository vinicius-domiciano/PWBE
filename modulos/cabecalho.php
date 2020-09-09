<header>
            <div class="conteudo center">
                <!-- logo -->
                <div id="logo" class="center_mobile">
                    <img src="img/logo.png" alt="logo">
                </div>
                <!--        Menu Principal        -->
                <nav>
                    <ul id="menu">
                        <li class="menu_itens">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="menu_itens">
                            <a href="promocao.php">Promoções</a> 
                        </li>
                        <li class="menu_itens">
                            <a href="produtos_mes.php">Produtos do mês</a> 
                        </li>
                        <li class="menu_itens"> 
                            <a href="nossas_lojas.php">Nossas lojas</a>
                        </li>
                        <li class="menu_itens desktop"> 
                            <a href="curiosidades.php">Curiosidades</a>
                        </li>
                        <li class="menu_itens desktop" ><a href="sobre_nos.php"> Sobre Nos </a></li>
                        <li class="menu_itens desktop"><a href="contatenos.php">Contate Nos</a></li>
                        <li class="menu_not_itens notebook">
                            Mais
                            <ul class="submenu_notebook">
                                <li class="menu_itens "> 
                                    <a href="curiosidades.php">Curiosidades</a>
                                </li>
                                <li class="menu_itens" ><a href="sobre_nos.php"> Sobre Nos </a></li>
                                <li class="menu_itens"><a href="contatenos.php">Contate Nos</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!--Menu para Mobile-->
                    <ul id="menu_mobile">
                        <li class="menu_itens">
                            <img src="icones/menu_mobile.png" alt="">
                            <ul id="submenu_mobile">
                                <li class="submenu_itens">
                                    <a href="index.php">
                                        Home
                                    </a>
                                </li>
                                <li class="submenu_itens">
                                    <a href="promocao.php">
                                        Promoções
                                    </a> 
                                </li>
                                <li class="submenu_itens">
                                    <a href="produtos_mes.php">
                                        Produtos do mês
                                    </a> 
                                </li>
                                <li class="submenu_itens"> 
                                    <a href="nossas_lojas.php">
                                        Nossas lojas
                                    </a>
                                </li>
                                <li class="submenu_itens"> 
                                    <a href="curiosidades.php">
                                        Curiosidades
                                    </a>
                                </li>
                                <li class="submenu_itens" >
                                    <a href="sobre_nos.php"> 
                                        Sobre Nos 
                                    </a>
                                </li>
                                <li class="submenu_itens">
                                    <a href="contatenos.php">
                                        Contate Nos
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!--       Login       -->
                <div id="login">
                    <form name="fmrLoginCms" method="post" action="bd/usuario.php">
                        <div class="inserir">
                            Usuário: <br>
                            <input type="text" name="txtusuario" value="" class="txtinserir" required>
                        </div>
                        <div class="inserir">
                            Senha: <br>
                            <input type="password" name="txtsenha" value="" class="txtinserir" required>
                        </div>
                        <div id="botao">
                            <input type="submit" name="btnLogin" value="OK" id="botao_ok">
                        </div>
                    </form>
                </div>
                <div id="caixa_redes_sociais" class=" display_none_mobile">
                    <div class="rede_social"><img src="icones/facebook.png" alt="facebook"></div>
                    <div class="rede_social"><img src="icones/twitter.png" alt="twitter"></div>
                    <div class="rede_social"><img src="icones/Pinterest.png" alt="pinterest"></div>
                </div>
            </div>
        </header>
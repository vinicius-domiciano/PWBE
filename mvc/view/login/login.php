<div id="caixa_login" class="bkground">
    <div class="login center">
        <div class="center">
            <div class="center logo">
                <img src="view/imagem/logo.png">
            </div>
            <h2>
             Sistema Interno - Login
            </h2>
        </div>
        <form name="frmLogin" method="post" action="router.php?controller=login&modo=login" autocomplete="off">
            <div class="caixa_preencher">
                <p>Usuario:</p>
                <input name="txtuser" type="text" class="txt_preencher" required> 
            </div>
            <div class="caixa_preencher">
                <p>Senha:</p>
                <input name="txtpassword" type="password" class="txt_preencher" required> 
            </div>
            <div class="botoes">
                <input class="btn_adm_user" name="btnSalvar" type="submit" value="Login">
            </div>
        </form>
    </div>
</div>
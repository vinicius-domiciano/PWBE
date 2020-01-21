<?php
    //verificando se a imagen existe
    if($_FILES['fleImage']['size'] > 0 && $_FILES['fleImage']['type'] != ""){
        //tamanho do arquivo
        $arquivo_size = $_FILES['fleImage']['size'];
        //conversao para KBytes
        $tamanho_imagen = round($arquivo_size / 1024);
        $ext_permitidas = array("image/jpeg", "image/jpg", "image/png");
        //extensão da imagem
        $ext_imagem = $_FILES['fleImage']['type'];
        
        /* valida o arquivo se esta na extensao permitida  */
        if( in_array($ext_imagem, $ext_permitidas)){
            /* verifica o tamanho maximo do arquivo */
            if( $tamanho_imagen < 2048 ){
                //nome da imageM
                $nome_imagem = pathinfo($_FILES['fleImage']['name'],PATHINFO_FILENAME);
                //Extensao da imagem
                $ext = pathinfo($_FILES['fleImage']['name'],PATHINFO_EXTENSION);
                
                //Criptografando nome da imagem
                $nome_imagem_criptografado = MD5(uniqid(time()).$nome_imagem);
                
                $foto = $nome_imagem_criptografado.".".$ext;
                
                $arquivo_temp = $_FILES['fleImage']['tmp_name'];
                
                $diretorio = "imagens/";
                
                if(move_uploaded_file($arquivo_temp, $diretorio.$foto)){
                    session_start();
                    $_SESSION['previewBackground'] = $foto;
                    echo("<img src='bd/imagens/".$foto."' alt='imagem escolhida' >");
                }else{
                     echo("<script> alert('Não foi possivel enviar a imagen para o servidor') </script>");
                }
                
            }else{
                 echo("
                    <script> 
                        alert('Tamanho de arqivo nao pode ser maior do que 2Mb')
                    </script>"
                     );
            }
        }else{
            echo("
                <script>
                    alert('Tipo de arquivo não pode ser enviado para o servidor (Arquivos Permitidos:    .jpg, .jpeg, .png)')
                </script>
            ");
        }
    }else{
        echo("<script>
                    alert('arquivo não selecionado conforme o tamanho ou tipo de arquivo') 
            </script>");
    }

?>
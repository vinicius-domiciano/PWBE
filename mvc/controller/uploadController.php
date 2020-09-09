<?php
/*  Classe controller de upload de imagem
    Autor: Vinicius Domiciano
    Data de Criação: 07/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class UploadController{
    
    private $upload;
        
    public function __construct(){
        require_once('model/uploadClass.php');
        $this->upload = new UploadClass();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->upload->setImagem($_FILES['fleImage']);
        }
        
    }
    
    public function uploadImagem(){
        //verificando se a imagen existe
        $imagem = $this->upload->getImagem();
        
        if($imagem['size'] > 0 && $imagem['type'] != ""){
            //tamanho do arquivo
            $arquivo_size = $imagem['size'];
            //conversao para KBytes
            $tamanho_imagen = round($arquivo_size / 1024);
            $ext_permitidas = array("image/jpeg", "image/jpg", "image/png");
            //extensão da imagem
            $ext_imagem = $imagem['type'];

            /* valida o arquivo se esta na extensao permitida  */
            if( in_array($ext_imagem, $ext_permitidas)){
                /* verifica o tamanho maximo do arquivo */
                if( $tamanho_imagen < 2048 ){
                    //nome da imageM
                    $nome_imagem = pathinfo($imagem['name'],PATHINFO_FILENAME);
                    //Extensao da imagem
                    $ext = pathinfo($imagem['name'],PATHINFO_EXTENSION);

                    //Criptografando nome da imagem
                    $nome_imagem_criptografado = MD5(uniqid(time()).$nome_imagem);

                    $foto = $nome_imagem_criptografado.".".$ext;

                    $arquivo_temp = $imagem['tmp_name'];

                    $diretorio = "../imagens/";

                    if(move_uploaded_file($arquivo_temp, $diretorio.$foto)){
                        /*Ativando a variavel de sessaõ*/
                        if( !isset($_SESSION)){
                            session_start();
                            /* ativando o recurso de variaveis de sessão */
                        }
                        //verifica se exixte ja uma foto e apaga
                        if(isset($_SESSION['foto'])){
                            unlink('../imagens/'.$_SESSION['foto']);
                            unset($_SESSION['foto']);
                        }
                        
                        $_SESSION['previewFoto'] = $foto;
                        echo("<img src='../imagens/".$foto."'/>");
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
    }
    
}

?>
$ativa = document.querySelectorAll('.ativa');
$desativa = document.querySelectorAll('.desativa');

function status(){
    for(let i = 0;i < $ativa.length; i++){
        if($ativa[i].alt == "true"){
            $ativa[i].src = "view/imagem/true.png";
            $desativa[i].src = "view/imagem/false (2).png";
        }else{
            $desativa[i].src = "view/imagem/false.png"
            $ativa[i].src = "view/imagem/true (2).png";
        }
    }
}

status();
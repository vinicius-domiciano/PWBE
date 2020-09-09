/*
Validando se o checkbox foi clicado para desbloquear 
as outras inputs

*/
const $chkProdutos = document.getElementById('chk_promocao')
const $inputText = document.querySelectorAll('.inputChecked');
//função que verifica se foi seleciona ou nao, e chama as funcao correspondentes
function verificaStatus(){
    if($chkProdutos.checked == true){
        statusInput(false);
    }else{
        statusInput(true);
    }
}

//função que ativa ou desativa as input
function statusInput(decisao){
    for(let i=0 ;i < $inputText.length; i++){
        $inputText[i].disabled = decisao;
    }
}

$chkProdutos.addEventListener("click", verificaStatus);
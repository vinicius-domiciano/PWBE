function validarEntrada(caracter, typeBlock){
    // charCode - converte o carecter digitado em ascii
    var tipo = typeBlock;
    //Serve para padronizar a conversão em ascii em todas versões de navegadores
    //os que são baseado em janela ou não
    if(window.event){
        var asc = caracter.charCode;
    }else{
        var asc = caracter.which;
    }
    
    //valida apenas a digitação de letras
    if(tipo == "numeric" ){
        if(asc >= 48 && asc <=57){
        return false; //cancela o evento da tecla digitada
        }
    }else if(tipo == "string"){
        if(asc <48 || asc > 57){
        return false;
        }
    }
}

function mascaraDate(obj, caracter){
    
    if(validarEntrada(caracter, "string") == false){
        return false
    }else{
    }
    
    var input = obj.value;
    var resultado = input;
    var id = obj.id;
    
    if(input.length == 2 || input.length == 5){
        resultado += "/";
    }else if(input.length == 10){
        return false;
    }   
    document.getElementById(id).value = resultado;
}

//criaçao do grafico
function dadosGrafico(){
    var $elementViews = document.querySelectorAll('.view');
    var views = Array.prototype.slice.call($elementViews);
    var array = views.map(obterViews);
    var max = array.reduce(maiorNum);
    createGrafico(array, max);
}

function createGrafico(array, maior){
    var $grafico = document.querySelectorAll('.grafico');
    var $porcentagem = document.querySelectorAll('.porcentagem');
    var x = 0;
    console.log($grafico);
    for(let i = 0; i < array.length; i++){
        x = array[i] * 100;
        x = x / maior;
        x = x.toFixed(2)
        $grafico[i].style = `width: ${x}%`;
        $porcentagem[i].innerHTML = `${x}%`;
    }
}

const obterViews = (elemento, indice) => {
    var view = parseInt(elemento.innerHTML);
    if(view){
        return view;
    }else{
        return 0;
    }
}

const maiorNum = (maior, num) => Math.max(maior, num);
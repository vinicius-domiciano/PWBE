function validarEntrada(caracter, typeBlock){
    //Conversão de caracter
    var tipo = typeBlock;
   
    //padronização navegadores
    if(window.event){
        var asc = caracter.charCode;
    }else{
        var asc = caracter.which;
    }
    
    //validação de letras ou numeros
    if(tipo == "numeric" ){
        if(asc >= 48 && asc <=57){
        return false;
        }
    }else if(tipo == "string"){
        if(asc <48 || asc > 57){
        return false;
        }
    }
}

/*Mascara para telefones e numeros*/
function mascaraFone(obj, caracter, tipoMascara){
    /*Mascara para telefone*/
    if( tipoMascara == "tel" ){
        if(validarEntrada(caracter, "string") == false){
        return false;
        }else{
        }

        var input = obj.value;
        var resultado = input;
        var id = obj.id;

        if(input.length == 0){
            resultado = "(";
        }else if(input.length == 4){
            resultado += ") ";
        }else if(input.length == 10){
            resultado += "-";      
        }else if(input.length == 15){
            return false;
        }   
        document.getElementById(id).value = resultado;

    }else if( tipoMascara == "cel" ){
        /*Mascara para celular*/
        if(validarEntrada(caracter, "string") == false){
        return false;
        }else{
        }

        var input = obj.value;
        var resultado = input;
        var id = obj.id;

        if(input.length == 0){
            resultado = "(";
        }else if(input.length == 4){
            resultado += ") ";
            resultado += 9;
        }else if(input.length == 11){
            resultado += "-";      
        }else if(input.length == 16){
            return false;
        }   
        document.getElementById(id).value = resultado;
    }
    
}

//funçao para adicionar ou reduzir contador
function contProduto(){
    /*obtendo os botoes*/
        const $mais = document.getElementById("mais");    
        const $menos = document.getElementById("menos");    
        const $cont = document.getElementById("cont");
        
        const contador =(operacao) =>{
            $num = parseInt($cont.innerHTML);
            if(operacao == "mais" && $num < 50){
                adicionar($num);
            }
            if(operacao == "menos" && $num != 0){
                retirar($num);
            }
        }
    
        const adicionar = (num) =>{
            $cont.innerHTML = num + 1;
        }
        
        const retirar = (num) =>{
            $cont.innerHTML = num - 1;
        }

        $mais.addEventListener("click", () => contador("mais"));
        $menos.addEventListener("click", () => contador("menos"));
}
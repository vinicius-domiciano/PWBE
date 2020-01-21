<?php 
    function conexaoMysql(){
//        local banco
        $server = (string) "localhost";
//        usuario
        $user = (string) "root";
//        senha
        $password = (string) "vini2003";
//        banco de dados
        $database = (string) "dbdeliciagelada";
//        conexão
        $conexao = mysqli_connect($server, $user, $password, $database);
        
        return $conexao;
    }

?>
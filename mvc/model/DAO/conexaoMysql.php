<?php

/* Classe para conexão com o banco de dados
    Autor: Vinicius Domiciano
    Data de Criação: 07/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class ConexaoMysql {
    private $server;
    private $user;
    private $password;
    private $database;
    
    //Construtor
    public function __construct (){
        $this->server="localhost";
        $this->user="root";
        $this->password="vini2003";
        $this->database="dbdeliciagelada";
    }
    
    //abrindo conexão com o banco
    public function conectDataBase(){
        try{
            $conexao = new PDO('mysql:host='.$this->server.';dbname='.$this->database, $this->user, $this->password);
            return $conexao;
        }catch(PDOException $erro){
            echo("  Erro ao realizar a conexão com o banco de dados
                    <br>
                    Erro na Linha:".$erro->getLine()."
                    <br>
                    Mensagem:".$erro->getMessage()
                );
        }
    }
}

?>
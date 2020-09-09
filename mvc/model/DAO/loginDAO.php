<?php
    
/*  Classe para integração com o banco
    Autor: Vinicius Domiciano
    Data de Criação: 07/12/2019
    Modificações:
        Data:
        Alterações Realizadas:
        Nome de Desenvolvedor:
*/

class LoginDAO{
    
    private $conexaoMysql;
    private $conexao;
    
    //construtor
    public function __construct (){
        require_once('conexaoMysql.php');
        require_once('model/loginClass.php');
        //instancia a classe com a conexão com banco
        $this->conexaoMysql = new ConexaoMysql();
        //Abre a conexão do banco de dados
        $this->conexao = $this->conexaoMysql->conectDataBase();
    }
    
    //Busca o Usuario e a senha digitado
    public function buscarUser(LoginClass $login){
        $sql = "select * from tblusuario where usuario ='".$login->getUser()."' and senha = '".$login->getPassword()."'";
        $select = $this->conexao->query($sql);
        if($rs = $select->fetch(PDO::FETCH_ASSOC)){
            //CRIANDO UM OBJETO
            $listLogin = new LoginClass();
            $listLogin->setUser($rs['usuario']);
            $listLogin->setPassword($rs['senha']);
        }
        
        if(isset($listLogin)){
            return $listLogin;
        }else{
            return false;
        }
        
    }
    
}

?>
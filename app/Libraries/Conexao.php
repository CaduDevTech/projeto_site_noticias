<?php 

class Conexao{

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "banco_site_noticias";
    private $porta = "3306";
    private $dbh;
    private $stmt;

public function __construct()
{
$serverName = $this->host;
$userName = $this->user;
$password = $this->password;
$db_name = $this->database;

$opcoes = [
  PDO::ATTR_PERSISTENT => true,
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

try{
$this->dbh = new PDO("mysql:host=$serverName;port=$this->porta;dbname=$db_name", $userName, $password, $opcoes);

}catch(PDOException $e){

    print "Erro ao conectar ao banco de dados: " . $e->getMessage();
    die();
}

    }

public function query($sql){
    $this->stmt = $this->dbh->prepare($sql);
    }

public function executa(){
    return$this->stmt->execute();
}

public function resultados(){
    $this->executa();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
}

public function resultado(){
    $this->executa();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
}

public function bind($parametro, $valor, $tipo = null){
    if(is_null($tipo)){
        switch(true){
            case is_int($valor):
                $tipo = PDO::PARAM_INT;
                break;
            case is_bool($valor):
                $tipo = PDO::PARAM_NULL;
                break;
            case is_null($valor):
                $tipo = PDO::PARAM_NULL;
                break;
            default:
                $tipo = PDO::PARAM_STR;
            }

            $this->stmt->bindValue($parametro, $valor, $tipo);
        }
    }

    public function totalResultados(){
        return $this->stmt->rowCount();
    }

    public function ultimoIdInserido(){
        return $this->dbh->lastInsertId();
    }
}
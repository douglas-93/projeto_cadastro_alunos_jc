<?php

class ConexaoDB
{
    private $server = "127.0.0.1";
    private $database = "cadastro";
    private $username = "root";
    private $password = "";
    private $dsn_options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    private $conn;

    function __construct()
    {
        if (!$this->check_database()) {
            $this->create_database();
        }
        $string_conection = "mysql:host=$this->server;dbname=$this->database;";

        try {
            $this->conn = new PDO($string_conection, $this->username, $this->password, $this->dsn_options);
        } catch (PDOException $th) {
            echo "Error: " . $th->getMessage();
        }
    }

    function __destruct()
    {
        if ($this->conn) {
            $this->conn = null;
        }
    }

    function check_database()
    {
        $con = mysqli_connect($this->server, $this->username, $this->password);
        $db_list = mysqli_query($con, "show databases;");

        while ($db = mysqli_fetch_array($db_list)) {
            if ((string) $db[0] == $this->database) {
                return true;
            }
        }
        return false;
    }

    function create_database()
    {
        $query_db_creation = "CREATE DATABASE $this->database;";
        $query_table_creation = <<<EOF
        CREATE TABLE users(
            id int auto_increment,
            user varchar(30),
            name varchar(80),
            pass varchar(100),
            Primary Key(id)
        );
        EOF;

        $con = mysqli_connect($this->server, $this->username, $this->password);
        mysqli_query($con, $query_db_creation);
        mysqli_select_db($con, $this->database);
        mysqli_query($con, $query_table_creation);
        mysqli_close($con);
    }

    function insert_user($name, $user, $pass)
    {
        $stm = $this->conn->prepare("INSERT INTO users (`user`, `name`, `pass`) VALUES ( :u, :n, :p )");
        $stm->bindParam(":u", $user);
        $stm->bindParam(":n", $name);
        $stm->bindParam(":p", $pass);
        $stm->execute();
    }

    function get_user($user)
    {
        $stm = $this->conn->prepare("SELECT `user`, `name`, `pass` FROM users WHERE user = :u");
        $stm->bindParam(":u", $user);
        $stm->execute();
        $result = $stm->fetchAll();
        if ($result) {
            return $result[0];
        } else {
            return null;
        }
    }
}

// $c = new ConexaoDB();
// $u = $c->get_user('dolts');
// print_r($u);
// echo $u['pass'];

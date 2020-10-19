<?php 
    define('DBHOST', 'localhost');
    define('DBDB', 'lab2');
    define('DBUSER', 'lamp1user');
    define('DBPW', '!Lamp12!');

    function connectDB() {
        $dsn = 'mysql:host='.DBHOST.';dbname='.DBDB.';charset=utf8';
        try {
            $db_conn = new PDO($dsn, DBUSER, DBPW);
            return $db_conn;
        } catch (PDOException $e) {
            echo '<p>Error opening database: '.$e->getMessage().'</p>';
            exit(1);
        }
    }
?>
<?php



define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'surveysystem');
define('ROOT_PATH', '../');

class db
{

    //database connection 
    public function __construct()
    {
        $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        $this->conn = $con;
        if (!$con) {
            die("Failed to connect to Database");
        }
    }
}
?>
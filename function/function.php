<?php
class studnet_management{
    private $conn;

    public function __construct() {
        try{
            $db_host="localhost";
            $db_user="root";
            $db_pass='';
            $db_name="student_management";
            $this->conn=mysqli_connect( $db_host, $db_user,$db_pass,$db_name);
        }catch(mysqli_sql_exception $msg){
            die("Database Connection Error!!". $msg->getMessage());
        }
    }
}







?>
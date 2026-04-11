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

    public function registration($data){
         $email = strtolower(trim($data['email'])); // lowercase + trim
        $password = $data['psw'];
        $repassword = $data['psw-repeat'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return "Invalid email format!";
        }
        if($password !== $repassword){
            return "Passwords do not match!";
        }
// Check duplicate email in PHP first 
        $stmt=$this->conn->prepare("SELECT ad_id FROM admin_info WHERE ad_email= ? ");
        if(!$stmt) return "Database Connection Error: Prepare Fail";

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if($stmt-> num_rows > 0){
            $stmt->close();
            return "Email already registered!";
        }
        $stmt->close();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt=$this->conn->prepare("INSERT INTO admin_info (ad_email, ad_pass) VALUES (?,?)");
        $stmt->bind_param("ss", $email,$hashedPassword);

        try{
            $stmt->execute();
            $stmt->close();
        }catch(mysqli_sql_exception $eMsg){
            if($eMsg->getCode() == 1062){
                return "Email already registered!";
            } else {
                return "Something went wrong: " . $eMsg->getMessage();
            }
        }
    }
}







?>
<?php
class studnet_management
{
    private $conn;

// Database Connection
    public function __construct()
    {
        try {
            $db_host = "localhost";
            $db_user = "root";
            $db_pass = '';
            $db_name = "student_management";
            $this->conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        } catch (mysqli_sql_exception $msg) {
            die("Database Connection Error!!" . $msg->getMessage());
        }
    }

// registration admin
    public function registration($data)
    {
        $email = strtolower(trim($data['email'])); // lowercase + trim
        $password = $data['psw'];
        $repassword = $data['psw-repeat'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format!";
        }
        if ($password !== $repassword) {
            return "Passwords do not match!";
        }
        // Check duplicate email in PHP first 
        $stmt = $this->conn->prepare("SELECT ad_id FROM admin_info WHERE ad_email= ? ");
        if (!$stmt) return "Database Connection Error: Prepare Fail";

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            return "Email already registered!";
        }
        $stmt->close();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO admin_info (ad_email, ad_pass) VALUES (?,?)");
        $stmt->bind_param("ss", $email, $hashedPassword);

        try {
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (mysqli_sql_exception $eMsg) {
            if ($eMsg->getCode() == 1062) {
                return "Email already registered!";
            } else {
                return "Something went wrong: " . $eMsg->getMessage();
            }
        }
    }
    // login user
    public function userLogin($data)
    {
        $email = strtolower(trim($data['email'])); // lowercase + trim
        $password = $data['std_pass'];
        if (empty($email) || empty($password)) {
            return "all fields are required!! ";
        }
        $stmt = $this->conn->prepare("SELECT * FROM admin_info WHERE ad_email=?");
        if (!$stmt) return "Database Error!!!";

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $stmt->close();
            return "Email Not Found";
        }
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['ad_pass'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['ad_id'];
            $_SESSION['user_email'] = $user['ad_email'];
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return "Invalid Password";
        }
    }
// logout
    public function logOut()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        header("location: index.php");
    }
// Add class
    public function addClass($data)
    {
        $ad_class = trim($data['add_class']);
        if (empty($data['add_class'])) {
            return "Class are Required";
        }
        $stmt = $this->conn->prepare("SELECT s_id FROM std_class WHERE s_class = ?");
        $stmt->bind_param("s", $ad_class);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "This class already exists!";
        }
        $stmt = $this->conn->prepare("INSERT INTO std_class (s_class) VALUES (?)");
        if (!$stmt) {
            return "Database Error" . $this->conn->error;
        }

        $stmt->bind_param("s", $ad_class);

        if (!$stmt->execute()) {
            return "Insert Fail" . $stmt->error;
        }
        return "Class Add Successfuly";
    }
// display class
    public function displayClassData()
    {
        $stmt = $this->conn->prepare("SELECT * FROM std_class");
        if (!$stmt) {
            return "database Erorr" . $this->conn->error;
        }
        $stmt->execute();
        $dis_class = $stmt->get_result();
        return $dis_class;
    }

    // public function addSection($data) {
    //     $add_section=trim($data['add_section'])
    // }
}

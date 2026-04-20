<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
            // if (session_status() === PHP_SESSION_NONE) {
            //     session_start();
            // }
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
            return "This $ad_class already exists!";
        }
        $stmt = $this->conn->prepare("INSERT INTO std_class (s_class) VALUES (?)");
        if (!$stmt) {
            return "Database Error" . $this->conn->error;
        }

        $stmt->bind_param("s", $ad_class);

        if (!$stmt->execute()) {
            return "Insert Fail" . $stmt->error;
        }
        return "success";
    }
    // display class
    public function displayClassData()
    {
        $stmt = $this->conn->prepare("SELECT * FROM std_class ORDER BY s_id ASC");
        if (!$stmt) {
            return "database Erorr" . $this->conn->error;
        }
        $stmt->execute();
        $dis_class = $stmt->get_result();
        return $dis_class;
    }
    // section
    public function addSection($data)
    {
        $add_section = trim($data['add_section']);
        if (empty($data['add_section'])) {
            return "Section are Required";
        }
        $stmt = $this->conn->prepare("SELECT id FROM std_section WHERE s_section= ?");
        $stmt->bind_param("s",  $add_section);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "exists!";
        }
        $stmt = $this->conn->prepare("INSERT INTO std_section (s_section) VALUES (?)");
        if (!$stmt) {
            return "Database Error" . $this->conn->error;
        }

        $stmt->bind_param("s", $add_section);
        if (!$stmt->execute()) {
            return " Insert Fail" . $stmt->error;
        }
        return "success";
    }
    // display section
    public function displaySection()
    {
        $stmt = $this->conn->prepare("SELECT * FROM std_section");
        if (!$stmt) {
            return "Database Error" . $this->conn->error;
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    // session
    public function addSession($data)
    {
        $addSession = trim($data['add_session']);
        if (empty($data['add_session'])) {
            return "Session are Required";
        }

        $stmt = $this->conn->prepare("SELECT id FROM std_session WHERE s_session=?");
        $stmt->bind_param("s", $addSession);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "This $addSession already exists!";
        }

        $stmt = $this->conn->prepare("INSERT INTO std_session (s_session) VALUES (?)");
        if (!$stmt) {
            return "Database Error" . $this->conn->error;
        }

        $stmt->bind_param("s", $addSession);
        if (!$stmt->execute()) {
            return "Insert Fail" . $stmt->error;
        }
        return "success";
    }
    // display session
    public function sessionDisplay()
    {
        $stmt = $this->conn->prepare("SELECT * FROM std_session");
        if (!$stmt) {
            return "Database Error" . $this->conn->error;
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    // add student
    public function addStudent($data)
    {
        $st_name     = htmlspecialchars(trim($data['std_name']));
        $st_roll     = htmlspecialchars(trim($data['std_roll']));
        $st_class    = $data['std_class'];
        $st_section  = $data['std_section'];
        $st_session  = $data['std_session'];
        $st_phone    = htmlspecialchars(trim($data['std_phn']));
        $st_status   = $data['std_status'];


        if (empty($st_name) || empty($st_roll) || empty($st_phone)) {
            return "All fields are required!";
        }

        if (!preg_match("/^[0-9]{11}$/", $st_phone)) {
            return "Invalid Number";
        }

        $stmt = $this->conn->prepare("SELECT id FROM students WHERE std_roll=?");
        if (!$stmt) {
            return "Databse Erorr" . $this->conn->error;
        }
        $stmt->bind_param("s", $st_roll);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "This $st_roll already exists!";
        }

        $stmt = $this->conn->prepare("INSERT INTO students (std_name, std_roll, std_class, std_section, std_session, std_phone, std_status) VALUES (?,?,?,?,?,?,?)");
        if (!$stmt) {
            return "Database Error" . $this->conn->error;
        }

        $stmt->bind_param("ssiiiss", $st_name, $st_roll, $st_class, $st_section, $st_session, $st_phone, $st_status);
        if (!$stmt->execute()) {
            return "Insert Fail" . $stmt->error;
        }
        return "Add Student Successfully";
    }

    public function dipalyStudent()
    {
        $stmt = $this->conn->prepare("
        SELECT 
            students.id,
            students.std_name,
            students.std_roll,
            std_class.s_class,
            std_section.s_section,
            std_session.s_session,
            students.std_phone,
            students.std_status
        FROM students
        INNER JOIN std_class 
            ON students.std_class = std_class.s_id
        INNER JOIN std_section 
            ON students.std_section = std_section.id
        INNER JOIN std_session 
            ON students.std_session = std_session.id
    ");

        $stmt->execute();
        return $stmt->get_result();
    }

    public function getClass_id($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM std_class WHERE s_id=?");

        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result();
    }
    public function updateClass($data)
    {
        $id = $data['class_id'];
        $class = trim($data['up_add_class']);

        if (empty($class)) {
            return "Field empty!";
        }
        $stmt = $this->conn->prepare("SELECT s_id FROM std_class WHERE s_class = ?");
        $stmt->bind_param("s", $class);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "This $class already exists!";
        }


        $stmt = $this->conn->prepare("UPDATE std_class SET s_class=? WHERE s_id=?");
        $stmt->bind_param("si", $class, $id);

        if (!$stmt->execute()) {
            return "Insert Fail" . $stmt->error;
        }
        return "Updated Successfully";
    }

    public function getSection_id($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM std_section WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function updateSection($data)
    {
        $id = $data['section_id'];
        $upSection = trim($data['up_add_section']);

        if (empty($upSection)) {
            return "Field empty!";
        }

        $stmt = $this->conn->prepare("SELECT id FROM std_section WHERE s_section = ?");
        if (!$stmt) {
            return "Databese Error" . $this->conn->error;
        }

        $stmt->bind_param("s", $upSection);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "This $upSection already exists!";
        }

        $stmt = $this->conn->prepare("UPDATE std_section SET s_section=? WHERE id=?");
        if (!$stmt) {
            return "database fail" . $this->conn->error;
        }
        $stmt->bind_param("si", $upSection, $id);
        if (!$stmt->execute()) {
            return "Insert Fail" . $stmt->error;
        }
        return "Updated Successfully";
    }

    public function getSession_id($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM std_session WHERE id=?");
        if (!$stmt) {
            return "Database Error" . $this->conn->error;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function updateSession($data)
    {
        $id = $data['session_id'];
        $upsession = trim($data['up_session']);

        if (empty($upsession)) {
            return "Field empty!";
        }

        $stmt = $this->conn->prepare("SELECT id FROM std_session WHERE s_session=? ");
        if (!$stmt) {
            return "database Error" . $this->conn->error;
        }
        $stmt->bind_param("s", $upsession);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return "This $upsession already exists!";
        }

        $stmt = $this->conn->prepare("UPDATE std_session SET s_session=? WHERE id=? ");
        if (!$stmt) {
            return "Database Fail" . $this->conn->error;
        }
        $stmt->bind_param("si", $upsession, $id);
        if (!$stmt->execute()) {
            return "insert Fail" . $stmt->error;
        }
        return "Update Session successfully";
    }
    public function getStudentById($id)
    {
        $stmt = $this->conn->prepare("
        SELECT 
            students.id,
            students.std_name,
            students.std_roll,
            students.std_phone,
            students.std_status,
            students.std_class,
            students.std_section,
            students.std_session,

            std_class.s_class,
            std_section.s_section,
            std_session.s_session

        FROM students

        INNER JOIN std_class 
            ON students.std_class = std_class.s_id

        INNER JOIN std_section 
            ON students.std_section = std_section.id

        INNER JOIN std_session 
            ON students.std_session = std_session.id

        WHERE students.id = ?
    ");

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateStudentData($data)
    {
        $id = $data['student_id'];

        $name    = trim($data['std_name']);
        $roll    = trim($data['std_roll']);
        $class   = $data['up_std_class'];
        $section = $data['up_std_section'];
        $session = $data['up_std_session'];
        $phone   = trim($data['up_std_phn']);
        $status  = $data['up_std_status'];

        if (empty($name) || empty($roll)) {
            return "Required fields missing!";
        }

        $stmt = $this->conn->prepare("
        UPDATE students 
        SET std_name=?, std_roll=?, std_class=?, std_section=?, std_session=?, std_phone=?, std_status=? 
        WHERE id=?
    ");

        if (!$stmt) {
            return "Database Error " . $this->conn->error;
        }

        $stmt->bind_param(
            "ssiiissi",
            $name,
            $roll,
            $class,
            $section,
            $session,
            $phone,
            $status,
            $id
        );

        if (!$stmt->execute()) {
            return "Update Failed " . $stmt->error;
        }

        return "Updated Successfully";
    }
    public function deleteClass($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM std_class WHERE s_id = ?");

        if (!$stmt) {
            return "Database Error: " . $this->conn->error;
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return "Deleted Successfully";
        } else {
            return "Delete Failed: " . $stmt->error;
        }
    }
    public function deleteSection($id){
        $stmt=$this->conn->prepare("DELETE FROM std_section WHERE id=?");
        if(!$stmt){
            return "Database Error". $this->conn->error;
        }

        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            return "Deleted Successfully";
        }else{
            return "Delete Fail!!". $stmt->error;
        }
    }
    public function deletesession($id){
        $stmt=$this->conn->prepare("DELETE std_session WHERE id=?");
        if(!$stmt){
            return "Database Error". $this->conn->error;
        }
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            return "Deleted Successfully";
        }else{
            return "Delete Fail!!". $stmt->error;
        }
    }
    public function deleteStudent($id){
        $stmt=$this->conn->prepare("DELETE students WHERE id=?");
        if(!$stmt){
            return "Database Error". $this->conn->error;
        }
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            return "Deleted Successfully";
        }else{
            return "Delete Fail!!". $stmt->error;
        }
    }
}

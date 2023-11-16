<?php
/* namespace Student_namespace; */
class Student
{

    public $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAll()
    {
        $query = "select * from diem";
        $result = $this->conn->query($query);
        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }
        return $result;
    }
    public function getUserById($userId)
    {
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $name = $_POST['name'];
            $masv = $_POST['code'];
            $diem = $_POST['score'];
            $insert = "INSERT INTO diem(ID, hoten, masv, diem) VALUES('', '{$name}', '{$masv}', '{$diem}')";
            $this->conn->query($insert);
        } else {
            echo 'lỗi';
        }
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $masv = $_POST['code'];
            $diem = $_POST['score'];
            $update = "UPDATE diem SET hoten='{$name}', masv='{$masv}', diem='{$diem}' WHERE ID='{$id}'";
            $this->conn->query($update);
        } else {
            echo 'lỗi';
        }
    }

    public function deleteUser()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $delete = "DELETE FROM diem WHERE ID='{$id}'";
            $this->conn->query($delete);
        }
    }
    public function searchUser()
    {
        if (isset($_GET['query'])) {

            $search = "select * from diem where hoten LIKE '%" . $_GET['query'] . "%'";
            $result = $this->conn->query($search);
            $arr = array();
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            return $arr;
        } else {
            return [];
        }
    }
    public function loginUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $select = "select * from account where email = '$email' and password = '$password'";
            $result = $this->conn->query($select);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                /* if ($row['role'] === "admin") { */
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['isLogin'] = true;
                    header("Location: http://localhost/basicMVC/app/View/main.php");
                /* } */
               /*  if ($row['role'] === "sinhvien") {             
                    $_SESSION['isLogin'] = true;
                    header("Location: http://localhost/basicMVC/app/View/sinhvien.php");
                } */
            } else {
                echo '<script>alert("Tài khoản mật khâu không khớp")</script>';
            }
        }
    }
    /* public function loginAdmin()
    {
        if ($_SESSION['isLogin'] != true) {
            header("Location: http://localhost/basicMVC/login.php");
        }
        header("Location: http://localhost/basicMVC/app/View/main.php");
    }
    public function loginSinhVien()
    {
        if ($_SESSION['isLogin'] != true) {
            header("Location: http://localhost/basicMVC/login.php");
        }
        header("Location: http://localhost/basicMVC/app/View/sinhvien.php");
    } */
}

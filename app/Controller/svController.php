<?php
require_once './app/Model/sinhvien.php';

class studentController
{

    private $sinhvien;

    public function __construct(Student $sinhvien)
    {
        $this->sinhvien = $sinhvien;
    }

    public function index()
    {
        $result = $this->sinhvien->getAll();
        include './app/View/main.php';
    }
    public function store()
    {
        $this->sinhvien->createUser();
        $this->index();
    }
    public function update()
    {
        $this->sinhvien->updateUser();
        $this->index();
    }
    public function delete()
    {
        $this->sinhvien->deleteUser();
        $this->index();
    }

    public function search()
    {
        $result = $this->sinhvien->searchUser();
        header('Content-Type: application/json');
        print_r(json_encode($result));
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $select = "select * from account where email = '$email' and password = '$password'";
            $result = $this->sinhvien->conn->query($select);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['role'] = $row['role'];
                $_SESSION['isLogin'] = true;
                $this->index();
            } else {
                echo '<script>alert("Tài khoản mật khâu không khớp")</script>';
            }
        }
    }
}

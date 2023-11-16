<?php
session_start();
include './config/database.php';
include './app/Model/sinhvien.php';
include './app/Controller/svController.php';


$student = new Student($conn);
$studentController = new studentController($student);


$action = isset($_GET['action']) ? $_GET['action'] : '';
function site_url($url)
{
    echo 'http://localhost/basicMVC' . $url;
}

switch ($action) {
    case '':
        $studentController->index();
        break;
    case 'store':
        $studentController->store();
        break;
    case 'update':
        $studentController->update();
        break;
    case 'delete':
        $studentController->delete();
        break;
    case 'search':
        $studentController->search();
        break;
    case 'login':
        $studentController->login();
        break;
    /* case 'admin':
        $studentController->admin();
        break;
    case 'sinhvien':
        $studentController->sinhvien();
        break; */
}

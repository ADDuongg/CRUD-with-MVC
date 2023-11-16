<?php

/* require '../Model/sinhvien.php';
require '../Controller/svController.php';
require '../../config/database.php'; */
if ($_SESSION['isLogin'] !== true) {
    header("Location: http://localhost/basicMVC/login.php");
}
else{
    $role = $_SESSION['role'];
}
/* else{
    $sinhvien = new Student($conn);
    $student_controller = new studentController($sinhvien);

} */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <div class="mt-5 d-flex justify-content-between" style="width: 60%; margin: auto;">
        <div class="d-flex">
            <label for="search" class="form-label me-2">Search: </label>
            <input type="search" class="form-control me-5" name="search" style="height: 30px; width: 200px;">
            <button class="btn btn-secondary btn-search">Tìm kiếm</button>
        </div>
        <button class="btn btn-success btn-add"><a style="text-decoration: none; color: white" href="<?php site_url('/app/View/formAdd.php') ?>">Thêm sinh viên</a></button>
        <button class="btn btn-success btn-logout"><a href="http://localhost/basicMVC/app/Controller/logout.php" style="text-decoration: none; color: white">Logout</a></button>
    </div>
    <table class="table table-striped" style="width: 60%; margin: auto;">
        <thead>
            <th>#</th>
            <th>Họ tên</th>
            <th>Mã sinh viên</th>
            <th>Điểm
                <!-- <?php
                        ?>
                <a href="index.php?sort=<?php echo $sort === "ASC" ? "DESC" : "ASC" ?>"><i class="fa-solid fa-sort-<?php echo $sort === "ASC" ? "up" : "down" ?>"></i></a>
                <?php
                ?> -->
            </th>
            <?php
                if($_SESSION['role'] === 'admin'){
                    ?>
                    <th>Action</th>
                    <?php
                }
                else{
                    echo '';
                }

                ?>
        </thead>
        <tbody class="tbody">
            <tr>
                <?php
                /*  if (isset($result) && $result !== null) { */
                while ($row = $result->fetch_assoc()) {
                ?>
            <tr>
                <td><?php echo $row['ID'] ?></td>
                <td><?php echo $row['hoten'] ?></td>
                <td><?php echo $row['masv'] ?></td>
                <td><?php echo $row['diem'] ?></td>
                <?php
                if($_SESSION['role'] === 'admin'){
                    ?>
                    <td>
                    <div class="d-flex">
                        <a href='<?php site_url("/app/View/formUpdate.php?id=" . $row['ID'] . "") ?>'>
                            <i value_id="<?php echo $row['ID'] ?>" class="fa-solid fa-pen-to-square btn-update me-3" style="font-size: 20px; color: blue; cursor: pointer;">
                            </i>
                        </a>

                        <a href="index.php/?action=delete&id=<?php echo $row['ID'] ?>">
                            <i value_id="<?php echo $row['ID'] ?>" class="fa-solid fa-trash btn-update me-3" style="font-size: 20px; color: red; cursor: pointer;">
                            </i>
                        </a>
                    </div>
                </td>
                    <?php
                }
                else{
                    ?>
                    <div></div>
                    <?php
                }

                ?>
            </tr>
        <?php
                }
                /* } */
        ?>
        </tbody>
    </table>
    <script>
        /* var btnadd = document.querySelector('.btn-add')
        var btnupdates = document.querySelectorAll('.btn-update')
        var btndeletes = document.querySelectorAll('.btn-delete') */
        var btnsearch = document.querySelector('.btn-search')
        var inputsearch = document.querySelector('input[name="search"]')
        var tbody = document.querySelector('.tbody')
        var btnlogout = document.querySelector('.btn-logout')
        btnlogout.addEventListener('click', function() {
            window.location.href = "login.php"
        })
        var tmp_value
        inputsearch.addEventListener('input', function() {
            tmp_value = inputsearch.value
            console.log(tmp_value);

        })

        function updateTable(data) {
            var tmp_tr = '';
            data.forEach(sinhvien => {
                tmp_tr += `
            <tr>
                <td>${sinhvien.ID}</td>
                <td>${sinhvien.hoten}</td>
                <td>${sinhvien.masv}</td>
                <td>${sinhvien.diem}</td>
                <td>
                    <div class="d-flex">
                        <i value_id="${sinhvien.ID}" class="fa-solid fa-pen-to-square btn-update me-3" style="font-size: 20px; color: blue; cursor: pointer;"></i>
                        <form action="./controller/delete.php" method="POST">
                            <button style="border: none; background-color: transparent;"> <i name="submit" class="fa-solid fa-trash  btn-delete" style="font-size: 20px; color: red; cursor: pointer;"></i>
                            </button>
                            <input name="id" type="hidden" value="${sinhvien.ID}">
                        </form>
                    </div>
                </td>
            </tr>
            `
            })
            tbody.innerHTML = tmp_tr
        }
        btnsearch.addEventListener('click', function() {
            fetch(`http://localhost/basicMVC/index.php?action=search&query=${tmp_value}`)
                .then(res => res.json())
                .then(data => updateTable(data))
                .catch(err => console.log(err))
        })

        /*  btnadd.addEventListener('click', function() {
             window.location.href = "./formAdd.php"
         })
         btnupdates.forEach(btnupdate => {
             btnupdate.addEventListener('click', function() {
                 window.location.href = `./formUpdate.php?id=${btnupdate.getAttribute('value_id')}`
             })
         }) */
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
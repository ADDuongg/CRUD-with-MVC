<?php
include '../../config/database.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "select * from diem where ID = '$id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/all.css">
    <title>Document</title>
</head>

<body>

    <form class="shadow-lg form" action="../../index.php?action=update" method="POST">
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input value="<?php echo $row['ID'] ?>" type="text" name="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input value="<?php echo $row['hoten'] ?>" type="text" name="name" class="form-control" id="" required>
        </div>
        <div class="mb-3">
            <label for="code" class="form-label">Mã sinh viên</label>
            <input value="<?php echo $row['masv'] ?>" type="text" name="code" class="form-control" id="" required>
        </div>
        <div class="mb-3">
            <label for="score" class="form-label">Điểm</label>
            <input value="<?php echo $row['diem'] ?>" type="text" name="score" class="form-control" id="" required>
        </div>


        <div class="d-flex justify-content-end" style="width: 100%;">
            <button class="btn btn-primary me-3 btn-back">Back</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
    <script>
        var btnback = document.querySelector('.btn-back')
        btnback.addEventListener('click', function(e) {
            e.preventDefault()
            window.location.href = '../../index.php'
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<?php
    // session_start();
    // if (isset($_SESSION["uname"])) {
    // header("location: view.php");
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
<a href="index2.php"><h2>KEMBALI</h2></a>
    <?php
    //Function
    include "koneksi.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $uname = $_POST["uname"];
        $pass = $_POST["password"];
        $ulangpass = $_POST["ulangpass"];
    
        $passHash = password_hash($pass, PASSWORD_DEFAULT);
    
        $errors = array();
        // validate
        if (empty($email) OR empty($uname) OR empty($pass) OR empty($ulangpass)) {
            array_push($errors,"Semua data harus terisi");
        }
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors,"Email tidak valid");
        }
    
        if (strlen($pass)<3) {
            array_push($errors,"pasword terdiri minimal 3 karakter");
        }
        if ($pass!==$ulangpass) {
            array_push($errors,"Password tidak sama");
        }
    
        if (count($errors)>0) {
            foreach ($errors as $errors) {
                echo "<div class='alert alert-danger'>$errors</div>";
            }}
    
        else {
            require_once "koneksi.php";
                    // Menyisipkan data ke dalam tabel pendaftaran
            $reg_sql = "INSERT INTO user (email, user_name, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($koneksi);
            $prepareStmt = mysqli_stmt_prepare($stmt,$reg_sql);
            if (!$prepareStmt) {
                echo "Terjadi kesalahan:" . mysqli_stmt_error($stmt);
            }
            else {
                mysqli_stmt_bind_param($stmt, "sss", $email, $uname, $passHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success''>Anda Berhasil registrasi <a href='index.php'>Kembali ke menu utama </a> </div> ";
    
                // session_start();           
                // // $_SESSION['email'] = $row['email'];
                $_SESSION['uname'] = $uname;
                // $_SESSION['id'] = $row['id'];
                // $_SESSION['name'] = "yes";   
            }
        }}
    ?>

    <form action="register.php" method="post" >
    <h2>Halaman Login</h2>
    <label>Nama Lengkap</label>
    <input type="text" name="uname" placeholder="Masukkan Nama"><br>
    <label>Email</label>
    <input type="email" name="email" placeholder="Masukkan Email"><br>
    <label>Password</label>
    <input type="password" name="password" placeholder="Password"><br>
    <input type="password" name="ulangpass" placeholder="Masukkan Password sekali lagi"><br>
    <button type="submit" >Register</button>
    <h5>Sudah punya akun? 
        <a href="login.php">Login</a>
    </h5>

    </form>
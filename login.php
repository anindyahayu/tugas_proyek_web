<?php
    // session_start();
    // if (isset($_SESSION["uname"])) {
    // header("location: index.php");
    // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<a href="index2.php"><h2>KEMBALI</h2></a>
    <?php
        include "koneksi.php";
        if(isset($_POST['login'])) {
            $email = $_POST['email'];
            $pass = $_POST['password'];
                require_once "koneksi.php";
                $sql = "SELECT * FROM user WHERE email = '$email'";
                $log_result = mysqli_query($koneksi, $sql);
                $user = mysqli_fetch_array($log_result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($pass, $user["password"])) {
                        echo "Logged In!";
                        session_start();           
                        // // $_SESSION['email'] = $row['email'];
                        // $_SESSION['uname'] = $user['user_name'];
                        // $_SESSION['id'] = $row['id'];
                        // $_SESSION['name'] = "yes";   
                        header("Location: index2.php");
                        exit(); }
                    else {
                        echo "<div class='alert alert-danger'>Password salah</div>";
                    }}
                else {
                    echo "<div class='alert alert-danger'>Email tidak ditemukan</div>";
                }
        } 
    ?>

    <form action="login.php" method="post" >
    <h2>Halaman Login</h2>
    <label>Email</label>
    <input type="text" name="email" placeholder="Masukkan Email"><br>
    <label>Password</label>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit" value="login" name="login">Login</button>
    <h5>Belum punya akun? 
        <a href="register.php">Register</a>
    </h5>
    </form>
    
</body>
</html>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="login.css">
    <script src="https://kit.fontawesome.com/cd43445493.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<?php
    if(isset($_SESSION['nama'])){
        header("location:index.php");
    }
    include ("koneksi.php");

    if(isset($_POST['login']))
    {
        $user_login = $_POST['username'];
        $pass_login = $_POST['pass'];

        $sql = "SELECT * FROM akun WHERE username = '$user_login'";
        $query = mysqli_query($koneksi,$sql);
        $count = mysqli_num_rows($query);

        if(!$count){
            echo "<script>Swal.fire({
                icon: 'error',
                text: 'Username Tidak Ditemukan',
                showConfirmButton: false,
                timer: 1500
                })</script>";
        }
        else{
            while ($data = mysqli_fetch_array($query)){
                $user = $data['username'];
                $pass = $data['password'];
                $nama = $data['nama'];
                $gmail = $data['gmail'];
                $level = $data['level'];
                $id = $data['id'];
            }
            if($user_login == $user && $pass_login == $pass){
                $_SESSION['username'] = $user;
                $_SESSION['nama'] = $nama;
                $_SESSION['gmail'] = $gmail;
                $_SESSION['level'] = $level;
                $_SESSION['id'] = $id;
?>
                <script>
                    Swal.fire
                    ({
                        icon: 'success',
                        text: 'Berhasil Login',
                        footer: "<a href='index.php'>Lanjutkan</a>",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    })
                </script>
<?php
            } 
            else {
                echo "<script>Swal.fire({
                    icon: 'error',
                    text: 'Password Salah!',
                    showConfirmButton: false,
                    timer: 1500
                    })</script>";
            }
        }
    }
    ?>
    <div class="login">

        <div class="avatar">
            <i class="fa fa-user"></i>
        </div>

        <h2>Login Form</h2>

        <form method="POST">
            <div class="box-login">
                <i class="fa fa-envelope"></i>
                <input type="text" placeholder="type your username" name="username" required>
            </div>

            <div class="box-login">
                <i class="fa fa-lock"></i>
                <input type="password" placeholder="type your password" name="pass" required>
            </div>

            <button type="submit" class="btn-login" name="login">login</button>

            <div class="bottom">
                <a href="register.php">Register</a>
                <a href="forgotpass.php">Forgot Password</a>
            </div>
        </form>
        
    </div> 
</body>
</html>

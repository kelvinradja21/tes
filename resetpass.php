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
<div class="login">

<div class="avatar">
    <i class="fa fa-user"></i>
</div>

<h2>Confirm password</h2>
<?php
if($_GET['key'] && $_GET['reset'])
{
    include('koneksi.php');
    $email=$_GET['key'];
    $pass=$_GET['reset'];

    $sql="SELECT email,password FROM akun where email='$email'";
    $select=mysqli_query($koneksi,$sql);
    if(mysqli_num_rows($select)==1) 
    {
?>

<form method="POST">
    <div class="box-login">
        <i class="fa fa-lock"></i>
        <input type="password" placeholder="type your new password" name="newpass" id="password" onkeyup='check();' required>
        <input type="hidden" name="email" value="<?php echo $email;?>">
		<input type="hidden" name="pass" value="<?php echo $pass;?>">
    </div>

    <button type="submit" class="btn-login" name="confirm">confirm</button>


</form>
<?php
    }  else 
{
    echo "Data Tidak Ditemukan";
}
}
?>

<?php
if(isset($_POST['confirm']))
{
    include('koneksi.php');
    $email=$_POST['email'];
    $pass=$_POST['newpass'];

    $sql2="UPDATE akun SET password='$pass' WHERE email='$email'";
    $select=mysqli_query($koneksi,$sql2) or die(mysqli_error());
    if($select)
    {
        echo "<script> alert('Password Berhasil Di Update'); window.location = 'login.php'; </script>";//jika pesan terkirim
    }
    else
    {
        echo "<script>alert('Gagal Mengganti Password '); window.location = 'login.php';</script>"; 
    }
}
?>
</div> 

</body>
</html>
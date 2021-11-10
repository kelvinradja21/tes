<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgotpass.css">
    <script src="https://kit.fontawesome.com/cd43445493.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="login">

<div class="avatar">
    <i class="fa fa-user"></i>
</div>

<h2>New Password</h2>

<?php
if(isset($_POST['update']))
{
    include('koneksi.php');
    $email = $_POST['email'];

     $sql="SELECT email,password FROM akun WHERE email='$email'";
     $select=mysqli_query($koneksi,$sql);
     if(mysqli_num_rows($select)==1)
     {
        while($row=mysqli_fetch_array($select))
        {
            $email=$row['email'];
            $pass=md5($row['password']);
        }

        require_once('phpmail/class.phpmailer.php');
        require_once('phpmail/class.smtp.php');
            $mail = new PHPMailer();
        //isi email
        $body = "Klik link berikut untuk reset Password, <a href='http://localhost/tubes/resetpass.php?reset=$pass&key=$email>$pass<a>'";
        
        $mail->IsSMTP();

        $mail->SMTPDebug  = 1;
        $mail->SMTPAuth = true;
        //email pengirim
        $mail->Username = "eyenews06@gmail.com";
        //pass email pengirim
        $mail->Password = "kelompok6tubes";
        $mail->SMTPSecure = "ssl";
        // sets GMAIL as the SMTP server
        $mail->Host = "smtp.gmail.com";
        // set the SMTP port for the GMAIL server
        $mail->Port = "465";
        $mail->From='eyenews06@gmail.com';
        //Username pengirim
        $mail->FromName='Admin Eye News';

        $email = $_POST['email'];

        $mail->ADDAddress($email, 'User sistem');
        $mail->Subject = 'Reset Password';
        $mail->IsHTML(true);
        $mail->MsgHTML($body);
        //jika pesan terkirim
        if($mail->Send())
        {
            echo "<script> alert(Link reset password telah dikirim ke email anda,Cek email anda untuk melakukan reset'); window.location = 'login.php'; </script>";
        }
        else
        {
           echo "Mail Error - >".$mail->Errorinfo; 
        }
    
     }
    else
    {
        echo "<script> alert('Email anda tidak terdaftar di sistem'); window.location = 'login.php'; </script>";//jika pesan terkirim   
    } 

}

?>

<form method="POST">
    <div class="box-login">
        <i class="fa fa-envelope"></i>
        <input type="text" placeholder="type your email" name="email" required>
    </div>

    <button type="submit" class="btn-login" name="update">update</button>


</form>

</div> 
</body>
</html>
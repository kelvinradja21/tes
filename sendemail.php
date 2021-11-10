<?php
if(isset($_POST['update']))
{
    include('koneksi.php');
    $email = $_POST('email');

     $select=mysqli_query("SELECT email,password FROM akun WHERE email='$email");
     if(mysql_num_rows($select)==1)
     {
        while($row=mysql_fetch_array($select))
        {
            $email=$row['email'];
            $pass=md5($row['password']);
        }

        require_once('phpmail/class.phpmailer.php');
        require_once('phpmail/class.smtp.php');
        $mail = new PHPMailer();
        //isi email
        $body = "Klik link berikut untuk reset Password, <a href=''";
        
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
            echo "<script> alert(Link reset password telah dikirim ke email anda,Cek email anda untuk melakukan reset'); window.location = 'login.php'; </script>"
        }
        else
        {
           echo "Mail Error - >".$mail->Errorinfo; 
        }
    
     }
     else
     {
        echo "<script> alert('Email anda tidak terdaftar di sistem'); window.location = 'login.php'; </script>";
     }
}

?>
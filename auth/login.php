<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login | waroengtemankita</title>
   <link rel="stylesheet" href="../assets/css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
    <div class="box-login">
        <h2>login</h2>
        <form action="" method="POST">
            <input type="text" name="user" placeholder="username" class="input-control">
            <input type="password" name="pass" placeholder="password" class="input-control">
            <input type="submit" name="submit" placeholder="login" class="btn">
        </form>
        <?php
        session_start();
        if(isset($_POST['submit'])){
            
            include '../config/db.php';

            $user = mysqli_real_escape_string($conn,$_POST['user']);
            $pass =mysqli_real_escape_string($conn,$_POST['pass']);

            $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$user."' AND password = '".$pass."'");
            if(mysqli_num_rows($cek)> 0){
              $d = mysqli_fetch_object($cek);
              $_SESSION['status_login'] = true;
              $_SESSION['a_global'] = $d;
              $_SESSION['id'] = $d->admin_id;

              echo'<script>window.location="../admin/dashboard.php"</script>';}
              else{
                echo '<script>alert("username atau password anda salah!")</script>';
            }
           
        }
        ?>
    </div>
</body>
</html>
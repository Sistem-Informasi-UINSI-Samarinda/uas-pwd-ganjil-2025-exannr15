<?php 
session_start();
include '../config/db.php';
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
}

$query = mysqli_query($conn,"SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."' ");
$d =mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>waroengtemankita</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    
     <header>
    <div class="container">
        <h1><a href="dashboard.php">WaroengTemanKita</a></h1>
        
        <div class="menu-toggle" id="menuToggle">☰</div>

        <ul class="nav-menu" id="navMenu">
            <li><a href="dashboard.php">dashboard</a></li>
            <li><a href="profil.php">profil</a></li>
            <li><a href="data-kategori.php">data kategori</a></li>
            <li><a href="data-produk.php">data produk</a></li>
            <li><a href="keluar.php">keluar</a></li>
        </ul>
    </div>
</header>
     
      <div class="section">
        <div class="container">
            <h3>Profil</h3>
            <div class="box">
            <form action="" method= "POST">
                <input type="text" name="nama" placeholder="nama lengkap"  class="input-control" value="<?php echo $d->admin_name?>" required>
                <input type="text" name="user" placeholder="username"  class="input-control" value="<?php echo $d->username?>" required>
                <input type="text" name="hp" placeholder="no hp"  class="input-control" value="<?php echo $d->admin_telp?>" required>
                <input type="email" name="email" placeholder="email"  class="input-control"value="<?php echo $d->admin_email?>" required> 
                <input type="text" name="alamat" placeholder="alamat"  class="input-control"value="<?php echo $d->admin_addres?>" required> 
                <input type="submit" name="submit" value="ubah profil" class= "btn">
            </form>
            <?php
            if(isset($_POST['submit'])){
                $nama   =ucwords($_POST['nama']);
                $user   =$_POST['user'];
                $hp     =$_POST['hp'];
                $email  =$_POST['email'];
                $alamat =ucwords($_POST['alamat']);
                
                $update = mysqli_query($conn,"UPDATE tb_admin SET
                admin_name = '".$nama."',
                username = '".$user."',
                admin_telp = '".$hp."',
                admin_email = '".$email."',
                admin_addres = '".$alamat."'
               WHERE admin_id = '".$d->admin_id."' ");
               if($update){
                echo '<script>alert("ubah data berhasil")</script>';
                echo '<script>window.location=profil.php</script>';
            }
                else{
                echo 'gagal'.mysqli_error($conn);
               }
                






            }
            ?>
            </div>
             <h3>ubah password</h3>
            <div class="box">
            <form action="" method= "POST">
                <input type="password" name="pass1" placeholder="Password Baru"  class="input-control"  required>
                <input type="password" name="pass2" placeholder="Konfirmasi password baru"  class="input-control"  required>
                
                <input type="submit" name="ubah password" value="ubah password" class= "btn">
            </form>
            <?php
            if(isset($_POST['ubah_password'])){
                
                $pass1  =$_POST['pass1'];
                $pass2  =$_POST['pass2'];
                if($pass2 !=$pass1){
                    echo '<script>alert("konfirmasi password baru tidak sesuai")</script>';
                }
                else{
                $u_pass= mysqli_query($conn,"UPDATE tb_admin SET
                     password = '".$pass1."'
                    WHERE admin_id = '".$d->admin_id."' ");
                if($u_pass){
                     echo '<script>alert("ubah data berhasil")</script>';
                     echo '<script>window.location=profil.php</script>';
                }else{
                     echo 'gagal'.mysqli_error($conn);
                     }
                } }
            ?>
            </div>
        </div>
      </div>
      
       <footer>
        <div class="container">
            <small>copyright &copy; 2025 - waroengtemankita.</small>
        </div>
       </footer>
       <script src="../assets/js/main.js"></script>
</body>
</html>
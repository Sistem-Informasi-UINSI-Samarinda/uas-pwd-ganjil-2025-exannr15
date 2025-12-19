<?php 
session_start();
include '../config/db.php';
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
}

$kategori = mysqli_query($conn,"SELECT * FROM tb_kategori WHERE category_id ='".$_GET['id']."' ");
if(mysqli_num_rows($kategori) ==0){
    echo '<script>window.location="data-kategori.php"</script';
}
$k = mysqli_fetch_object($kategori);
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
            <h3>edit data kategori</h3>
            <div class="box">
            <form action="" method= "POST">
                <input type="text" name="nama" placeholder="nama kategori"  class="input-control" value="<?php echo $k-> category_name?>" required>
                <input type="submit" name="submit" value="submit" class= "btn">
            </form>
            <?php
            if(isset($_POST['submit'])){
                $nama = ucwords($_POST['nama']);

               $update = mysqli_query($conn,"UPDATE tb_kategori SET
                                                  category_name = '".$nama."'
                                                  WHERE category_id = '".$k->category_id."' ");
               
               if($update){
                echo'<script>alert("edit data berhasil")</script>';
                echo'<script>window.location="data-kategori.php"</script>';
               } else{
                echo 'gagal' .mysqli_error($conn);
               }
            }
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
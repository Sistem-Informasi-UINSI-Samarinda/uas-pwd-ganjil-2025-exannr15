<?php 
session_start();
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
}
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
            <h3>dashboard</h3>
            <div class="box">
            <h4>selamat datang <?php echo $_SESSION['a_global']->admin_name?> di Waroeng Teman Kita</h4>
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
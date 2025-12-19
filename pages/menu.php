
<?php session_start(); ?>
<?php include '../config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - WaroengTemanKita</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
   <header>
    <div class="container">
        <h1>
            <a href="index.php">
                <img src="../assets/img/warung logo.png" class="logo-header">
                Waroeng<span>TemanKita</span></a>
        </h1>
        
        <div class="menu-toggle" id="menuToggle">☰</div>
        <ul class="nav-menu" id="navMenu">
            <li><a href="index.php">Beranda</a></li>
            <li><a href="tentang-kami.php">Tentang Kami</a></li>
            <li><a href="kontak.php">Kontak</a></li>
        </ul>
    </div>
</header>
        <div class="container">
            <h3 style="text-align : center;">Daftar Menu</h3>
            
            

            <div class="menu-grid" style="margin-top: 30px;">
                <?php 
                    $where = "";
                    if(isset($_GET['search'])) {
                        $where = "WHERE product_name LIKE '%".$_GET['search']."%' ";
                    }
                    if(isset($_GET['kat'])) {
                        $where = "WHERE category_name = '".$_GET['kat']."' ";
                    }

                    $produk = mysqli_query($conn, "SELECT * FROM tb_product $where ORDER BY product_id DESC");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                <div class="card-menu">
                    <img src="../assets/img/produk/<?php echo $p['product_image']; ?>" 
                    alt="<?php echo $p['product_name']; ?>">

                    <div class="card-body">
                        <h4><?php echo $p['product_name']; ?></h4>
                        <p class="harga">Rp <?php echo number_format($p['product_price']); ?></p>
                        <a href="beli.php?id=<?php echo $p['product_id']; ?>" class="btn-pesan">Tambah ke Keranjang</a>
                    </div>
                </div>
                <?php }} else { echo "<p>Menu tidak ditemukan.</p>"; } ?>
            </div>
        </div>
    </div>

  
<footer>
    <div class="container">
        <small>© <?php echo date('Y'); ?> Waroeng Teman Kita</small>
    </div>
</footer>
<script src="assets/js/main.js"></script>

</body>
</html>
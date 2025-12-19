<?php
include '../config/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waroeng Teman Kita</title>
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


<div class="hero">
    <div class="container">
        <h2>SELAMAT DATANG DI WAROENG TEMAN KITA</h2>
        <p>Makan enak, suasana akrab</p>
        <a href="menu.php" class="btn">Lihat Menu</a>
    </div>
</div>




<div class="section">
    <div class="container">
        <h3>Menu terbaru</h3>

        <div class="menu-grid">
            <?php $produk = mysqli_query($conn,
                "SELECT * FROM tb_product 
                 WHERE product_status = 1 
                 ORDER BY product_id DESC 
                 LIMIT 3"
            );

            if(mysqli_num_rows($produk) > 0){
                while($p = mysqli_fetch_array($produk)){
            ?>
            <div class="card-menu">
            <img src="../assets/img/produk/<?php echo $p['product_image']; ?>">



                <div class="card-body">
                    <h4><?php echo $p['product_name'] ?></h4>
                    <p class="harga">Rp <?php echo number_format($p['product_price']) ?></p>
                    <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>" class="btn-pesan">
                        Pesan
                    </a>
                </div>
            </div>
            <?php }} else { ?>
                <p>Menu belum tersedia.</p>
            <?php } ?>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <h3 style="text-align: center; margin-bottom: 20px;">Galeri Waroeng Kami</h3>
        <p style="text-align: center; margin-bottom: 20px;">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Placeat magni corrupti voluptatum sapiente, quasi eaque facilis tenetur. Obcaecati blanditiis, reprehenderit non officia deleniti doloribus veritatis rem porro dolorum optio voluptatibus, consequatur, corrupti autem quod ab nobis culpa odit atque eveniet delectus eaque distinctio excepturi quibusdam. Exercitationem iure distinctio consectetur pariatur?</p>
        <div class="galeri-warung">
            <div class="foto-item">
                <img src="../assets/img/suasana makan.jpg" alt="Suasana Warung">
            </div>
            <div class="foto-item">
                <img src="../assets/img/joglo vibes.jpg" alt="Tampak Depan">
            </div>
            <div class="foto-item">
                <img src="../assets/img/warung foto.jpeg" alt="Area Makan">
            </div>
            <div class="foto-item">
                <img src="../assets/img/dapur kondisi.jpg" alt="Dapur Bersih">
            </div>
        </div>
    </div>
</div>


<footer>
    <div class="container">
        <small>© <?php echo date('Y'); ?> Waroeng Teman Kita</small>
    </div>
</footer>
<script src="../assets/js/main.js"></script>

</body>
</html>

<?php 
    include '../config/db.php'; 
    $id = $_GET['id'];
    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '$id'");
    $p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $p->product_name ?> - WaroengTemanKita</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="section">
        <div class="container">
            <h3>Detail Produk</h3>
            <div class="box">
                <div class="col-2">
                    <img src="produk/<?php echo $p->product_image ?>" width="100%">
                </div>
                <div class="col-2">
                    <h2><?php echo $p->product_name ?></h2>
                    <h3>Rp <?php echo number_format($p->product_price) ?></h3>
                    <p>Deskripsi :<br>
                        <?php echo $p->product_description ?>
                    </p>
                    
                    <?php 
                        $pesan = "Halo Waroeng Teman Kita, saya ingin memesan menu " . $p->product_name . " seharga Rp " . number_format($p->product_price);
                        $link_wa = "https://api.whatsapp.com/send?phone=628582221157&text=" . urlencode($pesan);
                    ?>
                    
                    <a href="<?php echo $link_wa ?>" target="_blank" class="btn-wa">
                        Pesan via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
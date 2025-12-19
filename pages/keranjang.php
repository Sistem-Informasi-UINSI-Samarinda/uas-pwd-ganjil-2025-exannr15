<?php
session_start();
include '../config/db.php';


if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
    echo "<script>alert('Keranjang kosong, silakan pilih menu dulu!');</script>";
    echo "<script>location='menu.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja - WaroengTemanKita</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="index.php">Waroeng<span>TemanKita</span></a></h1>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3 style="margin-bottom: 20px;">Pesanan Anda</h3>
            
            <table class="table-cart">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $nomor = 1;
                    $total_belanja = 0;
                    $isi_pesan = "Halo WaroengTemanKita, saya ingin pesan:\n\n";

                    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): 
                        $ambil = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id='$id_produk'");
                        $pecah = mysqli_fetch_assoc($ambil);
                        $subtotal = $pecah["product_price"] * $jumlah;
                        
                        
                        $isi_pesan .= "• " . $pecah['product_name'] . " (" . $jumlah . "x) = Rp " . number_format($subtotal) . "\n";
                    ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><strong><?php echo $pecah["product_name"]; ?></strong></td>
                        <td>Rp <?php echo number_format($pecah["product_price"]); ?></td>
                        <td><?php echo $jumlah; ?> Porsi</td>
                        <td><strong>Rp <?php echo number_format($subtotal); ?></strong></td>
                        <td>
                            <a href="hapus-keranjang.php?id=<?php echo $id_produk ?>" class="btn-delete" onclick="return confirm('Hapus menu ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php 
                        $total_belanja += $subtotal;
                    endforeach; 
                    
                    $isi_pesan .= "\n*Total Belanja: Rp " . number_format($total_belanja) . "*";
                    $link_wa = "https://api.whatsapp.com/send?phone=628123456789&text=" . urlencode($isi_pesan);
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" style="text-align: right;">Total Belanja:</th>
                        <th colspan="2" style="font-size: 20px; color: #9b4d4d;">Rp <?php echo number_format($total_belanja); ?></th>
                    </tr>
                </tfoot>
            </table>
            
            <div style="margin-top: 30px; display: flex; gap: 10px;">
                <a href="menu.php" class="btn-action btn-continue">← Tambah Menu Lagi</a>
                <a href="<?php echo $link_wa ?>" target="_blank" class="btn-action btn-wa-checkout">Pesan Sekarang Lewat WA (Selesai)</a>
            </div>
        </div>
    </div>
</body>
</html>
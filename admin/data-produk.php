<?php 
session_start();
include '../config/db.php';
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
            <h3>Data produk</h3>
            <div class="box">
                <p><a href="tambah-produk.php">tambah data</a></p>
            <table border= "1" cellspacing ="0" class="table">
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>Kategori</th>
                        <th>nama produk</th>
                        <th>harga</th>
                        
                        <th>gambar</th>
                        <th>status</th>
                        <th width= "150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $produk = mysqli_query($conn,"SELECT * FROM tb_product LEFT JOIN tb_kategori USING(category_id) ORDER BY product_id DESC");
                    if(mysqli_num_rows($produk)> 0){
                    while($row = mysqli_fetch_array($produk)){
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['category_name'] ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        <td>Rp. <?php echo number_format($row['product_price']) ?></td> 
                        <td><a href="../assets/img/produk/<?php echo $row['product_image'] ?>" target="_blank">
                            <img src="../assets/img/produk/<?php echo $row['product_image'] ?>" width="50px"></a>
                        </td>

                        <td><?php echo ($row['product_status'] == 0)? 'tidak aktif' : 'aktif'?></td>
                        
                        <td>
                            <a href="edit-produk.php?id=<?php echo $row['product_id'] ?>">Edit</a>|| <a href="proses-hapus.php?idp=<?php echo $row['product_id']?>" onclick="return confirm('yakin ingin hapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php }}else{ ?>
                        <tr>
                            <td colspan="7">tidak ada data</td>
                        </tr>
                   <?php } ?>
                </tbody>
            </table>
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
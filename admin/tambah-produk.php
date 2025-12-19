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
            <h3>tambah data produk</h3>
            <div class="box">
            <form action="" method= "POST" enctype="multipart/form-data">
                <select class="input-control" name="kategori" required>
                    <option value="">-Pilih-</option>
                    <?php 
                    $kategori = mysqli_query($conn,"SELECT * FROM tb_kategori ORDER BY category_id");
                    while($r = mysqli_fetch_array($kategori)){

                    
                    ?>
                    <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                <?php } ?>
                </select>
                <input type="text" name="nama" class= "input-control" placeholder= "nama produk" required>
                <input type="text" name="harga" class= "input-control" placeholder= "harga" required>
                <input type="file" name="gambar" class= "input-control" required>
                <textarea class="input-control" name="deskripsi" placeholder= "deskripsi"></textarea>
                <select class="input-control" name="status">
                    <option value="">--pilih--</option>
                    <option value="1">porsi</option>
                    <option value="0">paketan</option>
                </select>
                <input type="submit" name="submit" value="submit" class= "btn">
            </form>
            <?php
            if(isset($_POST['submit'])){
            // print_r($_FILES['gambar']);


            // menampung inputan dari form
            $kategori = $_POST['kategori'];
            $nama     = $_POST['nama'];
            $harga    = $_POST['harga'];
            $deskripsi= $_POST['deskripsi'];
            $status   = $_POST['status'];



            // menampung data file yang di upload
            $filename = $_FILES['gambar']['name'];  
            $tmp_name = $_FILES['gambar']['tmp_name'];

            $type1 = explode('.', $filename);
            $type2 = strtolower(end($type1));


            $newname = 'produk'.time().'.'.$type2;

            // menampung data format file yang diizinkan
            $tipe_diizinkan = array('jpg','jpeg','png','gif');

            // validasi format file
                if(!in_array($type2,$tipe_diizinkan)){
                //   jika format file tidak masuk ke diizinkan
                    echo '<script>alert("format file tidak diizinkan")</script';
            
                }else{
                    echo 'berhasil upload';
                     // proses upload file sekaligus insert ke database
                    move_uploaded_file($tmp_name, '../assets/img/produk/'.$newname);



                    $insert = mysqli_query($conn,"INSERT INTO tb_product VALUES(
                     null,
                     '".$kategori."',
                     '".$nama."',
                     '".$harga."',
                     '".$deskripsi."',
                     '".$newname."',
                     '".$status."',
                     null
                             )");
                                
                          if($insert)  {
                            echo '<script>alert("tambah data berhasil")</script>';
                            echo '<script>window.location="data-produk.php"</script>';
                          }else{
                            echo 'gagal'.mysqli_error($conn);
                          } 

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
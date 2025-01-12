
<?PHP
#Memulakan fungsi session
session_start();
#Set rujukkan zon masa & tarikh
date_default_timezone_set("Asia/Kuala_Lumpur");
?>

<!DOCTYPE html>
<html>
<head>
<title>THE GRAND CINEMA</title>
<style>
      body {
        background-image: url('film.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
      }
    </style>
  </head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<!-- tajuk kepada sistem -->
<h1 class="w3-text-amber" style=font-family:"georgia"><b>THE GRAND CINEMA</b></h1>
<div class="w3-text-white"><i><b>Wayang dimana-mana bila-bila<b></i>
</div>
<div class="w3-bar w3-container">
<!-- Menu yang akan dipaparkan kepada semua pengguna -->
<a class="w3-button w3-text-orange" href="index.php">LAMAN UTAMA</a>

<!-- menyemak kewujudan session nama_pelanggan (jika telah login, maka session ini akan mempunyai nilai) -->
<?PHP if(empty($_SESSION['nama'])) { ?>

<!-- Menu yang akan dipaparkan kepada pengguna yang belum login-->
<a class="w3-button w3-text-orange" href="pelanggan_login.php">LOG MASUK</a>
<a class="w3-button w3-text-orange" href="pelanggan_daftar.php">DAFTAR MASUK</a>

<?PHP } else { ?>

<!-- Menu yang akan dipaparkan kepada pengguna yang telah login-->
 <a class="w3-button w3-text-amber" href="logout.php">LOGOUT</a>
<?PHP } ?>
</div>
</body>
</html>

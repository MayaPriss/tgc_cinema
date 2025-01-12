<?PHP
# memulakan fungsi session
session_start();

# Menyemak nama fail semasa
$namafail = basename($_SERVER['PHP_SELF']);
# Menguji adakah fail semasa bukan index.php dan pembolehubah session tidak mempunyai nilai
if($namafail !='index.php'and empty($_SESSION['id_admin']))
{
    die("<script>alert('Sila Daftar Masuk');
    window.location.href='index.php';</script>");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>LAMAN ADMIN</title>
<style>
      body {
        background-image: url('cube.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
      }
    </style>
  </head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<!-- Kod Javascript untuk membesarkan saiz tulisan-->
<script>
function resizeText(multiplier) {
    var elem = document.getElementById("saiz");
    var currentSize = elem.style.fontSize || 1;
    if(multiplier==2)
    {
        elem.style.fontSize = "1em";
    }
    else
    {
        elem.style.fontSize = ( parseFloat(currentSize) + (multiplier * 0.2)) + "em";
    }
}
</script>

<!-- Tajuk Sistem admin-->
<div class="w3-sidebar w3-bar-block w3-border-right w3-black w3-text-orange w3-left" style="display:none" id="mySidebar">
  <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>

<?PHP
# Jika pembolehubah session['nama_admin'] mempunyai nilai (not empty) bermaksud
# admin telah login dan paparkan senarai menu utama
if(!empty($_SESSION['id_admin'])) { ?>
<!-- Menu -->
<a class="w3-button w3-block" href="laman_utama.php">LAMAN UTAMA</a>
<a class="w3-button w3-block" href="maklumat_pelanggan.php">MAKLUMAT PENGGUNA</a>
<a class="w3-button w3-block" href="maklumat_filem.php">MAKLUMAT FILEM</a>
<a class="w3-button w3-block" href="maklumat_tayangan.php">MAKLUMAT TAYANGAN</a>
<a class="w3-button w3-block" href="maklumat_tempahan.php">MAKLUMAT PEMBELIAN</a>
<a class="w3-button w3-block" href="maklumat_admin.php">MAKLUMAT ADMIN</a>
<a class="w3-button w3-block" href="analisis.php">ANALISIS</a>
<a class="w3-button w3-block" href="upload.php" >UPLOAD TAYANGAN</a>
<a class="w3-button w3-block" href="../logout.php?id=admin">LOGOUT</a>

<?PHP } ?>
</div>
<div class="w3-gray">
  <button class="w3-button w3-black w3-xlarge" onclick="w3_open()">☰</button>
  <div class="w3-container">
    <h1 style=font-family:"fantasy"><b>THE GRAND CINEMA</b></h1>
  </div>
</div>

<script>
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>
</body>
</html>

<!-- Memanggil fail header-->
<?PHP include('header.php'); ?>
<!DOCTYPE html>
<html>
<body class="w3-sand">
<div class="w3-container">
<div class="w3-container w3-half">
    <img src="images/popcorn.gif" class="w3-image" width="600px" height="300px">
</div>
  <div class="w3-container w3-half w3-margin-top">
<!-- Menyediakan borang untuk mendaftar pelanggan baru-->
<h4 class="w3-text-white" style=font-family:"cambria"><b>DAFTAR MASUK PENGGUNA</b></h4>
<form action='' method='POST'>
<div class="w3-text-white">NAMA         <input class="w3-input w3-round-large" type='text' name='nama'><br></div>
<div class="w3-text-white">NO KAD PENGENALAN         <input class="w3-input w3-round-large" type='text' name='no_kad_pengenalan'><br></div>
<div class="w3-text-white">KATA LALUAN   <input  class="w3-input w3-round-large" type='password' name='kata_laluan'><br></div>
                  <input class="w3-button w3-round-xxlarge w3-indigo w3-block w3-margin-bottom" type='submit' value='DAFTAR MASUK'>
</form>
</div>

</div>
</body>
</html>
 <!-- Memanggil fail footer-->
<?PHP include('footer.php'); ?>

<?PHP
# menyemak kewujudan data POST
if (!empty($_POST))
{
    # memanggil fail connection
    include ('connection.php');

    # mengambil data POST
    $no_kad_pengenalan=$_POST['no_kad_pengenalan'];
    $nama=$_POST['nama'];
    $kata_laluan=$_POST['kata_laluan'];

    # -- data validation --
    if(empty($no_kad_pengenalan) or empty($nama) or empty($kata_laluan))
    {
        die("<script>alert('Lengkapkan maklumat yang dikehendaki.');
        window.history.back();</script>");
    }

    # --- data validation bilangan no_kad_pengenalan dan semak aksara
    if(strlen($no_kad_pengenalan)!=12 or !is_numeric($no_kad_pengenalan))
    {
        die("<script>alert('No Kad Pengenalan mesti 12 digit');
        window.history.back();</script>");
    }
    # arahan SQL untuk menyimpan data ke dalam jadual pelanggan
    $arahan_sql_simpan="insert into pengguna
    (no_kad_pengenalan,nama,kata_laluan)
    values
    ('$no_kad_pengenalan','$nama','$kata_laluan')";

    # melaksanakan proses menyimpan dalam syarat if
    if(mysqli_query($condb,$arahan_sql_simpan))
    {
        # jika proses menyimpan berjaya. papar info dan buka laman pelanggan_login.php
        echo "<script>alert('Pendaftaran Berjaya');
        window.location.href='pelanggan_login.php';</script>";
    }
    else
    {
        # jika proses menyimpan gagal, kembali ke laman sebelumnya
        echo "<script>alert('Pendaftaran Gagal');
        window.history.back();</script>";
    }
}
?>

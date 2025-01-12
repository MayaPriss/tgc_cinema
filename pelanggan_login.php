<!--Memanggil fail header-->
<?PHP include('header.php'); ?>

<!DOCTYPE html>
<html>
<body class="w3-sand">

<div class="w3-container">
<div class="w3-third w3-container">

</div>
<div class="w3-third w3-container w3-margin">
<!--Menyediakan form bagi daftar masuk pengguna-->
<h4 class="w3-text-white" style=font-family:"cambria"><b>LOG MASUK PENGGUNA</b></h4>
<form action='' method='POST' autofocus>
<div class="w3-text-white">NO KAD PENGENALAN   <input class="w3-input w3-round-xxlarge" type='text' name='no_kad_pengenalan'><br></div>
<div class="w3-text-white">KATA LALUAN      <input class="w3-input w3-round-xxlarge" type='password' name='kata_laluan'><br></div>
                <input class="w3-button w3-round-xxlarge w3-indigo" type='submit' value='LOG MASUK'>
</form>
</div>
<div class="w3-third w3-container">

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
    $kata_laluan=$_POST['kata_laluan'];

    # arahan SQL untuk mencari data dari jadual pelanggan
    $arahan_sql_cari="select*
    from pengguna
    where no_kad_pengenalan='$no_kad_pengenalan' and
    kata_laluan='$kata_laluan'
    limit 1 ";

    # melaksanakan proses carian
    $laksana_arahan=mysqli_query($condb,$arahan_sql_cari);

    # jika terdapat 1 baris rekod di temui
    if(mysqli_num_rows($laksana_arahan)==1)
    {
        # login berjaya
        # pembolehubah $rekod mengambil data yang di temui semasa proses mencari
        $rekod=mysqli_fetch_array($laksana_arahan);

        #mengumpukkan kepada pembolehubah session
        $_SESSION['no_kad_pengenalan']=$rekod['no_kad_pengenalan'];
        $_SESSION['nama']=$rekod['nama'];

        # mengarahkan fail index.php dibuka
        echo "<script>window.location.href='index.php';</script>";
    }
    else
    {
        # login gagal. kembali ke laman sebelumnya
        echo "<script>alert('Log Masuk Gagal');
        window.history.back();</script>";
    }
}
?>

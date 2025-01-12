<!-- Memanggil fail header_admin.php-->
<?PHP include('header_admin.php'); ?>
<div class="w3-third w3-container"></div>
<div class="w3-third w3-container w3-round-xxlarge w3-margin-top">
<!--Menyediakan form bagi daftar masuk admin-->
<h4 class="w3-text-white" style=font-family:"cambria"><b>LOG MASUK ADMIN<b/></h4>
<form action='' method='POST'>
<div class="w3-text-white">  ID ADMIN <input class="w3-input w3-round-xxlarge" type='text' name='id_admin'><br></div>
<div class="w3-text-white">   KATA LALUAN <input class="w3-input w3-round-xxlarge" type='password' name='kata_laluan'><br></div>
      <input class="w3-button w3-round-xxlarge w3-cyan w3-block w3-margin-bottom" type='submit' value='LOG MASUK'>
</form>
</div>
<div class="w3-third w3-container"></div>

<?PHP
# menyemak kewujudan data POST
if (!empty($_POST))
{
  # memanggil fail connection
  include ('../connection.php');

  # memanggil data POST
  $id_admin=$_POST['id_admin'];
  $kata_laluan=$_POST['kata_laluan'];

  # arahan SQL untuk mencari data dari jadual admin
  $arahan_sql_cari="select*
  from admin
  where id_admin ='".$id_admin."'
  and  kata_laluan='".$kata_laluan."' limit 1";

    # melaksanakan proses carian
    $laksana_arahan=mysqli_query($condb,$arahan_sql_cari);

    # jika terdapat 1 baris rekod di temui
    if(mysqli_num_rows($laksana_arahan)==1)
    {
        # login berjaya
        # pembolehubah $rekod mengambil data yang di temui semasa proses mencari
        $rekod=mysqli_fetch_array($laksana_arahan);

        #mengumpukkan kepada pembolehubah session
        $_SESSION['id_admin']=$rekod['id_admin'];
        $_SESSION['nama_admin']=$rekod['nama_admin'];

        # mengarahkan fail index.php dibuka
        echo "<script>window.location.href='laman_utama.php';</script>";
    }
    else
    {
        # login gagal. kembali ke laman sebelumnya
        echo "<script>alert('Maaf,Log Masuk Gagal');
        window.history.back();</script>";
    }
}
?>

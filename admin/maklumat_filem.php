<?PHP
# Memanggil fail header_admin.php
include ('header_admin.php');

# Memanggil fail connection.php dari folder luaran
include ('../connection.php');

#----------- Bahagian 2 : Proses penyimpan data-------
# Menyemak kewujudan data POST
if(!empty($_POST))
{
    # mengambil data POST
    $tajuk_filem=$_POST['tajuk_filem'];
    $tarikh_mula=$_POST['tarikh_mula'];
    $tarikh_tamat=$_POST['tarikh_tamat'];
    $harga_dewasa=$_POST['harga_dewasa'];
    $harga_kanak=$_POST['harga_kanak'];


    # memproses maklumat gambar yang di upload
    # proses ini lebih kepada menukar nama fail gambar
    $timestmp=date("Y-m-d");
    $saiz_fail = $_FILES['gambar']['size'];
    $nama_fail=basename($_FILES["gambar"]["name"]);
    $jenis_gambar = pathinfo($nama_fail,PATHINFO_EXTENSION);
    $lokasi = $_FILES['gambar']['tmp_name'];
    $folder = "../images/movie/";
    $nama_baru_gambar=$tajuk_filem.$timestmp.".".$jenis_gambar;

    # Arahan untuk menyimpan data ke dalam jadual filem
    $arahan_sql_simpan="insert into filem
    (tajuk_filem,gambar,harga_dewasa,harga_kanak,tarikh_mula,tarikh_tamat)
    values
    ('$tajuk_filem','$nama_baru_gambar','$harga_dewasa','$harga_kanak','$tarikh_mula','$tarikh_tamat')";

    # melaksanakan proses menyimpan dalam syarat if
    if(mysqli_query($condb,$arahan_sql_simpan))
    {
        # muat naik gambar ke dalam folder images/movie
        move_uploaded_file($lokasi,$folder.$nama_baru_gambar);

        # proses menyimpan data berjaya. papar mesej
        echo "<script>alert('Pendaftaran Berjaya');</script>";
    }
    else
    {
        # proses menyimpan data gagal. papar mesej
        echo "<script>alert('Pendaftaran gagal');
        window.history.back();
        </script>";
    }
}

?>

<h3 class='w3-text-white' style=font-family:'constantia'><b>MAKLUMAT FILEM</b></h3>
<!-- form / borang untuk mendaftar filem baru -->
    <h4 class='w3-text-white'><b>DAFTAR FILEM BARU</b></h4>
    <form action='' method='POST' enctype='multipart/form-data'>
    <table border='1' class="w3-table-all">
        <tr>
            <td style="width:10%"><b>TAJUK FILEM</b></td>
            <td style="width:60%">
                <input class="w3-round-xxlarge w3-input w3-black" type='text' name='tajuk_filem' size='60'>
            </td>


  <td style="width:10%"><b>Tarikh Mula</b></td>
    <td style="width:20%">
                    <input  name='tarikh_mula' type='date'>
                </td>
            </tr>

            <tr>
                <td colspan='2'></td>
                <td><b>Tarikh Tamat</b></td>
                <td>
                    <input name='tarikh_tamat' type='date'>
                </td>
            </tr>


        <tr>
            <td colspan='2'></td>
            <td><b>HARGA DEWASA</b></td>
            <td>
                <input class="w3-round-xxlarge w3-input w3-black" name='harga_dewasa' type='number'>
            </td>
        </tr>

        <tr>
            <td colspan='2'></td>
            <td><b>HARGA KANAK-KANAK</b></td>
            <td>
                <input class="w3-round-xxlarge w3-input w3-black" name='harga_kanak' type='text'>
            </td>
        </tr>

        <tr>
            <td colspan='2'></td>
            <td><b>GAMBAR</b></td>
            <td>
                <input class="w3-round-xxlarge w3-input w3-black" name='gambar' type='file'>
            </td>
        </tr>

        <tr>
            <td colspan='3'></td>
            <td>
                <input class="w3-button w3-round-xxlarge w3-red" type='submit' value='DAFTAR'>
            </td>
        </tr>
    </table>
    </form>



<!-- Memaparkan maklumat filem yang telah berdaftar -->
<h4 class='w3-text-white'><b>SENARAI FILEM</b></h4>
<table border='1' class="w3-table-all">

<?PHP
$arahan_sql= "select* from filem order by id_filem DESC";
$laksana_arahan=mysqli_query($condb,$arahan_sql);
$i=1;
while($rekod=mysqli_fetch_array($laksana_arahan))
{
    if($i==1)
    {
        echo "<tr>";
    }
    else if($i==3)
    {
        echo "";
    }
    else if($i==4)
    {
        echo "</tr>";
        $i=1;
    }
    echo "<td style=\"width:16.67%\" align='center'><img  src='../images/movie/".$rekod['gambar']."' width='100%'></td>
          <td>
            <p ><b> ".$rekod['tajuk_filem']."</b></p><hr>
            <p ><b>ID Filem :</b>        ".$rekod['id_filem']."
            <p ><b>Tarikh mula :</b>     ".$rekod['tarikh_mula']."
            <p ><b>Tarikh tamat :</b>    ".$rekod['tarikh_tamat']."</p>
            <p ><b>Harga dewasa :</b>    ".$rekod['harga_dewasa']."</p>
            <p ><b>Harga kanak :</b>     ".$rekod['harga_kanak']."</p>

            <a class='w3-button w3-aqua w3-round-xxlarge' href='hapus.php?jadual=filem&medan_kp=id_filem&kp=".$rekod['id_filem']."'
            onClick=\"return confirm('Anda pasti ingin padam data ini?')\" >Padam</a><br><br>


          </td>";
    $i++;
}
?>
</table>

<?PHP include ('footer_admin.php'); ?>

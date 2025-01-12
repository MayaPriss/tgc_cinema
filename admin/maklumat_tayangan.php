<?PHP
include ('header_admin.php');

# Memanggil fail connection.php dari folder luaran
include ('../connection.php');

#----------- Bahagian 2 : Proses penyimpan data-------
# Menyemak kewujudan data POST
if(!empty($_POST))
{
    # mengambil data POST
    $id_pawagam=$_POST['id_pawagam'];
    $id_filem=$_POST['id_filem'];
    $id_masa=$_POST['masa'];
    $tarikh=$_POST['tarikh'];
    $bilangan_simpan=0;

    # melaksanakan proses menyimpan
    foreach($_POST['masa'] as $masa)
    {
        # Arahan untuk menyimpan data ke dalam jadual tayangan
        $arahan_sql_simpan="insert into tayangan
        (id_pawagam,id_filem,id_masa,tarikh)
        values
        ('$id_pawagam','$id_filem','$masa','$tarikh')";
        $laksana_arahan_simpan=mysqli_query($condb,$arahan_sql_simpan);
        $bilangan_simpan++;
    }
    if(count($_POST['masa'])==$bilangan_simpan)
    {
        # proses menyimpan data berjaya. papar mesej
        echo "<script>alert('Pendaftaran Berjaya');</script>";
    }
    else
    {
        # proses menyimpan data gagal. papar mesej
        echo "<script>alert('Pendaftaran tidak lengkap. Semak semula data dalam jadual di bawah');
        window.history.back();</script>";
    }
}

?>

<h3 class='w3-text-white' style=font-family:'constantia'><b>MAKLUMAT TAYANGAN</b></h3>

    <h4 class='w3-text-white'><b>DAFTAR TAYANGAN BARU</b></h4>
    <!-- form / borang untuk mendaftar tayangan baru -->
    <form action='' method='POST'>
    <table class="w3-table-all" >
        <tr>
            <td style="width:10%"><b>NAMA FILEM</b></td>
            <td style="width:60%">
            <select class="w3-round-xxlarge w3-input w3-blue-gray" name='id_filem'  required>
            <option value selected disabled>Pilih</option>
            <?PHP
            $arahan_pilih_filem= "select* from filem order by tarikh_mula DESC";
            $laksanakan_pilih = mysqli_query($condb,$arahan_pilih_filem);
            while($rekod=mysqli_fetch_array($laksanakan_pilih))
            {
                echo "<option value='".$rekod['id_filem']."'>".$rekod['tajuk_filem']."</option>";
            }
            ?>

            </select>
            </td>
        </tr>

        <tr>
            <td style="width:10%"><b>NAMA PAWAGAM</b></td>
            <td style="width:60%">
            <select class="w3-round-xxlarge w3-input w3-blue-gray" name='id_pawagam' required>
            <option value selected disabled>Pilih</option>
            <?PHP
            $arahan_pilih_pawagam= "select* from pawagam limit 50";
            $laksanakan_pilih_pawagam = mysqli_query($condb,$arahan_pilih_pawagam);
            while($rekod=mysqli_fetch_array($laksanakan_pilih_pawagam))
            {
                echo "<option value='".$rekod['id_pawagam']."'>".$rekod['nama_pawagam']."</option>";
            }
            ?>

            </select>
            </td>
        </tr>

        <tr>
            <td style="width:10%"><b>TARIKH TAYANGAN</b></td>
            <td style="width:60%">
            <input class="w3-round-xxlarge w3-input w3-blue-gray" type='date' name='tarikh' >
            </td>
        </tr>

        <tr>
            <td style="width:10%"><b>MASA TAYANGAN</b></td>
            <td style="width:60%">
            <?PHP
            $arahan_pilih_masa= "select* from masa_tayangan";
            $laksanakan_pilih_masa = mysqli_query($condb,$arahan_pilih_masa);
            while($rekod=mysqli_fetch_array($laksanakan_pilih_masa))
            {
                echo "<input type='checkbox' name='masa[]' value='".$rekod['id_masa']."'>
                <label>".$rekod['masa']."</label> ";
            }
            ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <input class="w3-button w3-round-xxlarge w3-red" type='submit' value='DAFTAR'>
            </td>
        </tr>
    </table>
    </form>


<!-- Memaparkan maklumat tayangan yang telah berdaftar -->
<h4 class='w3-text-white'><b>SENARAI TAYANGAN</b></h4>

    <input class="w3-circle w3-blue" name='reSize1' type='button' value='reset' onclick="resizeText(2)" />
    <input class="w3-circle w3-aqua" name='reSize2' type='button' value='&nbsp;-&nbsp;' onclick="resizeText(-1)" />
    <input class="w3-circle w3-yellow" name='reSize' type='button' value='&nbsp;+&nbsp;' onclick="resizeText(1)" />

<table border='1' id='saiz' class="w3-table-all">
    <tr>
        <td><b>BIL</b></td>
        <td><b>TAJUK FILEM</b></td>
        <td><b>NAMA PAWAGAM</b></td>
        <td><b>TARIKH TAYANGAN</b></td>
        <td><b>MASA TAYANGAN</b></td>
    </tr>
<?PHP
# arahan untuk memilih tayangan
$arahan_sql= "SELECT*
FROM tayangan,filem,pawagam,masa_tayangan
WHERE
tayangan.id_filem=filem.id_filem AND
tayangan.id_pawagam=pawagam.id_pawagam AND
tayangan.id_masa=masa_tayangan.id_masa
order by tayangan.id_tayangan DESC";
# melaksanakan arahan memilih
$laksana_arahan=mysqli_query($condb,$arahan_sql);
$bil=0;
#mengambil data tayangan dan memaparkannya baris demi baris
while($rekod=mysqli_fetch_array($laksana_arahan))
{
    echo "
    <tr>
        <td>".++$bil."</td>
        <td>".$rekod['tajuk_filem']."</td>
        <td>".$rekod['nama_pawagam']."</td>
        <td>".$rekod['tarikh']."</td>
        <td>".$rekod['masa']."</td>

    </tr>


    ";

}
?>
</table>

<?PHP include ('footer_admin.php'); ?>

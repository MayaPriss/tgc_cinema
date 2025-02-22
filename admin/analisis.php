<?PHP
# Memanggil fail header_admin.php
include ('header_admin.php');
# Memanggil fail connection.php dari folder luaran
include ('../connection.php');

# menyemak kewujudan data POST
if(!empty($_POST))
{
    # Umpukan syarat tambahan kepada arahan SQL
    $bulan=$_POST['bulan'];
    $tambahan = "AND tayangan.tarikh LIKE '%$bulan%'";
}
else
{
    $bulan="Keseluruhan";
    $tambahan=" ";
}
?>

<h3 class='w3-text-white' style=font-family:'constantia'><b>ANALISIS KUTIPAN</b></h3>
<p class='w3-text-white'><b>Pilih Tajuk Filem</b>
<!-- Borang / form untuk memilih bulan kutipan -->
<form action='' method='POST'>
<select name='bulan' >
    <option value selected disabled>Keseluruhan</option>
    <option value='-01-'>Januari</option>
    <option value='-02-'>Februari</option>
    <option value='-03-'>Mac</option>
    <option value='-04-'>April</option>
    <option value='-05-'>Mei</option>
    <option value='-06-'>Jun</option>
    <option value='-07-'>Julai</option>
    <option value='-08-'>Ogos</option>
    <option value='-09-'>September</option>
    <option value='-10-'>Oktober</option>
    <option value='-11-'>November</option>
    <option value='-12-'>Disember</option>
</select>
<button class="w3-button w3-round-xxlarge w3-blue" type='Submit'>PAPAR</button></p>
</form>

<!-- Header untuk memaparkan data kutipan tayangan-->
<table border='1' class="w3-table-all">
    <tr >
        <th>BIL</th>
        <th>TAJUK FILEM</th>
        <th>JUMLAH KUTIPAN</th>

    </tr>

<?PHP
# arahan untuk mengira jumlah kutipan tayangan filem
$arahan_sql= "SELECT SUM(pembelian.jumlah_bayaran)AS jumlah_bayaran, filem.tajuk_filem
FROM pembelian, tayangan, filem
WHERE pembelian.id_tayangan=tayangan.id_tayangan AND
tayangan.id_filem=filem.id_filem $tambahan
GROUP BY tayangan.id_filem order by jumlah_bayaran DESC";

# melaksanakan arahan untuk mengira jumlah kutipan
$laksana_arahan=mysqli_query($condb,$arahan_sql);
$bil=0;
$jumlah_kutipan=0;

#Mengambil data dan memaparkan data baris demi baris
while($rekod=mysqli_fetch_array($laksana_arahan))
{
    echo "
    <tr>
        <td>".++$bil."</td>
        <td>".$rekod['tajuk_filem']."</td>
        <td >RM ".$rekod['jumlah_bayaran']."</td>
    </tr>";

    $jumlah_kutipan = $jumlah_kutipan + $rekod['jumlah_bayaran'];
}
echo "
    <tr>
        <th colspan='2' >Jumlah Kutipan Semua Filem pada bulan : $bulan</th>
        <th >RM ".number_format($jumlah_kutipan,2)."</th>
    </tr>";
?>
</table >
<?PHP include ('footer_admin.php'); ?>

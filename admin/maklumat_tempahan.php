<?PHP
#memanggil fail header_admin.php
include ('header_admin.php');
?>

<h3 class='w3-text-white' style=font-family:'constantia'><b>MAKLUMAT PEMBELIAN</b></h3>
    <!-- butang untuk mengubah saiz tulisan dalam jadual -->
    <input class="w3-circle w3-blue" name='reSize1' type='button' value='reset' onclick="resizeText(2)" />
    <input class="w3-circle w3-aqua" name='reSize2' type='button' value='&nbsp;-&nbsp;' onclick="resizeText(-1)" />
    <input class="w3-circle w3-cyan" name='reSize' type='button' value='&nbsp;+&nbsp;' onclick="resizeText(1)" />

<!-- Header kepada jadual yang akan memaparkan maklumat pengguna-->
<table border='1' id='saiz' class="w3-table-all">
    <tr>
        <td><b>BIL</td>
        <td><b>NAMA PENGGUNA</b></td>
        <td><b>TAJUK FILEM</b></td>
        <td><b>MASA TAYANGAN</b></td>
        <td><b>TARIKH TAYANGAN</b></td>
        <td><b>NO SEAT</b></td>
        <td><b>JUMLAH BAYARAN</b></td>
    </tr>

<?PHP
#memanggil fail connection.php dari folder luaran
include ('../connection.php');

#arahan untuk memilih semua medan dalam jadual pengguna, pembelian, tayangan, filem dan masa_tayangan
$arahan_sql= "SELECT*
FROM pembelian,pengguna,tayangan,filem,pawagam,masa_tayangan
WHERE
pembelian.no_kad_pengenalan=pengguna.no_kad_pengenalan and
pembelian.id_tayangan=tayangan.id_tayangan AND
tayangan.id_filem=filem.id_filem AND
tayangan.id_pawagam=pawagam.id_pawagam AND
tayangan.id_masa=masa_tayangan.id_masa
order by tayangan.id_tayangan DESC
limit 50 ";

# Melaksanakan arahan untuk memilih
$laksana_arahan=mysqli_query($condb,$arahan_sql);
$bil=0;

# mengambil data yang dicari dan memaparkannya baris demi baris. maximum paparan adalah 50 baris terakhir
while($rekod=mysqli_fetch_array($laksana_arahan))
{
    echo "
    <tr>
        <td>".++$bil."</td>
        <td>".$rekod['nama']."</td>
        <td>".$rekod['tajuk_filem']."</td>
        <td>".$rekod['masa']."</td>
        <td>".$rekod['tarikh']."</td>
        <td>".$rekod['no_seat']."</td>
        <td>".$rekod['jumlah_bayaran']."</td>
    </tr>
    ";
}
?>
</table>
<?PHP include ('footer_admin.php'); ?>

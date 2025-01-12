<?PHP
# Memanggil fail header_admin.php
include ('header_admin.php');
?>

<h3 class='w3-text-white' style=font-family:'constantia'><b>MAKLUMAT PENGGUNA</b></h3>

    <!-- Butang untuk membesarkan saiz tulisan dalam jadual -->
    <input class="w3-circle w3-blue" name='reSize1' type='button' value='reset' onclick="resizeText(2)" />
    <input class="w3-circle w3-aqua"  name='reSize2' type='button' value='&nbsp;-&nbsp;' onclick="resizeText(-1)" />
    <input class="w3-circle w3-yellow" name='reSize' type='button' value='&nbsp;+&nbsp;' onclick="resizeText(1)" />

<!-- Header jadual yang memaparkan data pelanggan-->
<table border='1' id='saiz' class="w3-table-all">
    <tr>
        <td><b>BIL</b></td>
        <td><b>NO KAD PENGENALAN</b></td>
        <td><b>NAMA</b></td>
        <td><b>KATA LALUAN</b></td>
    </tr>

<?PHP
# memanggil fail connection.php dari folder luaran
include ('../connection.php');

# arahan SQL untuk memilih semua medan dalam jadual pelanggan
$arahan_sql= "select* from pengguna order by no_kad_pengenalan";

# melaksanakan arahan tersebut
$laksana_arahan=mysqli_query($condb,$arahan_sql);
$bil=0;


while($rekod=mysqli_fetch_array($laksana_arahan))
{
    # Memaparkan data pelanggan satu demi satu
    echo "
    <tr>
        <td>".++$bil."</td>
        <td>".$rekod['no_kad_pengenalan']."</td>
        <td>".$rekod['nama']."</td>
        <td>".$rekod['kata_laluan']."</td>
    </tr>
    ";
}

?>

</table>
</div>

<?PHP include ('footer_admin.php'); ?>

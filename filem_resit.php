<?PHP
#memanggil fail header.php
include ('header.php');
# memanggil fail guard.php bg tujuan kawalan capaian pengguna
include ('guard.php');
?>

<!-- Memaparkan maklumat tayangan -->
<div id='resit' class='w3-gray'>
        <h4 style=font-family:'constantia'><b>Resit Pembelian</b></h4>

        <p><b>Tarikh Tayangan : </b>                <?PHP echo $_GET['tarikh_pilihan']; ?> </p>
        <p><b>Tajuk Filem : </b>                    <?PHP echo $_GET['tajuk_filem']; ?> </p>
        <p><b>Masa Tayangan : </b>                  <?PHP echo $_GET['masa']; ?> </p>
        <p><b>Nama Pawagam : </b>                   <?PHP echo $_GET['nama_pawagam']; ?> </p>
        <p><b>Bilangan Tiket Dewasa : </b>          <?PHP echo $_GET['dewasa']; ?> </p>
        <p><b>Bilangan Tiket Kanak-kanak : </b>     <?PHP echo $_GET['kanak2']; ?> </p>
        <p><b>No Tempat Duduk : </b>                   <?PHP echo $_GET['bil_seat']; ?> </p>
        <hr>
        <p><b>Jumlah Bayaran : RM</b>
        <?PHP
        $bayaran=($_GET['dewasa']*$_GET['harga_dewasa'])+($_GET['kanak2']*$_GET['harga_kanak']);
        echo number_format($bayaran,2);
        ?>
        </p><hr>
        <p><i>Sila berada di pawagam 10 minit sebelum tayangan bermula</i></p>
        <input class='w3-button w3-round-xxlarge w3-red' type='button' onClick="printdiv('resit');" value='Cetak'>
</div>

<?PHP include ('footer.php'); ?>

<!-- Fungsi untuk mencetak resit -->
<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>

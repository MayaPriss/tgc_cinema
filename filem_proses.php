<?PHP
# Memulakan fungsi session
session_start();
# memanggil fail connection.php
include('connection.php');

$i=1;
$bil_seat=" ";

# Mengambil no seat yang dipilih
foreach($_POST['seat'] as $seat_get)
{
    $bil_seat=$bil_seat.$seat_get."  ";
    if($i<=$_POST['dewasa'])
    {
        #arahan untuk menyimpan data berdasarkan bilangan tiket dewasa
        $sql="insert into pembelian
        (no_kad_pengenalan,id_tayangan,no_seat,jumlah_bayaran)
        values
        ('".$_SESSION['no_kad_pengenalan']."','".$_GET['id_tayangan']."','$seat_get','".$_GET['harga_dewasa']."')";
    }
    else
    {
        # arahan untuk menyimpan data berdasarkan bilangan tiket kanak2
        $sql="insert into pembelian
        (no_kad_pengenalan,id_tayangan,no_seat,jumlah_bayaran)
        values
        ('".$_SESSION['no_kad_pengenalan']."','".$_GET['id_tayangan']."','$seat_get','".$_GET['harga_kanak']."')";
    }

    # melaksanakan arahan untuk menyimpan data
    $laksana_arahan=mysqli_query($condb,$sql);
    $i++;

}
#mengumpukan array dengan data GET yang dihantar dari fail filem_bayar.php
$data_get= array(
    'tarikh_pilihan'=>$_GET['tarikh_pilihan'],
    'id_filem'=>$_GET['id_filem'],
    'tajuk_filem'=>$_GET['tajuk_filem'],
    'tarikh_mula'=>$_GET['tarikh_mula'],
    'tarikh_tamat'=>$_GET['tarikh_tamat'],
    'gambar'=>$_GET['gambar'],
    'harga_dewasa'=>$_GET['harga_dewasa'],
    'harga_kanak'=>$_GET['harga_kanak'],
    'id_tayangan'=>$_GET['id_tayangan'],
    'masa'=>$_GET['masa'],
    'nama_pawagam'=>$_GET['nama_pawagam'],
    'dewasa'=>$_POST['dewasa'],
    'kanak2'=>$_POST['kanak2'],
    'bil_seat'=>$bil_seat
    );

# memaparkan pop up dan terus ke page resit dengan menghantar data GET
echo "<script>alert('Urusan Pembelian Selesai');window.location.href='filem_resit.php?".http_build_query($data_get)."';</script>";


?>

<?PHP
#memanggil fail header.php
include ('header.php');
# memanggil fail guard.php bg tujuan kawalan capaian pengguna
include ('guard.php');
# menyemak jika tiada seat yang dipilih, kembali ke page untuk memilih seat
if(empty($_POST))
{
    die("<script>alert('Pilih tempat duduk');window.history.back();</script>");
}

#mengumpukan array dengan data GET yang dihantar dari fail filem_seat.php
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
    'nama_pawagam'=>$_GET['nama_pawagam']
  );

# Memaparkan butiran tempahan
echo"<table align='center' width='100%' >
  <tr valign='top'>
    <td class='w3-gray'>
        <h4 style=font-family:'constantia'><b>Butiran Pembelian</b></h4>
        <p><b>Tarikh Tayangan : </b>".$data_get['tarikh_pilihan']."</p>
        <p><b>Tajuk Filem : </b>".$data_get['tajuk_filem']."</p>
        <p><b>Masa Tayangan : </b>".$data_get['masa']."</p>
        <p><b>Nama Pawagam : </b>".$data_get['nama_pawagam']."</p>
        <p><b>Harga Tiket Dewasa : RM</b>".$data_get['harga_dewasa']."</p>
        <p><b>Harga Tiket Kanak-kanak : RM</b>".$data_get['harga_kanak']."</p>
    </td>
    <td class='w3-dark-gray w3-text-black'>
        <h4 style=font-family:'constantia'><b>Masukan Bilangan Kanak-Kanak</b></h4>
        <form action='filem_proses.php?".http_build_query($data_get)."' method='POST'>
        <p><b>No Tempat Duduk : </b>";

        foreach($_POST['seat'] as $seat_get)
        {
            echo $seat_get." ";
            echo "<input type='hidden' name='seat[]' value='".$seat_get."'>";
        }

        echo "<p><b>Bilangan Seat : </b>".count($_POST['seat'])."</p>";

        # Borang untuk memasukkan jumlah penonton.
        echo"</b></p>
        <input type='hidden' name='harga_dewasa' id='hv2' value='".$_GET['harga_dewasa']."'>
        <input type='hidden' name='harga_kanak2' id='hv1' value='".$_GET['harga_kanak']."'>
        <input type='hidden' name='bil' id='bil' value='".count($_POST['seat'])."'>
        <table >
            <tr>
                <td><b>Dewasa : </b></td>
                <td>
                <input name='dewasa' disable
                type='text' id ='v2' value='".count($_POST['seat'])."' onChange='calculate()' readonly>
                </td>
            </tr>
            <tr>
                <td><b>kanak-kanak : </b></td>
                <td>
                <input name='kanak2' autofocus
                type='text' id ='v1' value='0' onChange='calculate()'>
                </td>
            </tr>
            <tr>
                <td><b>Bayaran : </b></td>
                <td>
                    <input name='bayaran'  readonly disable
                    value='RM ".number_format((count($_POST['seat'])*$_GET['harga_dewasa']),2)."' type='text' id='result'>
                </td>

            </tr>
    </table>";

# bahagian untuk pembayaran harga tiket menggunkan kad kredit.
    echo"
    <br>
        <h4 style=font-family:'constantia'><b>Pembayaran Menggunakan Kad Kredit</b></h4>
        <input type='text' name='name_on_card' placeholder = 'Nama Atas Kad'><br>
        <input type='text' name='card_no' placeholder = 'Nombor Kad' maxlength='12'><br>

    <table >
        <tr>
            <td>
                <input maxlength='2'  type='text' name='mm' placeholder = 'MM' >
            </td>
            <td>
                <input maxlength='4'  type='text' name='mm' placeholder = 'YYYY'>
            </td>
            <td>
                <input maxlength='3'  type='text' name='cc' placeholder = 'CCV'>
            </td>
        </tr>
    </table><br>

    <input  type='text' name='alamat' placeholder = 'Alamat Bil'><br>
    <input maxlength='5'  type='text' name='poskod' placeholder = 'Poskod'><br>
    <input class='w3-button w3-round-xxlarge w3-amber'  type='submit' value='BAYAR'>

</form>
<hr>
</td>
</tr>
</table>";

#Memanggil fail footer.php
include ('footer.php');

?>

<!-- fungsi untuk mengira jumlah bayaran -->
<script>
function calculate()
{
    var dewasa=Number(document.getElementById('v2').value);
    var kanak2=Number(document.getElementById('v1').value);
    var harga_dewasa=Number(document.getElementById('hv2').value);
    var harga_kanak2=Number(document.getElementById('hv1').value);
    var bil=Number(document.getElementById('bil').value);
    if(kanak2>bil || kanak2<0)
    {
        alert("Ralat!! Bilangan kanak-kanak tidak tepat");
        location.reload();
    }
    dewasa=bil-kanak2;
    v2.value=bil-kanak2;
    result.value=((dewasa*harga_dewasa)+(kanak2*harga_kanak2)).toFixed(2);
}
</script>

  <?PHP
# Memanggil fail header.php
include ('header.php');
# Memanggil fail connection.php
include ('connection.php');

#menyemak kewujuan data GET tarikh tayangan
if(empty($_GET))
{ $tarikh_pilihan=date("Y-m-d"); }
else
{ $tarikh_pilihan=$_GET['tarikh_pilihan']; }

# arahan SQL untuk memilih filem yang tarikh tamat > dari tarikh pilihan
$arahan_cari="select* from filem
where tarikh_tamat>='$tarikh_pilihan' order by tarikh_mula DESC";

# laksanakan arahan SQL
$laksana=mysqli_query($condb,$arahan_cari);
?>

<!-- borang untuk memasukan tarikh pilihan -->
<form action='' method='GET'>
  <p class="w3-text-white"><b>Pilih Tarikh Tayangan</b></p>
  <input class="w3-round-xlarge w3-input" type='date' name='tarikh_pilihan' min='<?PHP echo date("Y-m-d"); ?>' value='<?PHP echo $tarikh_pilihan; ?>'>
  <button class="w3-button w3-round-xxlarge w3-orange w3-margin-top" type='submit'>PAPAR</button>
</form>
</div>
<!-- jadual untuk memaparkan senarai filem yang ditayangkan pada tarikh pilihan -->
<table class="w3-gray" style="width:70%" align="center">
<?PHP
$baris=0;

while($rekod=mysqli_fetch_array($laksana))
{
  # mengumpukan data yang diambil kepada tatasusunan
  $data_get= array(
    'tarikh_pilihan'=>$tarikh_pilihan,
    'id_filem'=>$rekod['id_filem'],
    'tajuk_filem'=>$rekod['tajuk_filem'],
    'tarikh_mula'=>$rekod['tarikh_mula'],
    'tarikh_tamat'=>$rekod['tarikh_tamat'],
    'gambar'=>$rekod['gambar'],
    'harga_dewasa'=>$rekod['harga_dewasa'],
    'harga_kanak'=>$rekod['harga_kanak']
  );


# Memaparkan maklumat filem
echo"<tr class ='w3-table-all w3-border-black'>
<td>
<p><b>TAJUK FILEM : ".$rekod['tajuk_filem']."</b></p>
<p><b>BERAKHIR PADA : ".$rekod['tarikh_tamat']."</b></p>
<p><b>HARGA DEWASA : ".$rekod['harga_dewasa']."</b></p>
<p><b>HARGA KANAK-KANAK : ".$rekod['harga_kanak']."</b></p>
<a class='w3-button w3-red w3-round-xxlarge' href='filem_info.php?".http_build_query($data_get)."'>BELI SEKARANG</a>
</td>
<td class='w3-right-align'>
<img src='images/movie/".$rekod['gambar']."' width='600px' height='300px'>
</td>

</tr>";

$baris++;
}
?>
</table>
<?PHP include ('footer.php'); ?>

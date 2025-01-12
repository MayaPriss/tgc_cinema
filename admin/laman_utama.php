<?PHP
# Memanggil fail header_admin.php
include ('header_admin.php');
# Memanggil fail connection.php dari folder luaran
include ('../connection.php');

echo"<h3 class='w3-text-white' style=font-family:'constantia'><b>LAMAN ADMIN</b></h3>";
# -------Pengiraan kutipan filem tertinggi-------------------
# Arahan SQL mengira jumlah kutipan tertinggi
$arahan_tinggi="SELECT SUM(pembelian.jumlah_bayaran)AS jumlah_bayaran, filem.tajuk_filem, filem.tarikh_mula,tayangan.tarikh
FROM pembelian, tayangan, filem
WHERE pembelian.id_tayangan=tayangan.id_tayangan AND
tayangan.id_filem=filem.id_filem
GROUP BY tayangan.id_filem order by jumlah_bayaran DESC limit 1";

# Melaksanakan arahan
$laksana_tinggi=mysqli_query($condb,$arahan_tinggi);

# Mengambil data jumlah kutipan tertinggi
$rekod_tinggi=mysqli_fetch_array($laksana_tinggi);

# mamaparkan Maklumat filem yang mempunyai kutipan tertinggi
echo "<div class='w3-panel w3-leftbar w3-border-cyan w3-pale-blue'>
<h3><b>Filem yang mempunyai kutipan Tiket Tertinggi</b></h3>
<p>Nama Filem : ".$rekod_tinggi['tajuk_filem']."</p>
<p>Tarikh Mula Tanyangan : ".$rekod_tinggi['tarikh_mula']."</p>
<p>Tarikh Tayangan Terkini : ".$rekod_tinggi['tarikh']."</p>
<p>Jumlah Kutipan :RM ".$rekod_tinggi['jumlah_bayaran']."</p>
</div> ";

# -------Pengiraan kutipan filem Terendah-------------------
# Arahan SQL mengira jumlah kutipan terendah
$arahan_rendah="SELECT SUM(pembelian.jumlah_bayaran)AS jumlah_bayaran, filem.tajuk_filem, filem.tarikh_mula,tayangan.tarikh
FROM pembelian, tayangan, filem
WHERE pembelian.id_tayangan=tayangan.id_tayangan AND
tayangan.id_filem=filem.id_filem
GROUP BY tayangan.id_filem order by jumlah_bayaran ASC limit 1";

# Melaksanakan arahan
$laksana_rendah=mysqli_query($condb,$arahan_rendah);

# Mengambil data jumlah kutipan terendah
$rekod_rendah=mysqli_fetch_array($laksana_rendah);

# Memaparkan maklumat filem yang mempunyai kutipan terendah
echo "<div class='w3-panel w3-leftbar w3-border-pink w3-pale-red'>
<h3><b>Filem yang mempunyai kutipan Tiket Terendah</b></h3>
<p>Nama Filem : ".$rekod_rendah['tajuk_filem']."</p>
<p>Tarikh Mula Tanyangan : ".$rekod_tinggi['tarikh_mula']."</p>
<p>Tarikh Tayangan Terkini : ".$rekod_tinggi['tarikh']."</p>
<p>Jumlah Kutipan :RM ".$rekod_rendah['jumlah_bayaran']."</p>
</div> ";

#memanggil fail footer.php
include ('footer_admin.php'); ?>

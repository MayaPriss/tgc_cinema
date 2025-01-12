<?PHP
#memanggil fail header.php
include ('header.php');
# memanggil fail guard.php bg tujuan kawalan capaian pengguna
include ('guard.php');
#mengumpukan array dengan data GET yang dihantar dari fail filem_info.php
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

  #memaparkan butiran tiket filem yang ingin ditempah
echo"<table width='100%' align='center'>
  <tr valign='top'>
    <td class='w3-gray'>
          <h4 style=font-family:'candara'><b>Butiran Pembelian</b></h4>
          <p><b>Tarikh Tayangan : </b>".$data_get['tarikh_pilihan']."</p>
          <p><b>Tajuk Filem : </b>".$data_get['tajuk_filem']."</p>
          <p><b>Masa Tayangan : </b>".$data_get['masa']."</p>
          <p><b>Nama Pawagam : </b>".$data_get['nama_pawagam']."</p>
          <p><b>Harga Tiket Dewasa : RM</b>".$data_get['harga_dewasa']."</p>
          <p><b>Harga Tiket Kanak-kanak : RM</b>".$data_get['harga_kanak']."</p>
    </td>
    <td class='w3-dark-gray w3-text-black'>

    <h4 style=font-family:'constantia'><b>Pilih tempat duduk</b></h4>
    <form action='filem_bayar.php?".http_build_query($data_get)."' method='POST'>
      <table border='1' class='w3-amber' >
        <tr>
            <td colspan='5' align='center'><b>SCREEN</b></td>
        </tr>
        <tr>
            <td>Keluar</td>
            <td colspan='3'></td>
            <td>Keluar</td>
        </tr>";

    $idtayangan=$_GET['id_tayangan'];

    # fungsi untuk menyemak adakah seat telah di tempah oleh orang lain
    function semak($idtayangan,$namaseat)
    {
      include ('connection.php');
      $sql_semak="select* from pembelian where id_tayangan='$idtayangan' and no_seat='$namaseat'";
      $laksana_semak=mysqli_query($condb,$sql_semak);
      $nama_seat=array();
      while ($rows=mysqli_fetch_array($laksana_semak))
      {
        array_push($nama_seat,$rows['no_seat']);
      }
      return $nama_seat;
    }

    # nama lajur seat
    $lajur = array('A','B','C','D','E','F','G','H','I','J');

    # memaparkan check box untuk memilih seat
    for($i=0;$i<10;$i++)
        {

            for($j=1;$j<=23;$j++)
            {
                $namaseat=$lajur[$i].$j;
                if($j==1)
                {
                    echo "<tr><td>";
                }
                else if($j==5)
                {
                    echo "</td><td></td><td>";
                }
                else if($j==20)
                {
                    echo "</td><td></td><td>";
                }
                else if($j==24)
                {
                    echo "</td></tr>";
                }
                $check= semak($idtayangan,$namaseat);
                if(in_array($namaseat, $check))
                {
                echo" <input name='seat[]' disabled checked value='".$namaseat."'type='checkbox'>";

                }
                else
                {
                  echo" <input name='seat[]' value='".$namaseat."' type='checkbox'>";

                }
            }
        }

echo"
    <tr>
        <td>Masuk</td>
        <td colspan='3'></td>
        <td>Masuk</td>
    </tr>
    </table>
  <br>
      <input class='w3-button w3-round-xxlarge w3-red' type='submit' value='BAYAR'>
    </form>
    </td>
  </tr>
</table>";

# memanggil fail footer
include ('footer.php'); ?>

<!-- Memanggil fail header_admin.php-->
<?PHP include('header_admin.php'); ?>

<!-- form untuk upload fail data-->
<h4 class='w3-text-white' style=font-family:'constantia'><b>Muat Naik Data Tayangan Secara Pukal</b></h4>
<div class='w3-text-white'><b>Sila Pilih Fail txt yang ingin diupload</b>
<form  action='' method='POST' enctype='multipart/form-data'>
<input class="w3-input w3-round-xxlarge" type='file' name='data_admin'>
<button class="w3-button w3-round-xxlarge w3-blue w3-margin-top" type='submit' name='btn-upload'>Muat Naik</button>
</form>

<?PHP
if (isset($_POST['btn-upload']))
{
    # Memanggil fail connection.php dari folder luaran
    include ('../connection.php');
    # mengambil nama sementara fail
    $namafailsementara=$_FILES["data_admin"]["tmp_name"];
    # mengambil nama fail
    $namafail=$_FILES['data_admin']['name'];
    # mengambil jenis fail
    $jenisfail=pathinfo($namafail,PATHINFO_EXTENSION);
    # menguji jenis fail dan saiz fail
    if($_FILES["data_admin"]["size"]>0 AND $jenisfail=="txt")
    {
        # membuka fail yang diambil
        $fail_data=fopen($namafailsementara,"r");

        # mendapatkan data dari fail baris demi baris
        while (!feof($fail_data))
        {
            # mengambil data sebaris sahaja bg setiap pusingan
            $ambilbarisdata = fgets($fail_data);

            #memecahkan baris data mengikut tanda pipe
            $pecahkanbaris = explode("|",$ambilbarisdata);

            # selepas pecahan tadi akan diumpukan kepada 4
            list($id_pawagam,$id_filem,$id_masa,$tarikh) = $pecahkanbaris;

            # arahan SQl untuk menyimpan data
            $arahan_sql_simpan="insert into tayangan
            (id_pawagam,id_filem,id_masa,tarikh) values
            ('$id_pawagam','$id_filem','$id_masa','$tarikh')";

            # memasukkan data kedalam jadual admin
            $laksana_arahan_simpan=mysqli_query($condb, $arahan_sql_simpan);
            echo"<script>alert('Import Fail Data Selesai.');
            window.location.href='maklumat_tayangan.php';</script>";
        }
    fclose($fail_data);
    }
    else  {
        echo"<script>alert('Hanya fail berformat txt sahaja dibenarkan');</script>";
    }
}
?>

<?PHP include ('footer_admin.php'); ?>

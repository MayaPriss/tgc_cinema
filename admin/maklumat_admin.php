<?PHP
# Memanggil fail header_admin.php
include ('header_admin.php');
# Memanggil fail connection dari folder luaran
include ('../connection.php');

#----------- Bahagian 2 : Proses penyimpan data-------
# Menyemak kewujudan data GET
if(!empty($_GET))
{   # mengambil data GET
    $id_admin=$_GET['id_admin'];
    $nama_admin=$_GET['nama_admin'];
    $kata_laluan=$_GET['kata_laluan'];

    # data validation - adakah data GET yang diambil empty
    if(empty($id_admin) or empty($nama_admin) or empty($kata_laluan))
    {
        die("<script>alert('Lengkapkan maklumat yang dikehendaki.');
        window.history.back();</script>");
    }

    # data validation - format nokp betul atau tidak
    if(strlen($id_admin)!=12 or !is_numeric($id_admin))
    {
        die("<script>alert('Ralat pada id_admin');
        window.history.back();</script>");
    }

    # Arahan untuk menyimpan data ke dalam jadual admin
    $arahan_sql_simpan="insert into admin
    (id_admin,nama_admin,kata_laluan)
    values
    ('$id_admin','$nama_admin','$kata_laluan')";

    # melaksanakan proses menyimpan dalam syarat IF
    if(mysqli_query($condb,$arahan_sql_simpan))
    {
        # proses menyimpan data berjaya. papar mesej
        echo "<script>alert('Pendaftaran Berjaya');
        window.location.href='maklumat_admin.php';
        </script>";
    }
    else
    {
        # proses menyimpan data gagal. papar mesej
        echo "<script>alert('Pendaftaran gagal');
        window.history.back();</script>";
    }
}
# ----------- bahagian 1 : memaparkan data dalam bentuk jadual
    # arahan SQL mencari admin
    $arahan_sql_cari="select* from admin";

    # melaksanakan arahan sql cari tersebut
    $laksana_sql_cari=mysqli_query($condb,$arahan_sql_cari);
?>
<!-- menyediakan header bagi jadual -->
<!-- selepas header akan diselitkan dengan borang untuk mendaftar admin baru -->
<h4 class='w3-text-white'><b>SENARAI ADMIN</b></h4>
<table id='saiz' border='1' class="w3-table-all" >
<tr>
        <td><b>BIL</b></td>
        <td><b>ID ADMIN</b></td>
        <td><b>NAMA ADMIN</b></td>
        <td><b>KATA LALUAN</b></td>
        <td></td>
    </tr>
    <tr>
    <!-- menyediakan borang untuk mendaftar admin baru -->
    <form action='' method='GET'>
        <td>#</td>
        <td><input class="w3-round-xxlarge w3-input" type='text' name='id_admin'></td>
        <td><input class="w3-round-xxlarge w3-input" type='text' name='nama_admin'></td>
        <td><input class="w3-round-xxlarge w3-input" type='password' name='kata_laluan'></td>
        <td><input class="w3-round-xxlarge w3-button w3-hover-purple" type='submit' value='simpan'></td>
    </form>
    </tr>
    <?PHP
    $bil=0;
    # pemboleh ubah $rekod mengambail semua data yang ditemui oleh $laksana_sql_cari
    while ($rekod=mysqli_fetch_array($laksana_sql_cari))
    {
        # sistem akan memaparkan data $rekod baris demi baris sehingga habis
        echo "
        <tr>
            <td>".++$bil."</td>
            <td>".$rekod['id_admin']."</td>
            <td>".$rekod['nama_admin']."</td>
            <td>".$rekod['kata_laluan']."</td>
            <td>

| <a class='w3-round-xxlarge w3-button w3-hover-teal' href='hapus.php?jadual=admin&medan_kp=id_admin&kp=".$rekod['id_admin']."'
onClick=\"return confirm('Anda pasti ingin padam data ini?')\" >Hapus </a>|


<a class='w3-round-xxlarge w3-button w3-hover-aqua' href='kemaskini_admin.php?id_admin=".$rekod['id_admin']."&nama_admin=".$rekod['nama_admin']."&kata_laluan=".$rekod['kata_laluan']."'
onClick=\"return confirm('Anda pasti ingin mengubahsuai data ini?')\" >Kemaskini</a> |

            </td>
        </tr>";
    }
    ?>
</table>
<?PHP include ('footer_admin.php'); ?>

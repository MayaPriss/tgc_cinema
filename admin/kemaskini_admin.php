<!-- Memanggil fail header_admin.php -->
<?PHP include ('header_admin.php'); ?>
<!-- menyediakan borang untuk mengemaskini data admin-->

<h4 class='w3-text-white'><b>KEMASKINI DATA ADMIN</b></h4>
<form action='' method='POST'>
<div class='w3-text-white'>ID ADMIN <input  type='text' name='id_admin_baru' value='<?PHP echo $_GET['id_admin']; ?>'><br>
<div class='w3-text-white'>NAMA ADMIN <input type='text' name='nama_admin_baru' value='<?PHP echo $_GET['nama_admin']; ?>'><br>
<div class='w3-text-white'>KATA LALUAN <input type='password' name='kata_laluan_baru' value='<?PHP echo $_GET['kata_laluan']; ?>'><br>
<input class='w3-blue' type='submit' value='KEMASKINI'>
</form>

<?PHP
# menyemak kewujudan data POST
if(!empty($_POST))
{
    # Memanggil fail connection dari folder luaran
    include ('../connection.php');

    # mengambil data POST
    $id_admin_baru=$_POST['id_admin_baru'];
    $nama_admin_baru=$_POST['nama_admin_baru'];
    $kata_laluan_baru=$_POST['kata_laluan_baru'];
    $id_admin_lama=$_GET['id_admin'];

    # Arahan untuk mengemaskini data ke dalam jadual admin
    $arahan_sql_update="update admin set
    id_admin='$id_admin_baru',
    nama_admin='$nama_admin_baru',
    kata_laluan='$kata_laluan_baru'
    where
    id_admin='$id_admin_lama'";

    # melaksanakan proses mengemaskini dalam syarat IF
    if(mysqli_query($condb,$arahan_sql_update))
    {
        # peroses mengemaskini berjaya.
        echo "<script>alert('Kemaskini Berjaya');
        window.location.href='maklumat_admin.php';
        </script>";
    }
    else
    {
        # proses mengemaskini gagal
        echo "<script>alert('Kemaskini gagal');
        window.history.back();</script>";
    }
}

?>

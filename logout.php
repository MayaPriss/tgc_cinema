<?PHP
# memulakan fungsi session
session_start();

# menghapuskan nilai pembolehubah session
session_unset();

# menghentikan fungsi session
session_destroy();

if(!empty($_GET))
{
    if($_GET['no_kad_pengenalan']="pengguna");
    header("location:index.php");
}
else
{
    header("location:index.php");
}
?>

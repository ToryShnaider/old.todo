<?

session_start();
require 'server.php';


if( !isset($_GET['update_task']) ){

    exit();
}

$res = mysqli_query($db,"select * from tasks where id=" . $_GET['update_task']);
header('location: index.php');
$row = mysqli_fetch_assoc($res);

if( $row['user_id'] != $_SESSION['logged_user_id'] ){
    echo 'no such file';
    exit();
}
?>
<form action="saveupdate.php" method="get">
    <input name="tname" type="text" value="<?=$row['task']?>">
    <input name="id" type="hidden" value="<?=$row['id']?>">

    <button type="submit">Save</button>
</form>


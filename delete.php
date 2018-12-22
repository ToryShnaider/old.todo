<?
require 'server.php';
if (isset($_SESSION['username'])) {
    if(isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
        header('location: index.php');

    }
} else{
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}


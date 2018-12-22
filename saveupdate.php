<?
session_start();
require 'server.php';

$sql = "update tasks 
          set 
              task='" . $_POST['task'] . "' 
          where id=" . $_POST['id'] . " 
          AND user_id=" . $_SESSION['id'];



if (isset($_SESSION['username'])) {
    $result = mysqli_query($db,
        $sql
		);

}

print_r($db->error);

exit();

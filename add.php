<?php
require 'server.php';
session_start();
header('location:index.php');


if (isset($_SESSION['username'])) {

    //echo $_GET['task_input'];

     if (isset($_POST['submit'])){

         $result = [];
         $result['status'] = 1;
         $result['task'] = $_POST['task'];
         $sid = $_SESSION['id'];
         if(empty($_POST['task'])){
            $errorst = "Пожалуйста, внесите новую заметку.";
         }else{
           mysqli_query($db, "INSERT INTO tasks(task, date, user_id) VALUES ('".$_POST['task']."', now(), '".$sid."')");
         }

         if( !mysqli_insert_id($db) ){
             $result['status'] = 0;
             $result['error'] = 'No data inserted';

         }
         echo json_encode($result);
     }

    //echo 1111;
}
<?php
session_start();
//include('server.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="js/custom.js"></script>
<?php
$errors = "";
$db = mysqli_connect('localhost', 'root', '', 'todo');

 $result = mysqli_query($db,"select * from tasks WHERE user_id ='".$_SESSION['id']."'");

//    del_task
//    if(isset($_GET['del_task'])){
//        $id = $_GET['del_task'];
//        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
//        header('location:index.php');
//    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>
        Home ToDo List
    </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="heading">
        <?php if (isset($_SESSION['success'])) : ?>
<!--            <div class="error success" >-->
<!--                <h3>-->
<!--                    --><?php
//                    echo $_SESSION['success'];
//                    unset($_SESSION['success']);
//                    ?>
<!--                </h3>-->
<!--            </div>-->
        <?php endif ?>

        <!-- logged in user information -->
        <?php  if (isset($_SESSION['username'])) : ?>
            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p> <a href="index.php?logout='1'" class="logout">logout</a> </p>
        <?php endif ?>
    </div>
    <div class="heading">
        <h2>Task Management</h2>
    </div>
    <form method="post" action="add.php" id="taskForm">
        <?php
        if(isset($errorst)):?>
            <p><?php echo $errorst;?></p>
        <?php endif;?>

        <input type="text" name="task" id="task_input">
        <button type="submit" class="add_btn" name="submit">Add task</button>
    </form>

    <table id="taskTable">
        <thead>
            <tr>
                <th>№</th>
                <th>Task</th>
                <th>Data</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1;
        while ($row = $result->fetch_row())
        {//            while($row = mysqli_fetch_array($tasks)){
//            while($row = mysqli_fetch_array($tasks)){
//        foreach ($tasks as $row)
        ?>
            <tr data-id="<?=$row['id']?>">
                <td><?php echo $i;?></td>
                <td class="taskTd"><?php echo $row[1];?></td>
                <td class="date"><?php echo $row[2];?></td>
                <td><a id="delete" href="delete.php?del_task=<?php echo $row[0];?>">X</a></td>
            </tr>
            <?php $i++;}?>
        </tbody>
    </table>
</body>
</html>

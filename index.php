<?php
include "db.php";

$query = "SELECT * FROM todo";
$result = mysqli_query($conn,$query);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $todo = $_POST['todo'];
    $date = $_POST['c_date'];
    if(empty($todo)){
        $error = "Field is Required";
    }
    else{
    $sql = "INSERT INTO todo(task,creation_date) VALUES('$todo','$date');";
    $results = mysqli_query($conn,$sql);

    if(!$results){
        die("Failed");
    }else{
        header("location:index.php?todo-added");
    }
}
}
if(isset($_GET['delete_todo'])){
    $dlt_todo = $_GET['delete_todo'];
    $sqli = "DELETE FROM todo WHERE id = $dlt_todo";
    $res = mysqli_query($conn,$sqli);

    if(!$res){
        die("Failed");
    }
    else{
        header("location:index.php?todo-deleted");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo Application</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="style.css"  type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container header">
        <div class="todo">
        <h2>Todo Application</h2>
        <h3>Make a new task your routine in todo Application</h3>
        <?php
        if(isset($error)){
            echo "<div class='alert alert-danger'>$error</div>";
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method ="POST">
        <div class="form-group">
        <input type="text" name="todo" placeholder="enter the task" class="form-control">
        </div>
        <div class="form-group">
        <input type="date" name="c_date" class="datepicker" >
        </div>
        <div class="form-group">
        <input type="submit" value="add new task" class="btn btn-primary mt-4" >
        </div>
        </form>
        </div>
        <div class="col-lg-4 search " style="margin:5px">
        <form action="search.php" method="POST">
        <input type="text" class="form-control" name="search" placeholder="search task">
        </form>
        </div>
        <div class="table-responsive col-lg-12">
        <table class="table table-bordered table-striped table-hover">
        <thead>
        <th>ID</th>
        <th>Task</th>
        <th>Date added</th>
        <th>Edit task</th>
        <th>Delete task</th>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)){
            $id =  $row['id'];
            $todo =  $row['task'];
            $date =  $row['creation_date'];
            ?>
            <tr>
            <td><?php echo $id?></td>
            <td><?php echo $todo?></td>
            <td><?php echo $date?></td>
            <td><a href="edit.php?edit-todo=<?php echo $id;?>" class="btn btn-primary">Edit Task</a></td>
            <td><a href="index.php?delete_todo=<?php echo $id;?>" class="btn btn-danger">Delete Task</a></td>
            </tr>
       <?php }
        ?>
        </tbody>
        </table>
        </div>
    </div>
</body>
</html>
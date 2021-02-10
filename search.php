<?php
include "db.php";

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $query = "SELECT * FROM todo WHERE task LIKE '%$search%'";
    $result = mysqli_query($conn,$query);
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
    <div class="container">
    <a href="index.php" class="btn btn-sm btn-dark mt-3 ml-4">Go to Home</a>
        <div class="todo">
        <h2><a href="index.php">Todo Application</a></h2>
        <h3>Make a new task your routine in todo Application</h3>
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
        if(mysqli_num_rows($result)=== 0){
            echo "<tr>";
            echo "<td></td>";
            echo "<td><h1 style='text-centered'>No Result Found</h1></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>"; 
            echo "<tr>";
        }
        else{
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
       <?php }}
        ?>
        </tbody>
        </table>
        </div>
    </div>
</body>
</html>
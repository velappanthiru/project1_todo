<?php
include "db.php";

if(isset($_GET['edit-todo'])) {
    $e_id = $_GET['edit-todo'];

}

if(isset($_POST['edit_todo'])){
    $edit_todo=$_POST['todo'];

    $query = "UPDATE todo SET task = '$edit_todo' WHERE id = $e_id";
    $run = mysqli_query($conn,$query);
    
    if(!$run){
        die('Failed');
    }else{
        header("location: index.php?updated");
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

<?php 

$sql = "SELECT * FROM todo WHERE id = $e_id";
$result = mysqli_query($conn,$sql);
$date = mysqli_fetch_assoc($result);
?>
    <div class="container">
        <a href="index.php" class="btn btn-sm btn-dark mt-3 ml-4">Go to Home</a>
        <div class="todo">
        <h2>Todo Application</h2>
        <h3>Make a new task your routine in todo Application</h3>
        <form action="" method ="POST">
        <div class="form-group">
        <input type="text" name="todo" placeholder="enter the task" class="form-control" value="<?php echo$date['task'];?>">
        </div>
        <div class="form-group">
        <input type="date" name="c_date" class="datepicker">
        </div>
        <div class="form-group">
        <input type="submit" value="add new task" class="btn btn-primary mt-4" name="edit_todo">
        </div>
        </form>
        </div>
        
    </div>
</body>
</html>
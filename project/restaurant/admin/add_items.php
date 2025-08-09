 <?php
session_start();
include "../db.php";
if(isset($_SESSION['user_id'])){
    if($_SESSION['user_type']=="admin"){
       if(isset($_POST['submit'])){
        $image=$_FILES['image']['name'];
        $temp_location=$_FILES['image']['tmp_name'];
        $tar_location="../image/";
        $name=$_POST['name'];
        $price=$_POST['price'];
        $category=$_POST['category'];

        $sql="insert into menu_items(image, name, price, category)values('$image', '$name', '$price', '$category')";
        $result=mysqli_query($conn, $sql);
        if(!$result){
            echo "error!: {$conn->error}";
        } else{
            move_uploaded_file($temp_location, $tar_location.$image);
            echo "<h1 style='margin-left: 350px; margin-top: 18px;'>item added successfully!</h1>";
        }
       }
    } if($_SESSION['user_type']=="user"){
        echo "go for user dashbaord";
    }
} else{
    header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>admin_dashboard</title>
        <style type="text/css">
            *{
                padding: 0;
                margin: 0;
            }
            .header{
                padding: 30px;
                background-color: black;
                color: white;
                text-align: right;
            }
            .header a{
                text-decoration: none;
                color: white;
                padding: 30px;
                background-color: red;
            }
            .sidebar{
                background-color: black;
                color: white;
                position: fixed;
                top: 0;
                height: 100%;
                width: 20%;
                border: 1px solid blue;
                text-align: center;
            }
            .sidebar a{
                text-decoration: none;
                display: block;
                padding: 30px 10px; 
                margin: 0;
                color: white;
            }
            .sidebar a:hover{
                background-color: blue;
            }
            .main{
                margin-left: 300px;
                margin-top: 20px;
            }
            .main form{
                background-color: lightcyan;
                padding: 30px;
                margin-right: 20px;
                text-align: center;
            }
            .main input{
                padding: 20px;
                border: 2px solid blue;
                display: block;
                margin-left: 450px;
                margin-top: 10px;
            }
            .submitbtn{
                background-color: blue;
                color: white;
            }
        </style>
    </head>
<body>
    <div class="div">
        <div class="header">
            <a href="../logout.php">log out</a>
        </div>
        <div class="main">
            <form action="add_items.php" method="post" enctype="multipart/form-data">
                upload item image: <input type="file" name="image">
                enter item name: <input type="name" name="name">
                enter item price: <input type="number" step="any" name="price">
                enter item category: <input type="text" name="category">
                <input class="submitbtn" type="submit" name="submit" value="add item">
        </form>
        </div>
        <div class="sidebar">
            <a href="admin_dashboard.php">admin dashboard</a>
            <a href="add_items.php">add menu items</a>
            <a href="view_items.php">view menu items</a>
        </div>
</body>
</html>
<?php
include "db.php";
session_start();
$sql="select * from menu_items";
$result=mysqli_query($conn, $sql);
if(!$result){
    echo "error: {$conn->error}";
} else{

}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Restaurant Menu</title>
        <style type="text/css">
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, sans-serif;
            }
            body{
                background-color: #f5f5f5;
            }
            .navbar{
                display: flex;
                padding: 10px 20px;
                background-color: #333;
                justify-content: space-between;
                align-items: center;
            }
            .navbar a{
                text-decoration: none;
                padding: 10px 15px;
                color: white;
                font-weight: bold;
            }
            .navbar a:hover{
                color: gold;
            }
            .navbar ul li{
                list-style: none;
            }
            .navbar ul{
                display: flex;
                gap: 10px;
            }
            .header{
                background-color: lightcoral;
                padding: 40px;
                text-align: center;
            }
            .header h1{
                margin-bottom: 10px;
                color: #333;
            }
            .product_card{
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                padding: 20px;
                gap: 20px;
            }
            .card:hover{
                transform: translateY(-5px);
            }
            .card img{
                width: 100%;
                height: 200px;
                object-fit: cover;
                border-radius: 5px;
                margin-bottom: 15px;
            }
            .card{
                background-color: white;
                margin: 5px;
                text-align: center;
                padding: 20px;
                width: 300px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                transition: transform 0.3s ease;
            }
            .card h3{
                margin: 10px 0;
                color: #333;
            }
            .card p{
                color: #666;
                margin-bottom: 15px;
                font-size: 14px;
            }
            .card a{
                display: inline-block;
                text-decoration: none;
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                margin-top: 15px;
                border-radius: 5px;
                font-weight: bold;
                transition: background-color 0.3s;
            }
            .card a:hover{
                background-color: #45a049;
            }
            </style>
            </head>
            <body>
                <nav class="navbar">
                <a href="index.php">home</a>
                    <ul>
                    <?php if(!isset($_SESSION['user_id'])){ ?>
                        <li><a href="login.php">login</a></li>
                        <li><a href="register.php">registration</a></li>
                        <?php } ?>
                        <?php if(isset($_SESSION['user_id'])){ ?>
                        <li><a href="user_dashboard.php">dashboard</a></li>
                        <?php } ?>
        </ul>
        </nav>
                <header class="header">
                    <h1>Order Your Favorite Items</h1>
                    <hr>
                    <?php if(isset($_GET['added_message'])){
                        $message=$_GET['added_message'];
                        ?>
                        <h2 style="color: green;"><?php echo $message; ?></h2>
                    <?php } ?>
</header>
<section class="product_card">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
    
    <div class="card">
        
        <img src="image/<?php echo $row['image']; ?>" alt="menu item">
        <h3><?php echo $row['name']; ?></h3>
        <p><?php echo $row['price']; ?></p>
        <?php if(isset($_SESSION['user_id'])){ ?>
            <a href="order_item.php?user_id=<?php echo $_SESSION['user_id']; ?>&menu_id=<?php echo $row['id']; ?>">order now</a>
 
    <?php } ?>
    <?php if(!isset($_SESSION['user_id'])){ ?>
    <a href="login.php">order now</a>
    <?php } ?>
    </div>
    <?php } ?>
        </section>
</body>
</html>
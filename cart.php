<?php
    session_start();
    require_once("db.php");
    $db_handle = new DBController();
    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
	    case "remove":
            $db_handle->que("UPDATE movies set quantity=0 WHERE code='" . $_GET["code"] . "'" );
	    break;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>BigNight</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="cart.css">
    </head>
    <body>
        <header>
            <a href="home.php" class="logo">Big Night</a>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="movies.php">Movies</a></li>
                <li><a href="cart.php" class="active">Shopping cart</a></li>
            </ul>
        </header>

        <div class="sec">

            <h2>Your cart</h2>

        </div>

        <div class="container">
            <?php		
            $product_array = $db_handle->runQuery("SELECT * FROM movies ORDER BY ID ASC");
            if (!empty($product_array)) { 
                foreach($product_array as $key=>$value)
                    if($product_array[$key]["quantity"]!=0)
                    {
		            ?>
				        <div class="col"><p><?php echo $product_array[$key]["name"]; ?></p> 
                            <a href="cart.php?action=remove&code=<?php echo$product_array[$key]["code"]; ?>" class="remove">remove</a>
                            <p style="font-weight: lighter; font-size: 19px;"><?php echo "$ ".$product_array[$key]["price"]; ?></p>
                        </div>
                    <?php
		             }
            }
		    ?>

            <a href="home.html" class="buyItem">Proceed to checkout</a>

        </div>

    </body>
    
</html>

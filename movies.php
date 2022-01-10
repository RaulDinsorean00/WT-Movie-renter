<?php
    session_start();
    require_once("db.php");
    $db_handle = new DBController();
    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
	        case "add":
            $db_handle->que("UPDATE movies set quantity=1 WHERE code='" . $_GET["code"] . "'" );		
	    break;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>BigNight</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="productt.css">
    </head>
    <body>
        <header>
            <a href="home.php" class="logo">Big Night</a>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="movies.php" class="active">Movies</a></li>
                <li><a href="cart.php">Shopping cart</a></li>
            </ul>
        </header>
        

        <div class="sec">
            <!-- Here is Movie List Title -->
            <br><h2>Movie list</h2>

            <?php
            $product_array = $db_handle->runQuery("SELECT * FROM movies ORDER BY ID ASC");
            if (!empty($product_array)) { 
	            foreach($product_array as $key=>$value){
                ?>
	                <div class="container">
                        <div class="card">
                            <div class="imgBx">
                                <img src="<?php echo $product_array[$key]["picture"]; ?>">
                            </div>
                            <div class="contentBx">
                                <h3 style="text-align: center;"> <?php echo $product_array[$key]["name"]; ?></h3>
                                <h2><a href="<?php echo $product_array[$key]["IMDBLink"]; ?> "style="color: #fff; "> IMDb: <?php echo $product_array[$key]["rating"]; ?>⭐</small></a></h2>
                                <h4><?php echo $product_array[$key]["genre"]; ?></h4>
                                <a href="movies.php?action=add&code=<?php echo$product_array[$key]["code"];?>" class="buy" style="padding: 5px 15px; color: #fff; text-decoration: none; background: #9e3636; border-radius: 30px; text-transform: uppercase;">Add to cart</a>
                            </div>
                        </div>
                    </div>
                <?php
	            }
            }
            ?>

        </div>
        
       
    </body>
    
</html>

<?php 



//cookies
// setcookie("emailCookie", $email, time()+ 864000);
// setcookie("streetCookie", $street, time()+ 864000);
// setcookie("streetNumberCookie", $streetNumber, time()+ 864000);
// setcookie("cityCookie", $city, time()+ 864000);
// setcookie("zipcodeCookie", $zipcode, time()+ 864000);

//form variables 
$email = $zipcode = $street = $streetNum = $city = "";

//variables
$totalValue=0;
$email = $_POST["email"];
$street =$_POST['street'];
$streetNumber=$_POST['streetnumber'];
$city=$_POST['city'];
$zipcode=$_POST['zipcode'];

$Adress= $street .", ". $streetNumber ." in ". $city .", ". $zipcode;

//sessioncookies
$_SESSION['street'] = $street;
$_SESSION['streetNumber'] = $streetNumber;
$_SESSION['city'] = $city;
$_SESSION['zipcode'] = $zipcode;
$_SESSION['email'] = $email;

//form error messages
$emptyZipcode = "zipcode is invalid or empty.";
$emptyEmail = "Please enter a valid email address.";
$emptyCity = "Please enter a city.";
$emptyStreetNumber = "Please enter a streetnumber.";
$errorEmail = "Please enter a valid e-mail adress.";

//filters form validation
if (isset($_POST['submit'])) {

    if (!filter_var($zipcode, FILTER_VALIDATE_INT) === true || empty($zipcode)) {
       $emptyZipcode = "zipcode is invalid or empty.";
    }
    if(empty($email)) {
        $emptyEmail = "Please enter a valid email address.";
    }
    if(empty($city)) {
       $emptyCity = "Please enter a city.";
    }
    if(empty($streetNumber)) {
       $emptyStreetNumber = "Please enter a streetnumber.";
    } 
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $errorEmail = "Please enter a valid e-mail adress.";
   }

    //zipcode number or empty
     $productChosen = array_keys($_POST["products"]);
        foreach ($productChosen as $item){
            $productChosenName = $products[$item]["name"];
            $productChosenPrice = $products[$item]["price"];
    }
}
   
     foreach ($_POST['products'] as $i => $product) {
        $totalValue += ($products[$i]['price']);
        }   


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Your fancy store</title>
    <style> 
        .alert-danger{
            text-align:center;
            margin: auto; 
            display:
            <?php
            $displayAlertDanger = "none;";
             if (empty($street)) {
                 echo $displayAlertDanger;
             };
            if (isset($_POST['submit'])){
                    if (empty($street)) {
                        echo "akdsqw";
                        $displayAlertDanger = "inline;";
                    } 
                }
            ?>
        ;}
        .alert-success{ 
            text-align:center;
            margin: auto; 
            display:
                <?php if(isset($_POST['submit'])){

                    echo "table;";
                }else{
                    echo "none;";}?>
        }
        .footerPrice{
            display:
            <?php if(isset($_POST['submit'])){
                    echo "none;";
                }else{
                    echo "inline;";}?>
                }
        }
    </style>
</head>
<body>
   <?php require 'variables.php';?>

<div class="container">

    <h1>Place your order</h1>
    <?php // Navigation for when you need it ?>
    <?php /*
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    */ ?>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" class="form-control" value="<?php echo $_SESSION['email']?>">
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value="<?php echo $_SESSION['street']?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?php echo $_SESSION['streetNumber']?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input  type="text" id="city" name="city" class="form-control" value="<?php echo $_SESSION['city']?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php echo $_SESSION['zipcode']?>">
                </div>
                <?php 

                if (isset($_POST['submit'])) {
                     if (empty($zipcode) || empty($city) || empty($street) || empty($streetNumber) || $productChosen === NULL) {
                        echo "<div class='alert alert-danger text-center' style='display: inline;'> The Gnomes are confused and do not know what to do. </div>";
                    } else { 
                        echo "<div class='alert alert-success text-center' style='display: inline;'> You ordered $productChosenName for $totalValue hard earned euros. The gnomes will deliver it at $Adress </div>";
                     }
                }
                ?>
                
                </div>
            </div>  
        </fieldset>

        <fieldset>
            <legend>Products</legend> 
            <?php foreach ($products as $i => $product): ?>
                <label>
                    <input type="checkbox" value="0" name="products[<?php echo $i ?>]"/> 
                    <?php echo $product['name'] ?> 
                    - 
                    &euro; <?= number_format($product['price'], 0) ?></label><br />
            <?php endforeach; ?>
        </fieldset>

        <!-- text alert -->
        <button type="submit" name="submit" class="btn btn-primary">Order!</button>

    </form>

    <footer> <p class="footerPrice">You already ordered </p><strong>&euro; <?php echo $totalValue ?></strong><p class="footerPrice">  
      worth of skull-smashing-goodies</p></footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>


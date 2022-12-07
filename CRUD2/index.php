<!-- JQUERY STEP -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>-->
<?php
require'dbConnection.php';



function clean($data)
{
$data=trim($data);
$data=htmlspecialchars($data);
$data=stripslashes($data);

return $data;

}


if ($_SERVER["REQUEST_METHOD"] == "POST")
{

$name=clean($_POST['name']);
$email=clean($_POST['email']);
$phone=clean($_POST['phone']);
$address=clean($_POST['address']);
$country=clean($_POST['country']);
$zip= clean($_POST['zip']);
$password=clean($_POST['password']);

$errors=[];

if(empty($name))
{
    $errors['name']="Pleas Enter Your Name For Process";
}
if(empty($email))
{
    $errors['email']="Pleas Enter Your Email For Process";
}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $errors['email']="your email not valid";
}

if(empty($password))
{
    $errors['password']="Enter your password";
}
elseif(strlen($password)<6)
{
$errors['password']="your password is weak";
}

 if (empty($phone))
{
    $errors['phone']="Please Enter Your phone";
}
elseif(strlen($phone)<11||strlen($phone)>11)
{
  $errors['phone']="phone must be 11 number";
}

if (empty($country))
{
    $errors['country']="Please Enter Your country";
}
if (empty($zip))
{
    $errors['zip']="Please Enter Your zip code";
}

elseif(strlen($zip)>5||strlen($zip)<5)
{
  $errors['zip']="Post code must be equal 5";
}



if(count($errors)>0)
{
   foreach($errors as $key=>$value)
{

echo "$key: $value ".'<br>';



}

}
else{

$password=md5($password);
$sql="insert into user (name,email,password,phone,address,country,zip)values('$name','$email','$password','$phone','$address','$country','$zip')";
$op= mysqli_query($con,$sql);
if($op)
{

    echo "Your data Entered Thank you ";

}else
{

    echo "Error".mysqli_error($con);

}
mysqli_close($con);







}















}
























?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
<div class="wrapper">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post">
        <div id="wizard">
            <!-- SECTION 1 -->
            <h1 align="center" >"ENTRY DATA"</h>
            <section>
                <div class="form-row"> <input type="text" class="form-control" placeholder="Name" name="name"> </div>
                <div class="form-row"> <input type="text" class="form-control" placeholder="Email" name="email"> </div>
                <div class="form-row"> <input type="password" class="form-control" placeholder="Your password"name="password"> </div>
                <div class="form-row"> <input type="number" class="form-control" placeholder="Phone number"name="phone"> </div>
                
                <div class="form-row"> <input type="text" class="form-control" placeholder="Street address" name="address"> </div>
            </section> <!-- SECTION 2 -->
            <h4></h4>
            <section>
                <div class="form-row"> <input type="text" class="form-control" placeholder="country" name="country"> </div>
                <div class="form-row"> <input type="number" class="form-control" placeholder="zip code" name="zip"> </div>
                <div class="form-row" style="margin-bottom: 18px"> <textarea name="textarea" id="" class="form-control" placeholder="Any order note about delivery or special offer" style="height: 108px"></textarea> </div>
            </section> <!-- SECTION 3 -->
            <h4></h4>
           <!-- <section>
                <div class="product">
                    <div class="item">
                        <div class="left"> <a href="#" class="thumb"> <img src="https://i.imgur.com/yYu3Hbl.jpg" alt=""> </a>
                            <div class="purchase">
                                <h6> <a href="#">Macbook Air Laptop</a> </h6> <span>x1</span>
                            </div>
                        </div> <span class="price">$290</span>
                    </div>
                    <div class="item">
                        <div class="left"> <a href="#" class="thumb"> <img src="https://www.businessinsider.in/thumb/msid-70101317,width-600,resizemode-4,imgsize-87580/tech/ways-to-increase-mobile-phone-speed/13d0e0722dbca5aa91e16a8ae2a744e5.jpg" alt=""> </a>
                            <div class="purchase">
                                <h6> <a href="#">Mobile Phone Mi</a> </h6> <span>x1</span>
                            </div>
                        </div> <span class="price">$124</span>
                    </div>
                </div>
                <div class="checkout">
                    <div class="subtotal"> <span class="heading">Subtotal</span> <span class="total">$364</span> </div>
                </div>
            </section> <!-- SECTION 4 -->
            <h4> <button id="submit" type="submit" class="btn btn-primary">Submit</button>    </h4>
           
        </div>
    </form>
</div>
</body>
</html>
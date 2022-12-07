<?php
require'dbConnection.php';


## clean data....
function clean($data)
{

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

}
## check data..
if ($_SERVER["REQUEST_METHOD"] == "POST")

{


$name=clean($_POST['name']);
$email= clean($_POST['email']);
$password=clean($_POST['password']);


## array for errors..
$errors =[];
## check name..
if (empty($name))
{
    $errors['name']="name required";
}
## check email..
if (empty($email))
{
    $errors['email']="email required";

}
## check password
if(empty($password))
{
    $errors['password']="password required";

}elseif(strlen($password)<=6)
{
    $errors['password']="password must be more than 6" ;

}
/*
## check gender...
if (empty($gender))
{
    $errors['gender']="required";

}/* 
elseif($gender =='male'){
    $gender="Gender :  male";
}
elseif ($gender =='female') {
    $gender="Gender : female";
}*/
## count error..
if(count($errors)>0)
{
  foreach($errors as $key=>$value)
  {

    echo "$key : $value" ."<br>";


  }


}
## insert data to database project1 ...
else{
    $password=md5($password);

$sql= "insert into user (name,email,password)values('$name','$email','$password')";
$op=mysqli_query($con,$sql);

if($op)
{
echo " welcome to our project your data inserted".'<br>'."Here Your Account".'<br>'.'<a href="display.php">Account</a>'




;

}else
{
    echo "Error".mysqli_error($con);
}
mysqli_close($con);










}


























}
















?>
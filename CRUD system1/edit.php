<?php
require'dbConnection.php';
$id=$_GET['id'];
$sql="select *from user where id=$id";
$query=mysqli_query($con,$sql);
$data=mysqli_fetch_array($query);

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
   

$sql= "update user set name='$name' ,email='$email' where id =$id";
$query=mysqli_query($con,$sql);

if($query)
{
    $message = 'Raw Updated';

    $_SESSION['Message'] = $message;

header("location:display.php");

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
    <title>Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Update Account</h2>

        <form action="edit.php?id=<?php echo $data['id'];?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control"  id="exampleInputTitle" aria-describedby="" name="name"
                    placeholder="Enter name" value="<?php echo $data['name']?>">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email</label>
                <input type="email" class="form-control"  id="Content" aria-describedby="emailHelp"
                    name="email" placeholder="Enter email" value="<?php echo $data['email']?>">
            </div>

            
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>
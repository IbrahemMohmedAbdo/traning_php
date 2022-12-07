<?php
require'dbConnection.php';

$id=$_GET['id'];
$sql="delete from user where id=$id";
$op= mysqli_query($con,$sql);


if($op)
{

$message="Raw deleted";

}else
{

    $message="ERROR TRY AGIAN";
}
$_SESSION['Message']=$message;

header("location:display.php")











?>
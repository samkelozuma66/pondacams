<?php
include 'config.php';
//header('Content-type: application/json');
//
$row = $conn->getRow('chatusers',['email'=>$_POST['email']]);
if(count($row)>0){
    echo "Email Already Exist!!!";
}else{
    $conn->insData('chatusers',$_POST);
    $_SESSION['name']=$_POST['name'];
    $_SESSION['email']=$_POST['email'];
    $_SESSION['password']=$_POST['password']; 
}
//echo json_encode(); 
?>
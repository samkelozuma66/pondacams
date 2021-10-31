<?php 
include 'config.php';
$array_response =[];
$user = $conn->getRow('chatusers',['email'=>$_POST['email']]);
if(count($user)<=0){
    $array_response['mailErr'] = "ERROR!!";
}elseif(isset($user[0])){
    if($user[0]['password']==$_POST['password']){
        $_SESSION['id']=$user[0]['id'];
        $_SESSION['name']=$user[0]['name'];
        $_SESSION['email']=$user[0]['email'];
        $_SESSION['password']=$user[0]['password']; 
    }else{
        $array_response['passErr'] = "ERROR!!"; 
    }
}
echo json_encode($array_response);
?>
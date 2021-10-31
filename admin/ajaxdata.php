<?php
include 'config.php';
header('Content-type: application/json');
if(!empty($_FILES)){
    move_uploaded_file($_FILES['id_front']['tmp_name'], 'documents/' . $_FILES['id_front']['name'].time().rand(1,999));
    $images['id_front']=$_FILES['id_front']['name'];
    move_uploaded_file($_FILES['id_back']['tmp_name'], 'documents/' . $_FILES['id_back']['name'].time().rand(1,999));
    $images['id_back']=$_FILES['id_back']['name'];
    move_uploaded_file($_FILES['face_id']['tmp_name'], 'documents/' . $_FILES['face_id']['name'].time().rand(1,999));
    $images['face_id']=$_FILES['face_id']['name'];
    move_uploaded_file($_FILES['selfie']['tmp_name'], 'documents/' . $_FILES['selfie']['name'].time().rand(1,999));
    $images['selfie']=$_FILES['selfie']['name'];
    
    $conn->updateData('users',$images,['id'=>$_POST['id']]);
}
if(!empty($_POST)){
    $conn->updateData('users',$_POST,['id'=>$_POST['id']]);
}

$row = $conn->getRow('users',['id'=>$_POST['id']]);
echo json_encode($row);
//$conn ->updateData('users',$_POST,['id'=>$_POST['id']]);

?>
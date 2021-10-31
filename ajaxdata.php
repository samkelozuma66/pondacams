<?php
include 'config.php';
 
if(!empty($_FILES)){
   // print_r($_FILES);
   
    if(isset($_FILES['id_front']))
    {
        $id_front = time() .$_FILES['id_front']['name'];
        move_uploaded_file($_FILES['id_front']['tmp_name'], 'documents/' .$id_front);
        $images['id_front']= $id_front;
    }
    
    if(isset($_FILES['id_back']))
    {
        $id_back = time() .$_FILES['id_back']['name'];
        move_uploaded_file($_FILES['id_back']['tmp_name'], 'documents/' .$id_back);
        $images['id_back']= $id_back;
    }
    
    if(isset($_FILES['face_id']))
    {
        $face_id = time() .$_FILES['face_id']['name'];
        move_uploaded_file($_FILES['face_id']['tmp_name'], 'documents/' .$face_id);
        $images['face_id']= $face_id;
    }
    
    if(isset($_FILES['selfie']))
    {
        $selfie = time() .$_FILES['selfie']['name'];
        move_uploaded_file($_FILES['selfie']['tmp_name'], 'documents/' .$selfie);
        $images['selfie']= $selfie;
    }
    
    if(isset($_FILES['company_registration']))
    {
        $company_registration = time() .$_FILES['company_registration']['name'];
        move_uploaded_file($_FILES['company_registration']['tmp_name'], 'documents/' .$company_registration);
        $images['company_registration']=$company_registration;
    }
    
    if(isset($_FILES['proof_address']))
    {
        $proof_address =time() .$_FILES['proof_address']['name'];
        move_uploaded_file($_FILES['proof_address']['tmp_name'], 'documents/' .$proof_address);
        $images['proof_address']=$proof_address;
    }
    
    if(isset($_FILES['bank_confirm']))
    {
        $bank_confirm = time() .$_FILES['bank_confirm']['name'];
        move_uploaded_file($_FILES['bank_confirm']['tmp_name'], 'documents/' .$bank_confirm);
        $images['bank_confirm']=$bank_confirm;
    }
    
    $conn->updateData('users',$images,['id'=>$_POST['id']]);
}
elseif(!empty($_POST)){
   // print_r($_POST); owner_details
    $data = ['owner_details'=>$_POST['owner_details'],'d_name'=>$_POST['d_name'],'l_name'=>$_POST['l_name'],'gender'=>$_POST['gender'],'country'=>$_POST['country'],'dob'=>$_POST['dob'],'id_number'=>$_POST['id_number']];
    if($_POST['registration_type']!=""){
        $data['registration_type']=$_POST['registration_type'];
    }
    $conn->updateData('users',$data,['id'=>$_POST['id']]);
}
header('Content-type: application/json');
$row = $conn->getRow('users',['id'=>$_SESSION['id']]);
//print_r($row);
echo json_encode($row); 
//$conn ->updateData('users',$_POST,['id'=>$_POST['id']]);

?>
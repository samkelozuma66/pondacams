<?php
include 'config.php';
$data1 = [];
$data2 = [];

$dataPayment = [];
if(!empty($_POST)){
    if(isset($_SESSION['id'])){
        $data1['model_id'] = $_SESSION['id'];
        $dataPayment['user_id'] = $_SESSION['id'];
        $dataPref['model_id'] = $_SESSION['id'];
    } 
    if(isset($_POST['showType'])){
        $data1['showType']=$_POST['showType'];        
    }
    if(isset($_POST['price'])){
        $data1['price'] = $_POST['price'];
    }
    if(isset($_POST['willingness'])){
        $data1['willingness'] = $_POST['willingness'];
    }
    if(isset($_POST['language'])){
        $data1['language'] = $_POST['language'];
    }
    if(isset($_POST['age'])){
        $data1['age'] = $_POST['age'];
    }
    if(isset($_POST['ethnicity'])){
        $data1['ethnicity'] = $_POST['ethnicity'];
    }
    if(isset($_POST['appearance'])){
        $data1['appearance'] = $_POST['appearance'];
    }
    if(isset($_POST['bSize'])){
        $data1['bSize'] = $_POST['bSize']; 
    }
    if(isset($_POST['hair'])){
        $data1['hair'] = $_POST['hair'];
    }
    if(isset($_POST['region'])){
        $data1['region'] = $_POST['region'];
    }
    if(isset($_POST['eye'])){
        $data1['eyecolor'] = $_POST['eye'];
    }
    if(isset($_POST['place'])){
        $data1['broadcastplace'] =$_POST['place'];
    }
    //location
    if(isset($_POST['province']) && $_POST['province'] != ""){
        $data1['province'] =$_POST['province'];
    }
    if(isset($_POST['city']) && $_POST['city'] != ""){
        $data1['city'] =$_POST['city'];
    }
    if(isset($_POST['area']) && $_POST['area'] != ""){
        $data1['area'] =$_POST['area'];
    }
    
    if(isset($_POST['bio']) && $_POST['bio'] != ""){
        $data1['bio'] =$_POST['bio'];
    }
    //Payment Details
    if(isset($_POST['bank_name'])){
        $dataPayment['bank_name'] =$_POST['bank_name'];
    }
    if(isset($_POST['account_no'])){
        $dataPayment['account_no'] =$_POST['account_no'];
    }
    if(isset($_POST['branch_code'])){
        $dataPayment['branch_code'] =$_POST['branch_code'];
    }
    if(isset($_POST['account_type'])){
        $dataPayment['account_type'] =$_POST['account_type'];
    }
    
    if(isset($_POST['iban'])){
        $dataPayment['iban'] =$_POST['iban'];
    }
    if(isset($_POST['swift'])){
        $dataPayment['swift'] =$_POST['swift'];
    }
    if(isset($_POST['bank_address'])){
        $dataPayment['bank_address'] =$_POST['bank_address'];
    }
    
    //preferenca
    if(isset($_POST['private'])){
        $dataPref['private'] =$_POST['private'];
    }
    if(isset($_POST['camtocam'])){
        $dataPref['camtocam'] =$_POST['camtocam'];
    }
    if(isset($_POST['spy'])){
        $dataPref['spy'] =$_POST['spy'];
    }
    
    $prefRow =  $conn->getRow('preference',['model_id'=>$_SESSION['id']]);
    if(count($prefRow)>0){
        $conn->updateData('preference',$dataPref,['id'=>$prefRow[0]['id']]);
    }else{
        
        $last_id = $conn->insData('preference',$dataPref);
    }
    
    $pRow =  $conn->getRow('banking_details',['user_id'=>$_SESSION['id']]);
    if(count($pRow)>0){
        $conn->updateData('banking_details',$dataPayment,['id'=>$pRow[0]['id']]);
    }else{
        
        $last_id = $conn->insData('banking_details',$dataPayment);
    }
    
    $mRow =  $conn->getRow('modelinfo',['model_id'=>$_SESSION['id']]);
    if(count($mRow)>0){
        $conn->updateData('modelinfo',$data1,['id'=>$mRow[0]['id']]);
    }else{
        $last_id = $conn->insData('modelinfo',$data1);
    }
    echo $prefRow;
}

?>
<?php
include 'config.php';
$data1 = [];
$data2 = [];
if(!empty($_POST)){
    if(isset($_SESSION['id'])){
        $data1['model_id'] = $_SESSION['id'];
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
    print_r($data1);
    $mRow =  $conn->getRow('modelinfo',['model_id'=>$_SESSION['id']]);
    if(count($mRow)>0){
        $conn->updateData('modelinfo',$data1,['id'=>$mRow[0]['id']]);
    }else{
        $last_id = $conn->insData('modelinfo',$data1);
    }
}

?>
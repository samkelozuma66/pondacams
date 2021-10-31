<?php
    include 'config.php';
    
    
    $conn->deleteRow('modelpictures',['id'=>$_POST['id']]);
    
?>
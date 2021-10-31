<?php
    include 'config.php';
    
    
    $conn->deleteRow('modelvideo',['id'=>$_POST['id']]);
    
?>
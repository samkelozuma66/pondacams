<?php
include 'config.php';
if(!empty($_FILES)){
    $type = $_POST["type"];
    if(isset($_FILES['avatar']['name'])){
        $name = time() .$_FILES['avatar']['name'];
        if($type == "profile")
        {
            $images['selfie']= $name;
        }
        else
        {
            $images['cover_photo']= $name;
        }
        ///cover_photo
        move_uploaded_file($_FILES['avatar']['tmp_name'], '../documents/' .$name);
    }
   $delete = $conn->updateData('users',$images,['id'=>$_SESSION['id']]);
   if($delete){
       echo "Image Successfully Updated";
   }else{
       echo "Something Went Wrong";
   }
}


?>
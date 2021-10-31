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
        else if($type == "cover_photo")
        {
            $images['cover_photo']= $name;
        }
        else if($type == "gen_photo")
        {
            $images['image_name']= $name;
            
            $images['escort_id'] = $_POST['id'];
        }
        ///cover_photo
        move_uploaded_file($_FILES['avatar']['tmp_name'], '../documents/' .$name);
    }
    echo "type ".$type;
    if($type == "gen_photo")
    {
        $delete = $conn->insData('escort_image',$images);
        echo "delete ".$delete;

    }
    else
    {
        $delete = $conn->updateData('escort',$images,['id'=>$_POST['id']]);
    }
   
   if($delete){
       echo "Image Successfully Updated";
   }else{
       echo "Something Went Wrong";
   }
}


?>
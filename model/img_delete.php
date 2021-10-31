<?php
include 'config.php';
print_r($_POST['id']);
if(!empty($_POST)){
   if($_POST['id'] == "cover_photo")
   {
       
       $delete = $conn -> updateData("users",["cover_photo" => ""], ['id'=>$_SESSION['id']]);
   }
   else
   {
        $delete = $conn->deleteRow('modelpictures',['id'=>$_POST['id']]);
   }
   if($delete){
       echo "Image Successfully deleted";
   }else{
       echo "Something Went Wrong";
   }
}
?>
<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $nic = $_POST['nic'];
   $email = $_POST['email'];
   $special = $_POST['special'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../images/uploaded_images/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `staff_doc` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
    
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `staff_doc`(name,nic,email,special, image) VALUES('$name', '$nic','$email','$special','$image')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:doctors_view.php');
         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Doctor</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../styles/doctor_reg.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Add New Doctor's Details</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="name" placeholder="enter Doctors name" class="box" required>
      <input type="text" name="nic" placeholder="enter NIC" class="box" required>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="text" name="special" placeholder="enter City" class="box" required>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="Register Doctor" class="btn">
      <button onclick="document.location='doctors_view.php'" class = "nav_btn">Go Back</button>
   </form>
 
</div>

</body>
</html>
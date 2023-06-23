<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $nic = $_POST['nic'];
   $gender = $_POST['gender'];
   $age = $_POST['age'];
   $email = $_POST['email'];
   $contact = $_POST['contact'];
   $city = $_POST['city'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../images/uploaded_images/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `reg_user` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `reg_user`(name,nic,gender,age, email,contact,city, password, image) VALUES('$name', '$nic', '$gender', '$age', '$email', '$contact', '$city', '$pass', '$image')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:login.php');
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
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../style/myprofile.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>register now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="name" placeholder="enter username" class="box" required>
      <input type="text" name="nic" placeholder="enter NIC" class="box" required>
      <input type="text" name="gender" placeholder="enter Gender" class="box" required>
      <input type="number" name="age" placeholder="enter Age" class="box" required>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="tel" name="contact" placeholder="enter contact" class="box" required>
      <input type="text" name="city" placeholder="enter City" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>
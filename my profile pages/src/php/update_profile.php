<?php


include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){

   $update_name = $_POST['update_name'];
   $update_nic = $_POST['update_nic'];
   $update_gender = $_POST['update_gender'];
   $update_age = $_POST['update_age'];
   $update_email = $_POST['update_email'];
   $update_contact = $_POST['update_contact'];
   $update_city = $_POST['update_city'];

   mysqli_query($conn, "UPDATE `reg_user` SET 
    name = '$update_name',
    nic = '$update_nic',
    gender = '$update_gender',
    age = '$update_age',
    email = '$update_email',
    contact = '$update_contact',
    city = '$update_city'
    WHERE id = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = $_POST['update_pass'];
   $new_pass =$_POST['new_pass'];
   $confirm_pass =$_POST['confirm_pass'];

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `reg_user` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = '../images/uploaded_images/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `reg_user` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
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
   <title>update profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../styles/update_profile.css">

</head>
<body>
   
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `reg_user` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="../images/default-avatar.png">';
         }else{
            echo '<img src="../images/uploaded_images/'.$fetch['image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>username :</span>
            <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
            <span>NIC :</span>
            <input type="text" name="update_nic" value="<?php echo $fetch['nic']; ?>" class="box">
            <span>Gender :</span>
            <input type="text" name="update_gender" value="<?php echo $fetch['gender']; ?>" class="box">
            <span>Age :</span>
            <input type="number" name="update_age" value="<?php echo $fetch['age']; ?>" class="box">
            <span>email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>contact :</span>
            <input type="tel" name="update_contact" value="<?php echo $fetch['contact']; ?>" class="box">
            <span>city :</span>
            <input type="text" name="update_city" value="<?php echo $fetch['city']; ?>" class="box">
            <span>update your pic :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>
      </div>
      <input type="submit" value="update profile" name="update_profile" class="btn">
      <a href="myprofile.php" class="delete-btn">go back</a>
   </form>

</div>

</body>
</html>
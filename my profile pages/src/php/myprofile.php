<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../styles/myprofile.css">

</head>
<body>
   
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `reg_user` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="../images/default-avatar.png">';
         }else{
            echo '<img src="../images/uploaded_images/'.$fetch['image'].'">';
         }
      ?><br><br>
      <h3>Name    : <?php echo $fetch['name']; ?></h3><br>
      <h3>NIC     :<?php echo $fetch['nic']; ?></h3><br>
      <h3>Gender  :<?php echo $fetch['gender']; ?></h3><br>
      <h3>Age     : <?php echo $fetch['age']; ?></h3><br>
      <h3>Email   :<?php echo $fetch['email']; ?></h3><br>
      <h3>Contact : <?php echo $fetch['contact']; ?></h3><br>
      <h3>City    :<?php echo $fetch['city']; ?></h3>
      <br><br>
      <a href="update_profile.php" class="btn">update profile</a>
      <a href="myprofile.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
   </div>

</div>

</body>
</html>
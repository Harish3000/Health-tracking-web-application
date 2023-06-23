<?php
@ include'config.php';

?>

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
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="../styles/admin_page.css" />
  </head>
  <body>

  <h1>Welcome to Adinstrator page</h1>
    <!-- Patient Details -->
    <div class="card">

              <h2>Recent Updates</h2>
              <?php $select = "SELECT * FROM med_products";
              $result = $conn -> query($select);?>
               <?php $select2 = "SELECT * FROM request_doc";
               $result2 = $conn -> query($select2);?>

              <div class="product-display">      

                   <?php while($row = $result->fetch_assoc()) {?>
                     
                        <img src = "../images/uploaded_images/<?php echo $row['image'];?>" height = "20" alt = ""> 
                        <?php echo $row['name']." has been added";?><br><br>
                    <?php } ?>

                    <?php while($row = $result2->fetch_assoc())  {?>
                     
                     <img src = "../images/tick.jpg" height = "20" alt = "">DR. 
                     <?php echo $row['name']." has been Requested";?><br><br>
                 <?php } ?>


               </div>

    </div>


<br><br> <br>


    <!-- Add new  Items to store -->
    <div class="yaxis">
  
      <div class="xaxis">
     
        <div class="card">

              <form action="search_user.php" method="post" enctype="multipart/form-data">
                  <h3>Search Users</h3>

                  <input type="text" placeholder="enter User name" name="user_name" class="input_box" required>
                    <br> <br>

                  <input type="submit" class = "btn" value="Submit" name="search">
                  <br><br>
                   <input  class = "btn" type="reset" value="Reset">

                  
                  

                </form> 

                <br> <br><br> <br>
                <button onclick="document.location='user_view.php'" class = "nav_btn">VIEW ALL USERS</button>
                </div>
              </div>
            </div>


<!-- Add new  Items to store -->
<div class="yaxis">
   <div class="xaxis">
      <div class="card">
         <form action="doctors_Edit.php" method="post" enctype="multipart/form-data">
            <h3>Request Doctors</h3>
            <input type="text" placeholder="Enter Doctors name" name="doctor_name" class="input_box" required>
            <br> <br>
            <input type="email" placeholder="Enter Doctor email" name="doctor_email" class="input_box"required>
            <br> <br> <br> <br>
            <input type="submit" class="btn" name="request_doctor" value="Request Doctor">
         </form>
         <br> <br>
         <button onclick="document.location='doctors_view.php'"class = "nav_btn">View Doctors</button>
      </div>
   </div>
</div>


<!-- Add new  Items to store -->
<div class="yaxis">
   <div class="xaxis">
      <div class="card">
         <form action="product_Edit.php" method="post" enctype="multipart/form-data">
            <h3>Add a new product</h3>
            <input type="text" placeholder="enter product name" name="product_name" class="input_box" required>
            <br> <br>
            <input type="number" placeholder="enter product price" name="product_price" class="input_box"required>
            <br> <br>
            <input type="file" accept="image/png, image/jpeg, image/jpg"name="product_image" required>
            <br> <br>
            <input type="submit" class="btn" name="add_product" value="Add product">
         </form>
         <br> <br>
         <button onclick="document.location='products_view.php'" class = "nav_btn">VIEW PRODUCTS</button>
      </div>
   </div>
</div>

<a href="admin_page.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
      
</body>
</html>

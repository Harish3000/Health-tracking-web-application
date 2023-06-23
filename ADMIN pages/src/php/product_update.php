<?php

@include 'config.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = '../images/uploaded_images/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE med_products SET name='$product_name', price='$product_price', image='$product_image'  WHERE id = '$id'";
      $upload =$conn->query($update_data);
      
      

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:products_view.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../styles/update.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="card">


<div class="center_box">

   <?php
      
      $select ="SELECT * FROM med_products WHERE id = '$id'";
      $result = $conn->query($select);
      while($row = $result->fetch_assoc()){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update the product</h3>
      <input type="text" class="input_box" name="product_name" value="<?php echo $row['name']; ?>" placeholder="enter the product name">
      <br><br>
      <input type="number" min="0" class="input_box" name="product_price" value="<?php echo $row['price']; ?>" placeholder="enter the product price">
      <br><br>
      <input type="file" class="input_box" name="product_image"  accept="image/png, image/jpeg, image/jpg">
      <br><br>
      <input type="submit" value="update product" name="update_product" class="btn">
      <br><br>
    
   </form>
   


   <?php }; ?>

   <button onclick="document.location='products_view.php'" class ="nav_btn">Go Back</button>

</div>

</div>

</body>
</html>
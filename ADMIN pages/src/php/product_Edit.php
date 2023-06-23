<?php
@ include'config.php';

if(isset($_POST['add_product']))
{
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder ='../images/uploaded_images/'.$product_image;


    
        $insert = "INSERT INTO med_products(name,price,image) VALUES('$product_name', '$product_price','$product_image')";

        $conn->query($insert);
         move_uploaded_file( $product_image_tmp_name,$product_image_folder );
    
    
};

if(isset($_GET['delete']))
{
  $id = $_GET['delete'];
  $sql =  "DELETE FROM med_products WHERE id = $id";
  $conn->query($sql);
  header('location:admin_page.php');
}

    header("Location:admin_page.php");
?>
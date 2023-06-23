<?php
@ include'config.php';



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>View Products</title>
    <link rel="stylesheet" href="../styles/view.css" />
  </head>
  <body>

<?php $select ="SELECT * FROM med_products";?>

<div class="card">

<table id = "product_table">
      <thead>

        <tr>
          <th>product image</th>
          <th>product name</th>
          <th>product price</th>
          <th >action</th>
        </tr>

      </thead>
      <?php $result = $conn->query($select);
       while($row = $result->fetch_assoc()) {?>
        <tr>
          <td><img src = "../images/uploaded_images/<?php echo $row['image'];?>" height = "100" alt = ""> </td>
          <td><?php echo $row['name'];?></td>
          <td>Rs<?php echo $row['price'];?></td>

          <td >
            <button onclick="document.location='product_update.php?edit=<?php echo $row['id'];?>'"class ="btn">Edit</button>
            <br><br>
            <button onclick="document.location='product_Edit.php?delete=<?php echo $row['id'];?>' " class ="btn">Delete</button>
          </td>


        </tr>

        <?php } ?>


      

    </table>

    <br>
    <button onclick="document.location='admin_page.php'" class = "nav_btn">Back to Admin page</button>

</div>
</div>

      </body>
</html>
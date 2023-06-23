<?php
@ include'config.php';



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>View Doctors</title>
    <link rel="stylesheet" href="../styles/view.css" />
  </head>
  <body>

<?php $select ="SELECT * FROM reg_user";?>

<div class="card">

<table id = "product_table">
      <thead>

        <tr>
         <th>Name</th>
          <th>NIC</th>
          <th>gender</th>
          <th>age</th>
          <th>email</th>
          <th>contact</th>
          <th>city</th>
          
          <th>Action</th>
        </tr>

      </thead>
      <?php $result = $conn->query($select);
       while($row = $result->fetch_assoc()) {?>
        <tr>
          <td><img src = "../images/uploaded_images/<?php echo $row['image'];?>" height = "100" alt = ""> </td>
          <td><?php echo $row['name'];?></td>
          <td><?php echo $row['nic'];?></td>
          <td><?php echo $row['gender'];?></td>
          <td><?php echo $row['age'];?></td>
          <td><?php echo $row['email'];?></td>
          <td><?php echo $row['contact'];?></td>
          <td><?php echo $row['city'];?></td>

        </tr>

        <?php } ?>


      

    </table>

    <br>
    <button onclick="document.location='admin_page.php'" class = "nav_btn">Back to Admin page</button>
</div>
</div>

      </body>
</html>
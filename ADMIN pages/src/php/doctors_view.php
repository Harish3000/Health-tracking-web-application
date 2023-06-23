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

<?php $select ="SELECT * FROM staff_doc";?>

<div class="card">

<table id = "product_table">
      <thead>

        <tr>
         <th>Photo</th>
          <th>Name</th>
          <th>NIC</th>
          <th>Email</th>
          <th >Speciality</th>
          <th>Action</th>
        </tr>

      </thead>
      <?php $result = $conn->query($select);
       while($row = $result->fetch_assoc()) {?>
        <tr>
          <td><img src = "../images/uploaded_images/<?php echo $row['image'];?>" height = "100" alt = ""> </td>
          <td><?php echo $row['name'];?></td>
          <td><?php echo $row['nic'];?></td>
          <td><?php echo $row['email'];?></td>
          <td><?php echo $row['special'];?></td>

          <td >
            <button onclick="document.location='doctors_Edit.php?delete=<?php echo $row['id'];?>' " class ="btn">Delete</button>
          </td>


        </tr>

        <?php } ?>


      

    </table>

    <br>
    <button onclick="document.location='admin_page.php'" class = "nav_btn">Back to Admin page</button>
    <button onclick="document.location='doctor_reg.php'" class = "nav_btn">Add Doctors</button>
</div>
</div>

      </body>
</html>
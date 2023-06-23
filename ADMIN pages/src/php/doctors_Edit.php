<?php
require'config.php';

if(isset($_POST['request_doctor']))
{
    $doctor_name = $_POST['doctor_name'];
    $doctor_email = $_POST['doctor_email'];


    
        $insert = "INSERT INTO request_doc(name,email) VALUES('$doctor_name', '$doctor_email')";

        $conn->query($insert);

        $conn->close();

        
    header("Location:admin_page.php");

      
};
if(isset($_GET['delete']))
{
  $id = $_GET['delete'];
  $sql = "DELETE FROM staff_doc WHERE id = $id";
  $conn->query($sql);
  $conn->close();
  header("Location:doctors_view.php");

}


  
?>
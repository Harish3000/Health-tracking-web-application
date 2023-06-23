<?php
@ include'config.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>
   <link rel="stylesheet" href="../styles/search_user.css" />
    <!-- custom css file link  -->

</head>
<body>
   
<?php 
if(isset($_POST["search"]))
{ $pname = $_POST["user_name"]; 
    
    $sql= "SELECT * FROM reg_user where name LIKE '%$pname%'"; 
    
    if($result=$conn->query($sql))
    { 
        if($result->num_rows > 0)
        { 
         echo("<img src='../images/user.png' height = 800px width = 1500px>");
         echo '<div class="alert2">';
         echo ("<table border='1' class = 'styled-table'>");
         echo ("<tr>");
         echo ("<th> Name </th>");
         echo ("<th> NIC</th>");
         echo ("<th> gender </th>");
         echo ("<th> age </th>");
         echo ("<th> email </th>");
         echo ("<th> contact </th>");
         echo ("<th> city </th>");
         echo ("</tr>");
             while($row = $result->fetch_assoc())
             { echo ("<tr>"); 
                 echo ("<td>". $row['name']. "</td>");
                 echo ("<td>" . $row['nic'] . "</td>"); 
                 echo ("<td>" . $row['gender'] . "</td>"); 
                 echo ("<td>" . $row['age'] . "</td>");
                 echo ("<td>" . $row['email'] . "</td>"); 
                 echo ("<td>" . $row['contact'] . "</td>"); 
                 echo ("<td>" . $row['city'] . "</td>");  
              echo ("<tr>");


    	    } 
            echo ("</table><br><br>");
            echo("<button  onclick=\"location.href='admin_page.php'\" >Back to Home</button>");
            echo '</div>';
         }
         else{ 
            echo("<img src='../images/alert.png' class = center>");
            echo '<div class="alert">';
            echo ("<h2>user doesnt exist</h2> <br> <br>");
            echo("<button  onclick=\"location.href='admin_page.php'\" >Back to Home</button>");
            echo '</div>';
         }
    }
           
         }
?>
</body>
</html>
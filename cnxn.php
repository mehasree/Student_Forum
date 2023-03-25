<?php

$fileupload = $_POST['fileupload'];

if (!empty($fileupload) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "files";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $INSERT = "INSERT Into files (fileupload)values(?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $regno);
     $stmt->execute();
     $stmt->bind_result($regno);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("s", $fileupload);
      $stmt->execute();
      echo "Accounts Registered Successfully!"."<a href='ppt.html'>Click Here To Login</a>";
     } else {
      echo "Someone already register using this register number";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
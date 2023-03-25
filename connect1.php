<?php

$email = $_POST['email'];
$password = $_POST['password'];

$regno = $_POST['regno'];
$name  = $_POST['name'];
$department = $_POST['department'];

if (!empty($email) || !empty($password) || !empty($regno) || !empty($name) || !empty($department))
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "reg";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT regno From stud Where regno = ? Limit 1";
  $INSERT = "INSERT Into stud ( email,password,regno,name,department)values(?,?,?,?,?)";

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
      $stmt->bind_param("sssss", $email,$password,$regno,$name,$department);
      $stmt->execute();
      echo "Accounts Registered Successfully!"."<a href='login.html'>Click Here To Login</a>";
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
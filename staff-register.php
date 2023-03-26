<?php
$email = $_POST['Email'];
$password = $_POST['psw'];
$regno = $_POST['Register-no'];
$name  = $_POST['Name'];
$department = $_POST['Dept'];

$servername="localhost";
$username="root";
$password="";
$dbname="student_forum";

if (!empty($email) || !empty($password) || !empty($regno) || !empty($name) || !empty($department))
{
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
  $select='SELECT email From student_register Where email = ? Limit 1';
  $insert='INSERT Into student_register(uname,email,pass) values(?,?,?)';
  $stmt=$conn->prepare($select);
  $stmt->bind_param("s",$email);
  $stmt->execute();
  $stmt->bind_result($email);
  $stmt->store_result();
  $rnum=$stmt->num_rows;
  if($rnum==0)
  {
      $stmt->close();
      $stmt=$conn->prepare($insert);
      $stmt->bind_param("sss",$uname,$email,$pass);
      $stmt->execute();
      echo "Registration successful";
      header("location: index.html");
  }
  else{
  echo "Someone already registered using this email";
  header("location: login.html");
  }
  $stmt->close();
  $conn->close();
}
} 
else{
  echo 'All fields are required';
  die();
}
?>
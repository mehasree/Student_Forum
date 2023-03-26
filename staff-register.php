<?php
$email = $_POST['Email'];
$pass = $_POST['Password'];
$userid = $_POST['userid'];
$uname  = $_POST['Name'];

$servername="localhost";
$username="root";
$password="";
$dbname="student_forum";

if (!empty($email) || !empty($pass) || !empty($userid) || !empty($uname))
{
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
  $select='SELECT email From staff_db Where email = ? Limit 1';
  $insert='INSERT Into staff_db(uname,email,pass,userid) values(?,?,?,?)';
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
      $stmt->bind_param("ssss",$uname,$email,$pass,$userid);
      $stmt->execute();
      echo "Registration successful";
      header("location: homepage.html");
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
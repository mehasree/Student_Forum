<?php
$userid=$_POST['UserId'];
$pass=$_POST['Password'];
$servername="localhost";
$username="root";
$password="";
$dbname="student_forum";
if(!empty($userid) || !empty($pass))
{
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    $select='SELECT userid From login_db Where userid= ? and pass= ? Limit 1 ';
    $insert='INSERT Into login_success(userid) values(?)';
    $stmt=$conn->prepare($select);
    $stmt->bind_param("ss",$userid,$pass);
    $stmt->execute();
    $stmt->bind_result($userid);
    $stmt->store_result();
    $rnum=$stmt->num_rows;
    if($rnum==0)
    {
        echo "Account doesn't exist";
        header("location: index.html");
    }
    else{
        $stmt->close();
        $stmt=$conn->prepare($insert);
        $stmt->bind_param("s",$userid);
        $stmt->execute();
        echo "Login successful";
        header("location: homepage.html");
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
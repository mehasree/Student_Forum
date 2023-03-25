<html>
<head>
	<img src="" alt="">
	<style>
		body{
			background-image: url("sucessbg.jpg");
			background-repeat: no-repeat;
			background-size: cover;
		}
		body{
			text-align: center;
		
			font-size:50px;
			font-family:Franklin Gothic Medium;
			font-weight:bold;
			text-transform:uppercase;
			padding:20%;
			border: soild 15px #e74c3c;
		}
		
	</style>
</head>

<body>
<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="chatbot";
$conn=mysqli_connect($server_name,$username,$password,$database_name);
if(!$conn)
{
	die("connection failed".mysqli_connect_error());
}
if(isset($_POST['submit']))
{
	$uname=$_POST['uname'];
	$pass=$_POST['pass'];
	$sql_query="SELECT * FROM register WHERE uname='$uname' AND pass='$pass'";
	$result=mysqli_query($conn,$sql_query);
	$link_address='Test.php';

	if(mysqli_num_rows($result)>0)
	{
	  echo $uname, "\r\n", "Logged in successfully","\r\n",'<a href="https://app.wotnot.io/bot-preview/6VRBmKEPK29E085635685630g5vmS8Ff">Chatbot</a>'; 


	}
	else
	{
		echo '<script>alert("username or password is wrong")</script>';

	}

}
?>

</body>
</html>
<?php
define("SECRET_WORD", "Kat4RahAS1a");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
    setcookie('message', '', time() - 3600, '/');
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// PROSES LOGIN
if(!empty($_POST)){
	$user	= $_POST['username'];
	$pass	= $_POST['password'];

	if($user && $pass){
		$sql = "SELECT password FROM user WHERE username='$user'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			if (password_verify($pass, mysqli_fetch_array($result, MYSQLI_BOTH)['password'])) {
				header("location: /home.php");
			}
			else {
				alert("Password salah");
			}
		} else {
			alert("Username tidak ditemukan");
		}
	}
}
$conn->close();
?>

<html>
<head>
	<title>Simple Login System by TUTORIALWEB.NET</title>
</head>
<body>
 
    <!--/ FORM LOGIN /-->
	<form action="" method="post">
    <table>
    	<tr>
        	<td>Username</td><td>:</td><td><input type="text" name="username"/></td>
        </tr>
        <tr>
        	<td>Password</td><td>:</td><td><input type="password" name="password"/></td>
        </tr>
        <tr>
        	<td></td><td></td><td><input type="submit" name="login" value="Login"/></td>
        </tr>
    </table>
    </form>
 
</body>
</html>
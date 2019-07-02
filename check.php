<?php 
  include('config.php') ;

$user_name = $_POST['username'];
$user_pwd = $_POST['password'];

$tsql = "SELECT * FROM SystemUsers";

echo "DB info";
print_r($conn);

$stmt = sqlsrv_query( $conn, $tsql);

while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
{
	
	if(trim($obj['Username']) == $user_name)
	{
		if(trim($obj['Password']) == $user_pwd)
		{
			$_SESSION["username"] = $user_name;			
			$_SESSION["id"] = $obj['id'];			
			header("location:dashboard.php");
		}
		else
		{
			$_SESSION["pwderror"] = "Invalid Password";			
			header("location:index.php");
		}

	}
	else
	{
		$_SESSION["nameerror"] = "Invalid Username";
		header("location:index.php");
	}
}


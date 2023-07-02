<?php
include ("Db.php");
function Redirect_to($New_Location){
header("Location:".$New_Location);
exit;}
function CheckUserNameExist($UserName){
global $ConnectingDb;
$sql="SELECT username FROM admins WHERE username=:userName";
$stmt=$ConnectingDb->prepare($sql);
$stmt->bindValue(':userName',$UserName);
$stmt->execute();
$Result=$stmt->rowcount();
if ($Result==1) {
return true;
}
else {
return false;
}
}
	function LoginAttempt($UserName,$Password){
		global $ConnectingDb;
		$sql="SELECT * FROM admins WHERE username=:userName AND password=:passWord LIMIT 1";
		$stmt=$ConnectingDb->prepare($sql);
		$stmt->bindValue(':userName',$UserName);
		$stmt->bindValue(':passWord',$Password);
		$Execute=$stmt->execute();

		$Result =$stmt->rowcount();
		if ($Result==1) {
			return $FoundAccount=$stmt->fetch();
		}
		else
		{
			return null;

		}
	}
	function ConfirmLogin(){
		$Role=$_SESSION["Role"];
		if (isset($_SESSION["User_Id"])) {
			return true;
	}
		else{
			$_SESSION["ErrorMessage"]="Login Required!";
			Redirect_to("login.php");
		}
	}
?>
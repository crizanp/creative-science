<?php

session_start();


function ErrorMessage(){
	if(isset($_SESSION["ErrorMessage"])){
		$Output="<div class=\"alert alert-danger alert-dismissible fade show\"role=\"alert\">";
		$Output .=htmlentities($_SESSION["ErrorMessage"]);
		$Output .="<button type=\"button\"class=\"close\"data-dismiss=\"alert\"aria-label=\"Close\">";
		$Output .="<span arial-hidden=\"true\">";
		$Output .="&times;";
		$Output .="</scan>";
		$Output .="</button>";



		$Output .="</div>";

		$_SESSION["ErrorMessage"]=null;
		return $Output;
	}
}
function SuccessMessage(){
	if(isset($_SESSION["SuccessMessage"])){
		$Output="<div class=\"alert alert-success alert-dismissible fade show\"role=\"alert\">";
		$Output .=htmlentities($_SESSION["SuccessMessage"]);
		$Output .="<button type=\"button\"class=\"close\"data-dismiss=\"alert\"aria-label=\"Close\">";
		$Output .="<span arial-hidden=\"true\">";
		$Output .="&times;";
		$Output .="</scan>";
		$Output .="</button>";



		$Output .="</div>";

		$_SESSION["SuccessMessage"]=null;
		return $Output;
	}
}
global $ConnectingDb;
$sql="SELECT role FROM admins";
$stmt=$ConnectingDb->query($sql);
while ($DataRows=$stmt->fetch()) {
  # code...
	$Role=$DataRows["role"];
	
}

?>

<? ob_start(); ?><?php
require_once("../includes/Db.php");
require_once("../includes/Functions.php");
require_once("../includes/Sessions.php");
require_once("../includes/DateTime.php");
if ($_SESSION["Role"]==null) {
  # code...
    $_SESSION["ErrorMessage"]="Login required";

    Redirect_to("login.php");
}
else if($_SESSION["Role"]=="admin"){
  ConfirmLogin();
}
else if($_SESSION["Role"]=="Editor"){
    $_SESSION["ErrorMessage"]="You have no authority to delete the admin";
    Redirect_to("dashboard.php");
}
global $ConnectingDb;
if (isset($_GET["id"])) {
    $SearchQueryParameter=$_GET["id"];
    $sql="SELECT * FROM admins WHERE id='$SearchQueryParameter'";
    $stmt = $ConnectingDb->query($sql);

    while ($DataRows = $stmt->fetch()) {

        $Roled = $DataRows["role"];
    }
    if ($Roled != 'Admin') {
        $sql="DELETE FROM admins WHERE id='$SearchQueryParameter'";

        $Execute=$ConnectingDb->query($sql);
        if ($Execute) {
            $_SESSION["SuccessMessage"]=" Deleted Successfully".$Roled;
            Redirect_to("user.php");
        
        }
        else {
            $_SESSION["ErrorMessage"]="Oops cant delete admin";
            Redirect_to("user.php");
        }

    }
    else{
        $_SESSION["ErrorMessage"]="Sorry can't delete admin roled";
        Redirect_to("user.php");
    }    
}
?><? ob_flush(); ?>

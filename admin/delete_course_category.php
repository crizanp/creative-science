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
    $_SESSION["ErrorMessage"]="You have no authority to delete the category";
    Redirect_to("add_course_category.php");
  }


if (isset($_GET["id"])) {
    $SearchQueryParameter=$_GET["id"];
    global $ConnectingDb;
    $sql="DELETE FROM course_category WHERE id='$SearchQueryParameter'";

    $Execute=$ConnectingDb->query($sql);
    if ($Execute) {
        $_SESSION["SuccessMessage"]="Category Deleted Successfully".$SearchQueryParameter;
        Redirect_to("add_course_category.php");
        # code...
    }
    else {
        $_SESSION["ErrorMessage"]="Oops cant delete category";
        Redirect_to("add_course_category.php");
    }
    # code...
}

?><? ob_flush(); ?>

    
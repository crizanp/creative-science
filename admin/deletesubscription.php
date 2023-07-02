
<? ob_start(); ?><?php
require_once("../includes/Db.php");
require_once("../includes/Functions.php");
require_once("../includes/Sessions.php");
require_once("../includes/DateTime.php");
$SearchQueryParameter = $_GET['id'];

if ($_SESSION["Role"]==null) {
  # code...
    $_SESSION["ErrorMessage"]="Login required";

  Redirect_to("login.php");
}
else if($_SESSION["Role"]=="admin"){
  ConfirmLogin();
  }
 else if($_SESSION["Role"]=="Editor"){
    $_SESSION["ErrorMessage"]="You have no authority to delete";
    Redirect_to("course_post.php?id=$SearchQueryParameter");
  }
  if (isset($_GET["id"])) {


        $sql="DELETE FROM email WHERE id ='$SearchQueryParameter'";
        $Execute=$ConnectingDb->query($sql);
      
        if ($Execute) {
          
          $_SESSION["SuccessMessage"]="Subscription Deleted Successfully ";
          Redirect_to("subscription.php");
      
        }
        else
        {
         $_SESSION["ErrorMessage"]="Something Went Wrong";
         Redirect_to("subscription.php");
      
       }
          # code...
}
  
    ?>
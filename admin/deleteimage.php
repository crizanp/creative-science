
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
    $_SESSION["ErrorMessage"]="You have no authority to delete the image";
    Redirect_to("editmain.php?id=$SearchQueryParameter");
  }
  if (isset($_GET["id"])) {


$sql="SELECT image FROM post WHERE id=$SearchQueryParameter";
$stmt=$ConnectingDb->query($sql);
while ($DataRows=$stmt->fetch()) {
       # code...
 $ImageToBeUpdated=$DataRows['image'];
}
if ($ImageToBeUpdated==null) {
    $_SESSION["ErrorMessage"]="Your image selection is null";
        Redirect_to("editpost.php?id=$SearchQueryParameter");
    # code...
}
      $Target_Path_To_Delete_Image="../uploads/$ImageToBeUpdated";
      if(unlink($Target_Path_To_Delete_Image)){
        $sql="UPDATE post 
        SET image='' WHERE id='$SearchQueryParameter'";
        $Execute = $ConnectingDb->query($sql);
        $_SESSION["SuccessMessage"]="Image Deleted Successfully ";
        Redirect_to("editpost.php?id=$SearchQueryParameter");
      }
      else{
        $_SESSION["ErrorMessage"]="Oops can't connect Your image right now , server is under construction";
        Redirect_to("editpost.php?id=$SearchQueryParameter");
      }
      
}
  
    ?>
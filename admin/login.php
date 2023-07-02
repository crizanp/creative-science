  <? ob_start(); ?>
<?php
require_once("../includes/Db.php");
require_once("../includes/Functions.php");
require_once("../includes/Sessions.php");
require_once("../includes/DateTime.php");

$SecurityCheck=$_GET['csp'];
if ($SecurityCheck!='learnwithpractically') {
  header('location:../404');

}

if (isset($_SESSION['UserName'])) {
  header("location:course_post.php");
  die();
}
if(isset($_POST["Submit"])){
  $UserName=$_POST["Username"];
  $Password=$_POST["Password"];
    if (empty($UserName)||empty($Password)) {
    # code...
    $_SESSION["ErrorMessage"]="You can't make your field blank";
    Redirect_to("login.php");
  }
  else{
  // insert query
  $FoundAccount=LoginAttempt($UserName,$Password);
  if ($FoundAccount) {
  $_SESSION["User_Id"]=$FoundAccount["id"];
  $_SESSION["UserName"]=$FoundAccount["username"];
  $_SESSION["AdminName"]=$FoundAccount["aname"];
 global $ConnectingDb;
  $sql="SELECT role FROM admins WHERE role=:Role";
 $stmt=$ConnectingDb->prepare($sql);
    $stmt->bindValue(':Role',$Role);
    $stmt->execute();
$_SESSION["Role"]=$FoundAccount["role"];
  $_SESSION["SuccessMessage"]="Welcome ". $_SESSION["AdminName"];
  Redirect_to("course_post.php");
}
else{
$_SESSION["ErrorMessage"]="Incorrect username/password";
Redirect_to("login.php");
}
}
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Local CSS -->
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css"
  integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous" />
  <link rel="shortcut icon" type="images/png" href="../img/logo/ol.png">
  <title>Admin Panel</title>
</head>
<style>
.card{
  background-color: #f0e7e7;

}
</style>
<body>
  <!-- NAVBAR -->
  <!-- NAVBAR -->
  


  <!-- HEADER -->
  <header id="main-header" class="p-3 bg-dark text-light">
    <div class="container">
      <div class="row">
        <div class="col align-self-center" id="header-div">
          <h3 class="text-light"><i class="fas fa-edit"></i> <a href="blog.php">Login Required</a></h3>
        </div>
      </div>
    </div>
  </header>
  <div class="p-1 bg-primary"></div>

  <!-- HEADER END -->


  <!-- LOGIN -->
  <section id="login">
    <div class="container mt-5">

      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card px-auto py-auto">
           <?php
           echo ErrorMessage();
           ?> 
           <div class="card-header text-center">
            <h4>Login to continue</h4>
          </div>
          <div class="card-body">
            <form action="login.php" method="post">
              <div class="form-group">
                <label for="Username">Username</label>
                <input type="text"name="Username" class="form-control">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="Password"class="form-control">
              </div>
              <input type="submit"name="Submit" value="Login" class="btn background-primary btn-block">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer id="main-footer" class="bg-dark p-2 text-light fixed-bottom">
  <div class="container">
    <div class="row">
      <div class="col">
        <p class="lead text-center">
          Copyright &copy; <span id="year"></span>
csp panel        </p>
      </div>
    </div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
crossorigin="anonymous"></script>
<script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());
  </script>
  <script src="./js/app.js"></script>
</body>

</html><? ob_flush(); ?>
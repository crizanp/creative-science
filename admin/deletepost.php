<? ob_start(); ?>
<?php
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
    $_SESSION["ErrorMessage"]="You have no authority to delete the post";
    Redirect_to("dashboard.php");
}


$SearchQueryParameter=$_GET['id'];

echo SuccessMessage();
echo ErrorMessage();
global $ConnectingDb;
$sql="SELECT * FROM post WHERE id=$SearchQueryParameter";
$stmt=$ConnectingDb->query($sql);
while ($DataRows=$stmt->fetch()) {
  
  $CategoryToBeUpdated=$DataRows["category"];
  $SubCategory=$DataRows["sub_category"];
  $DateTime=$DataRows["datetime"];
  $Admin=$DataRows["author"];
  $HeadingToBeUpdated=$DataRows["heading"];
  $Title=$DataRows["title"];
  $Youtube=$DataRows["ylink"];
  $ImageToBeUpdated=$DataRows["image"];
  $Files=$DataRows["files"];
  $PostToBeUpdated=$DataRows["overview"];


}
if(isset($_POST["submit"])){


  // delete query
  global $ConnectingDb;    
  $sql="DELETE FROM post WHERE id ='$SearchQueryParameter'";
  $Execute=$ConnectingDb->query($sql);

  if ($Execute) {
    $Target_Path_To_Delete_Image="../uploads/$ImageToBeUpdated";
    unlink($Target_Path_To_Delete_Image);
    $_SESSION["SuccessMessage"]="Posts Deleted Successfully ";
    Redirect_to("course_post.php");

}
else
{
 $_SESSION["ErrorMessage"]="Something Went Wrong";
 Redirect_to("deletepost.php?id=$SearchQueryParameter");

}

}

?>
<!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/libs/css/style.css">
        <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
        <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
        <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
        <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
        <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
        <title>Admin | Posts</title>
        <style type="text/css">
            .bootstrap-tagsinput {
                background-color: white;
                border: 1px solid #ccc;
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                display: inline-block;
                padding: 4px 6px;
                color: black;
                vertical-align: middle;
                border-radius: 4px;
                max-width: 100%;
                line-height: 22px;
                cursor: text;
            }

            .bootstrap-tagsinput input {
                border: none;
                box-shadow: none;
                outline: none;
                background-color: transparent;
                padding: 0 6px;
                margin: 0;
                width: auto;
                max-width: inherit;
            }

            .bootstrap-tagsinput.form-control input::-moz-placeholder {
                color: black;
                opacity: 1;
            }

            .bootstrap-tagsinput.form-control input:-ms-input-placeholder {
                color: black;
            }

            .bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
                color: black;
            }

            .bootstrap-tagsinput input:focus {
                border: none;
                box-shadow: none;
            }

            .bootstrap-tagsinput .tag {
                margin-right: 2px;
                color: black;
            }

            .bootstrap-tagsinput .tag [data-role="remove"] {
                margin-left: 8px;
                cursor: pointer;
            }

            .bootstrap-tagsinput .tag [data-role="remove"]:after {
                content: "x";
                padding: 0px 2px;
            }

            .bootstrap-tagsinput .tag [data-role="remove"]:hover {
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
            }

            .bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
                box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            }
        </style>
    </head>

    <body>
        <div class="dashboard-main-wrapper">
            <div class="dashboard-header">



                <?php
                require_once("navbar/topnav.php");
                ?>
                <!-- nav -->
            </div>
            <div class="nav-left-sidebar sidebar-dark">
                <div class="menu-list">


                    <?php
                    require_once("navbar/sidenav.php");
                    ?>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end left sidebar -->

            <div class="dashboard-wrapper">
                <div class="dashboard-ecommerce">

                    <!-- ============================================================== -->
                    <!-- HEADER -->
                    <header id="main-header" class="p-3 bg-dark text-light">
                        <div class="container">
                            <div class="row">
                                <div class="col align-self-center" id="header-div">
                                    <h3><i class="fas fa-pencil-alt"></i> Posts</h3>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- HEADER END -->


                    <!-- SEARCH -->
                <!-- <section id="search" class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ml-auto">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Posts...">
            <div class="input-group-append">
              <button class="btn bg-primary" id="searchPostBtn">Search</button>
            </div>
          </div>
        </div>
      </div>
    </div>
</section> -->
<!-- SEARCH END -->


<!-- main section of adding post -->
<section class="container p-2">
    <nav aria-label="breadcrumb"class="bg-light">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="posts.php">Add new</a></li>
        <li class="breadcrumb-item"><a href="deletepost.php">Delete Post</a></li>
        <li class="breadcrumb-item"><a href="editpost.php">Posts</a></li>
    </ol>
</nav>
<?php
echo SuccessMessage();
echo ErrorMessage();

?>
<section class="container p-2">

    <div class="">
      <form class="p-2" action="deletepost.php?id=<?php echo $SearchQueryParameter;?>" method="post"
        enctype="multipart/form-data">
        <div class="form-row">
          <div class="col-lg">
            <div class="category-section-text bg-primary text-light p-3"><i class="fas fa-plus"></i> Delete
            Your Existing Post</div>
            <div class="p-2">
              <div class="form-group">
                <label for="title" class="font-weight-bold">
                  <h4>Category:</h4>
              </label>
              <input disabled value="<?php echo $CategoryToBeUpdated;?>" type="text" class="form-control"
              name="PostTitle">
          </div>
          <div class="form-group">
                <label for="title" class="font-weight-bold">
                  <h4>Sub category:</h4>
              </label>
              <input disabled value="<?php echo $SubCategory;?>" type="text" class="form-control"
              name="PostTitle">
          </div>

          <div class="form-group">
            <span>Existing Image:</span><br><img src="../uploads/<?php echo $ImageToBeUpdated;?>"
            width="170px" ;height="70px" ;></b></span><br><br>

            <div class="form-group">
              <label for="body">
                <h4>Heading:</h4>
            </label>
            <textarea disabled name="text" class="form-control"
            id="postBody"><?php echo $HeadingToBeUpdated;?></textarea>
        </div>
        <div class="form-group">
          <label for="body">
            <h4>Body:</h4>
        </label>
        <textarea disabled name="text" class="form-control"
        id="postBody"><?php echo $PostToBeUpdated;?></textarea>
    </div>

</div>
</div>
</div>
</div>
<button class="btn btn-danger font-weight-bold" type="submit" name="submit"><i class="fas fa-trash"></i> Delete Post</button>
<a href="editpost.php?id=<?php echo $SearchQueryParameter;?>"><i class="fas fa-trash"></i> Edit Post</a>
</form>
</div>
</section>

</section>
<!-- footer -->
<!-- ============================================================== -->
<div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                Copyright © 2021 Concept. All rights reserved. Dashboard by <a href="https://creativescienceproject.com/">csp admin</a>.
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="text-md-right footer-links d-none d-sm-block">
                    <a href="javascript: void(0);">About</a>
                    <a href="javascript: void(0);">Support</a>
                    <a href="javascript: void(0);">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- end wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- end main wrapper  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<!-- jquery 3.3.1 -->
<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<!-- bootstap bundle js -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<!-- slimscroll js -->
<script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<!-- main js -->
<script src="assets/libs/js/main-js.js"></script>
<!-- chart chartist js -->
<script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
<!-- sparkline js -->
<script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
<!-- morris js -->
<script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
<script src="assets/vendor/charts/morris-bundle/morris.js"></script>
<!-- chart c3 js -->
<script src="assets/vendor/charts/c3charts/c3.min.js"></script>
<script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
<script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
<script src="assets/libs/js/dashboard-ecommerce.js"></script>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
            // Get the current year for the copyright
            $('#year').text(new Date().getFullYear());

            CKEDITOR.replace('editor1');
            CKEDITOR.replace('editor2');
        </script>
    </body>

    </html>
<? ob_start(); ?>
<?php
require_once("../includes/Db.php");
require_once("../includes/Functions.php");
require_once("../includes/Sessions.php");
require_once("../includes/DateTime.php"); ?>
<?php ConfirmLogin();
if(isset($_POST["submit"])){
  $Category=$_POST["categoryTitle"];
  $Level=$_POST["level"];
  $Admin= $_SESSION["UserName"];
  $Status=$_POST["status"];
  $link_unlink=$_POST["link_unlink"];
   $Description=$_POST["description"];
  $Tag=$_POST["tag"];
 
  if (empty($Category)) {
    $_SESSION["ErrorMessage"]="You can't make required field blank";
    Redirect_to("add_course_category.php");
  }
  elseif (strlen($Category)<2) {
    $_SESSION["ErrorMessage"]="Character should be at least 2 characters";
    Redirect_to("add_course_category.php");
  }
  elseif (strlen($Category)>49) {
    $_SESSION["ErrorMessage"]="Character shouldn't be more then 50 characters";
    Redirect_to("add_course_category.php");
  }
  else{
   $sql="SELECT title FROM course_category";
   $stmt=$ConnectingDb->query($sql);
   while ($DataRows=$stmt->fetch()) {
    $CategoryToBeUpdated2=$DataRows['title'];
  }
  if ($Category != $CategoryToBeUpdated2) {
    $sql="INSERT INTO course_category(title,author,datetime,level,visible,link_unlink,description,tag)";
    $sql .="VALUES(:categoryName,:adminName,:datetime,:level,:Visible,:link_unlink,:Description,:Tag)";
    $stmt=$ConnectingDb->prepare($sql);
    $stmt->bindValue(':categoryName',$Category);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':datetime',$DateTime);
    $stmt->bindValue(':level',$Level);
    $stmt->bindValue(':Visible',$Status);
    $stmt->bindValue(':link_unlink',$link_unlink);
    $stmt->bindValue(':Description',$Description);
    $stmt->bindValue(':Tag',$Tag);
    $Execute=$stmt->execute();
    if ($Execute) {
     $_SESSION["SuccessMessage"]=$ConnectingDb->lastInsertId()." id's " ."Category Added Successfully ";
     Redirect_to("add_course_category.php");
   }
   else
   {
     $_SESSION["ErrorMessage"]="Something Went Wrong";
     Redirect_to("add_course_category.php");

   }
 }
 else
 {
   $_SESSION["ErrorMessage"]="sry can't add pre-existing category";
   Redirect_to("add_course_category.php");

 }
}
}
if(isset($_POST["submit_sub_category"])){
  $SubCategoryTitle=$_POST["subCategoryTitle"];
  $MainCategory=$_POST["mainCategory"];
    $Admin= $_SESSION["UserName"];


  if (empty($MainCategory)) {
    $_SESSION["ErrorMessage"]="You can't make required field blank";
    Redirect_to("add_course_category.php");
  }
  elseif (strlen($MainCategory)<2) {
    $_SESSION["ErrorMessage"]="Character should be at least 2 characters";
    Redirect_to("add_course_category.php");
  }
  elseif (strlen($MainCategory)>49) {
    $_SESSION["ErrorMessage"]="Character shouldn't be more then 50 characters";
    Redirect_to("add_course_category.php");
  }
  else{
    $sql="SELECT id FROM course_category WHERE title='$MainCategory'";
     $stmt=$ConnectingDb->query($sql);
                          while ($DataRows=$stmt->fetch()) {
                            $Id=$DataRows["id"];
                           
    $sql="INSERT INTO sub_category(sub_title,author,datetime,category_id)";
    $sql .="VALUES(:subCategoryName,:adminName,:datetime,:categoryId)";
    $stmt=$ConnectingDb->prepare($sql);
    $stmt->bindValue(':subCategoryName',$SubCategoryTitle);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':datetime',$DateTime);
    $stmt->bindValue(':categoryId',$Id);
    $Execute=$stmt->execute();
    if ($Execute) {
     $_SESSION["SuccessMessage"]=$ConnectingDb->lastInsertId()." id's " ."Category Added Successfully ";
     Redirect_to("add_course_category.php");
   }
   else
   {
     $_SESSION["ErrorMessage"]="Something Went Wrong";
     Redirect_to("add_course_category.php");

   }
 }
 
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
                  <h3>Add Course Categories</h3>
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
    <?php
    echo SuccessMessage();
    echo ErrorMessage();
    ?>


    <div class="container">
      <div class="row">
        <div class="col" id="categoryParent">
          <div class="card" id="categoryContainer">
            <div class="card-header">

              <nav aria-label="breadcrumb" class="bg-light">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="posts.php">Add new</a></li>
                  <li class="breadcrumb-item"><a href="deletepost.php">Delete post</a></li>
                  <li class="breadcrumb-item"><a href="editpost.php">Posts</a></li>
                </ol>
              </nav>
              <div class="container category-section bg-warning">
                <form class="p-4" novalidate method="post">
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label class="category-section-text text-dark"><i class="fas fa-plus"></i> Add New Course Category</label>
                      <h4 style="color:black"> Title</h4 style="color:black">
                      <input type="text"name="categoryTitle" class="form-control"required>
                      <h4 style="color:black"> Level</h4 style="color:black">
                      <input type="text"name="level" class="form-control"required>
                      <h4 style="color:black"> Status</h4 style="color:black">
                      <select name="status" class="form-control"id="">
                        <option value="1">Visible</option>
                        <option value="0">Hidden</option>
                      </select>

<h4 style="color:black"> Link and Unlink</h4 style="color:black">
                      <select name="link_unlink" class="form-control"id="">
                        <option value="1">Link</option>
                        <option value="0">Unlink</option>
                      </select> 
                       <h4 style="color:black"> Tag <span style="font-size: small;color: green;">(enter with comma)</span></h4 style="color:black">
                      <input type="text"name="tag" class="form-control"required>    
                      <h4 style="color:black"> Description <span style="font-size: small;color: green;">(enter 150 words des for this category)</span></h4 style="color:black">
                <textarea class="form-control"name="description" id="postBody"></textarea>
                                       </div>
                  </div>
                  <br>
                  <button class="btn btn-primary" type="submit"name="submit">Publish</button>
                </form>
              </div>
              <div class="container category-section bg-primary">

                <form class="p-4" novalidate method="post">
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label class="category-section-text text-light"><i class="fas fa-plus"></i> Add New Sub Category</label>
                      <h4 style="color:black"> Title eg: Physics</h4 style="color:black">
                      <input type="text"name="subCategoryTitle" class="form-control"required>
                      <h4 style="color:black"> Category eg: Class 4</h4 style="color:black">
                      <div class="form-group">
                        <select class="form-control"id=""name="mainCategory"> <option disabled selected value> -- select an option -- </option>
                          <?php
                          global $ConnectingDb;

                          $sql="SELECT DISTINCT title FROM course_category";
                          $stmt=$ConnectingDb->query($sql);
                          while ($DataRows=$stmt->fetch()) {
                            $Id=$DataRows["id"];
                            $CategoryName=$DataRows["title"];


                            ?>
                            <option><?php echo $CategoryName; ?></option>
                          <?php }?>
                        </select>
                      </div>                      
                     <!--  <h4 style="color:black"> Status</h4 style="color:black">
                      <select name="status" class="form-control"id="">
                        <option value="1">Visible</option>
                        <option value="0">Hidden</option>

                      </select> -->

                    </div>

                  </div>
                  
                  <br>
                  <button class="btn btn-secondary bg-secondary" type="submit"name="submit_sub_category">Publish</button>
                </form>



              </div>
              <form class="p-4">
                <div id="custom-search" class="top-search-bar float-left row">
                  <input class="form-control" type="text" placeholder="Search.." name="Search">
                  <button class="btn btn-primary" name="SearchButton">Search</button>
                </div>
              </form>

              <div class="table-responsive">
                <table class="table table-striped " id="categoryTable">
                  <thead class="bg-dark text-center text-light">
                    <tr>
                      <th>SN.</th>
                      <th>Title</th>
                      <th>Date</th>
                      <th>Author</th>
                      <th>Level</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php
                  global $ConnectingDb;
                  $Sr = 0;
                  if (isset($_GET["SearchButton"])) {
                                                # code...
                    $Search = $_GET["Search"];
                    $sql = "SELECT * FROM course_category
                    WHERE datetime LIKE :search
                    OR title LIKE :search
                    OR author LIKE :search
                    OR level LIKE :search
                    ORDER BY id desc";
                    $stmt = $ConnectingDb->prepare($sql);
                    $stmt->bindValue(':search', '%' . $Search . '%');
                    $stmt->execute();
                  } elseif (isset($_GET["page"])) {
                    $Page = $_GET["page"];
                    if ($Page == 0 || $Page < 1 || $Page == null) {
                      $ShowPostFrom = 0;
                                                    # code...
                    } else {
                      $ShowPostFrom = ($Page * 5) - 5;
                    }
                    $sql = "SELECT * FROM course_category ORDER BY id desc LIMIT $ShowPostFrom,5";
                    $stmt = $ConnectingDb->query($sql);
                                                # code...
                  } else {
                    $sql = "SELECT * FROM course_category ORDER BY id desc LIMIT 0,10";
                    $stmt = $ConnectingDb->query($sql);
                  }
                  while ($DataRows=$stmt->fetch()) {
                                                # code...

                    $Id=$DataRows["id"];
                    $Category=$DataRows["title"];
                    $DateTime=$DataRows["datetime"];
                    $Admin=$DataRows["author"];
                    $Level=$DataRows["level"];
                    $Visible=$DataRows["visible"];
                    $Sr++;
                    

                    ?>

                    <tbody id="categoryTableBody" class="text-center">
                     <tr>
                      <td><?php 
                      echo $Sr;
                    ?></td>
                    <td><?php 
                    echo $Category;
                  ?></td>
                  <td><?php 
                  echo $DateTime;
                ?></td>
                <td><?php 
                echo $Admin;
              ?></td>
              <td><?php 
              echo $Level;
            ?></td>
            <td>  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $Id; ?>">
              Delete
            </button>
            <a href="edit_course_category.php?id=<?php echo $Id ;?>"> <button type="button" class="btn btn-warning">
              Edit
            </button></a>
            Status: 
            <?php 
            if($Visible==1){
              echo 'Visible';
            }
            else{
              echo 'Hidden';
            } ?>



            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?php echo $Id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete it?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Ones deleted Category can't be undone !!
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="delete_course_category.php?id=<?php echo $Id; ?>">
                      <button type="button" class="btn btn-danger" name="deleteadmin">Delete</button>
                    </a>
                    <td>

                    </div>
                  </div>
                </div>

              </td>
            </tr>
          <?php }?>
        </tbody>                                        
      </table>
    </div>
    <nav>
      <ul class="pagination pagination-md">
        <?php
        global $ConnectingDb;
        $sql = "SELECT COUNT(*) FROM course_category";
        $stmt = $ConnectingDb->query($sql);
        $RowPagination = $stmt->fetch();
        $TotalPosts = array_shift($RowPagination);
        $PostPagination = $TotalPosts / 5;
        $PostPagination = ceil($PostPagination);
        for ($i = 1; $i <= $PostPagination; $i++) {
          if (!isset($_GET["Search"])) {

            if (!isset($_GET["page"])) {
              $Page = 1;
                                        # code...
            }
                                    # code...

            if ($i == $Page) {
                                        # code...

                                        # code...

              ?>
              <li class="page-item">
                <a href="add_course_category.php?page=<?php echo $i ?>" class="page-link bg-primary"><?php echo $i ?></a>
              </li>
            <?php } else {
                                        # code...
              ?>
              <li class="page-item">
                <a href="add_course_category.php?page=<?php echo $i ?>" class="page-link bg-secondary"><?php echo $i ?></a>
                </li><?php } ?>
              <?php }
            } ?>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</section>
<!-- footer -->
<!-- ============================================================== -->
<div class="footer sticky-bottom">
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
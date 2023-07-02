<? ob_start(); ?><?php
require_once("../includes/Db.php");
require_once("../includes/Functions.php");
require_once("../includes/Sessions.php");
require_once("../includes/DateTime.php"); ?>
<?php ConfirmLogin(); ?>
<?php 
if(isset($_POST["submit"])){
  $Category=$_POST["category"];
  $SubCategory=$_POST["sub_category"];
  $Image=$_FILES["Image"]["name"];
  $Target_Image="../uploads/".basename($_FILES["Image"]["name"]);
  $PostOverview=$_POST["editor_post"];
  $PostQuestion=$_POST["editor_qus"];
  $Admin=$_SESSION["UserName"];
  $PostHeading=$_POST["heading"];
  $Title=$_POST["title"];
  $YoutubeLink=$_POST["ylink"];
  $SeoDescription=$_POST["description"];
  $SeoTag=$_POST["tag"];
  $Files=$_FILES["Files"]["name"];
  $Target_File="../uploads/files/".basename($_FILES["Files"]["name"]);
  if (empty($Category)) {
  # code...
    $_SESSION["ErrorMessage"]="You can't make your post category blank";
    Redirect_to("course_post.php");

  }
  elseif (strlen($Category)<2) {

    $_SESSION["ErrorMessage"]="Category should be at least 2 characters";
    Redirect_to("course_post.php");


  }
  elseif (strlen($Category)>99999) {

    $_SESSION["ErrorMessage"]="Category shouldn't be more then 100000 characters";
    Redirect_to("posts.php");


  }
  else{
// insert query
    global $ConnectingDb;
    $Check=0;
    $sql="SELECT id FROM course_category WHERE title='$Category'";//class 4-->46
    $stmt=$ConnectingDb->query($sql);
    while ($DataRows=$stmt->fetch()) {
                    $CatId=$DataRows["id"]; //46
                  }
                  $sql="SELECT * FROM sub_category WHERE category_id='$CatId'";//class 4-->24
                  $stmt=$ConnectingDb->query($sql);
                  while ($DataRows=$stmt->fetch()) {
                    $SubCategoryToBeCheck=$DataRows["sub_title"]; //physics
                    if (($SubCategoryToBeCheck==$SubCategory) ) {
                     $Check=1;
                   }
                 }
                 if ($Check==0) {
                   $_SESSION["ErrorMessage"]="Not founds";
    Redirect_to("course_post.php");
                   // code...
                 }

                 $sql="INSERT INTO post(datetime,author,course_category_id,image,heading,title,category,ylink,overview,files,faq,sub_category,tag,description)";
                 $sql .="VALUES(:dateTime,:adminName,:courseCategoryId,:imageName,:postHeading,:postTitle,:postCategory,:yLink,:postOverview,:fileName,:Faq,:subCategory,:Tag,:Description)";
                 $stmt=$ConnectingDb->prepare($sql);
                 $stmt->bindValue(':dateTime',$DateTime);
                 $stmt->bindValue(':adminName',$Admin);
                 $stmt->bindValue(':courseCategoryId',$CatId);
                 $stmt->bindValue(':imageName',$Image);
                 $stmt->bindValue(':postHeading',$PostHeading);
                 $stmt->bindValue(':postTitle',$Title);
                 $stmt->bindValue(':postCategory',$Category);
                 $stmt->bindValue(':yLink',$YoutubeLink);
                 $stmt->bindValue(':postOverview',($PostOverview));
                 $stmt->bindValue(':Faq',($PostQuestion));
                 $stmt->bindValue(':Tag',($SeoTag));
                 $stmt->bindValue(':Description',($SeoDescription));
                 $stmt->bindValue(':fileName',$Files);
                 $stmt->bindValue(':subCategory',$SubCategory);
    // $stmt->bindValue(':file',$File);
    // $stmt->bindValue(':postLike',$PostLike);
    // $stmt->bindValue(':postView',$PostView);


                 $Execute=$stmt->execute();
                 move_uploaded_file($_FILES["Image"]["tmp_name"],$Target_Image);    
                 if ($Execute) {
                   $_SESSION["SuccessMessage"]=$ConnectingDb->lastInsertId()." id's " ."Posts Added Successfully";
                   Redirect_to("course_post.php");

                 }
                 else
                 {
                   $_SESSION["ErrorMessage"]="Something Went Wrong";
                   Redirect_to("course_post.php");

                 }   move_uploaded_file($_FILES["Files"]["tmp_name"],$Target_File);    
                 if ($Execute) {
                   $_SESSION["SuccessMessage"]=$ConnectingDb->lastInsertId()." id's " ."Posts Added Successfully";
                   Redirect_to("course_post.php");

                 }
                 else
                 {
                   $_SESSION["ErrorMessage"]="Something Went Wrong";
                   Redirect_to("course_post.php");

                 }}

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
                  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: '#mytextarea',
        plugins: [
          'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
          'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
          'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
      });
    </script>

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
    <?php 
    echo SuccessMessage();
    echo ErrorMessage();
    ?>
    <nav aria-label="breadcrumb"class="bg-light">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="posts.php">Add new</a></li>
        <li class="breadcrumb-item"><a href="deletepost.php">Delete Post</a></li>
        <li class="breadcrumb-item"><a href="editpost.php">Posts</a></li>
      </ol>
    </nav>
    <div class="">
      <form class="p-2" method="post"enctype="multipart/form-data">
        <div class="form-row">
          <div class="col-lg">
            <div class="category-section-text bg-primary p-3"><i class="fas fa-plus"></i> Add New Post</div>
            <div class="p-2">

              <div class="form-group">
                <label for="category"class="font-weight-bold ">Category <span style="font-size:12px;color:red"class="px-3"> [ Example: Class 12 ]</span></label>
                <select class="form-control"id=""name="category"> <option disabled selected value> -- select an option -- </option>
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
              <div class="form-group">
                <label for="category"class="font-weight-bold ">Sub Category <span style="font-size:12px;color:red"class="px-3"> [ Example: Astronomy, make sure you have make your sub category in add category page ]</span></label>
                <select class="form-control"id=""name="sub_category"> <option disabled selected value> -- select an option -- </option>
                  <?php
                  global $ConnectingDb;
                  
                  $sql="SELECT DISTINCT sub_title FROM sub_category";
                  $stmt=$ConnectingDb->query($sql);
                  while ($DataRows=$stmt->fetch()) {
                    $Id=$DataRows["id"];
                    $CategoryName=$DataRows["sub_title"];


                    ?>
                    <option><?php echo $CategoryName; ?></option>
                  <?php }?>
                </select>
              </div>
              

              <div class="form-group">
                <label for="body"class="font-weight-bold">Heading <span style="font-size:12px;color:red"class="px-3"> [ Example: Invertebrate ]</span></label>
                <textarea class="form-control"name="heading" id="postBody"></textarea>
              </div>  
              <div class="form-group">
                <label for="body"class="font-weight-bold">Title <span style="font-size:12px;color:red"class="px-3"> [ Example: To prepare alcohol ]</span></label>
                <textarea class="form-control"name="title" id="postBody"></textarea>
              </div>
              <div class="form-group">
                <label for="body"class="font-weight-bold">Youtube Embad Code <span style="font-size:12px;color:red"class="px-3"> [ no link, but full embad code ]</span></label>
                <textarea class="form-control"name="ylink" id="postBody"></textarea>
              </div>  
              <div class="form-group">
                <label for="image"class="font-weight-bold">Upload Image</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input"name="Image">
                  <label for="image" class="custom-file-label">Choose File</label>
                  <small class="form-text text-muted">Max Size 3Mb</small>
                </div></div>
                <div class="form-group">
                  <label for="body"class="font-weight-bold">Post Overview <span style="font-size:12px;color:red"class="px-3"> [ detail overview of lecture ]</span></label>
                  <textarea id="mytextarea" name="editor_post" class="form-control"></textarea>
                </div> 
                
                <div class="form-group">
                  <label for="body"class="font-weight-bold">Post Questions <span style="font-size:12px;color:red"class="px-3"> [ some questions of this post ]</span></label>
                  <textarea id="mytextarea" name="editor_qus" class="form-control"></textarea>
                </div> 
                <div class="form-group">
                  <label for="image"class="font-weight-bold">Upload Files</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input"name="Files">
                    <label for="image" class="custom-file-label">Choose File</label>
                    <small class="form-text text-muted">Max Size 3Mb</small>
                  </div></div>
                   <h4 style="color:black"> Tag <span style="font-size: small;color: green;">(enter with comma)</span></h4 style="color:black">
                      <textarea  type="text"name="tag" class="form-control"required>  </textarea>  
                      <h4 style="color:black"> Description  <span style="font-size: small;color: green;">(enter 150 words des for this category)</span> <span id="word-count"style="color:grey"> 0</span><span style="color:grey"> Words</span><span id="character-count"style="display:none"></span> </h4 style="color:black">
                <textarea id="word-count-input" class="form-control"name="description"required></textarea>
                <script>
                    var countTarget = document.querySelector("#word-count-input");
var wordCount = document.querySelector("#word-count");
var characterCount = document.querySelector("#character-count");

var count = function () {
  var characters = countTarget.value;
  var characterLength = characters.length;

  var words = characters.split(/[\n\r\s]+/g).filter(function (word) {
    return word.length > 0;
  });

  wordCount.innerHTML = words.length;
  characterCount.innerHTML = characterLength;
};

count();

window.addEventListener(
  "input",
  function (event) {
    if (event.target.matches("#word-count-input")) {
      count();
    }
  },
  false
);

                </script>
                </div>
              </div>
            </div>
            <button class="btn btn-primary font-weight-bold" type="submit"name="submit">Publish</button>

          </form>
        </div>
        <div class="container">
          <div class="row">
            <div class="col" id="categoryParent">
              <div class="card" id="categoryContainer">
                <div class="card-header text-center">

                  <nav aria-label="breadcrumb"class="bg-light"id="jump">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="posts.php">Add new</a></li>
                      <li class="breadcrumb-item"><a href="deletepost.php">Delete Post</a></li>
                      <li class="breadcrumb-item"><a href="editpost.php">Posts</a></li>
                    </ol>
                  </nav>
                  <h4>Latest Post</h4>

                  <form>
                    <div id="custom-search" class="top-search-bar float-left row">
                      <input class="form-control" type="text" placeholder="Search.."name="Search">
                      <button class="btn btn-primary"name="SearchButton">Search</button>
                    </div>
                  </form>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped " id="categoryTable">
                    <thead class="bg-dark text-white">
                      <tr>
                       <th>SN.</th>
                       <th>Date</th>
                       <th>Author</th>
                       <th>Category</th>
                       <th>Sub Category</th>
                       <th>Heading</th>
                       <th>Title</th>
                       <th>Image</th>

                       <th>P-Overview</th>
                       <th>Files</th>
                       <th>Action</th>
                     </tr>
                   </thead>
                   <?php
                   global $ConnectingDb;
                   $Sr=0;
                   if (isset($_GET["SearchButton"])) {
                # code...
                    $Search = $_GET["Search"];
                    $sql = "SELECT * FROM post
                    WHERE datetime LIKE :search
                    OR heading LIKE :search
                    OR title LIKE :search
                    OR category LIKE :search
                    OR sub_category LIKE :search
                    OR overview LIKE :search
                    OR author LIKE :search ORDER BY id desc";
                    $stmt = $ConnectingDb->prepare($sql);
                    $stmt->bindValue(':search', '%' . $Search . '%');
                    $stmt->execute();

                  } 
                  elseif (isset($_GET["page"])) {
                    $Page=$_GET["page"];
                    if ($Page==0 || $Page<1 || $Page==null) {
                      $ShowPostFrom=0;
                # code...
                    }
                    else{
                      $ShowPostFrom=($Page*5)-5;
                    }
                    $sql="SELECT * FROM post ORDER BY id desc LIMIT $ShowPostFrom,5";
                    $stmt=$ConnectingDb->query($sql);
              # code...
                  }
                  else{
                    $sql="SELECT * FROM post ORDER BY id desc LIMIT 0,10";
                    $stmt=$ConnectingDb->query($sql);}
                    while ($DataRows=$stmt->fetch()) {
  # code...
                      $Id=$DataRows["id"];
                      $Category=$DataRows["category"];
                      $SubCategory=$DataRows["sub_category"];
                      $DateTime=$DataRows["datetime"];
                      $Admin=$DataRows["author"];
                      $Heading=$DataRows["heading"];
                      $Title=$DataRows["title"];
                      $Youtube=$DataRows["ylink"];
                      $Image=$DataRows["image"];
                      $Files=$DataRows["files"];
                      $Post=$DataRows["overview"];
                      $Sr++;


                      ?>

                      <tbody id="categoryTableBody">
                       <tr>
                        <td><?php 
                        echo $Sr;
                      ?></td>
                      <td><?php 
                      echo $DateTime;
                    ?></td>
                    <td><?php 
                    echo $Admin;
                  ?></td>
                  <td>
                    <a href="../fullpost.php?category=<?php echo $Category?>"target="_blank"> <?php echo $Category; ?></td>
                      <td>
                    <a href="../fullpost.php?category=<?php echo $Category?>"target="_blank"> <?php echo $SubCategory; ?></td>
                      <td>
                        <a href="../headingpost.php?heading=<?php echo $Heading?>"target="_blank"> <?php echo $Heading; ?></a>
                      </td>
                      <td>
                        <a href="../headingpost.php?heading=<?php echo $Heading?>"target="_blank"> <?php echo $Title; ?></a>
                      </td>

                      <td>
                        <?php 
                        if ($Image != null) {
                          ?>

                          <img src="../uploads/<?php echo $Image ?>" style="height: 50px;width: 100px;">
                        <?php }
                        else{
                          echo "no image";

                        }
                        ?>
                      </td>
                      <td>
                       <a href="../headingpost.php?heading=<?php echo $Heading?>"target="_blank"> <?php echo substr($Post, 0,150)."..."; ?></a>
                     </td>
                     <td>
                      <a href="../uploads/files/<?php echo $Files;?>"download><?php echo $Files?></a>

                    </td>

                    <td>
                     <a href="editpost.php?id=<?php echo $Id ;?>"><button type="button" class="btn btn-warning">
                      Edit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </button></a>
                    <a href="deletepost.php?id=<?php echo $Id ;?>"><button type="button" class="btn btn-danger">
                      Delete
                    </button></a>
                    
                  </td>
                </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
      <nav>
       <ul class="pagination pagination-md">
         <?php
         global $ConnectingDb;
         $sql="SELECT COUNT(*) FROM post";
         $stmt=$ConnectingDb->query($sql);
         $RowPagination=$stmt->fetch();
         $TotalPosts=array_shift($RowPagination);
         $PostPagination=$TotalPosts/5;
         $PostPagination=ceil($PostPagination);
         for ($i=1; $i<=$PostPagination ; $i++) { 
          if (!isset($_GET["Search"])) {

           if (!isset($_GET["page"])) {
             $Page=1;
           # code...
           }
           # code...

           if ($i==$Page) {
           # code...

         # code...

             ?>
             <li class="page-item">
               <a href="course_post.php?page=<?php echo $i ?>#jump"class="page-link bg-primary"><?php echo $i ?></a>
             </li>
           <?php }
           else {
         # code...
             ?>
             <li class="page-item">
               <a href="course_post.php?page=<?php echo $i ?>#jump"class="page-link bg-secondary"><?php echo $i ?></a>
               </li><?php }?>
             <?php }} ?>
           </ul></nav>
         </div>
       </div>
     </div>

     <!-- footer -->
     <!-- ============================================================== -->
     <div class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            Copyright © 2021 Concept. All rights reserved. Dashboard by <a
            href="#">csp admin</a>.
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
    <!-- ============================================================== -->
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
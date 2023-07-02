<? ob_start(); ?>
<?php
require_once("../includes/Db.php");
require_once("../includes/Functions.php");
require_once("../includes/Sessions.php");
require_once("../includes/DateTime.php"); ?>
<?php ConfirmLogin();
$SearchQueryParameter = $_GET['id'];
if (isset($_POST["submit"])) {
    $Category = $_POST["Category"];
    $SubCategory = $_POST["SubCategory"];
    $Image = $_FILES["Image"]["name"];
    $Target = "../uploads/" . basename($_FILES["Image"]["name"]);
    $PostText = $_POST["editor_post"];
    $Faq = $_POST["editor_qus"];
    $PostHeading = $_POST["heading"];
    $PostTitle = strtoupper($_POST["title"]);
    $YoutubeEmbed=$_POST['ylink'];
    $SeoDescription=$_POST['description'];
    $SeoTag=$_POST['tag'];

    $Admin = $_SESSION['UserName'];
    if (empty($Category)) {
        # code...
        $_SESSION["ErrorMessage"] = "You can't make your post category blank";
        Redirect_to("editpost.php?id=$SearchQueryParameter");
    } elseif (strlen($Category) < 2) {

        $_SESSION["ErrorMessage"] = "Title should be at least 2 characters";
        Redirect_to("editpost.php?id=$SearchQueryParameter");
    } elseif (strlen($Category) > 9999) {

        $_SESSION["ErrorMessage"] = "Post description shouldn't be more then 1000 characters";
        Redirect_to("editpost.php?id=$SearchQueryParameter");
    } else {
        $sql="SELECT * FROM course_category WHERE title='$Category'";
$stmt = $ConnectingDb->query($sql);
while ($DataRows = $stmt->fetch()) {
    $CategoryId = $DataRows['id']; //class 4 id
    
}
$check=0;
$sql="SELECT * FROM sub_category WHERE category_id='$CategoryId'";
$stmt = $ConnectingDb->query($sql);
while ($DataRows = $stmt->fetch()) {
    $SubCategoryCheck = $DataRows['sub_title'];
    if ($SubCategoryCheck==$SubCategory) {
     $check=1;
}
    
}
if ($check==0) {
     $_SESSION["ErrorMessage"] = "Not Match cat and sub cat";
        Redirect_to("editpost.php?id=$SearchQueryParameter");
    // code...
}
        // insert query
        global $ConnectingDb;
        if (!empty($_FILES["Image"]["name"])) {
            $sql = "UPDATE post 
            SET category='$Category', image='$Image',overview='$PostText',heading='$PostHeading',title='$PostTitle',ylink='$YoutubeEmbed',description='$SeoDescription',tag='$SeoTag'
            WHERE id='$SearchQueryParameter'";
            # code...
        } else {
            $sql = "UPDATE post 
            SET category='$Category',heading='$PostHeading',overview='$PostText',title='$PostTitle',ylink='$YoutubeEmbed',faq='$Faq',sub_category='$SubCategory',description='$SeoDescription',tag='$SeoTag'
            WHERE id='$SearchQueryParameter'";
        }

        $Execute = $ConnectingDb->query($sql);
        move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);

        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Posts Edited Successfully ";
            Redirect_to("editpost.php?id=$SearchQueryParameter");
        } else {
            $_SESSION["ErrorMessage"] = "Something Went Wrong";
            Redirect_to("editpost.php?id=$SearchQueryParameter");
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
global $ConnectingDb;
$sql = "SELECT * FROM post WHERE id='$SearchQueryParameter'";
$stmt = $ConnectingDb->query($sql);
while ($DataRows = $stmt->fetch()) {
                        # code...
    $CategoryToBeUpdated = $DataRows['category'];
    $SubCategoryToBeUpdated = $DataRows['sub_category'];
    $ImageToBeUpdated = $DataRows['image'];
    $PostToBeUpdated = $DataRows['overview'];
    $QuestionToBeUpdated = $DataRows['faq'];
    $HeadingToBeUpdated = $DataRows['heading'];
    $TitleToBeUpdated = $DataRows['title'];
    $YoutubeLink=$DataRows['ylink'];
    $SeoDescription=$DataRows['description'];
     $SeoTag=$DataRows['tag'];
   
}
?>

<div class="">
    <form class="p-2" action="editpost.php?id=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="col-lg">
                <div class="category-section-text bg-primary text-light p-3"><i class="fas fa-plus"></i> Edit
                Your Existing Post</div>
                <div class="p-2">

                    <div class="form-group">
                        <label for="category" class="font-weight-bold">
                            <h4>Update Heading</h4>
                        </label>
                        
                        <textarea name="heading" class="form-control"
                        id="HeadingTitle"><?php echo $HeadingToBeUpdated;?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category" class="font-weight-bold">
                            <h4>Update Title</h4>
                        </label>
                        
                        <textarea name="title" class="form-control"
                        id="HeadingTitle"><?php echo $TitleToBeUpdated;?></textarea>
                    </div>
                     <div class="form-group">
                        <label for="category" class="font-weight-bold">
                            <h4>Update Youtube Embed</h4>
                        </label>
                        
                        <textarea name="ylink" class="form-control"
                        id="HeadingTitle"><?php echo $YoutubeLink;?></textarea>
                    </div>


                    <br>
                    <span>Existing Category:<b> <?php echo $CategoryToBeUpdated; ?></b></span><br>

                    <label for="category" class="font-weight-bold">
                        <h4>Update Category</h4>
                    </label>
                    <select class="form-control" id="CategoryTitle" name="Category">
                        <option disabled value>..select..</option>

                        <?php
                        global $ConnectingDb;
                        $sql = "SELECT DISTINCT title FROM course_category";
                        $stmt = $ConnectingDb->query($sql);
                        while ($DataRows = $stmt->fetch()) {
                            $Id = $DataRows["id"];
                            $CategoryName = $DataRows["title"];


                            ?>
                            <option <?php if ($CategoryToBeUpdated==$CategoryName) {
                                // code...
                                echo 'selected';
                            } ?>
                            ><?php echo $CategoryName; ?></option>
                        <?php } ?>
                    </select>
                </div>
                 <br>
                    <span>Existing Sub Category:<b> <?php echo $SubCategoryToBeUpdated; ?></b></span><br>

                    <label for="category" class="font-weight-bold">
                        <h4>Update Sub Category</h4>
                    </label>
                    <select class="form-control" id="CategoryTitle" name="SubCategory">
                        <option disabled value>..select..</option>
                        <?php
                        global $ConnectingDb;
                        $sql = "SELECT DISTINCT sub_title FROM sub_category";
                        $stmt = $ConnectingDb->query($sql);
                        while ($DataRows = $stmt->fetch()) {
                            $SubCategoryName = $DataRows["sub_title"];


                            ?>
                            <option <?php if ($SubCategoryToBeUpdated==$SubCategoryName) {
                                // code...
                                echo 'selected';
                            } ?>
                            ><?php echo $SubCategoryName; ?></option>
                        <?php } ?>
                    </select>
                <div class="form-group">
                    <span>Existing Image:</span><br><img src="../uploads/<?php echo $ImageToBeUpdated; ?>" width="170px" height="70px" alt=" null"></b><br>
                    <a href="deleteimage.php?id=<?php echo $SearchQueryParameter?>">Delete image</a><br>




                    <label for="image" class="font-weight-bold">
                        <h4>Update Image</h4>
                    </label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="Image">
                        <label for="image" class="custom-file-label">Choose File</label>
                        <small class="form-text text-muted">Max Size 3Mb</small>
                    </div>

               </div>
                <div class="form-group">
                    <label for="body">
                        <h4>Update Body</h4>
                    </label>
                    <textarea id="mytextarea" name="editor_post" class="form-control"><?php echo $PostToBeUpdated; ?></textarea>

                </div>
                <div class="form-group">
                    <label for="body">
                        <h4>Update Questions</h4>
                    </label>
                    <textarea id="mytextarea" name="editor_qus" class="form-control"><?php echo $QuestionToBeUpdated; ?></textarea>
                </div>
                 <h4 style="color:black"> Tag <span style="font-size: small;color: green;">(enter with comma)</span></h4 style="color:black">
                      <textarea type="text"name="tag" class="form-control"required> <?php echo $SeoTag;?> </textarea>  
                      <h4 style="color:black"> Description <span style="font-size: small;color: green;">(enter 150 words des for this category)</span><span id="word-count"style="color:grey"> 0</span><span style="color:grey"> Words</span><span id="character-count"style="display:none"></span></h4 style="color:black">
                <textarea id="word-count-input" class="form-control"name="description" id="postBody"required><?php echo $SeoDescription; ?></textarea>
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
<button class="btn btn-primary font-weight-bold" type="submit" name="submit">Publish</button>
</form>

</div>
</section>
<!-- footer -->
<!-- ============================================================== -->
<div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                Copyright © 2021 Concept. All rights reserved. Dashboard by <a href="#">csp admin</a>.
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
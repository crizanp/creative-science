<? ob_start(); ?> <?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
?> <?php
global $ConnectingDb;

if (!isset($_GET["topic"])) {
    $_SESSION["ErrorMessage"] = "Sorry, this page isn't available";
    Redirect_to("http://creativescienceproject.com/course");
}
else{ 
    $PostIdFromURL = str_replace('-', ' ', strtoupper($_GET["topic"]));
}
$sql = "SELECT p.* FROM post p WHERE p.title='$PostIdFromURL'";
$stmt = $ConnectingDb->query($sql);
$sqlviews="UPDATE post SET view = view+1 WHERE title ='$PostIdFromURL'";
$ConnectingDb->query($sqlviews);
$CheckUrl=0;

while ($DataRows = $stmt->fetch()) {

    $PostId = $DataRows["id"];
    $Title = strtoupper($DataRows["title"]);
    $Heading=$DataRows["heading"];
    $Category=$DataRows["category"];
    $Admin = $DataRows["author"];
    $DatePost=$DataRows["datetime"];
    $PostDescription = $DataRows["overview"];
    $YoutubeLink=$DataRows["ylink"];
    $Image = $DataRows["image"];
    $SeoTag=$DataRows["tag"];
    $SeoDescription=$DataRows["description"];
    $Questions = $DataRows["faq"];
    if ($Title==$PostIdFromURL) {
        $CheckUrl=1;

    }
}

if ($CheckUrl==0) {
    $_SESSION["ErrorMessage"] = "oops, no page found," ;
    Redirect_to("http://creativescienceproject.com/course");
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="png" href="images/icon/creativescienceprojectfevicon.png">
    <meta http-equiv="X-UA-Comaptible" content="IE=edge">
    <meta name="title" content="<?php echo ucfirst(strtolower($Heading)); ?> | Science Experiment | Creative Science Project">
    <meta name="description" content="<?php if($SeoDescription!=null){echo $SeoDescription;}?>">
    <meta name="keywords" content="<?php echo $SeoTag;?>">
    <meta name="robots" content="index, follow">
<meta property="og:url" content="https://creativescienceproject.com/post/<?php echo $_GET["topic"]?>" />
<meta property="og:title" content="<?php echo ucfirst(strtolower($Heading)); ?> | Science Experiment | Creative Science Project" />
<meta property="og:description" content="<?php if($SeoDescription!=null){echo $SeoDescription;}?>" />
<meta property="og:image" content="https://creativescienceproject.com/uploads/<?php echo $Image;?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <base href="/csp/">

    <meta name="revisit-after" content="1 days">
    <meta name="author" content="creative science project">
    <title><?php echo ucfirst(strtolower($Heading)); ?> | Science Experiment | Creative Science Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script>
        $(window).on('scroll', function() {
            if ($(window).scrollTop()) {
                $('nav').addClass('black');
            } else {
                $('nav').removeClass('black');
            }
        })
    </script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-6PWLKZ16SZ');
</script>
</head>
<style type="text/css">
    .si-border-round {
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        border-radius: 50%;
    }
.gsc-search-button-v2 {
    font-size: 0;
    padding: 6px 27px;
    width: auto;
    vertical-align: middle;
    border: 1px solid #666;
    border-radius: 2px;
    border-color: #3c334a!important;
    background-color: #291b2c!important;
    background-image: linear-gradient(top, #4d90fe, #4787ed);
}
.gsc-input-box {
    border: 1px solid #000000!important;
    background: #fff;
}
    .social-icon-sm {
        margin: 0 5px 5px 0;
        width: 30px;
        height: 30px;
        font-size: 18px;
        line-height: 30px !important;
        color: #555;
        text-shadow: none;
        border-radius: 3px;
        overflow: hidden;
        display: block;
        float: left;
        text-align: center;
        border: 1px solid #AAA;
    }

    .tabs-admin>.nav-item>.nav-link.active {
        border-color: #0073ff;
        color: #0073ff;
    }

    .tabs-admin>.nav-item>.nav-link {
        padding: 10px 15px;
        color: #555;
        font-weight: 600;
        text-transform: capitalize;
        margin-bottom: -2px;
        border-bottom: 2px solid transparent;
    }

    .act-content span.text-small {
        display: block;
        color: #999;
        margin-bottom: 10px;
        font-size: 12px;
    }

    .text-small {
        font-size: 12px !important;
    }

    .admin-tab-content {

    }

    .pt30 {
        padding-top: 30px !important;
    }

    .card .card-title {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        min-height: 28px;
        margin: 0;
        font-size: .9rem;
        font-weight: 600;
        line-height: 28px;
    }

    .mb20 {
        margin-bottom: 20px !important;
    }

    .pb20 {
        padding-bottom: 20px !important;
    }

    .pt20 {
        padding-top: 20px !important;
    }

    .text-small {
        font-size: 12px !important;
    }

    .text-muted {
        color: #999 !important;
    }

    .card .card-content {
        padding: 15px 15px;
    }

    .profile-header {
        background-size: cover;
        position: relative;
        overflow: hidden;
    }

    .profile-header .img-fluid.rounded-circle {
        max-width: 100px;
        margin: 0 auto;
        margin-bottom: 20px;
        display: block;
    }

    .activity-list>li {
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .activity-list .float-left {
        margin-right: 10px;
        width: 40px;
        height: 40px;
        float: left;
        display: block;
        border-radius: 50%;
        background-color: #eee;
        font-size: 20px;
        line-height: 100%;
        line-height: 43px;
        text-align: center;
    }

    .activity-list .float-left a {
        display: inline-block;
        color: #999;
    }

    .act-content {
        overflow: hidden;
    }

    .act-content span.text-small {
        display: block;
        color: #999;
        margin-bottom: 10px;
        font-size: 12px;
    }

    .w-full {
        width: 100%;
        height: 100%;
    }

    .h-\[30vh\] {
        height: 30vh;
    }

    @media (min-width: 1024px) {
        .lg\:h-\[30vh\] {
            height: 30vh;
        }
    }

    @media (min-width: 1280px) {
        .xl\:h-\[70vh\] {
            height: 60vh;
        }
    }

    .tabbable-panel {
        padding: 10px;
    }

    .tabbable-line>.nav-tabs {
        border: none;
        margin: 0px;
    }

    .tabbable-line>.nav-tabs>li {
        margin-right: 2px;
        background-color: #dddddd00;
    }

    .tabbable-line>.nav-tabs>li>a {
        border: 0;
        margin-right: 14px;
        margin-left: 14px;
        font-size: larger;
        font-weight: bold;
        color: #333333;
    }

    .tabbable-line>.nav-tabs>li>a>i {

    }

    .tabbable-line>.nav-tabs>li.open,
    .tabbable-line>.nav-tabs>li:hover {}

    .tabbable-line>.nav-tabs>li.open>a,
    .tabbable-line>.nav-tabs>li:hover>a {
        border: 0;
        background: none !important;
        color: #333333;
    }

    .tabbable-line>.nav-tabs>li.open>a>i,
    .tabbable-line>.nav-tabs>li:hover>a>i {

    }

    .tabbable-line>.nav-tabs>li.open .dropdown-menu,
    .tabbable-line>.nav-tabs>li:hover .dropdown-menu {
        margin-top: 0px;
    }

    .tabbable-line>.nav-tabs>li.active {

        position: relative;
    }

    .tabbable-line>.nav-tabs>li.active>a {
        border: 0;
        color: #333333;
    }

    .tabbable-line>.nav-tabs>li.active>a>i {
        color: #404040;
    }

    .tabbable-line>.tab-content {
        margin-top: -3px;
        background-color: #fff;
        border: 0;
        border-top: 1px solid #eee;
        padding: 15px 0;
    }

    .portlet .tabbable-line>.tab-content {
        padding-bottom: 0;
    }

    .profile-header a {
        text-decoration: none;
        color: black;
        margin-left: 0px;
        width: 100%;
        padding-top: 4px;
        padding-bottom: 4px;
        border-bottom: 1px solid black;
    }

    .profile-header a:hover {
        color: black;
        background-color: silver;
    }

    table {}

    th,
    td {
        text-align: left;
        padding: 8px;
    }
   
    .nav-tabs{
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: nowrap;
    padding-left: 0;
    overflow-x: scroll;
    margin-bottom: 0;
    list-style: none;

    }
    .nav-tabs::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.nav-tabs {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
.post-container li{
    margin-left: 25px;
}
</style>
<body>
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0" nonce="KPPGjILu"></script>
    <!-- Navigation Bar -->
    <header id="header"> <?php
    require_once("includes/navbar.php");
?> </header>
<div class="jumbotron mb-0 p-md-5 text-light" style="border-radius: 0px;background-color:#291b2c">
    <div class="col-md-12 px-0">
        <h3 class="display-5 text-center font-weight-bold animate__animated animate__bounceInLeft"> <?php echo strtoupper($Category) ?> PRACTICAL | <span class="text-secondary"> <?php echo strtoupper($Heading);?> </span>
        </h3>
         <nav aria-label="breadcrumb"class="row d-flex justify-content-center align-content-center"style="padding: 0.75rem 0rem 0rem 0rem;">
  <ol class="breadcrumb"style="background-color: transparent;padding: 0.75rem 0rem 0rem 0rem!important;">
    <li class="breadcrumb-item"><a href="topic/<?php echo str_replace(' ', '-', ($Category)); ?>"class="text-light"><?php echo $Category; ?> </a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $Heading;?></li>
  </ol>
</nav>
    </div>
</div>
<div class="container-fluid my-4">
    <div class="row">
        <div class="col-md-8 mb30">
            <div class="card">
                <div class="p-3">
                    <h1 style="font-size: x-large;"> <?php if($Category!='DIY'){ echo strtoupper('Science Experiment on '.ucfirst(strtolower($Heading)));}
                    else{
                        echo 'Project on '.ucfirst(strtolower($Heading));
                    }?> </h1>
                    <span class="text-small">Published on <?php echo $DatePost=date("Y:m:d",strtotime($DatePost));?> by <?php echo $Admin; ?> </span>
                    <div class="text-center clearfix pt-3">
                        <a href="https://www.facebook.com/share.php?u=https://www.creativescienceproject.com/post.php/
                        <?php echo $Title;?> " target='_blank' class="social-icon-sm si-border si-facebook si-border-round">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="#" class="social-icon-sm si-border si-twitter si-border-round">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon-sm si-border si-g-plus si-border-round">
                        <i class="fa fa-google-plus"></i>
                    </a>
                    <a href="#" class="social-icon-sm si-border si-skype si-border-round">
                        <i class="fa fa-skype"></i>
                    </a>
                    </div> <?php
                    if ($YoutubeLink!=null) {
                        ?>
                        <!-- Tab panes -->
                        <div class="tab-content admin-tab-content pt30">
                            <div role="tabpanel" class="tab-pane active show" id="t1">
                                <ul class="activity-list list-unstyled">
                                    <li class="clearfix ml-0">
                                        <div class="h-[30vh] lg:h-[30vh] mx-auto xl:h-[70vh]">
                                            <iframe width="1520" height="549" src="
                                            <?php echo $YoutubeLink;?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" class="w-full" allowfullscreen>
                                        </iframe>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabbable-panel">
                                <div class="tabbable-line">
                                    <ul class="container nav nav-tabs mb-2">
                                        <li class="active ml-0">
                                            <a href="#tab_default_1" data-toggle="tab"> Overview </a>
                                        </li>
                                        <li>
                                            <a href="#tab_default_2" data-toggle="tab"> Q&A </a>
                                        </li>
                                        <li class="">
                                            <a href="#tab_default_3" data-toggle="tab"> Downloads </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content container-fluid">
                                        <div class="tab-pane active" style="color:#524b4b" id="tab_default_1">
                                            <div class=" container-md post-container table-responsive" style="color: #524b4b;"> <?php if ($PostDescription!= null) {
                                                ?><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1034088896081627"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-1034088896081627"
     data-ad-slot="4267663166"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?php 
                                               echo "$PostDescription";}else {?><p>
                                                <h5>No Overview found for this post</h5>
                                            </p><?php } ?> </div>
                                        </div>
                                        <div class="tab-pane" id="tab_default_2">
                                            <h4>Discussions:  </h4>
                                            <div style="color: #524b4b"> <?php echo $Questions; ?> </div>
                                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1034088896081627"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-1034088896081627"
     data-ad-slot="4267663166"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
                                            <div class="fb-comments" data-href="https://creativescienceproject.com/post/<?php echo str_replace(' ', '-', strtolower($Title));?>" data-width="" data-numposts="5"></div><br>
                                        </div>
                                        <div class="tab-pane" id="tab_default_3">
                                            <h4> Downloads</h4>
                                            <p>
                                                <h5>No Downloadable files found for this post</h5>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div> <?php } 
                        else{ 
                            if($Image!=null){
                                ?>
                                <img src="uploads/<?php echo $Image;?>"width="100%"class="pt-3">
                                <?php
                            }
                            echo $PostDescription;?><br><?php
                            echo $Questions;
                        }?>
                    </div>
                    </div> <?php
                    $sql="SELECT * FROM post WHERE (id<'$PostId') AND (category='$Category') ORDER BY id ASC";
                    $stmt = $ConnectingDb->query($sql);
                    if ($DataRows = $stmt->fetch()) {
                        $title=$DataRows['title'];
                    ?> <a href="post/<?php echo str_replace(' ', '-', strtolower($title)); ?>" class="py-3 ">
                    <button type="button" class="btn btn-primary"style="background-color:#291b2c">
                        <i class="fa fa-angle-double-left"></i> Previous </button>
                        </a> <?php } ?> <?php
                        $sql="SELECT * FROM post WHERE (id>'$PostId') AND (category='$Category') ORDER BY id ASC";
                        $stmt = $ConnectingDb->query($sql);
                        if ($DataRows = $stmt->fetch()) {
                            $title=$DataRows['title'];
                        ?> <a href="post/<?php echo str_replace(' ', '-', strtolower($title)); ?>" class="px-3 py-3 ">
                        <button type="button" class="btn btn-primary"style="background-color:#291b2c"> Next <i class="fa fa-angle-double-right"></i>
                        </button>
                        </a> <?php } ?>
                    </div>
                    <div class="col-md-4 mb30">
                        <div class="card">
                            <div class="card-content pt20 pb20 profile-header">
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1034088896081627"
     crossorigin="anonymous"></script>
<!-- for sidebar -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1034088896081627"
     data-ad-slot="2887751434"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script><?php
                            $sql = "SELECT p.course_category_id FROM post p WHERE p.title='$PostIdFromURL'";
                            $stmt = $ConnectingDb->query($sql);

                            while ($DataRows = $stmt->fetch()) {

                                $Category_Id = $DataRows["course_category_id"];
                            }
                            $sql = "SELECT p.* FROM post p WHERE p.course_category_id='$Category_Id'";
                            $stmt = $ConnectingDb->query($sql);

                            while ($DataRows = $stmt->fetch()) {

                                $Title = strtoupper($DataRows["title"]);
                                if ($Title !=$PostIdFromURL ) {


                                ?> <a href="post/<?php echo str_replace(' ', '-', strtolower($Title)); ?>" class="b-2 my-2 px-1">
                                    <h5 style="font-size:17px"> <?php echo ucfirst(strtolower($Title));?> </h5>
                                    </a> <?php }
                                    else{ ?> <a href="post/<?php echo str_replace(' ', '-', strtolower($Title)); ?>" class="bg-dark  b-2 my-2 px-1"style="color:white;">
                                        <h5 style="font-size:17px"> <?php echo ucfirst(strtolower($Title));?> </h5>
                                    </a> <?php }}?> </div>
                                    <!--content-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FOOTER --> <?php
                    require_once("includes/footer.php");?>
                </body>
                </html>
<? ob_start(); ?>
<?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
?>
<?php
global $ConnectingDb;

if (!isset($_GET["category"])) {
    $_SESSION["ErrorMessage"] = "Sorry, this page isn't available";
    Redirect_to("index.php");
} else {

    $PostIdFromURL = str_replace('-', ' ', ($_GET["category"]));
    if (isset($_GET["view"])) {
        $SortView = $_GET['view'];
    }
    if (isset($_GET["sub-category"])) {
        $SortSubCategory = $_GET['sub-category'];
    }
}
$sql = "SELECT c.* FROM course_category c WHERE c.title='$PostIdFromURL'";
$stmt = $ConnectingDb->query($sql);

while ($DataRows = $stmt->fetch()) {
    $CheckUrl = 0;
    $PostId = $DataRows["id"];
    $Category = $DataRows["title"];
    $Level = $DataRows["level"];
    $SeoTag = $DataRows["tag"];
    $SeoDescription = $DataRows["description"];
    if ($Category == $PostIdFromURL) {
        $CheckUrl = 1;
    }
}
if ($CheckUrl == 0) {
    $_SESSION["ErrorMessage"] = "Sorry, this page isn't available";
    Redirect_to("index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" type="png" href="images/icon/creativescienceprojectfevicon.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Comaptible" content="IE=edge">
    <meta name="title" content="<?php echo $_GET["category"]; ?> | <?php if (($_GET["category"]) == 'DIY') {
            echo 'Videos and Process | Boost your innovation';
        } else { ?>Science Experimental Video and Theory<?php } ?>">
    <meta name="description" content="<?php if ($SeoDescription != null) {
        echo $SeoDescription;
    } ?>">
    <meta name="keywords" content="<?php if ($SeoTag != null) {
        echo $SeoTag;
    } ?>">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="revisit-after" content="1 days">
    <meta name="author" content="creative science project">
    <title>
        <?php echo $_GET["category"]; ?> |
        <?php if (($_GET["category"]) == 'DIY') {
            echo 'Videos and Process | Boost your innovation';
        } else { ?>Science Experimental Video and Theory
        <?php } ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="/csp/">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script>
        $(window).on('scroll', function () {
            if ($(window).scrollTop()) {
                $('nav').addClass('black');
            } else {
                $('nav').removeClass('black');
            }
        })
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6PWLKZ16SZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-6PWLKZ16SZ');
    </script>
</head>
<style type="text/css">
    .head-container {
        margin-top: 84px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-around;
    }

    .quote {
        transform: translateY(-50px);
        width: 100%;
    }

    .card {
        border: 1px solid var(--color-three);
        margin-bottom: 20px;
        transition: border 0.1s, transform 0.3s;
    }

    .card:hover {
        border: 1px solid var(--color-two);
        -webkit-transform: translateY(-10px);
        transform: translateY(-10px);
        cursor: pointer;
    }

    .card .card-body h2 {
        color: var(--color-two);
    }

    .card img:hover {
        opacity: 0.6;
    }

    .card-p {
        color: var(--color-three);
    }

    .card-p i {
        color: var(--color-two);
        margin-right: 8px;
    }

    [data-pagination],
    [data-pagination] *,
    [data-pagination] *:before,
    [data-pagination] *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        font-kerning: auto;
    }

    [data-pagination] {
        font-size: 8pt;
        line-height: 1;
        font-weight: 400;
        font-family: 'Open Sans', 'Source Sans Pro', Roboto, 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', 'Myriad Pro', 'Segoe UI', Myriad, Helvetica, 'Lucida Grande', 'DejaVu Sans Condensed', 'Liberation Sans', 'Nimbus Sans L', Tahoma, Geneva, Arial, sans-serif;
        -webkit-text-size-adjust: 100%;
        margin: 1em auto;
        text-align: center;
        transition: font-size .2s ease-in-out;
    }

    [data-pagination] ul {
        list-style-type: none;
        display: inline;
        font-size: 100%;
        margin: 0;
        padding: .5em;
    }

    [data-pagination] ul li {
        display: inline-block;
        font-size: 100%;
        width: auto;
        border-radius: 3px;
    }

    [data-pagination]>a {
        font-size: 140%;
    }

    [data-pagination] a {
        color: #777;
        font-size: 100%;
        padding: .5em;
    }

    [data-pagination] a:focus,
    [data-pagination] a:hover {
        color: #f60;
    }

    [data-pagination] li.current {
        background: rgba(0, 0, 0, .1)
    }

    /* Disabled & Hidden Styles */
    [data-pagination] .disabled,
    [data-pagination] [hidden],
    [data-pagination] [disabled] {
        opacity: .5;
        pointer-events: none;
    }

    @media (min-width: 350px) {
        [data-pagination] {
            font-size: 10pt;
        }
    }

    @media (min-width: 500px) {
        [data-pagination] {
            font-size: 12pt;
        }
    }

    @media (min-width: 700px) {
        [data-pagination] {
            font-size: 14pt;
        }
    }

    @media (min-width: 900px) {
        [data-pagination] {
            font-size: 16pt;
        }
    }

    a {
        text-decoration: none !important;
        color: black;
    }

    a:hover {
        color: grey;
    }

    .dropbtn {
        background-color: #291b2c;
        color: white;
        padding: 9px;
        font-size: 18px;
        border: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 180%;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        width: 100%;
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
        margin-top: 45px
    }

    .dropdown:hover .dropbtn {
        background-color: #291b2cb5;
    }

    .scrollbar {
        overflow: auto;
        width: fit-content;
        /* width: 100%; */
        white-space: nowrap;
        margin-bottom: 13px;
    }

    .scrollbar a {
        display: inline-block;
        color: white;
        background: #291b2c;
        text-align: center;
        padding: 10px 15px 10px 15px;
        box-shadow: 1px 1px 1px 0px rgba(0, 0, 0, .2);
        font-size: 12px;
        margin: 5px;
        border-radius: 3px;
        text-decoration: none;

    }

    .gsc-search-button-v2 {
        font-size: 0;
        padding: 6px 27px;
        width: auto;
        vertical-align: middle;
        border: 1px solid #666;
        border-radius: 2px;
        border-color: #3c334a !important;
        background-color: #291b2c !important;
        background-image: linear-gradient(top, #4d90fe, #4787ed);
    }

    .gsc-input-box {
        border: 1px solid #000000 !important;
        background: #fff;
    }
</style>

<body>

    <!-- Navigation Bar -->
    <header id="header">


        <?php
        require_once("includes/navbar.php");
        ?>
    </header>
    <div class="jumbotron mb-0 p-md-5 text-light" style="border-radius: 0px;background-color:#291b2c">
        <div class="col-md-12 px-0">
            <h3 class="display-5 text-center font-weight-bold animate__animated animate__bounceInLeft">
                <?php echo strtoupper($PostIdFromURL);
                if ($Level == 'School' || $Level == 'school' || $Level == 'SCHOOL' || $Level == 'College' || $Level == 'college' || $Level == 'COLLEGE') {
                    echo ' PRACTICAL';
                } else {
                    echo " PROJECT'S";
                } ?>
                TOPICS
            </h3>
            <nav aria-label="breadcrumb" class="row d-flex justify-content-center align-content-center"
                style="padding: 0.75rem 0rem 0rem 0rem;">
                <ol class="breadcrumb" style="background-color: transparent;padding: 0.75rem 0rem 0rem 0rem!important;">
                    <li class="breadcrumb-item"><a href="course" class="text-light">Courses </a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo $PostIdFromURL; ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <center>
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>
    </center>
    <div class="dropdown mx-3 my-1">
        <button class="dropbtn">Sort By</button>
        <div class="dropdown-content">
            <a href="topic.php?category=<?php echo $PostIdFromURL; ?>&view=new">date added (newest)</a>
            <a href="topic.php?category=<?php echo $PostIdFromURL; ?>&view=old">date added (Oldest)</a>
            <a href="topic.php?category=<?php echo $PostIdFromURL; ?>&view=most_viewed">Most Viewed</a>
        </div>
    </div>


    <div class="container my-auto mx-auto">
        <div class="scrollbar mt-0 mx-auto">
            <?php

            $sql = "SELECT * FROM course_category WHERE title='$Category'"; //birthday-wishing-->24
            $stmt = $ConnectingDb->query($sql);
            while ($DataRows = $stmt->fetch()) {
                $CatId = $DataRows["id"]; //24
                $Category = $DataRows["title"];
            }
            $sql = "SELECT * FROM sub_category WHERE category_id='$CatId'";
            $stmt = $ConnectingDb->query($sql);

            while ($DataRows = $stmt->fetch()) {
                $SubTitle = $DataRows["sub_title"];
                ?>
                <a
                    href="topic?category=<?php echo str_replace(' ', '-', $Category) ?>&sub-category=<?php echo $SubTitle; ?>"><?php echo $SubTitle; ?></a>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card shadow">
                    <script async
                        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1034088896081627"
                        crossorigin="anonymous"></script>
                    <!-- for sidebar -->
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-1034088896081627"
                        data-ad-slot="2887751434" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
            <?php
            $sr = 0;
            if (isset($_GET["view"]) && $SortView == 'new') {
                $sql = "SELECT * FROM post WHERE category='$PostIdFromURL' ORDER BY datetime desc";
            } elseif (isset($_GET["view"]) && $SortView == 'old') {
                $sql = "SELECT * FROM post WHERE category='$PostIdFromURL' ORDER BY datetime asc";
            } elseif (isset($_GET["view"]) && $SortView == 'most_viewed') {
                $sql = "SELECT * FROM post WHERE category='$PostIdFromURL' ORDER BY view desc";
            } else {
                $sql = "SELECT * FROM post WHERE category='$PostIdFromURL'";
            }
            if (isset($_GET["sub-category"])) {
                $sql = "SELECT * FROM post WHERE sub_category='$SortSubCategory' AND category='$PostIdFromURL'";
            }
            $stmt = $ConnectingDb->query($sql);
            while ($DataRows = $stmt->fetch()) {
                $PostHeading = $DataRows["heading"];
                $PostTitle = $DataRows["title"];
                $IfVideo = $DataRows["ylink"];
                $SubCategory = $DataRows["sub_category"];
                $View = $DataRows["view"];
                $sr = 1;
                ?>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card shadow">
                        <a href="post/<?php echo str_replace(' ', '-', strtolower($PostTitle)); ?>">
                            <div class="card-body">
                                <h2 class="card-title px-0">
                                    <?php echo strtoupper($PostHeading); ?>
                                </h2>
                                <p class="card-text">
                                    <?php echo strtoupper($PostTitle); ?>
                                </p>
                            </div>
                        </a>
                        <div class="card-body card-p">
                            <div class="row">

                                <div class="col col-xs-6 ">
                                    <span class="py-1">
                                        <i class="fa fa-eye"></i>
                                        <?php echo $View; ?>
                                                </span>
                                            </div>
                                            <div class="col col-xs-6">
                                                <center><div class="bg-dark py-1 text-light"style="border-radius: 6px;"><?php if ($SubCategory==null) {
                                                    echo "Project";
                                                }
                                                else{
                                                    echo $SubCategory;
                                                } ?></div></center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        if ($sr==0) {
                            ?>
                            <div class="container my-auto mx-auto" style="height: 50vh;">
                               <center> <h1>No post yet</h1>      </center>  
                           </div>
                       <?php }?>
                   </div>
               </div>
               <?php
               require_once("includes/footer.php");?>
           </body>
           </html>
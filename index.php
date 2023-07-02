<? ob_start(); ?>
<?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php"); ?>
<?php

if (isset($_POST["submit_mail"])) {
    $Mail = $_POST["email"];
    $sql = "SELECT email FROM email";
    $stmt = $ConnectingDb->query($sql);
    while ($DataRows = $stmt->fetch()) {
        $EmailCheck = $DataRows['email'];
        if ($Mail === $EmailCheck) {
            $_SESSION["ErrorMessage"] = "Looks Like You have already subscribed";
            Redirect_to("index.php");
        }
    }
    $sql = "INSERT INTO email(datetime,email)";
    $sql .= "VALUES(:datetime,:email)";
    $stmt = $ConnectingDb->prepare($sql);
    $stmt->bindValue(':datetime', $DateTime);
    $stmt->bindValue(':email', $Mail);
    $Execute = $stmt->execute();
    if ($Execute) {
        $_SESSION["SuccessMessage"] = "Email sent sucessfully ";
        Redirect_to("index.php");
    } else {
        $_SESSION["ErrorMessage"] = "Something Went Wrong";
        Redirect_to("index.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" type="png" href="images/icon/creativescienceprojectfevicon.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Comaptible" content="IE=edge">
    <title>Creative Science Project</title>
    <meta name="desciption" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1034088896081627"
        crossorigin="anonymous"></script>
</head>
<style type="text/css">
    header.masthead {
        box-shadow: 0 0.125rem 1.25rem rgba(0, 0, 0, 0.275) !important;
        background-color: white;
        padding-top: 4rem;
        padding-bottom: 4rem;
    }

    header.masthead h1,
    header.masthead .h1 {
        font-size: 2rem;
    }

    @media (min-width: 768px) {
        header.masthead {}

        header.masthead h1,
        header.masthead .h1 {
            font-size: 3rem;
        }
    }

    .showcase .showcase-text {
        padding: 3rem;
    }

    .showcase .showcase-img {
        background-size: cover;
    }

    @media (min-width: 768px) {
        .showcase .showcase-text {
            padding: 3srem;
        }
    }

    .testimonials {
        padding-top: 7rem;
        padding-bottom: 7rem;
    }

    .testimonials .testimonial-item {
        max-width: 18rem;
    }

    .testimonials .testimonial-item img {
        max-width: 12rem;
        box-shadow: 0px 5px 5px 0px #adb5bd;
    }

    .call-to-action {
        position: relative;
        background-color: #343a40;
        background: url("../assets/img/bg-masthead.jpg") no-repeat center center;
        background-size: cover;
        padding-top: 7rem;
        padding-bottom: 7rem;
    }

    .call-to-action:before {
        content: "";
        position: absolute;
        background-color: #1c375e;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        opacity: 0.5;
    }

    footer.footer {
        padding-top: 4rem;
        padding-bottom: 4rem;
    }

    .section-head {}

    .section-head h4 {
        position: relative;
        padding: 0;
        color: #f91942;
        line-height: 1;
        letter-spacing: 0.3px;
        font-size: 34px;
        font-weight: 700;
        text-align: center;
        text-transform: none;
        margin-bottom: 30px;
    }

    .section-head h4 span {
        font-weight: 700;
        padding-bottom: 5px;
        color: #2f2f2f
    }

    p.service_text {
        color: #cccccc !important;
        font-size: 16px;
        line-height: 28px;
        text-align: center;
    }

    .section-head p,
    p.awesome_line {
        color: #818181;
        font-size: 16px;
        line-height: 28px;
        text-align: center;
    }

    .extra-text {
        font-size: 34px;
        font-weight: 700;
        color: #2f2f2f;
        margin-bottom: 25px;
        position: relative;
        text-transform: none;
    }

    .extra-text::before {
        content: '';
        width: 60px;
        height: 3px;
        background: #f91942;
        position: absolute;
        left: 0px;
        bottom: -10px;
        right: 0;
        margin: 0 auto;
    }

    .extra-text span {
        font-weight: 700;
        color: #f91942;
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

    .item {
        background: #fff;
        text-align: center;
        padding: 30px 25px;
        -webkit-box-shadow: 0 0px 25px rgba(0, 0, 0, 0.07);
        box-shadow: 0 0px 25px rgba(0, 0, 0, 0.07);
        border-radius: 20px;
        border: 5px solid rgba(0, 0, 0, 0.07);
        margin-bottom: 30px;
        -webkit-transition: all .5s ease 0;
        transition: all .5s ease 0;
        transition: all 0.5s ease 0s;
    }

    .item:hover {
        background: #f91942;
        box-shadow: 0 8px 20px 0px rgba(0, 0, 0, 0.2);
        -webkit-transition: all .5s ease 0;
        transition: all .5s ease 0;
        transition: all 0.5s ease 0s;
    }

    .item:hover .item,
    .item:hover span.icon {
        background: #fff;
        border-radius: 10px;
        -webkit-transition: all .5s ease 0;
        transition: all .5s ease 0;
        transition: all 0.5s ease 0s;
    }

    .item:hover h6,
    .item:hover p {
        color: #fff;
        -webkit-transition: all .5s ease 0;
        transition: all .5s ease 0;
        transition: all 0.5s ease 0s;
    }

    .item .icon {
        font-size: 40px;
        margin-bottom: 25px;
        color: #f91942;
        width: 90px;
        height: 90px;
        line-height: 96px;
        border-radius: 50px;
    }

    .item .feature_box_col_one {
        background: rgba(247, 198, 5, 0.20);
        color: #f91942
    }

    .item .feature_box_col_two {
        background: rgba(255, 77, 28, 0.15);
        color: #f91942
    }

    .item .feature_box_col_three {
        background: rgba(0, 147, 38, 0.15);
        color: #f91942
    }

    .item .feature_box_col_four {
        background: rgba(0, 108, 255, 0.15);
        color: #f91942
    }

    .item .feature_box_col_five {
        background: rgba(146, 39, 255, 0.15);
        color: #f91942
    }

    .item .feature_box_col_six {
        background: rgba(23, 39, 246, 0.15);
        color: #f91942
    }

    .item p {
        font-size: 15px;
        line-height: 26px;
    }

    .item h6 {
        margin-bottom: 20px;
        color: #2f2f2f;
    }

    .mission p {
        margin-bottom: 10px;
        font-size: 15px;
        line-height: 28px;
        font-weight: 500;
    }

    .mission i {
        display: inline-block;
        width: 50px;
        height: 50px;
        line-height: 50px;
        text-align: center;
        background: #f91942;
        border-radius: 50%;
        color: #fff;
        font-size: 25px;
    }

    .mission .small-text {
        margin-left: 10px;
        font-size: 13px;
        color: #666;
    }

    .skills {
        padding-top: 0px;
    }

    .skills .prog-item {
        margin-bottom: 25px;
    }

    .skills .prog-item:last-child {
        margin-bottom: 0;
    }

    .skills .prog-item p {
        font-weight: 500;
        font-size: 15px;
        margin-bottom: 10px;
    }

    .skills .prog-item .skills-progress {
        width: 100%;
        height: 10px;
        background: #e0e0e0;
        border-radius: 20px;
        position: relative;
    }

    .skills .prog-item .skills-progress span {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        background: #f91942;
        width: 10%;
        border-radius: 10px;
        -webkit-transition: all 1s;
        transition: all 1s;
    }

    .skills .prog-item .skills-progress span:after {
        content: attr(data-value);
        position: absolute;
        top: -5px;
        right: 0;
        font-size: 10px;
        font-weight: 600;
        color: #fff;
        background: rgba(0, 0, 0, 0.9);
        padding: 3px 7px;
        border-radius: 30px;
    }

    .features-icons {
        padding-top: 4rem;
        padding-bottom: 6rem;
    }

    .features-icons .features-icons-item {
        max-width: 20rem;
    }

    .features-icons .features-icons-item .features-icons-icon {
        height: 7rem;
    }

    .features-icons .features-icons-item .features-icons-icon i {
        font-size: 4.5rem;
    }

    .navbar {
        background-color: #ffffff !important;
        box-shadow: 0 0.125rem 1.25rem rgba(0, 0, 0, 0.275) !important;
    }

    .navbar-light .navbar-nav .nav-link {
        color: rgb(0 0 0 / 93%) !important;
    }

    a,
    button {
        font-family: "Montserrat", sans-serif;
        font-weight: 500;
        color: #2E3D49;
        display: block;
        text-decoration: none;
    }
</style>

<body>
    <!-- Navigation Bar -->
    <?php
    require_once("includes/navbar.php");
    ?>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container position-relative">
            <?php
            echo SuccessMessage();
            echo ErrorMessage();
            ?>
            <div class="row justify-content-center">
                <div class="col-md-8 text-center my-auto">
                    <div class="text-center text-dark">
                        <!-- Page heading-->
                        <h1 class=" mb-2">Creative Science Project, Boost Your Innovation</h1>
                        <p class="">
                            <big>Learning by doing is students' most effective and proven method of remembering and
                                understanding. At Creative Science Project we guide and help you understand the science
                                practical lessons from junior classes. DIY your projects and toys learning the science
                                behind them.</big>
                        </p>
                        <div class="d-flex justify-content-center">
                            <a href="https://creativescienceproject.com/course"><button type="button"
                                    class="btn-primary btn mx-auto"> Explore Now</button></a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-auto">
                    <div class="text-center text-white pt-3">
                        <img src="images/icon/scientist.svg" width="100%">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="features-icons text-light text-center " style="background-color: #132684">
        <div class="container">
            <div class="text-center">
                <h1>Features</h1>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <i class="fa fa-flask m-auto text-light"></i>
                        </div>
                        <h3>Science Experiment</h3>
                        <p class="lead mb-0" style="color: silver;">Explore the science experiment video from Creative
                            Science Project</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <i class="fa fa-lightbulb-o  m-auto text-light"></i>
                        </div>
                        <h3>DIY Videos</h3>
                        <p class="lead mb-0" style="color: silver;">Learn to create. Your first DIY project</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <i class="fa fa-book     m-auto text-light"></i>
                        </div>
                        <h3>Educational Article</h3>
                        <p class="lead mb-0" style="color: silver;">You can learn something new</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Image Showcases-->
    <section class="showcase" id="about">
        <div class="container-fluid p-0">
            <div class="row g-0" style="margin-right: 0px;">
                <div class="col-lg-6 text-white my-auto showcase-img my-3 ">
                    <img src="images/pic.png" style="    width: 100%;">
                </div>
                <div class="col-lg-6 order-lg-1 mx-0  showcase-text">
                    <h2>What you think about us ?</h2>
                    <p class="lead mb-0">Science education in the developing world is more focused on scoring marks
                        rather than understanding and simplifying concepts. Even in the twenty-first century, many young
                        children are deprived of practical education. The Creative Science project is initiated by Mr.
                        Laxmi Nand Dhakal to introduce young students importance of learning by doing and help them
                        understand the concept of science easily. In his thirty years of teaching experience at
                        different schools in Nepal, he found hardly a number of schools are able to run necessary
                        science practical classes to the students. The situation is almost the same in many developing
                        nations. With Creative Science Project we want to help students, teachers, and any interested
                        person to learn and DIY their own projects using science.</p>

                </div>
            </div>
        </div>
    </section>
    <center>
        <script async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1034088896081627"
            crossorigin="anonymous"></script>
        <!-- short horizontal -->
        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-1034088896081627"
            data-ad-slot="6267759096" data-ad-format="auto" data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </center>
    <div class="feat pt-5 pb-5" style="background-color: #132684;color:white;">
        <div class="container">
            <div class="row">
                <div class="section-head col-sm-12">
                    <h4>
                        <span class="text-light">Our Vision</span>
                    </h4>
                    <p class="" style="color:silver">
                        <big>Focus on STEM education is the need of modern society. Creative Science Project advocates
                            the “ Learning by Doing” approach which enhances creativity among the students. Learning is
                            fun yet most learners struggle to enjoy it. The time has come that we all to embrace the new
                            methodologies to educate students. Our aim is to encourage students and teachers that
                            science is more than just some theory and marks in the exam. Science is everywhere and
                            impacts all our daily life, using simple and readily available resources anyone can create,
                            and do experiments.</big>
                    </p>
                    <br>
                    <p class="" style="color:silver">
                        <big> Using digital platforms we want to encourage anyone interested to learn to get an idea of
                            how to use their knowledge to see a change in their day-to-day life. With the growth of the
                            project, we aim to provide necessary training and resources to the schools in the remote
                            region and encourage them to use available resources to learn and DIY their own
                            projects.</big>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Join With Us-->
    <section class="call-to-action text-white text-center" id="signup">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <h2 class="mb-4">Get Latest Update. Join us now!</h2>
                    <form class="form-subscribe" id="contactFormFooter" data-sb-form-api-token="API_TOKEN"
                        method="post">
                        <!-- Email address input-->
                        <div class="row">
                            <div class="col">
                                <input class="form-control form-control-lg" id="emailAddressBelow" type="email"
                                    placeholder="Email Address" data-sb-validations="required,email" name="email">
                                <div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:required">
                                    Email Address is required.</div>
                                <div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:email">
                                    Email Address Email is not valid.</div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit"
                                    name="submit_mail">Submit</button>
                            </div>
                        </div>
                        <div class="d-none" id="submitSuccessMessage"></div>
                        <div class="d-none" id="submitErrorMessage"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- FOOTER -->
    <?php
    require_once("includes/footer.php"); ?>
</body>

</html>
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
      Redirect_to("youtube.php");
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
    Redirect_to("youtube.php");
  } else {
    $_SESSION["ErrorMessage"] = "Something Went Wrong";
    Redirect_to("youtube.php");

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
</head>
<style type="text/css">
  body {
    background-color: black;
    font-family: 'Merriweather', serif, sans-serif;
  }

  .bg-lightgray {
    background-color: #ff6262;
  }

  .submit {
    background-color: rgba(226, 226, 93, 0.644);
  }

  .submit a {
    color: black;
  }

  .txt-black {
    color: black;
  }

  .icon {
    font-size: 5rem;
    color: rgb(206, 141, 20);
    padding: 25px;
    border: solid;
    border-radius: 100%;
  }

  .heavy-border {
    border-width: 5px;
  }

  #get-started {
    margin-top: 65px;

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


  <?php
  require_once("includes/navbar.php");
  ?>
  <center class="pt-3">
    <div class="container">
      <?php
      echo SuccessMessage();
      echo ErrorMessage();
      ?>
    </div>
  </center>
  <section id="get-started" class="container text-center p-5 mb-5 rounded bg-lightgray">

    <div class="row d-flex justify-content-center">
      <div class="col-10 col-sm-8">
        <p class="h1">See All Videos In YouTube</p>

      </div>
    </div>
  </section>

  <!--features-->
  <section id="features">
    <div class="container mb-5">
      <div class="row">
        <div class="col-4 d-flex justify-content-center align-items-center bg-light">
          <i class="fa fa-flask icon"></i>
        </div>
        <div class="col-8 border p-3">
          <h2 class="text-light">Science Experiment</h2>
          <p class="text-muted">Learning Science Experiment helps you to understand better. Get access to all the videos
            on our channel. Don't forget to like, subscribe and share among your friends.</p>
          <a href="https://www.youtube.com/c/CreativeScienceProject"> <button type="btn"
              class="btn btn-outline-light">Click Here</button></a>
        </div>
      </div>
    </div>
    <div class="container mb-5">
      <div class="row">
        <div class="col-4 d-flex justify-content-center align-items-center bg-light">
          <i class="fa fa-lightbulb-o icon"></i>
        </div>
        <div class="col-8 border p-3">
          <h2 class="text-light">DIY Creativity</h2>
          <p class="text-muted">learn to create things understanding the science behind them. DIY shows a real-life
            implementation of the science to help boost your creativity and confidence of the subject.</p>
          <a href="https://www.youtube.com/channel/UC1EpJx6hreIcyXcTc6TAlSA"> <button type="btn"
              class="btn btn-outline-light">Click Here</button></a>

        </div>
      </div>
    </div>
  </section>
  <section id="how-it-works">
    <div class="container  mb-5">
      <div class="row d-flex justify-content-center">
        <div class="col-10 col-md-8">
          <iframe id="video" height="350" width="100%"
            src="https://www.youtube-nocookie.com/embed/videoseries?start=120&amp;list=PL2prSejOMN3_DF665xc5f31tZDja5wnyE"
            frameborder="0" allowfullscreen=""></iframe>
        </div>
      </div>
    </div>
  </section>


  <!-- Call to Action-->
  <section class="call-to-action text-white text-center" id="signup">
    <div class="container position-relative">
      <div class="row justify-content-center">
        <div class="col-xl-6">
          <h2 class="mb-4">Get Latest Update. Join us now!</h2>
          <form class="form-subscribe" id="contactFormFooter" data-sb-form-api-token="API_TOKEN" method="post">
            <!-- Email address input-->
            <div class="row">
              <div class="col">
                <input class="form-control form-control-lg" id="emailAddressBelow" type="email"
                  placeholder="Email Address" data-sb-validations="required,email" name="email">
                <div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:required">Email Address is
                  required.</div>
                <div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:email">Email Address Email
                  is not valid.</div>
              </div>
              <div class="col-auto"><button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit"
                  name="submit_mail">Submit</button></div>
            </div>

            <div class="d-none" id="submitSuccessMessage">

            </div>

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
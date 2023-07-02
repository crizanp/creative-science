<? ob_start(); ?> <?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
?>
<?php
if(isset($_POST["submit_mail"])){
  $Mail=$_POST["email"];
   $sql="SELECT email FROM email";
   $stmt=$ConnectingDb->query($sql);
   while ($DataRows=$stmt->fetch()) {
    $EmailCheck=$DataRows['email'];
     if ( $Mail===$EmailCheck) {
 $_SESSION["ErrorMessage"]="Looks Like You have already subscribed";
     Redirect_to("courses.php");
  }
  }
  $sql="INSERT INTO email(datetime,email)";
    $sql .="VALUES(:datetime,:email)";
    $stmt=$ConnectingDb->prepare($sql);
    $stmt->bindValue(':datetime',$DateTime);
    $stmt->bindValue(':email',$Mail);
    $Execute=$stmt->execute();
    if ($Execute) {
     $_SESSION["SuccessMessage"]="Email sent sucessfully ";
     Redirect_to("courses.php");
   }
   else
   {
     $_SESSION["ErrorMessage"]="Something Went Wrong";
     Redirect_to("courses.php");
   }
}
 ?> <style type="text/css">
	
</style>
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
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/script.js"></script>
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
		<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6PWLKZ16SZ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
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
		.call-to-action {
		position: relative;
		background-size: cover;
		padding-top: 7rem;
		padding-bottom: 7rem;
	}

	.call-to-action:before {
		content: "";
		position: absolute;
		background-color: #7c5784;
		height: 100%;
		width: 100%;
		top: 0;
		left: 0;
		opacity: 1;
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
.Marquee{
  background:linear-gradient(-135deg, #291b2c, hsl(232deg 57% 22%));
  box-sizing :border-box;
/*  padding :0.5em;
*/  color: white;
  font-weight: 200;
  display: flex;
  align-items :center;
  overflow: hidden;
}

  .Marquee-content{
    display: flex;
    animation :marquee 10s linear infinite running;
}
   .Marquee-content:hover{
      animation-play-state :paused;
   }

  .Marquee-content .Marquee-tag{
    width: 200px;
    margin :0 .5em;
    padding: .5em;
    background: rgba(255, 255, 255, .1);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition :all .2s ease;}
   .Marquee-content .Marquee-tag:hover{
      transform :scale(1.1);
      cursor: pointer;
      color: silver;
  }
    
    
@keyframes marquee{
  0%{
    transform :translateX(0)}
  100%{
    transform: translate(-50%)}}

	</style>
	<body>
		<!-- Navigation Bar -->
		<header id="header"> <?php
		require_once("includes/navbar.php");
		?> </header>
<h5 class="mt-4 mx-3">Latest Post:</h5>
		<div class="Marquee ">
  <div class="Marquee-content">
  	 <?php 

     $sql="SELECT * FROM post ORDER BY id DESC LIMIT 0,10 ";//birthday-wishing-->24
     $stmt=$ConnectingDb->query($sql);
     while ($DataRows=$stmt->fetch()) {
                    $Heading=$DataRows["heading"];
                    $Title=$DataRows["title"];
                ?>
   <a href="post/<?php echo str_replace(' ', '-', strtolower($Title));?>" style="text-decoration: none;color: white;"> <div class="Marquee-tag"><?php  echo substr($Heading, 0,13)."..."; ?></div></a>
    <?php }?>
  </div>
</div>
		<center class="container mt-4"> <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?> </center>
		<div class="head-container container">
			<div class="quote">
				<h1 style="font-size:27px;">Accelerate Your Intellegence Through Creative Science Project DIY</h1>
				<p>learn to create things understanding the science behind them. DIY shows a real-life implementation of the science to help boost your creativity and confidence of the subject.</p>
				<div class="button py-2">
					<a class="btn btn-dark btn-md" href="topic/
														<?php echo "DIY";?>" target="_blank">Explore Now <i class="fa fa-globe pl-2"></i>
					</a>
				</div>
			</div>
		</div>
		<div class="jumbotron mb-0 p-md-5 text-light" style="border-radius: 0px;background-color:#291b2c">
			<div class="col-md-12 px-0">
				<h3 class="display-5 text-center font-weight-bold animate__animated animate__bounceInLeft">CLASSWISE CATEGORIES</h3>
				<nav aria-label="breadcrumb"class="row d-flex justify-content-center align-content-center"style="padding: 0.75rem 0rem 0rem 0rem;">
  <ol class="breadcrumb"style="background-color: transparent;padding: 0.75rem 0rem 0rem 0rem!important;">
    <li class="breadcrumb-item"><a href="home"class="text-light">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Courses</li>
  </ol>
</nav>
			</div>
		</div>
		<!-- Some Popular Subjects -->
		<div class="course" style="background-color: #e7ecf2!important;">
			<div class="py-4 m-0">
				<div class="title">
					<center>
						<p style="font-size: 25px;color: #ff2c2c;font-weight: bold;">School Level</p>
					</center>
				</div>
				<br>
				<center>
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
<br/>
					<div class="cbox"> <?php
			global $ConnectingDb;
			$sql = "SELECT * FROM course_category";
			$stmt = $ConnectingDb->query($sql);
			while ($DataRows = $stmt->fetch()) {
				$CategoryId = $DataRows["id"];
				$Title = $DataRows["title"];
				$Admin = $DataRows["author"];
				$DateTime=$DataRows["datetime"];
				$Level=$DataRows["level"];
				$Status=$DataRows["visible"];
				if (($Level=="School" || $Level=="school" || $Level=="SCHOOL")  && $Status == 1) {
					?> <div class="det">
							<a href="topic/<?php echo str_replace(' ', '-', ($Title));?>">
							<i class="fa fa-book" style="font-size:20px;"></i> <?php  echo'&nbsp;&nbsp; '.$Title;
					?> </a>
						</div> <?php
				}
				?> <?php }?> </div>
				</center>
			</div>
			<div class="course" style="background-color: #e7ecf2!important;">
				<div class="py-4">
					<div class="title">
						<center>
							<p style="font-size: 25px;color: #ff2c2c;">
								<b>Coming Soon</b>
							</p>
						</center>
					</div>
					<br>
					<center>
						<div class="cbox"> <?php
			$sql = "SELECT * FROM course_category";
			$stmt = $ConnectingDb->query($sql);
			while ($DataRows = $stmt->fetch()) {
				$CategoryId = $DataRows["id"];
				$Title = $DataRows["title"];
				$Admin = $DataRows["author"];
				$DateTime=$DataRows["datetime"];
				$Level=$DataRows["level"];
				$Status=$DataRows["visible"];
				$LinkUnlink=$DataRows["link_unlink"];
				if (($Level=="College" || $Level=="college" || $Level=="COLLEGE") && $Status == 1) {
					?> <div class="det"> <?php if($LinkUnlink==1){ ?> <a href="topic/
																				<?php echo str_replace(' ', '-', $Title);?>"> <?php }elseif ($LinkUnlink==0) {
					 ?> <a href="javascript:void(0)"> <?php } ?> <?php  echo $Title;
					?> </a>
							</div> <?php
				}
				?> <?php }?> </div>
				</div>
			</div>
			</center>
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
										<input class="form-control form-control-lg" id="emailAddressBelow" type="email" placeholder="Email Address" data-sb-validations="required,email" name="email">
										<div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:required">Email Address is required.</div>
										<div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:email">Email Address Email is not valid.</div>
									</div>
									<div class="col-auto">
										<button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit" name="submit_mail">Submit</button>
									</div>
								</div>
								<div class="d-none" id="submitSuccessMessage"></div>
								<div class="d-none" id="submitErrorMessage"></div>
							</form>
						</div>
					</div>
				</div>
			</section>
			<!-- FOOTER --> <?php
	require_once("includes/footer.php");?>
	</body>
</html>
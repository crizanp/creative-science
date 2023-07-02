<? ob_start(); ?>
<?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
?>
<?php
if (isset($_POST["submit_mail"])) {
	$Mail = $_POST["email"];
	$sql = "SELECT email FROM email";
	$stmt = $ConnectingDb->query($sql);
	while ($DataRows = $stmt->fetch()) {
		$EmailCheck = $DataRows['email'];
		if ($Mail === $EmailCheck) {
			$_SESSION["ErrorMessage"] = "Looks Like You have already subscribed";
			Redirect_to("courses.php");
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
		Redirect_to("courses.php");
	} else {
		$_SESSION["ErrorMessage"] = "Something Went Wrong";
		Redirect_to("courses.php");
	}
}
?>
<style type="text/css">

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
	<base href="https://www.creativescienceproject.com/">
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

	.Marquee {
		background: linear-gradient(-135deg, #291b2c, hsl(232deg 57% 22%));
		box-sizing: border-box;
		/*  padding :0.5em;
*/
		color: white;
		font-weight: 200;
		display: flex;
		align-items: center;
		overflow: hidden;
	}

	.Marquee-content {
		display: flex;
		animation: marquee 10s linear infinite running;
	}

	.Marquee-content:hover {
		animation-play-state: paused;
	}

	.Marquee-content .Marquee-tag {
		width: 200px;
		margin: 0 .5em;
		padding: .5em;
		background: rgba(255, 255, 255, .1);
		display: inline-flex;
		align-items: center;
		justify-content: center;
		transition: all .2s ease;
	}

	.Marquee-content .Marquee-tag:hover {
		transform: scale(1.1);
		cursor: pointer;
		color: silver;
	}


	@keyframes marquee {
		0% {
			transform: translateX(0)
		}

		100% {
			transform: translate(-50%)
		}
	}
</style>

<body>
	<div class="jumbotron mb-0 p-md-5 text-light" style="border-radius: 0px;background-color:darkred;">
		<div class="col-md-12 px-0">
			<h3 class="display-5 text-center font-weight-bold animate__animated animate__bounceInLeft">OOPS!!! The
				Requested URL is not Found (:</h3>
			<div class="row d-flex justify-content-center align-content-center pt-3"><a
					href="https://creativescienceproject.com"><button type="button" class="btn-danger btn mx-auto"> Back
						to homepage</button></a></div>
		</div>
	</div>
	<!-- Some Popular Subjects -->
	<div class="course" style="background-color: #e7ecf2!important;">
		<div class="py-4 m-0">
			<div class="title">
				<center>
					<p style="font-size: 25px;color: #ff2c2c;font-weight: bold;">Also Browse Category</p>
				</center>
			</div>
			<br>
			<center>
				<div class="cbox">
					<?php
					global $ConnectingDb;
					$sql = "SELECT * FROM course_category";
					$stmt = $ConnectingDb->query($sql);
					while ($DataRows = $stmt->fetch()) {
						$CategoryId = $DataRows["id"];
						$Title = $DataRows["title"];
						$Admin = $DataRows["author"];
						$DateTime = $DataRows["datetime"];
						$Level = $DataRows["level"];
						$Status = $DataRows["visible"];
						if (($Level == "School" || $Level == "school" || $Level == "SCHOOL") && $Status == 1) {
							?>
							<div class="det">
								<a href="topic/<?php echo str_replace(' ', '-', ($Title)); ?>">
									<i class="fa fa-book" style="font-size34px;color:red"></i>
									<?php echo '&nbsp &nbsp' . $Title;
									?>
								</a>
							</div>
							<?php
						}
						?>
					<?php } ?>
				</div>
			</center>
		</div>

		</center>
		<!-- Call to Action-->
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
									<div class="invalid-feedback text-white"
										data-sb-feedback="emailAddressBelow:required">Email Address is required.</div>
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
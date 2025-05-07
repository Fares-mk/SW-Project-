<?php
require_once '../controllers/EducationController.php';
$educationController = new EducationController();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_education'])) {
        $institution = $_POST['institution'];
        $field = $_POST['field'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $description = $_POST['description'];
        $educationController->addEducation($institution, $field, $start_date, $end_date, $description);
    } elseif (isset($_POST['update_education'])) {
        $id = $_POST['education_id'];
        $institution = $_POST['institution'];
        $field = $_POST['field'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $description = $_POST['description'];
        $educationController->updateEducation($id, $institution, $field, $start_date, $end_date, $description);
    } elseif (isset($_POST['delete_education'])) {
        $id = $_POST['education_id'];
        $educationController->delete($id);
    }
}

// Get all education entries for display
$education = $educationController->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Winku Social Network Toolkit</title>
    <link rel="icon" href="../images/fav.png" type="image/png" sizes="16x16"> 
    
    <link rel="stylesheet" href="../css/main.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/color.css">
    <link rel="stylesheet" href="../css/responsive.css">

</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	
	<div class="responsive-header">
		<div class="mh-head first Sticky">
			<span class="mh-btns-left">
				<a class="" href="#menu"><i class="fa fa-align-justify"></i></a>
			</span>
			<span class="mh-text">
				<a href="index.html" title=""><img src="../images/logo2.png" alt=""></a>
			</span>
			<span class="mh-btns-right">
				<a class="fa fa-sliders" href="#shoppingbag"></a>
			</span>
		</div>
		<div class="mh-head second">
			<form class="mh-form">
				<input placeholder="search" />
				<a href="#/" class="fa fa-search"></a>
			</form>
		</div>
		<nav id="menu" class="res-menu">
			<ul>
				<li><span>Home</span>
					<ul>
						<li><a href="index.php" title="">Home Social</a></li>
						<li><a href="landing.php" title="">Login page</a></li>
						<li><a href="logout.php" title="">Logout Page</a></li>
					</ul>
				</li>
				<li><span>Time Line</span>
					<ul>
						<li><a href="time-line.php" title="">timeline</a></li>
						<li><a href="timeline-friends.php" title="">timeline friends</a></li>
						<li><a href="timeline-groups.php" title="">timeline groups</a></li>
						<li><a href="timeline-pages.php" title="">timeline pages</a></li>
						<li><a href="timeline-photos.php" title="">timeline photos</a></li>
						<li><a href="timeline-videos.php" title="">timeline videos</a></li>
						<li><a href="groups.php" title="">groups page</a></li>
						<li><a href="page-likers.php" title="">Likes page</a></li>
					</ul>
				</li>
				<li><span>Account Setting</span>
					<ul>
						<li><a href="edit-account-setting.php" title="">edit account setting</a></li>
						<li><a href="edit-skills.php" title="">edit skills</a></li>
						<li><a href="edit-password.php" title="">edit-password</a></li>
						<li><a href="edit-profile-basic.php" title="">edit profile basics</a></li>
						<li><a href="edit-work-eductation.php" title="">edit work educations</a></li>
					</ul>
				</li>
				</li>
				<li><span>forum</span>
					<ul>
						<li><a href="forum-open-topic.php" title="">Forum Open Topic</a></li>
					</ul>
				</li>

				<li><span>Support & Help</span>
					<ul>
						<li><a href="support-and-help.php" title="">Support & Help</a></li>
						<li><a href="support-and-help-detail.php" title="">Support & Help Detail</a></li>
						<li><a href="support-and-help-search-result.php" title="">Support & Help Search Result</a></li>
					</ul>
				</li>
				<li><span>More pages</span>
					<ul>
						<li><a href="404-2.php" title="">404 error page</a></li>
						<li><a href="about.php" title="">about</a></li>
						<li><a href="contact.php" title="">contact</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div><!-- responsive header -->
	
	<div class="topbar stick">
		<div class="logo">
			<a title="" href="index.html"><img src="../images/logo.png" alt=""></a>
		</div>
		
		<div class="top-area">
			<ul class="main-menu">
				<li>
					<a href="#" title="">Home</a>
					<ul>
						<li><a href="index.php" title="">Home Social</a></li>
						<li><a href="landing.php" title="">Login page</a></li>
						<li><a href="logout.php" title="">Logout Page</a></li>
					</ul>
				</li>
				<li>
					<a href="#" title="">timeline</a>
					<ul>
						<li><a href="time-line.php" title="">timeline</a></li>
						<li><a href="timeline-friends.php" title="">timeline friends</a></li>
						<li><a href="timeline-groups.php" title="">timeline groups</a></li>
						<li><a href="timeline-pages.php" title="">timeline pages</a></li>
						<li><a href="timeline-photos.php" title="">timeline photos</a></li>
						<li><a href="timeline-videos.php" title="">timeline videos</a></li>
						<li><a href="groups.php" title="">groups page</a></li>
						<li><a href="page-likers.php" title="">Likes page</a></li>
					</ul>
				</li>
				<li>
					<a href="#" title="">account settings</a>
					<ul>
						<li><a href="edit-account-setting.php" title="">edit account setting</a></li>
						<li><a href="edit-skills.php" title="">edit skills</a></li>
						<li><a href="edit-password.php" title="">edit-password</a></li>
						<li><a href="edit-profile-basic.php" title="">edit profile basics</a></li>
						<li><a href="edit-work-eductation.php" title="">edit work educations</a></li>
					</ul>
				</li>
				<li><span>forum</span>
					<ul>
						<li><a href="forum-open-topic.php" title="">Forum Open Topic</a></li>
					</ul>
				</li>
				<li>
					<a href="#" title="">more pages</a>
					<ul>
						<li><a href="404-2.php" title="">404 error page</a></li>
						<li><a href="about.php" title="">about</a></li>
						<li><a href="contact.php" title="">contact</a></li>
					</ul>
				</li>
			</ul>
			<ul class="setting-area">
				<li>
					<a href="#" title="Home" data-ripple=""><i class="ti-search"></i></a>
					<div class="searched">
						<form method="post" class="form-search">
							<input type="text" placeholder="Search Friend">
							<button data-ripple><i class="ti-search"></i></button>
						</form>
					</div>
				</li>
			</ul>
			<span class="ti-menu main-menu" data-ripple=""></span>
		</div>
	</div>
	<!-- topbar -->
	
	<section>
			<div class="feature-photo">
				<figure><img src="../images/resources/timeline-1.jpg" alt=""></figure>
				<div class="add-btn">
					<span>1205 followers</span>
					<a href="#" title="" data-ripple="">Add Friend</a>
				</div>
				<form class="edit-phto">
					<i class="fa fa-camera-retro"></i>
					<label class="fileContainer">
						Edit Cover Photo
					<input type="file"/>
					</label>
				</form>
				<div class="container-fluid">
					<div class="row merged">
						<div class="col-lg-2 col-sm-3">
							<div class="user-avatar">
								<figure>
									<img src="../images/resources/user-avatar.jpg" alt="">
									<form class="edit-phto">
										<i class="fa fa-camera-retro"></i>
										<label class="fileContainer">
											Edit Display Photo
											<input type="file"/>
										</label>
									</form>
								</figure>
							</div>
						</div>
						<div class="col-lg-10 col-sm-9">
							<div class="timeline-info">
								<ul>
									<li class="admin-name">
										<h5>Janice Griffith</h5>
										<span>Group Admin</span>
									</li>
									<li>
										<a class="" href="time-line.html" title="" data-ripple="">time line</a>
										<a class="" href="timeline-photos.html" title="" data-ripple="">Photos</a>
										<a class="" href="timeline-videos.html" title="" data-ripple="">Videos</a>
										<a class="" href="timeline-friends.html" title="" data-ripple="">Friends</a>
										<a class="" href="groups.html" title="" data-ripple="">Groups</a>
										<a class="" href="about.html" title="" data-ripple="">about</a>
										<a class="active" href="#" title="" data-ripple="">more</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- top area -->

	<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="row" id="page-contents">
							<div class="col-lg-3">
								<aside class="sidebar static">
									<div class="widget">
										<h4 class="widget-title">Edit Profile</h4>
										<ul class="naves">
											<li>
												<i class="ti-clipboard"></i>
												<a href="edit-skills.php" title="">Skills</a>
											</li>
											<li>
												<i class="ti-book"></i>
												<a href="edit-work-eductation.php" title="">Education</a>
											</li>
											<li>
												<i class="ti-briefcase"></i>
												<a href="edit-Experience.php" title="">Experience</a>
											</li>
											<li>
												<i class="ti-world"></i>
												<a href="edit-Language.php" title="">Languages</a>
											</li>
										</ul>
									</div>
								</aside>
							</div><!-- sidebar -->
							<div class="col-lg-6">
								<div class="central-meta">
									<div class="editing-info">
										<h5 class="f-title"><i class="ti-info-alt"></i> Edit Education</h5>

										<form method="post">
											<div class="form-group">
												<label for="institution">Studying at</label>
												<input type="text" class="form-control" id="institution" name="institution" required>
											</div>
											<div class="form-group">
												<label for="field">Field of Study</label>
												<input type="text" class="form-control" id="field" name="field" required>
											</div>
											<div class="form-group">
												<label for="start_date">Start Date</label>
												<input type="date" class="form-control" id="start_date" name="start_date" required>
											</div>
											<div class="form-group">
												<label for="end_date">End Date</label>
												<input type="date" class="form-control" id="end_date" name="end_date">
											</div>
											<div class="form-group">
												<label for="description">Description</label>
												<textarea class="form-control" id="description" name="description" rows="3"></textarea>
											</div>
											<button type="submit" name="add_education" class="btn btn-primary">Add Education</button>
										</form>

										<div class="education-list mt-4">
											<h5>Your Education</h5>
											<?php if (empty($education)): ?>
												<p class="text-muted">No education entries yet. Add your first education entry above.</p>
											<?php else: ?>
												<?php foreach ($education as $edu): ?>
												<div class="education-item card mb-3">
													<div class="card-body">
														<div class="d-flex justify-content-between align-items-start">
															<div>
																<h6 class="card-title mb-1"><?php echo htmlspecialchars($edu['studied_at']); ?></h6>
																<p class="card-text text-muted mb-1"><?php echo htmlspecialchars($edu['field']); ?></p>
																<p class="card-text small text-muted">
																	<?php echo date('Y', strtotime($edu['start_date'])); ?> - 
																	<?php echo $edu['end_date'] ? date('Y', strtotime($edu['end_date'])) : 'Present'; ?>
																</p>
																<?php if (!empty($edu['description'])): ?>
																	<p class="card-text"><?php echo nl2br(htmlspecialchars($edu['description'])); ?></p>
																<?php endif; ?>
															</div>
															<form method="post" class="delete-form">
																<input type="hidden" name="education_id" value="<?php echo $edu['id']; ?>">
																<button type="submit" name="delete_education" class="btn btn-link text-danger" onclick="return confirm('Are you sure you want to delete this education entry?')">
																	<i class="fa fa-times"></i>
																</button>
															</form>
														</div>
													</div>
												</div>
												<?php endforeach; ?>
											<?php endif; ?>
										</div>
									</div>
								</div>	
							</div><!-- centerl meta -->
							<!-- sidebar -->
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<div class="widget">
						<div class="foot-logo">
							<div class="logo">
								<a href="index-2.html" title=""><img src="../images/logo.png" alt=""></a>
							</div>	
							<p>
								The trio took this simple idea and built it into the world's leading carpooling platform.
							</p>
						</div>
						<ul class="location">
							<li>
								<i class="ti-map-alt"></i>
								<p>33 new montgomery st.750 san francisco, CA USA 94105.</p>
							</li>
							<li>
								<i class="ti-mobile"></i>
								<p>+1-56-346 345</p>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-4">
					<div class="widget">
						<div class="widget-title"><h4>follow</h4></div>
						<ul class="list-style">
							<li><i class="fa fa-facebook-square"></i> <a href="https://web.facebook.com/shopcircut/" title="">facebook</a></li>
							<li><i class="fa fa-twitter-square"></i><a href="https://twitter.com/login?lang=en" title="">twitter</a></li>
							<li><i class="fa fa-instagram"></i><a href="https://www.instagram.com/?hl=en" title="">instagram</a></li>
							<li><i class="fa fa-google-plus-square"></i> <a href="https://plus.google.com/discover" title="">Google+</a></li>
							<li><i class="fa fa-pinterest-square"></i> <a href="https://www.pinterest.com/" title="">Pintrest</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-4">
					<div class="widget">
						<div class="widget-title"><h4>Navigate</h4></div>
						<ul class="list-style">
							<li><a href="about.html" title="">about us</a></li>
							<li><a href="contact.html" title="">contact us</a></li>
							<li><a href="terms.html" title="">terms & Conditions</a></li>
							<li><a href="#" title="">RSS syndication</a></li>
							<li><a href="sitemap.html" title="">Sitemap</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-4">
					<div class="widget">
						<div class="widget-title"><h4>useful links</h4></div>
						<ul class="list-style">
							<li><a href="#" title="">leasing</a></li>
							<li><a href="#" title="">submit route</a></li>
							<li><a href="#" title="">how does it work?</a></li>
							<li><a href="#" title="">agent listings</a></li>
							<li><a href="#" title="">view All</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-4">
					<div class="widget">
						<div class="widget-title"><h4>download apps</h4></div>
						<ul class="colla-apps">
							<li><a href="https://play.google.com/store?hl=en" title=""><i class="fa fa-android"></i>android</a></li>
							<li><a href="https://www.apple.com/lae/ios/app-store/" title=""><i class="ti-apple"></i>iPhone</a></li>
							<li><a href="https://www.microsoft.com/store/apps" title=""><i class="fa fa-windows"></i>Windows</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- footer -->
	<div class="bottombar">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<span class="copyright"><a target="_blank" href="../https://www.templateshub.net">Templates Hub</a></span>
					<i><img src="images/credit-cards.png" alt=""></i>
				</div>
			</div>
		</div>
	</div>
</div>
	<div class="side-panel">
			<h4 class="panel-title">General Setting</h4>
			<form method="post">
				<div class="setting-row">
					<span>use night mode</span>
					<input type="checkbox" id="nightmode1"/> 
					<label for="nightmode1" data-on-label="ON" data-off-label="OFF"></label>
				</div>
				<div class="setting-row">
					<span>Notifications</span>
					<input type="checkbox" id="switch22" /> 
					<label for="switch22" data-on-label="ON" data-off-label="OFF"></label>
				</div>
				<div class="setting-row">
					<span>Notification sound</span>
					<input type="checkbox" id="switch33" /> 
					<label for="switch33" data-on-label="ON" data-off-label="OFF"></label>
				</div>
				<div class="setting-row">
					<span>My profile</span>
					<input type="checkbox" id="switch44" /> 
					<label for="switch44" data-on-label="ON" data-off-label="OFF"></label>
				</div>
				<div class="setting-row">
					<span>Show profile</span>
					<input type="checkbox" id="switch55" /> 
					<label for="switch55" data-on-label="ON" data-off-label="OFF"></label>
				</div>
			</form>
			<h4 class="panel-title">Account Setting</h4>
			<form method="post">
				<div class="setting-row">
					<span>Sub users</span>
					<input type="checkbox" id="switch66" /> 
					<label for="switch66" data-on-label="ON" data-off-label="OFF"></label>
				</div>
				<div class="setting-row">
					<span>personal account</span>
					<input type="checkbox" id="switch77" /> 
					<label for="switch77" data-on-label="ON" data-off-label="OFF"></label>
				</div>
				<div class="setting-row">
					<span>Business account</span>
					<input type="checkbox" id="switch88" /> 
					<label for="switch88" data-on-label="ON" data-off-label="OFF"></label>
				</div>
				<div class="setting-row">
					<span>Show me online</span>
					<input type="checkbox" id="switch99" /> 
					<label for="switch99" data-on-label="ON" data-off-label="OFF"></label>
				</div>
				<div class="setting-row">
					<span>Delete history</span>
					<input type="checkbox" id="switch101" /> 
					<label for="switch101" data-on-label="ON" data-off-label="OFF"></label>
				</div>
				<div class="setting-row">
					<span>Expose author name</span>
					<input type="checkbox" id="switch111" /> 
					<label for="switch111" data-on-label="ON" data-off-label="OFF"></label>
				</div>
			</form>
		</div><!-- side panel -->		
	
	<script src="../js/main.min.js"></script>
	<script src="../js/script.js"></script>
	<script src="../js/map-init.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>

</body>	

</html>
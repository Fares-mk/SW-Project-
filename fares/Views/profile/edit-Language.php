<?php
session_start();

require_once '../../controllers/LanguageController.php';
require_once '../../controllers/UserController.php';

// Require user to be logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../Views/auth/login.php');
    exit();
}

$userId = $_SESSION['user_id'];
$userController = new UserController();
$user = $userController->getUser($userId);

$languageController = new LanguageController();
$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'create') {
                if ($languageController->addLanguage($userId, $_POST['language_name'])) {
                    $_SESSION['success_message'] = "Language added successfully!";
                    header("Location: edit-Language.php");
                    exit;
                }
            } elseif ($_POST['action'] === 'update') {
                if ($languageController->updateLanguage($_POST['id'], $userId, $_POST['language_name'])) {
                    $_SESSION['success_message'] = "Language updated successfully!";
                    header("Location: edit-Language.php");
                    exit;
                }
            } elseif ($_POST['action'] === 'delete') {
                if ($languageController->deleteLanguage($_POST['id'], $userId)) {
                    $_SESSION['success_message'] = "Language deleted successfully!";
                    header("Location: edit-Language.php");
                    exit;
                }
            }
        }
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Get success message from session if it exists
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Clear the message after displaying
}

$languages = $languageController->getUserLanguages($userId);
$edit_language = null;
if (isset($_GET['edit'])) {
    $edit_language = $languageController->getLanguageById($_GET['edit'], $userId);
    if (!$edit_language) {
        $error_message = "Language not found or you don't have permission to edit it.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<!-- change all where the user add interest in input , save it to DB , then show them in EX...Table   -->>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edit your languages" />
    <meta name="keywords" content="" />
	<title>Edit Languages</title>
    <link rel="icon" href="../images/fav.png" type="../../Assets/image/png" sizes="16x16"> 
    
    <link rel="stylesheet" href="../../Assets/css/main.min.css">
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <link rel="stylesheet" href="../../Assets/css/color.css">
    <link rel="stylesheet" href="../../Assets/css/responsive.css">

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
				<a href="profile.php" title=""><img src="../../Assets/images/logo2.png" alt=""></a>
			</span>
			<span class="mh-btns-right">
				<a class="fa fa-arrow-left" href="profile.php" title="Back to Profile"></a>
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
			<a title="" href="index.html"><img src="../../Assets/images/logo.png" alt=""></a>
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
				<figure><img src="../../Assets/images/resources/timeline-1.jpg" alt=""></figure>
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
									<img src="../../Assets/images/resources/user-avatar.jpg" alt="">
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
								</div>
								<div class="col-lg-6">
									<div class="central-meta">
										<div class="editing-interest">
											<h5 class="f-title"><i class="ti-clipboard"></i>Languages</h5>
											
											<?php if (isset($error)): ?>
												<div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
											<?php endif; ?>
											
											<?php if (isset($success_message)): ?>
												<div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
											<?php endif; ?>

											<!-- Add New Language Form -->
											<?php if (!$edit_language): ?>
												<form method="post">
													<input type="hidden" name="action" value="create">
													<div class="form-group">
														<label for="language_name">Language</label>
														<input type="text" class="form-control" id="language_name" name="language_name" required>
													</div>
													<button type="submit" class="btn btn-primary">Add Language</button>
												</form>
												<hr>
											<?php endif; ?>

											<!-- Edit Language Form -->
											<?php if ($edit_language): ?>
												<form method="post">
													<input type="hidden" name="action" value="update">
													<input type="hidden" name="id" value="<?php echo $edit_language->id; ?>">
													<div class="form-group">
														<label for="edit_language_name">Language</label>
														<input type="text" class="form-control" id="edit_language_name" name="language_name" value="<?php echo htmlspecialchars($edit_language->languageName); ?>" required>
													</div>
													<button type="submit" class="btn btn-primary">Update Language</button>
													<a href="edit-Language.php" class="btn btn-secondary">Cancel</a>
												</form>
												<hr>
											<?php endif; ?>

											<!-- Display Languages List -->
											<div class="languages-list mt-4">
												<h5>Your Languages</h5>
												<?php if (empty($languages)): ?>
													<p class="text-muted">No languages added yet. Add your first language above.</p>
												<?php else: ?>
													<?php foreach ($languages as $language): ?>
													<div class="language-item card mb-3">
														<div class="card-body">
															<div class="d-flex justify-content-between align-items-start">
																<div>
																	<h6 class="card-title mb-1"><?php echo htmlspecialchars($language['language_name']); ?></h6>
																</div>
																<div>
																	<a href="edit-Language.php?edit=<?php echo $language['id']; ?>" class="btn btn-primary btn-sm mr-2">
																		<i class="fa fa-edit"></i> Edit
																	</a>
																	<form method="post" class="delete-form d-inline">
																		<input type="hidden" name="action" value="delete">
																		<input type="hidden" name="id" value="<?php echo $language['id']; ?>">
																		<button type="submit" class="btn btn-danger btn-sm p-1" onclick="return confirm('Are you sure you want to delete this language?')">
																			<i class="fa fa-trash"></i> Delete
																		</button>
																	</form>
																</div>
															</div>
														</div>
													</div>
													<?php endforeach; ?>
												<?php endif; ?>
											</div>
										</div>
									</div>	
								</div><!-- centerl meta -->
							</div>	
						</div>
					</div>
				</div>
			</div>	
		</section>

		<!-- Edit Language Modal -->
		<div class="modal fade" id="editExperienceModal" tabindex="-1" role="dialog" aria-labelledby="editExperienceModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editExperienceModalLabel">Edit Experience</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" id="editExperienceForm" action="">
						<input type="hidden" name="action" value="update">
						<input type="hidden" name="id" id="edit_experience_id">
						<div class="form-group">
							<label for="edit_company_name">Company/Organization</label>
							<input type="text" class="form-control" id="edit_company_name" name="company_name" required>
						</div>
						<div class="form-group">
							<label for="edit_from_year">From Year</label>
							<input type="date" class="form-control" id="edit_from_year" name="from_year" required>
						</div>
						<div class="form-group">
							<label for="edit_to_year">To Year</label>
							<input type="date" class="form-control" id="edit_to_year" name="to_year">
						</div>
						<div class="form-group">
							<label for="edit_description">Description</label>
							<textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Update Experience</button>
					</form>
				</div>
			</div>
		</div>
	</div>

		<script>
		function editLanguage(id, language_name) {
			document.getElementById('edit_language_id').value = id;
			document.getElementById('edit_language_name').value = language_name;
			$('#editLanguageModal').modal('show');
		}
		</script>

		<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<div class="widget">
						<div class="foot-logo">
							<div class="logo">
								<a href="index-2.html" title=""><img src="../../Assets/images/logo.png" alt=""></a>
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
					<span class="copyright"><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></span>
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
	
	<script src="../../Assets/js/main.min.js"></script>
	<script src="../../Assets/js/script.js"></script>
	

</body>	

</html>
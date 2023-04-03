<?php


if (!function_exists('createCustomers')) {
	/**
	 * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
	 * @throws QueryExecutionException
	 */
	function createCustomers()
	{

		$args  = array(
			'role'    => 'wpamelia-customer',
		);
		$users = get_users($args);

		$container = require AMELIA_PATH . '/src/Infrastructure/ContainerConfig/container.php';
		/** @var CustomerApplicationService $customerAS */
		$customerAS = $container->get('application.user.customer.service');

		foreach ($users as $user) {
			$userMetaData = get_user_meta($user->ID);
			$userArr      =
				[
					'status'     => 'visible',
					'type'       => 'customer',
					'firstName'  => !empty($userMetaData['first_name'][0]) ? $userMetaData['first_name'][0] : $user->data->user_login,
					'lastName'   => !empty($userMetaData['last_name'][0]) ? $userMetaData['last_name'][0] : $user->data->user_login,
					'email'      => $user->data->user_email,
					'externalId' => $user->ID,
				];

			$customerAS->createCustomer($userArr, true);
		}
	}
}
add_action('init', 'createCustomers');


add_action('parse_request', 'my_custom_url_handler');
function my_custom_url_handler()
{

	if ($_SERVER["REQUEST_URI"] == '/update_bio') {

		global $wpdb;
		$tbprefix1 = $wpdb->prefix;

		$bio = urldecode($_POST["bio"]);
		//$bio = sanitize_text_field($_POST["bio"]);
		$bio = stripslashes($bio);
		$email = $_POST["email"];
		$position = $_POST["position"];
		$trustedbrand1 = $_POST["trustedbrand1"];
		$trustedbrand2 = $_POST["trustedbrand2"];
		$trustedbrand3 = $_POST["trustedbrand3"];
		$trustedbrand4 = $_POST["trustedbrand4"];
		$trustedbrand5 = $_POST["trustedbrand5"];
		$language = $_POST["language"];


		//echo 'position'.$position;
		// 		echo $email;

		$sql = "SELECT * FROM " . $tbprefix1 . "amelia_users WHERE email='$email'";
		$result = $wpdb->get_results($sql);
		echo count($result);
		if (count($result) > 0) {

			$wpdb->query($wpdb->prepare("UPDATE " . $tbprefix1 . "amelia_users SET full_name = CONCAT(firstName, ' ', lastName)  WHERE email='$email'"));

			$wpdb->query($wpdb->prepare("UPDATE " . $tbprefix1 . "amelia_users SET trustedbrand1='" . $trustedbrand1 . "', trustedbrand2='" . $trustedbrand2 . "',  trustedbrand3='" . $trustedbrand3 . "', trustedbrand4='" . $trustedbrand4 . "', trustedbrand5='" . $trustedbrand5 . "', bio='" . $bio . "', position='" . $position . "' , language='" . $language . "' WHERE email='" . $email . "'"));
			//echo $bio;
			//echo $email;
			$wpdb->update(
				$tbprefix1 . 'amelia_users',
				array(
					'bio' => $bio,
					'position' => $position,
				),
				array(
					'email' => $email,
				),
			);
			echo 'saved';
		}

		exit();
	}
}




add_action('parse_request', 'my_services_handler');
function my_services_handler()
{

	if ($_SERVER["REQUEST_URI"] == '/update_service_data') {

		global $wpdb;

		
		$videourl = $_POST["videourl"];
		$videoStartTime = $_POST["videoStartTime"];
		$videoViews = $_POST["videoViews"];
		$pretalkid = $_POST["pretalkid"];
		//	$serviceid = $_POST["serviceid"];


		$catval = $_POST["catvalue"];
		$servicename = $_POST["servicenameval"];


		$empval = $_POST["empvalue"];
		$fullname = $_POST["empvalue"];
		$lastSpacePos = strrpos($empval, ' ');
		$firstname = substr($empval, 0, $lastSpacePos);
		$lastname = substr($empval, $lastSpacePos + 1);
// 		echo $empval . "<br>";
// 		echo $catval . "<br>";


		$tag1 = $_POST["tag1"];
		$tag2 = $_POST["tag2"];
		$tag3 = $_POST["tag3"];
		$tag4 = $_POST["tag4"];
		$tag5 = $_POST["tag5"];
		$excerpt = $_POST["short_excerpt"];
		$language1 = $_POST["language1"];
		$language2 = $_POST["language2"];
		$language3 = $_POST["language3"];
		// echo 'tag name = '.$tag1;

// echo 'awa2';

		$tbprefix2 = $wpdb->prefix;
// echo 'awa3'.$tbprefix2;
		$serchdataservice = "SELECT " . $tbprefix2 . "amelia_services.id FROM " . $tbprefix2 . "amelia_services INNER JOIN " . $tbprefix2 . "amelia_categories INNER JOIN " . $tbprefix2 . "amelia_users INNER JOIN " . $tbprefix2 . "amelia_providers_to_services ON " . $tbprefix2 . "amelia_services.categoryId=" . $tbprefix2 . "amelia_categories.id and " . $tbprefix2 . "amelia_services.id=" . $tbprefix2 . "amelia_providers_to_services.serviceId and " . $tbprefix2 . "amelia_users.id=" . $tbprefix2 . "amelia_providers_to_services.userId where " . $tbprefix2 . "amelia_users.full_name='" . $fullname . "' and " . $tbprefix2 . "amelia_services.name='" . $servicename . "' and " . $tbprefix2 . "amelia_categories.name='" . $catval . "'";

		$serviceid = '';
		$result1 = $wpdb->get_results($serchdataservice);

		if (count($result1) > 0) {

			$services = json_decode(json_encode($result1[0]), true);
// var_dump($services);
			$serviceid = $services["id"];
		}

		echo "servid-".$serviceid;
		$sql = "SELECT * FROM " . $tbprefix2 . "amelia_services WHERE id='$serviceid'";
		$result = $wpdb->get_results($sql);
		if (count($result) > 0) {
			//print_r($result);
			$rows_affected =  $wpdb->query($wpdb->prepare("UPDATE " . $tbprefix2 . "amelia_services SET video='" . $videourl . "' ,preTalkSessionId='" . $pretalkid . "' , videoStartTime='" . $videoStartTime . "' , videoViews = '" . $videoViews . "' , tag1='" . $tag1 . "' , tag2='" . $tag2 . "' , tag3='" . $tag3 . "' , tag4='" . $tag4 . "' , tag5='" . $tag5 . "' , short_excerpt='" . $excerpt . "', language1='" . $language1 . "' , language2='" . $language2 . "', language3='" . $language3 . "' WHERE id='" . $serviceid . "'"));



			echo "Saved";
		}

		//echo $servicename;

		exit();
	}
}




add_action('parse_request', 'getBio');
function getBio()
{
	if ($_SERVER["REQUEST_URI"] == '/get_bio') {
		global $wpdb;
		$tbprefix3 = $wpdb->prefix;
		$id = $_POST["id"];

		$sql = "SELECT * FROM " . $tbprefix3 . "amelia_users WHERE id='$id'";
		$result = $wpdb->get_results($sql);
		$user = json_encode($result[0]);

		// 		echo $result[0]['bio'];
		print_r($user);

		// 		echo $user;



		exit();
	}
}


add_action('parse_request', 'getTags');
function getTags()
{
	if ($_SERVER["REQUEST_URI"] == '/get_tags') {
		global $wpdb;
		$tbprefix4 = $wpdb->prefix;

		$id = $_POST["id"];

		$sql = "SELECT * FROM " . $tbprefix4 . "amelia_services WHERE id='$id'";
		$result = $wpdb->get_results($sql);
		$services = json_encode($result[0]);


		print_r($services);

		// 		echo $user;



		exit();
	}
}


add_action('parse_request', 'duplicateService');
function duplicateService()
{
	if ($_SERVER["REQUEST_URI"] == '/duplicate_service') {
		global $wpdb;
		$tbprefix5 = $wpdb->prefix;

		$id = $_POST["id"];
		global $userserviceid;
		global $userserviceprice;
		global $latestserviceid;
		


		$userforservice = $wpdb->get_results(
			$wpdb->prepare("SELECT * from " . $tbprefix5 . "amelia_providers_to_services where serviceId=". $id)
		);

		if ($userforservice > 0) {
			
			foreach ($userforservice as $row) {
				$userserviceid = $row->userId;
				$userserviceprice = $row->price;
				 //echo $userserviceid."xx".$userserviceprice;
			}
		}



 		$selectservice = "INSERT INTO " . $tbprefix5 . "amelia_services (name, description, color, price, status, categoryId, minCapacity, maxCapacity, duration, timeBefore, priority, pictureFullPath, pictureThumbPath, aggregatedPrice, settings, recurringCycle, recurringSub, recurringPayment, translations, depositPayment, depositPerPerson, deposit, fullPayment, mandatoryExtra, minSelectedExtras, video, videoStartTime, videoViews, tag1, tag2, tag3, tag4, tag5, short_excerpt, language1, language2, language3, preTalkSessionId, customPricing, maxExtraPeople, limitPerCustomer) SELECT name, description, color, price, status, categoryId, minCapacity, maxCapacity, duration, timeBefore, priority, pictureFullPath, pictureThumbPath, aggregatedPrice, settings, recurringCycle, recurringSub, recurringPayment, translations, depositPayment, depositPerPerson, deposit, fullPayment, mandatoryExtra, minSelectedExtras, video, videoStartTime, videoViews, tag1, tag2, tag3, tag4, tag5, short_excerpt, language1, language2, language3, preTalkSessionId, customPricing, maxExtraPeople, limitPerCustomer FROM  " . $tbprefix5 . "amelia_services WHERE id='" . $id . "'";
 		$resultservice = $wpdb->query($wpdb->prepare($selectservice));

 		// echo count($resultservice);
 		if ($resultservice > 0) {

			$wpdb->query($wpdb->prepare("UPDATE " . $tbprefix5 . "amelia_services SET position = position + 1"));

			$getlastservice = $wpdb->get_var(
				$wpdb->prepare("SELECT id FROM " . $tbprefix5 . "amelia_services ORDER BY id DESC LIMIT 1")
			);

			if ($getlastservice) {
				$latestserviceid = $getlastservice;
			}

			$wpdb->query(
				$wpdb->prepare(
					"INSERT INTO " . $tbprefix5 . "amelia_providers_to_services (userId, serviceId, price) VALUES (%d, %d, %f)",
					$userserviceid,
					$latestserviceid,
					$userserviceprice
				)
			);
			// echo $userserviceid . "+" . $latestserviceid . "+" . $userserviceprice;
			echo "DuplicateSuccess";
		} 
// 		else {
//  			echo "Failed";
//  		}
		exit();
	}
}


add_action('parse_request', 'getservicetags');
function getservicetags()
{
	if ($_SERVER["REQUEST_URI"] == '/get_service_tags') {
		global $wpdb;
		


		$sql = "SELECT * FROM services_tags";
		$result = $wpdb->get_results($sql);
		$servicestags = json_encode($result);


		print_r($servicestags);

		exit();
	}
}


add_action('parse_request', 'updateReview');
function updateReview()
{


	if ($_SERVER["REQUEST_URI"] == '/update_review') {


		global $wpdb;

		$reviewRating = $_POST["review_rating"];
		$reviewText = $_POST["review_text"];
		$reviewId = $_POST["review_id"];
		$expertId = $_POST["user_id"];

		if (isset($_POST['delete'])) {
			$sql = "SELECT * FROM review_details WHERE review_id='$reviewId'";
			$result = $wpdb->get_results($sql);
			if (count($result) > 0) {

				$rows_affected =  $wpdb->query($wpdb->prepare("DELETE FROM review_details WHERE review_id='" . $reviewId . "'"));
			}
			header("Location: /wp-admin/admin.php?page=review-page");
			exit();
		} elseif (isset($_POST['save'])) {
			$sql = "SELECT * FROM review_details WHERE review_id='$reviewId'";
			$result = $wpdb->get_results($sql);
			if (count($result) > 0) {
				echo "count is" . count($result);

				$rows_affected =  $wpdb->query($wpdb->prepare("UPDATE review_details SET starreview='" . $reviewRating . "' , review='" . $reviewText . "'   WHERE review_id='" . $reviewId . "'"));
			} else {

				$wpdb->insert('review_details', array(
					'user' => $expertId,
					'review' => $reviewText,
					'starreview' => $reviewRating,
				));
			}

			header("Location: /wp-admin/admin.php?page=review-page");
			exit();
		}
	}
}


function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');



function hs_admin_menu()
{
	add_menu_page(
		__('Page Title', 'https://deisessions.com/'),
		__('Add Service Tags', 'https://deisessions.com/'),
		'manage_options',
		'sample-page',
		'my_admin_page_contents',
		'dashicons-schedule',
		3
	);
}
add_action('admin_menu', 'hs_admin_menu');

// global $wpdb;  
function my_admin_page_contents()
{

	//$service = $wpdb->get_results("SELECT * FROM `services_tags`");

?>
	<div class="py-5 stepr">

		<div class="container">

			<div class="row justify-content-center">
				<div class="p-5 col-md-12 border border-dark">

					<h2 class="text-center pb-3">Add Service Tag</h2>

					<p>Please add your tags comma separated. Example tag1,tag2,tag3</p>
					<div class="form-group"> <textarea class="form-control h-25 tagstext" rows="6" aria-label="With textarea" id="tagstext">
       <?php
		global $wpdb;
		$servictag = $wpdb->get_results("SELECT * FROM services_tags");


		$numItems = count($servictag);
		$i = 0;


		foreach ($servictag as $rowtags) {

			// $servicecateid = $rowtags->id;
			$servicetagename = $rowtags->Tag;
			$trimval = trim($servicetagename);
			$str = $trimval . ",";

			if (++$i === $numItems) {
				$str = $trimval;
			}
			echo $str;
		}




		?>
            </textarea></div>

				</div>

				<div class="row">

					<div class="col-md-12"><button id="tagsubmit" type="submit" class="adminbtn btn btn-primary btn text-center btn-lg btn-dark float-right w-50">Save</button></div>
				</div>
			</div>
		</div>
	</div>

<?php
}



// add review page to admin dashboard
function hs_admin_menu_review()
{
	add_menu_page(
		__('Page Title', 'https://deisessions.com/'),
		__('Edit Reviews', 'https://deisessions.com/'),
		'manage_options',
		'review-page',
		'my_admin_review_page_contents',
		'dashicons-schedule',
		4
	);
}
add_action('admin_menu', 'hs_admin_menu_review');

function my_admin_review_page_contents()
{

?>
	<div class="py-5 stepr">

		<div class="container">

			<div class="row justify-content-center">
				<div class="p-5 col-md-12 border border-dark">

					<h2 class="text-center pb-3">Edit Reviews Tag</h2>


					<table id="reviewtable">

						<tr>

							<th>Expert</th>
							<th>Rating</th>
							<th>Review</th>
							<th>Edit</th>


						</tr>

						<?php
						global $wpdb;
						$reviewtag = $wpdb->get_results("SELECT * FROM review_details");


						$numItems = count($reviewtag);
						$i = 0;


						foreach ($reviewtag as $rowtags) {
						?>

							<tr>
								<input type="hidden" class="review_id" value="<?php echo $rowtags->review_id; ?>">

								<td class="userid"><?php echo $rowtags->user; ?></td>
								<td class="starrating"><?php echo $rowtags->starreview; ?></td>
								<td class="review"><?php echo $rowtags->review; ?></td>
								<td><button class="editreviewbtn">Edit</button></td>
							</tr>

						<?php

						}
						?>


					</table>
					<script>
						jQuery(document).ready(function() {
							jQuery("#reviewtable").on('click', '.editreviewbtn', function() {
								let self = jQuery(this).closest('tr');

								let userid = self.find('.userid').text();
								let startrating = self.find('.starrating').text();
								let review = self.find('.review').text();
								let reviewid = self.find('.review_id').val();


								jQuery('#user_id').val(userid);
								jQuery('#review_rating').val(startrating);
								jQuery('#review_text').val(review);
								jQuery('#review_id').val(reviewid);

							});
						});
					</script>
					<form action="/update_review" method="POST">
						<div class="editreview">
							<div class="row">
								<div class="col-md-4">
								</div>
								<div class="col-md-4">

									<?php
									global $wpdb;
									$tbprefix6 = $wpdb->prefix;
									//$expertname = "SELECT full_name FROM wp_821991_amelia_users";



									$expertname = $wpdb->get_results(
										$wpdb->prepare("SELECT full_name FROM ".$tbprefix6."amelia_users")
									);
							
									if (count($expertname) > 0) {
										echo '<datalist id="expert-list">';
										foreach ($expertname as $row) {
											
											echo '<option value="'.$row->full_name.'">';
										
										}
										echo '</datalist>';
									}
							
									
							

									?>

									<label>Expert</label>
									<input name="user_id" id="user_id" type="text" value="" list="expert-list">
								</div>
								<div class="col-md-4">
									<label>Rating</label>
									<input name="review_rating" id="review_rating" type="text" value="">
								</div>
							</div>
							<div class="row">
								<input type="hidden" name="review_id" id="review_id">
								<textarea name="review_text" id="review_text" class="form-control h-25 reviewtext" rows="6" aria-label="With textarea" id="reviewtext"></textarea>
								<input type="submit" name="save" class="rbtn" id="reviewsavebtn" value="Save">
								<input type="submit" name="delete" class="rbtn" id="reviewsavebtn" value="Delete">
							</div>

						</div>
					</form>
					<?php



					?>
				</div>


			</div>
		</div>
	</div>

<?php
}



function my_plugin_body_class($classes)
{


	if (current_user_can('manage_options')) {
		$classes .= " useradminrole";
	}

	return $classes;
}

add_filter('admin_body_class', 'my_plugin_body_class');

add_action('admin_head', 'customservices');

function customservices()
{
	global $wpdb;
	$tbprefix7 = $wpdb->prefix;
	$userlogid = get_current_user_id();

	$service = $wpdb->get_results("select " . $tbprefix7 . "amelia_providers_to_services.serviceId from " . $tbprefix7 . "amelia_users inner join " . $tbprefix7 . "amelia_providers_to_services on " . $tbprefix7 . "amelia_users.id=" . $tbprefix7 . "amelia_providers_to_services.userId where " . $tbprefix7 . "amelia_users.externalId='" . $userlogid . "'");



	if (current_user_can('manage_options')) {
	} else {
		echo '<style>
  .am-service-card{
	display:none !important;
  }
  </style>';
		foreach ($service as $row) {
			$servicesingleid = $row->serviceId;
			echo $servicesingleid;




			echo '<style>
  .s' . $servicesingleid . '.am-service-card{
	display:block !important;
  }
  </style>';
		}
	}
}




if (!function_exists('createProviders')) {
	/**
	 * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
	 * @throws QueryExecutionException
	 * @throws ContainerException
	 */
	function createProviders()
	{
		$args  = array(
			'role'    => 'wpamelia-provider',
		);
		$users = get_users($args);

		$container = require AMELIA_PATH . '/src/Infrastructure/ContainerConfig/container.php';
		/** @var SettingsService $settingsService */
		$settingsService = $container->get('domain.settings.service');
		/** @var LocationRepository $locationRepository */
		$locationRepository = $container->get('domain.locations.repository');
		/** @var ProviderApplicationService $providerAS */
		$providerAS = $container->get('application.user.provider.service');

		$schedule    = $settingsService->getCategorySettings('weekSchedule');
		// $weekDayList = getWorkHours($schedule);

		foreach ($users as $user) {
			$userMetaData = get_user_meta($user->ID);
			//echo $user->ID ."<br>";

			$locations = $locationRepository->getFiltered([], 1);

			$userArr =
				[
					'status'      => 'visible',
					'type'        => 'provider',
					'password'    => $user->data->user_pass,
					'firstName'  => !empty($userMetaData['first_name'][0]) ? $userMetaData['first_name'][0] : $user->data->user_login,
					'lastName'   => !empty($userMetaData['last_name'][0]) ? $userMetaData['last_name'][0] : $user->data->user_login,
					'email'       => $user->data->user_email,
					'externalId'  => $user->ID,
					'weekDayList' => $weekDayList,
					'sendEmployeePanelAccessEmail' => true,
					'locationId'  => $locations && $locations->length() && $locations->getItem(0) ? $locations->getItem(0)->getId()->getValue() : ''
				];
			//print_r($userArr);
			$providerAS->createProvider($userArr, true);
		}
	}
}
add_action('user_register', 'createProviders');

function getpagecurrency()
{
	global $curr;
	if (class_exists('WOOMULTI_CURRENCY_F_Data')) {
		$currency_data_obj = new WOOMULTI_CURRENCY_F_Data();
		$current_currency = $currency_data_obj->get_current_currency();
		$curr = $current_currency;
	} else {
		$curr = "€";
	}
}
add_action('wp_head', 'getpagecurrency');


// function wpse_update_user_meta_pkg_type( $user_id ) {
//     update_user_meta( $user_id, 'disapprove', 'disapprove' );
// }
// Fire late to try to ensure this is done after any other function hooked to `user_register`.
// add_action( 'user_register','wpse_update_user_meta_pkg_type', PHP_INT_MAX, 1 );


// add linkedin field into profile page


function wpse_230369_quote_of_the_day($user)
{
	$quote = esc_attr(get_option('quote_of_the_day'));
?>

	<div class="visible-only-for-admin">
		<h3>Linkedin Link</h3>
		<table class="form-table">
			<tr>
				<th><label for="quote_of_the_day">Linkedin Link</label></th>
				<td>
					<?php if (current_user_can('administrator')) : ?>


						<?php
						$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


						$url_components = parse_url($url);

						parse_str($url_components['query'], $params);

						// Display result
						global $wpdb;
						$tbprefix8 = $wpdb->prefix;
						$userID = $params['user_id'];




						$linkedin = $wpdb->get_results("select linkedin from " . $tbprefix8 . "amelia_users where externalId='" . $userID . "'");

						foreach ($linkedin as $row) {
							$linkedinlink = $row->linkedin;
						?>
							<input readonly type="text" name="quote_of_the_day" value="<?php echo $linkedinlink ?>" class="regular-text" />
						<?php
							//echo $linkedinlink;
						}
						?>


					<?php else : ?>

						<?php echo $quote ?>

					<?php endif ?>
				</td>
			</tr>
		</table>
	</div>

<?php
}

add_action('show_user_profile', 'wpse_230369_quote_of_the_day', 10);
add_action('edit_user_profile', 'wpse_230369_quote_of_the_day', 10);

function hs_admin_contact()
{
	add_menu_page('Contact Support', 'Contact Support', 'read', 'custompage', 'my_custom_menu_page', 'dashicons-schedule', 6);
}
add_action('admin_menu', 'hs_admin_contact');


function my_custom_menu_page()
{
	echo do_shortcode('[quform id="3" name="Contact Support form"]');
}

// return card content
function kd_return_card_content()
{
	$sid = 29;
	// $verified_user = true;
	// $price = 100;
	// $curr = 'EUR';
	// $name = 'test';
	// $exchange_price_widget = do_shortcode('[woo_multi_currency_exchange price="' . $price . '" currency="' . $curr . '"]');
	// $booking_widget = do_shortcode('[ameliastepbooking service="' . $sid . '"]');
	// $video_views = 25;
	// $short_excerpt = 'test excerpt';
	// $video = 'W3_RjJtd6Eo';
	// $videoStartTime = 1;
	// $finalurl1 = 'https://www.youtube.com/embed/W3_RjJtd6Eo?controls=1&showinfo=0&start=10&rel=0&loop=1&autoplay=1';
	// $pictureFullPath = 'https://demoleqture.royboy.eu/wp-content/uploads/2022/09/Lesa-Bradshaw288x163.png';
	// $url = 'test.com';

	// $return_html = '<div class="popup-content-inner">
	// 	<div class="kd-popup-video-part">
	// 		<div class="container">
	// 			<p class="cardauthor">';

	// if ($verified_user) {
	// 	$return_html .= '<span class="verifiedtext"><img class="verifyimg" src="https://deisessions.com/wp-content/uploads/2022/10/checked.png"></span>';
	// }

	// $return_html .= '</p>
	// 			<h4 class="sessionttile"><b>' . $name . '</b></h4>
	// 			<p class="pricesession">60 minutes / ' . $exchange_price_widget . '</p>
	// 			<p class="views"><img class="views-icon" src="https://deisessions.com/wp-content/uploads/2022/10/eyeball.png" /> 
	// 			' . $video_views . '</p>
	// 			<p class="paratext">' . $short_excerpt . '</p>
	// 		</div>';
	// if (pictureFullPath != "") {
	// 	$return_html .= '<img data-videoid="' . $video . '" data-starttime="' . $videoStartTime . '" data-finalurl="' . $finalurl1 . '" class="kd-yt-video-img" src="' . $pictureFullPath . '" />';
	// } else {
	// 	$return_html .= '<img data-videoid="' . $video . '" data-starttime="' . $videoStartTime . '" data-finalurl="' . $finalurl1 . '" class="kd-yt-video-img" src="https://deisessions.com/wp-content/uploads/2022/10/defaultimg.png" />';
	// }

	// $return_html .= '</div>
	// 	<div class="kd-popup-booking-part">
	// 		<div class="booking-calendar">
	// 	   ' . $booking_widget . '
	// 		</div>
	// 		<div class="service-link">

	// 			<h3>Book Now <br> Or</h3>
	// 			<a class="kd-btn" href="' . $url . '">View Session Page</a>
	// 		</div>
	// 	</div>
	// 	</div>
	// </div>';

	echo do_shortcode('[ameliastepbooking service="' . $sid . '"]');
	wp_die();
}

add_action('wp_ajax_return_card_content', 'kd_return_card_content');
add_action('wp_ajax_noppriv_return_card_content', 'kd_return_card_content');


/**
 * Perform automatic login.
 */
function wpdocs_custom_login()
{
	if (isset($_GET['username']) && isset($_GET['pass'])) {
		$creds = array(
			'user_login'    => $_GET['username'],
			'user_password' => $_GET['pass'],
			'remember'      => true
		);

		$user = wp_signon($creds, true);

		if (is_wp_error($user)) {

			echo $user->get_error_message();
			return false;
		} else {
			wp_redirect(home_url('/speakers-panel'), 301);
			exit;
		}
	}
}

// Run before the headers and cookies are sent.
add_action('after_setup_theme', 'wpdocs_custom_login');

function wc_billing_field_strings($translated_text, $text, $domain)
{
	switch ($translated_text) {
		case 'Billing details':
			$translated_text = __('Contact Information', 'woocommerce');
			break;
	}
	return $translated_text;
}
add_filter('gettext', 'wc_billing_field_strings', 20, 3);


function custom_rewrite_rule()
{
	// add_rewrite_rule('^single-service/([^/]*)/?','index.php?page_id=28978&sid=$matches[1]','top');
	add_rewrite_rule('^single-service/([^/]*)-([0-9]+)/?', 'index.php?page_id=28978&sid=$matches[2]', 'top');
}
add_action('init', 'custom_rewrite_rule', 10, 0);



// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'hello-elementor','hello-elementor','hello-elementor-theme-style' ) );
    
	// jquery time picker
	wp_enqueue_style( 'jquery-time-picker-by-kd', get_stylesheet_directory_uri().'/kd-date-time-picker/jquery.datetimepicker.css');
	wp_enqueue_script( 'jquery-time-picker-sript-by-kd', get_stylesheet_directory_uri().'/kd-date-time-picker/jquery.datetimepicker.js');
	}
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 100 );

// END ENQUEUE PARENT ACTION
// 

function custom_query_vars( $vars ) {
    $vars[] = 'sid';
    return $vars;
}
add_filter( 'query_vars', 'custom_query_vars' );

function my_custom_js() {
    if ( is_page( 'speakers-panel' ) || is_user_logged_in() ) {
        echo '<script>
        function checkElements() {
          const dropdown = document.querySelector(".am-cabinet-user-email.el-dropdown");
          const myProfileLink = document.querySelector(".el-dropdown-menu__item");

          if (dropdown && myProfileLink) {
            console.log("Dropdown found");
            dropdown.click();

            console.log("My Profile link found");
            myProfileLink.click();
          } else {
            if (!dropdown) {
              console.log("Dropdown not found");
            }
            if (!myProfileLink) {
              console.log("My Profile link not found");
            }
            setTimeout(checkElements, 1000); // Retry after 1 second
          }
        }

        document.addEventListener("DOMContentLoaded", function() {
          checkElements();
        });
        </script>';
    }
}
add_action( 'wp_footer', 'my_custom_js' );




function add_custom_links_to_admin_bar($wp_admin_bar) {
    // Add link for Amelia Employees
    $args_employees = array(
        'id' => 'amelia_employees_link',
        'title' => 'Amelia Experts',
        'href' => 'https://livelnd.com/wp-admin/admin.php?page=wpamelia-employees#/employees',
        'parent' => 'top-secondary',
    );
    $wp_admin_bar->add_node($args_employees);

    // Add link for Amelia Services
    $args_services = array(
        'id' => 'amelia_services_link',
        'title' => 'Amelia Sessions',
        'href' => 'https://livelnd.com/wp-admin/admin.php?page=wpamelia-services#/services',
        'parent' => 'top-secondary',
    );
    $wp_admin_bar->add_node($args_services);
}
add_action('admin_bar_menu', 'add_custom_links_to_admin_bar', 999);


<?php
/**
 * Template Name: New Purchase Info Upload Form
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Here's all the vars
 */

$submission_email = 'ira@birchgold.com';
// $submission_email = 'aleksandarziher@gmail.com';

define('SUBMISSION_REDIRECT_URL', '/purchase-info-complete');
define('LEADS360_API_URL', 'https://service.leads360.com/ClientService.asmx');
define('LEADS360_USERNAME', 'VelocifyAPI@velocify.com');
define('LEADS360_PASSWORD', '@Inte11ecTpo');

define('SALESFORCE_API_URL', 'https://birchgoldgroup.my.salesforce.com');
define('SALESFORCE_CLIENT_ID', '3MVG9LBJLApeX_PBrh3.CqQ45HOkJZbZMkWKnTCdS6yQO0C6lUrGrIh1IBt0dYcfe1Lid7kVl1HJTwJ5aX6c5');
define('SALESFORCE_CLIENT_SECRET', 'D4F29382ACAC3EC5DD9DC39AF6CE9CA1567C658836056C2C9B797B656AE3E28B');
define('SALESFORCE_USERNAME', 'apiuser@birchgold.com');
define('SALESFORCE_PASSWORD', '#4Passwprd1');

/**
 * STOP editing vars
 */

add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style('new-upload-form', get_stylesheet_directory_uri() . '/new-upload-form/new-upload-form.css', [], '6.1.3');
	wp_enqueue_script('new-upload-form', get_stylesheet_directory_uri() . '/new-upload-form/new-upload-form.js', ['jquery'], '6.1.3', true);
});

if (isset($_POST['purchase-info-submit'])) {
	unset($_POST['purchase-info-submit']);
	
	foreach ($_POST as $name => $input) {
		$_POST[$name] = filter_var($input, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}
	
	$_POST = array_filter($_POST, function ($value) {
		return !empty($value);
	});
	
	// Form and lead data
	$message = '<b>Form info</b><br/><hr/>';
	@$message .= '<b>Account type:</b> ' . $_POST['account-type'] . '<br/>';
	@$message .= '<b>Account full name:</b> ' . $_POST['account-full-name'] . '<br/>';
	@$message .= '<b>Transfer type:</b> ' . $_POST['account-transfer-type'] . '<br/>';
	
	if ($_POST['account-transfer-type'] === 'Bank wire') {
		if ($_POST['account-amount'] === 'Up') {
			@$message .= '<b>Amount:</b> Up to $25,000<br/>';
		} else if ($_POST['account-amount'] === 'Over') {
			@$message .= '<b>Amount:</b> Over $25,000<br/>';
		}
	}
	
	@$message .= '<br/><b>Lead info</b><br/><hr/>';
	@$message .= '<b>Lead ID:</b> ' . $_POST['ID'] . '<br/>';
	@$message .= '<b>Salesforce Account:</b> <a href="https://birchgoldgroup.lightning.force.com/' . $_POST['Salesforce_ID'] . '">https://birchgoldgroup.lightning.force.com/' . $_POST['Salesforce_ID'] . '</a><br/>';
	/*
	@$message .= '<b>Title:</b> ' . $_POST['title'] . '<br/>';
	@$message .= '<b>Campaign:</b> ' . $_POST['campaign'] . '<br/>';
	@$message .= '<b>Status:</b> ' . $_POST['lead_status'] . '<br/>';
	@$message .= '<b>Email address:</b> ' . $_POST['lead_email'] . '<br/>';
	@$message .= '<b>First name:</b> ' . $_POST['lead_fname'] . '<br/>';
	@$message .= '<b>Last name:</b> ' . $_POST['lead_lname'] . '<br/>';
	@$message .= '<b>Phone:</b> ' . $_POST['lead_phone'] . '<br/>';
	@$message .= '<b>Broker:</b> ' . $_POST['lead_broker'] . '<br/><hr/>';
	 */
	$message .= '<hr/><b>Any uploaded documents can be found as attachments of this email.</b><hr/>';
	
	$subject = 'New upload form submission';
	
	$headers[] = 'From: clientrelations@birchgold.com';
	$headers[] = 'Cc: customercare@birchgold.com';
	$headers[] = 'Cc: hesparza@birchgold.com';
	// $headers[] = 'Cc: aleksandarziher@gmail.com';
	$headers[] = 'Content-Type: text/html; charset=UTF-8';
	
	// Documents
	$files = ['identification', 'identification-2', 'address', 'address-2', 'trust', 'corporation'];
	
	$attachments = [];
	
	$upload_path = WP_CONTENT_DIR . '/uploads/purchase-info-upload/';
	
	wp_mkdir_p($upload_path);
	
	$salesforce_checks = [
		'IsDriverLicenceUploaded__c' => false,
		'IsAddressProofUploaded__c' => false
	];
	
	foreach ($files as $file) {
		if (!empty($_FILES[$file]['name'])) {
			$final_path = $upload_path . basename($_FILES[$file]['name']);
			
			$attachments[] = $final_path;
			
			if (move_uploaded_file($_FILES[$file]['tmp_name'], $final_path)) {
				if ($file === 'identification' || $file === 'identification-2') {
					$salesforce_checks['IsDriverLicenceUploaded__c'] = true;
				}
				
				if ($file === 'address' || $file === 'address-2') {
					$salesforce_checks['IsAddressProofUploaded__c'] = true;
				}
			}
		}
	}
	
	wp_mail($submission_email, $subject, $message, $headers, $attachments);
	
	// send lead data to Salesforce API
	$data = [
		'username' => SALESFORCE_USERNAME,
		'password' => SALESFORCE_PASSWORD,
		'grant_type' => 'password',
		'client_id' => SALESFORCE_CLIENT_ID,
		'client_secret' => SALESFORCE_CLIENT_SECRET
	];
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, SALESFORCE_API_URL . '/services/oauth2/token');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec($ch);
	curl_close($ch);
	
	$server_output = json_decode($server_output);
	$access_token = '';
	
	if ($server_output) {
		$access_token = $server_output->access_token;
	}
	
	if (!empty($access_token) && !empty($_POST['Salesforce_ID'])) {
		// send files
		$postFields = new stdClass();
		
		$i = 0;
		
		foreach ($files as $k => $file) {
			if (!empty($_FILES[$file]['name'])) {
				$data = [];
				$data['attributes']['type'] = "ContentVersion";
				$data['attributes']['referenceId'] = "id" . $i;
				$data['FirstPublishLocationId'] = $_POST['Salesforce_ID'];
				
				if ($file === 'identification' || $file === 'identification-2') {
					$name = 'Drivers License - ' . $_POST['ID'] . ' ' . date('Y-m-d H:i:s');
				}
				
				if ($file === 'address' || $file === 'address-2') {
					$name = 'Proof of Address - ' . $_POST['ID'] . ' ' . date('Y-m-d H:i:s');
				}
				
				if ($file === 'trust' || $file === 'corporation') {
					$name = 'Birch Gold Support Documents - ' . $_POST['ID'] . ' ' . date('Y-m-d H:i:s');
				}
				
				$data['Title'] = $name;
				$data['PathOnClient'] = basename($_FILES[$file]['name']);
				$data['Description'] = $name;
				$data['VersionData'] = base64_encode(file_get_contents($upload_path . basename($_FILES[$file]['name'])));
				
				$postFields->records[$i] = $data;
				
				$i++;
			}
		}
		
		if (!empty($postFields->records)) {
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, SALESFORCE_API_URL . "/services/data/v55.0/composite/sobjects");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postFields));
			curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $access_token]);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec($ch);
			
			curl_close($ch);
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, SALESFORCE_API_URL . '/services/data/v55.0/sobjects/Account/' . $_POST['Salesforce_ID']);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($salesforce_checks));
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $access_token]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		
		curl_close($ch);
	}
	
	if (!empty($attachments)) {
		foreach ($attachments as $attachment) {
			@unlink($attachment);
		}
	}
	
	wp_redirect(SUBMISSION_REDIRECT_URL);
}
$lead_info = [];
if (isset($_GET['id']) && isset($_GET['vid'])) {
	$lead_id = filter_var($_GET['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$velocity_id = filter_var($_GET['vid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	
	if ($lead_id && $velocity_id) {
		$endpoint = LEADS360_API_URL . '/GetLead?username=' . LEADS360_USERNAME . '&password=' . LEADS360_PASSWORD . '&LeadId=' . $lead_id;
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$response = curl_exec($ch);
		
		curl_close($ch);
		
		if (!curl_errno($ch)) {
			$lead = simplexml_load_string($response);
			
			if (is_object($lead)) {
				$lead_info['ID'] = $lead_id;
				$lead_info['Salesforce_ID'] = $velocity_id;
				@$lead_info['title'] = (string)$lead->Lead->attributes()->LeadTitle;
				@$lead_info['campaign'] = (string)$lead->Lead->Campaign->attributes()->CampaignTitle;
				@$lead_info['lead_status'] = (string)$lead->Lead->Status->attributes()->StatusTitle;
				
				$lead_email = $lead->xpath('//Field[@FieldId="3"]');
				
				if ($lead_email) {
					@$lead_info['lead_email'] = (string)$lead_email[0]->attributes()->Value;
				}
				
				$lead_fname = $lead->xpath('//Field[@FieldId="4"]');
				
				if ($lead_fname) {
					@$lead_info['lead_fname'] = (string)$lead_fname[0]->attributes()->Value;
				}
				
				$lead_lname = $lead->xpath('//Field[@FieldId="5"]');
				
				if ($lead_lname) {
					@$lead_info['lead_lname'] = (string)$lead_lname[0]->attributes()->Value;
				}
				
				$lead_phone = $lead->xpath('//Field[@FieldId="11"]');
				
				if ($lead_phone) {
					@$lead_info['lead_phone'] = (string)$lead_phone[0]->attributes()->Value;
				}
				
				$lead_broken = $lead->xpath('//Field[@FieldId="233"]');
				
				if ($lead_broken) {
					@$lead_info['lead_broker'] = (string)$lead_broken[0]->attributes()->Value;
				}
			}
		}
	}
}
get_header(); ?>

	<div class="container">
		<div class="bgld-new-upload-form">
			<div class="bgld-purchase">
				<h2>
					Important steps to complete Your Purchase
				</h2>
				<div class="bgld-complete">
					<svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
						<path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path>
					</svg>
				</div>
			</div>

			<form action="" enctype="multipart/form-data" method="post">
				<div class="bgld-form-div bgld-form-div-account-type">
					<h4>What type of account will your funds come from? <span class="input-required">*</span></h4>

					<label>
						<input type="radio" name="account-type" value="Personal Account" required><span>Personal Account</span>
					</label>
					<label>
						<input type="radio" name="account-type" value="Joint Account"><span>Joint Account</span>
					</label>
					<label>
						<input type="radio" name="account-type" value="Trust"><span>Trust</span>
					</label>
					<label>
						<input type="radio" name="account-type" value="Corporation"><span>Corporation, LLC, S Corp and any other business type</span>
					</label>
				</div>

				<div class="bgld-form-div bgld-form-div-hidden bgld-form-div-account-full-name">
					<h4>What is the full name on the account that the funds will come from?</h4>

					<label>
						<input type="text" name="account-full-name"/>
					</label>
				</div>

				<div class="bgld-form-div bgld-form-div-hidden bgld-form-div-account-transfer">
					<h4>How do you intend to send funds for your purchase? <span class="input-required">*</span></h4>

					<label>
						<input type="radio" name="account-transfer-type" value="Bank wire" required><span>Bank wire</span>
					</label>
					<label>
						<input type="radio" name="account-transfer-type" value="Check"><span>Check</span>
					</label>
				</div>

				<div class="bgld-form-div bgld-form-div-hidden bgld-form-div-account-amount">
					<h4>What is your intended purchase amount? <span class="input-required">*</span></h4>

					<label>
						<input type="radio" name="account-amount" value="Up"><span>Up to $25,000</span>
					</label>
					<label>
						<input type="radio" name="account-amount" value="Over"><span>Over to $25,000</span>
					</label>
				</div>

				<div class="bgld-form-div bgld-form-div-identification">
					<div class="bgld-purchase">
						<div class="bgld-complete">
							<svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
								<path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path>
							</svg>
						</div>
					</div>

					<h4>Attach Your Identification <span class="input-required">*</span>
						<span class="for-two-people">(Joint account requires documents for two people)</span>
					</h4>
					<p>
						Please attach a photo or scan of government identification, such as a driver's license or passport.
						<br>
						The image must be clear and include the entire card or document.
					</p>
					<div class="bgld-form-file-upload bgld-form-file-upload-id">
						<input type="file" name="identification" class="input-field-id" required>
					</div>
					<div class="bgld-form-file-upload bgld-form-file-upload-id bgld-form-file-upload-two-people bgld-form-div-hidden">
						<input type="file" name="identification-2" class="input-field-id">
					</div>
				</div>

				<div class="bgld-form-div bgld-form-div-address bgld-form-div-hidden">
					<h4>Attach Proof of Current Address
						<span class="for-two-people">(Joint account requires documents for two people)</span>
					</h4>
					<p>
						Please attach a photo or scan of a document showing your current address such as a utility bill, cable bill, mortgage statement or signed lease agreement.
						<br>
						The image must be clear and include the entire card or document.
					</p>
					<div class="bgld-form-file-upload bgld-form-file-upload-address">
						<input type="file" name="address" class="input-field-address">
					</div>
					<div class="bgld-form-file-upload bgld-form-file-upload-address bgld-form-file-upload-two-people bgld-form-div-hidden">
						<input type="file" name="address-2" class="input-field-address">
					</div>
				</div>

				<div class="bgld-form-div bgld-form-div-trust bgld-form-div-hidden">
					<h4>Attach Trust Documents</h4>
					<p>
						Please attach a photo or scan of the first page of your trust documents, which must include the name of the person who will be sending funds.
						<br>
						The image must be clear and include the entire document.
					</p>
					<div class="bgld-form-file-upload bgld-form-file-upload-trust">
						<input type="file" name="trust" class="input-field-trust">
					</div>
				</div>

				<div class="bgld-form-div bgld-form-div-corporation bgld-form-div-hidden">
					<h4>Attach Articles of Incorportion</h4>
					<p>
						Please attach a photo or scan of (1) your articles of incorporation or (2) a statement of information from the Secretary of the State website.
						<br>
						The image must be clear and include the entire document.
					</p>
					<div class="bgld-form-file-upload bgld-form-file-upload-corporation">
						<input type="file" name="corporation" class="input-field-corporation">
					</div>
				</div>

				<div class="bgld-form-div-hidden-data">
					
					<?php
					
					if (!empty($lead_info)) {
						foreach ($lead_info as $key => $value) {
							echo '<input type="hidden" name="' . $key . '" value="' . $value . '"/>';
						}
					}
					
					?>
				</div>

				<div class="bgld-form-div">
					<div class="bgld-purchase">
						<div class="bgld-complete">
							<svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
								<path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path>
							</svg>
						</div>
					</div>

					<div>
						<p>When you click "Next" below, you will redirect to a page to sign Birch Gold's Shipping and Transaction Agreement. This will be the final step to complete at this time.</p>
						<input type="submit" name="purchase-info-submit" value="Submit">
					</div>
				</div>
			</form>
		</div>
	</div>

<?php get_footer();

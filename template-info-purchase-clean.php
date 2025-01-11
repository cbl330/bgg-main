<?php

/**

 * Template Name: Purchase Information Clean

 */

get_header('nonavnofollow');



global $wpdb;

global $wp_session;

global $access_token;

$API_URI = 'https://birchgoldgroup.my.salesforce.com';



/**

 * @return true

 */



function updateLead($updatedLead, $access_token): bool {

    global $API_URI;

    $updatedLead = json_encode($updatedLead);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $API_URI . "/services/apexrest/leadservices");

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");

    curl_setopt($ch, CURLOPT_POSTFIELDS, $updatedLead);

    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'boundary:a7V4kRcFA8E79pivMuV2tukQ85cmNKeoEgJgq', 'Authorization: Bearer ' . $access_token]);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    return true;

}



function updateLeadFiles($files, $account_id, $access_token) {

    global $API_URI;

    foreach ($files as $index => $file) {

        $data['attributes']['type'] = "ContentVersion";

        $data['attributes']['referenceId'] = "id" . $index;

        $data['FirstPublishLocationId'] = $account_id;

        $data['PathOnClient'] = $file['filename'];

        $data['Description'] = $file['filename'];

        $data['VersionData'] = base64_encode(file_get_contents($file['file']));

        $postFields->records[$index] = $data;

    }

    $json_test = json_encode($postFields);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $API_URI . "/services/data/v45.0/composite/sobjects");

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_test);

    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $access_token]);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    $server_output = json_decode($server_output);

    return $server_output;

}



function processComplete($fields, $access_token) {

    global $API_URI;

    $postFields = json_encode($fields);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $API_URI . "/services/apexrest/leadservices");

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $access_token]);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    echo $server_output;

    $server_output = json_decode($server_output);

    return $server_output;

}



function getAccessToken() {

    global $API_URI;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $API_URI . "/services/oauth2/token");

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, "username=apiuser@birchgold.com&password=#4Passwprd1&grant_type=password&client_id=3MVG9LBJLApeX_PBrh3.CqQ45HOkJZbZMkWKnTCdS6yQO0C6lUrGrIh1IBt0dYcfe1Lid7kVl1HJTwJ5aX6c5&client_secret=D4F29382ACAC3EC5DD9DC39AF6CE9CA1567C658836056C2C9B797B656AE3E28B");

    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    $server_output = json_decode($server_output);

    return $server_output;

}



$account_id = isset($_GET['account_id']) ? $_GET['account_id'] : "0"; $valoID = 0;



if ($account_id == "0") {

    header('Location:' . home_url());

    exit();

} else {

    global $API_URI;

    $server_output = getAccessToken();

    $access_token = $server_output->access_token;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $API_URI . "/services/apexrest/leadservices/" . $account_id);

    curl_setopt($ch, CURLOPT_GET, 1);

    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $access_token]);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    $leadData = json_decode($server_output);

    $wp_session['leadData'] = $leadData;



    if (curl_error($ch)) {

        header('Location:' . home_url());

        exit();

    } else {

        $first_name = $last_name = $email = $phone = $mobile = $address = $city = $state = $zip = $acc_type = $acc_name = "";

        $api_first_name = $api_last_name = $api_email = $api_phone = $api_mobile = $api_address = $api_city = $api_state = $api_zip = $api_acc_type = $api_acc_name = "";

        if ($leadData->lead) {



            $api_first_name = $first_name = $leadData->lead->FirstName;



            $api_last_name = $last_name = $leadData->lead->LastName;



            $api_email = $email = $leadData->lead->Email;



            $api_phone = $phone = $leadData->lead->Phone;



            $api_mobile = $mobile = $leadData->lead->MobilePhone;



            $api_street_address = $address = $leadData->lead->Street;



            $api_city = $city = $leadData->lead->City;



            $api_state = $state = $leadData->lead->State;



            $api_zip = $zip = $leadData->lead->PostalCode;



            $api_acc_name = $acc_name = $leadData->lead->Company;



            $valoID = $leadData->lead->Velo__Lead360RecordId__c;



            $dated = date("Y-m-d");



        } else {

            header('Location:' . home_url());

            exit();

        }

    }

    curl_close($ch);

}



if (isset($_REQUEST['nextbtn'])) {

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {



        $wp_session['leadData']->lead->FirstName = $first_name = $wpdb->escape($_REQUEST['fname']);

        $wp_session['leadData']->lead->LastName = $last_name = $wpdb->escape($_REQUEST['lname']);

        $wp_session['leadData']->lead->Email = $email = $wpdb->escape($_REQUEST['email']);

        $wp_session['leadData']->lead->Phone = $phone = $wpdb->escape($_REQUEST['pphone']);

        $wp_session['leadData']->lead->MobilePhone = $mobile = $wpdb->escape($_REQUEST['aphone']);

        $wp_session['leadData']->lead->Street = $address = $wpdb->escape($_REQUEST['adress']);

        $wp_session['leadData']->lead->City = $city = $wpdb->escape($_REQUEST['city']);

        $wp_session['leadData']->lead->PostalCode =  $zip = $wpdb->escape($_REQUEST['zip']);

        $wp_session['leadData']->lead->State =  $state = $wpdb->escape($_REQUEST['state']);

        $wp_session['leadData']->lead->Funding_Account_Type__c = $acc_type = $wpdb->escape($_REQUEST['account']);

        $wp_session['leadData']->lead->Funding_Account_Full_Name__c = $acc_type = $wpdb->escape($_REQUEST['accountname']);

        $wp_session['leadData']->lead->Fund_Sending_Mode__c = $acc_type = $wpdb->escape($_REQUEST['Account']);

        $wp_session['leadData']->lead->Intended_Purchase_Amount__c = $wpdb->escape($_REQUEST['Accounttt']);



        if (0 === count($errors)) {



            updateLead($wp_session['leadData'], $access_token);



            if (!empty($_FILES["file_upload"]["name"])) {

                $attach_name = 'ID-' . $account_id . '_' . basename($_FILES["file_upload"]["name"]);

                $target_dir = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";

                $target_file = $target_dir . $attach_name;

            } else {

                $target_file;

            }

            if (!empty($_FILES["file_upload1"]["name"])) {

                $attach_name1 = 'POI-' . $account_id . '_' . basename($_FILES["file_upload1"]["name"]);

                $target_dir1 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";

                $target_file1 = $target_dir1 . $attach_name1;

            } else {

                $target_file1;

            }

            if (!empty($_FILES["file_upload2"]["name"])) {

                $attach_name2 = 'AOI-' . $account_id . '_' . basename($_FILES["file_upload2"]["name"]);

                $target_dir2 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";

                $target_file2 = $target_dir2 . $attach_name2;

            } else {

                $target_file2;

            }

            if (!empty($_FILES["file_upload3"]["name"])) {

                $attach_name3 = 'TD-' . $account_id . '_' . basename($_FILES["file_upload3"]["name"]);

                $target_dir3 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";

                $target_file3 = $target_dir3 . $attach_name3;

            } else {

                $target_file3;

            }



            $message = "Hello,<br><br>";

            $message .= "Please find attachment as submitted document.'<br><br>";

            $message .= "Account Id: " . $account_id . '<br>';

            $message .= "First Name: " . $first_name . '<br>';

            $message .= "Last Name: " . $last_name . '<br>';

            $message .= "Email: " . $email . '<br>';

            $message .= "Phone: " . $phone . '<br>';

            $message .= "Mobile: " . $mobile . '<br><br>Thank You';

            $subject = __("Document Submission");



            $admin_email = "clientrelations@birchgold.com";



            $headers[] = 'From: clientrelations@birchgold.com';

            $headers[] = 'Cc: hesparza@birchgold.com';

            $headers[] = 'Content-Type: text/html; charset=UTF-8';



            $mail_attachment = [];

            $ApiAttachments = [];

            $index = 0;

            $uploadOk = 0;



            if (!empty($_FILES["file_upload"]["name"])) {



                $attach_name00 = $account_id . '_' . basename($_FILES["file_upload"]["name"]);

                $target_dir00 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";

                $target_file00 = $target_dir00 . $attach_name00;

                if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file00)) {

                    $mail_attachment[] = WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name00;

                    $ApiAttachments[$index]['filename'] = 'ID-' . $_FILES["file_upload"]["name"];

                    $ApiAttachments[$index]['file'] = WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name00;

                    $index++;

                    $uploadOk = 1;

                }

            }



            if (!empty($_FILES["file_upload1"]["name"])) {

                $attach_name100 = $account_id . '_' . basename($_FILES["file_upload1"]["name"]);

                $target_dir100 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";

                $target_file100 = $target_dir100 . $attach_name100;

                if (move_uploaded_file($_FILES["file_upload1"]["tmp_name"], $target_file100)) {

                    $mail_attachment[] = WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name100;

                    $ApiAttachments[$index]['filename'] = 'POA-' . $_FILES["file_upload1"]["name"];

                    $ApiAttachments[$index]['file'] = WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name100;

                    $index++;

                    $uploadOk = 1;

                }

            }

            if (!empty($_FILES["file_upload2"]["name"])) {

                $attach_name200 = 'AOI-' . $account_id . '_' . basename($_FILES["file_upload2"]["name"]);

                $target_dir200 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";

                $target_file200 = $target_dir200 . $attach_name200;

                if (move_uploaded_file($_FILES["file_upload2"]["tmp_name"], $target_file200)) {

                    $mail_attachment[] = WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name200;

                    $ApiAttachments[$index]['filename'] = 'AOI-' . $_FILES["file_upload2"]["name"];

                    $ApiAttachments[$index]['file'] = WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name200;

                    $index++;

                    $uploadOk = 1;

                }

            }

            if (!empty($_FILES["file_upload3"]["name"])) {

                $attach_name300 = 'TD-' . $account_id . '_' . basename($_FILES["file_upload3"]["name"]);

                $target_dir300 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";

                $target_file300 = $target_dir300 . $attach_name300;

                if (move_uploaded_file($_FILES["file_upload3"]["tmp_name"], $target_file300)) {

                    $mail_attachment[] = WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name300;

                    $ApiAttachments[$index]['filename'] = 'TD-' . $_FILES["file_upload3"]["name"];

                    $ApiAttachments[$index]['file'] = WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name300;

                    $index++;

                    $uploadOk = 1;

                }

            }



            $response = updateLeadFiles($ApiAttachments, $account_id, $access_token);

            $requestBody->isSuccess = $response[0]->success;

            $requestBody->leadId = $account_id;

            $response = processComplete($requestBody, $access_token);



            $convertedId =  $response->message;

            foreach ($mail_attachment as $att) {

                @unlink($att);

            }

            $to = "7niteweb@gmail.com";



            remove_filter('wp_mail_content_type', 'set_html_content_type');

            if (!is_wp_error($errors)) {

                $msg_success = "true";

                unlink('wp-content/uploads/customerdoc/' . $attach_name);

            } else {

                $errors['file_upload'] = "failed to upload file.";

            }



            $address = urlencode($address);

            $redirectURL = "https://www.docusign.net/Member/PowerFormSigning.aspx?PowerFormId=e0fa61c1-7512-42c9-9041-d9b9e59b8fe0&env=na1&acct=12f8b00b-1980-40bb-86a6-2dbc8a744207&v=2&Recipient_UserName=$first_name $last_name&Recipient_Email=$email&Name=$first_name $last_name&LeadId=$valoID&address=$address&Day=$phone&City=$city%2C$state%2C$zip&Email=$email&FullName=$first_name $last_name";

            

            header("Location: $redirectURL");



        }

    }

}

?>

<script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8-beta.7/jquery.inputmask.min.js" integrity="sha512-x3zoB6e8YsZipoDoCTClRYkEpqucilZ8IYsaJFE0XUtUJQdO7v2xFzvd1zQKrb3ParCNpvdAE0C85msCw3NrLA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="/wp-content/themes/birchgold/js/template_purchase_information.js"></script>



<div id="blogHeaderSidebar" class="row clearfix"></div>

<section class="content_block_background">

	<section id="row-<?php the_ID(); ?>" class="content_block clearfix" style="padding-top: 17px;">

		<section id="post-<?php the_ID(); ?>" <?php post_class("content full"); ?>>

			<div class="row clearfix">

				<div class="custom-page_title">

					<?= get_the_title(); ?>

				</div>

				<div class="row clearfix">

					<div class="box one clearfix first widget widget_text">

						<div class="textwidget"></div>

					</div>

				</div>

			</div>

			<div class="row clearfix">

				<hr class="style-six fadeInDown animated" data-rt-animation-group="single" data-rt-animation-type="fadeInDown" data-rt-animate="animate" style="animation-delay: 0s;">

			</div>

			<div class="row clearfix">

				<?php do_action("get_info_bar", apply_filters('get_info_bar_pages', ["called_for" => "inside_content"])); ?>

				<?php get_template_part('content', 'page'); ?>

				<?php if (comments_open() && get_option(RT_THEMESLUG . "_allow_page_comments")) : ?>

					<div class='entry commententry'>

						<?php comments_template(); ?>

					</div>

				<?php endif; ?>

			</div>

		</section>

	</section>

</section>

<section class="full_page">

	<div class="purchase">

		<h2>

			Important steps to complete Your Purchase

		</h2>

		<div class="complete">

			<i class="fas fa-angle-down"></i>

		</div>

		<h3 class="confirm">

			Confirm Your Information

		</h3>

		<p>

			Please review the following detail and update as necessary.

		</p>

	</div>

    <?php include 'include-purchase_information-form.php' ?>

</section>

<div class="footer-block" id="blogFooterSidebar">

	<?php dynamic_sidebar('footer nonav'); ?>

</div>



</section>

</section>

<div class="icon_foo">

	<?php get_footer('nonav'); ?>

</div>
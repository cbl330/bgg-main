<?php

/**
 *
* Template Name: Purchase Information Live*/
/* echo (WP_CONTENT_DIR);
exit(); */
get_header('nonavnofollow');

global $wpdb;
/**
 * @return true
 */
function updateLead($fieldId, $fieldVal): bool
{
    $account_id = isset($_GET['account_id']) ? $_GET['account_id'] : "0";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://service.leads360.com/ClientService.asmx/ModifyLeadField");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "username=VelocifyAPI@velocify.com&password=@Inte11ecTpo&leadId=" . $account_id . "&fieldId=" . $fieldId . "&newValue=" . $fieldVal);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    return true;
}
/**
 * @return true
 */
function addLeadNote($actionNote): bool
{
    $account_id = isset($_GET['account_id']) ? $_GET['account_id'] : "0";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://service.leads360.com/ClientService.asmx/AddLeadAction");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "username=VelocifyAPI@velocify.com&password=@Inte11ecTpo&leadId=" . $account_id . "&actionTypeId=2167&actionNote=" . $actionNote);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    return true;
}

$account_id = isset($_GET['account_id']) ? $_GET['account_id'] : "0";
if ($account_id == "0") {
    header('Location:' . home_url());
    exit();
} else {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://service.leads360.com/ClientService.asmx/GetLead");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "username=VelocifyAPI@velocify.com&password=@Inte11ecTpo&leadId=" . $account_id);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    if (curl_error($ch)) {
        header('Location:' . home_url());
        exit();
    } else {
        $first_name = $last_name = $email = $phone = $mobile = $address = $city = $state = $zip = $acc_type = $acc_name = "";
        $api_first_name = $api_last_name = $api_email = $api_phone = $api_mobile = $api_address = $api_city = $api_state = $api_zip = $api_acc_type = $api_acc_name = "";
        $xmlData = new SimpleXMLElement($server_output);
        $leadDataXml = json_encode($xmlData);
        $leadDataArr1 = json_decode($leadDataXml, true);
        $leadDataArr = $leadDataArr1['Lead']['Fields']['Field'];
        //echo "<pre>"; print_r($leadDataArr); echo "</pre>"; exit;
        if (count($leadDataArr) > 0) {
            foreach ($leadDataArr as $leadDataIndex => $leadDataVal) {
                if ($leadDataVal['@attributes']['FieldId'] == "4") {
                    $api_first_name = $first_name = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "5") {
                    $api_last_name = $last_name = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "3") {
                    $api_email = $email = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "11") {
                    $api_phone = $phone = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "12") {
                    $api_mobile = $mobile = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "6") {
                    $api_street_address = $address = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "7") {
                    $api_city = $city = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "230") {
                    $api_state = $state = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "160") {
                    $api_zip = $zip = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "166") {
                    $api_acc_name = $acc_name = $leadDataVal['@attributes']['Value'];
                }
            }
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
        /*  echo "<pre>";
            print_r($_REQUEST); */
        $first_name = $wpdb->escape($_REQUEST['fname']);
        $last_name = $wpdb->escape($_REQUEST['lname']);
        $email = $wpdb->escape($_REQUEST['email']);
        $phone = $wpdb->escape($_REQUEST['pphone']);
        $mobile = $wpdb->escape($_REQUEST['aphone']);
        $address = $wpdb->escape($_REQUEST['adress']);
        $city = $wpdb->escape($_REQUEST['city']);
        $state = $wpdb->escape($_REQUEST['state']);
        $zip = $wpdb->escape($_REQUEST['zip']);
        $acc_type = $wpdb->escape($_REQUEST['account']);
        $acc_name = $wpdb->escape($_REQUEST['accountname']);

        /*  echo $data ="https://www.docusign.net/Member/PowerFormSigning.aspx?PowerFormId=e0fa61c1-7512-42c9-9041-d9b9e59b8fe0&Recipient_UserName=$first_name $last_name&Recipient_Email=$email&Name=$acc_name&LeadId=$account_id&address=$address&Day=$phone&City=$city%2C$state%2C$zip&Email=$email";

            die();  */
        if (0 === count($errors)) {
            //echo "here"; exit;
            $actionNote = "";
            if ($first_name != $api_first_name) {
                $actionNote .= "First_Name_Old=" . $api_first_name . ", First_Name_New=" . $first_name . ",";
                updateLead(4, $first_name);
            }
            if ($last_name != $api_last_name) {
                $actionNote .= "Last_Name_Old=" . $api_last_name . ", Last_Name_New=" . $last_name . ",";
                updateLead("5", $last_name);
            }
            if ($address != $api_street_address) {
                $actionNote .= "Address_Old=" . $api_street_address . ", Address_New=" . $address . ",";
                updateLead("6", $address);
            }
            if ($city != $api_city) {
                $actionNote .= "City_Old=" . $api_city . ", City_New=" . $city . ",";
                updateLead("7", $city);
            }
            if ($state != $api_state) {
                $actionNote .= "State_Old=" . $api_state . ", State_New=" . $state . ",";
                updateLead("230", $state);
            }
            if ($zip != $api_zip) {
                $actionNote .= "Zip_Old=" . $api_zip . ", Zip_New=" . $zip . ",";
                updateLead("160", $zip);
            }
            if ($phone != $api_phone) {
                $actionNote .= "Phone_Old=" . $api_phone . ", Phone_New=" . $phone . ",";
                updateLead("11", $phone);
            }
            if ($mobile != $api_mobile) {
                $actionNote .= "Alternative_Mobile_old=" . $api_mobile . ", Alternative_Mobile_New=" . $mobile . ",";
                updateLead("12", $mobile);
            }
            if ($email != $api_email) {
                $actionNote .= "Email_old=" . $api_email . ", Email_New=" . $email . ",";
                updateLead("3", $email);
            }
            if ($acc_name != $api_acc_name) {
                $actionNote .= "AccountName_old=" . $api_acc_name . ", AccountName_New=" . $acc_name . ",";
                updateLead("166", $acc_name);
            }
            updateLead("258", $dated);
            if ($actionNote != "") {
                addLeadNote("STA fields updated " . $actionNote);
            }

            // if (!empty($_FILES["file_upload"]["name"])) {
            // $attach_name = $account_id.'_'.basename($_FILES["file_upload"]["name"]);
            // $target_dir = "/home/birchgold.com/public_html/wp-content/uploads/customerdoc/";
            // $target_file = $target_dir.$attach_name;

            // // $attach_name = $account_id.'_'.basename($_FILES["file_upload"]["name"]);
            // // $target_dir = "/home/birchgold.com/public_html/wp-content/uploads/customerdoc/";
            // // file_put_contents($target_dir.'test.txt',$attach_name);
            // // $target_file = $target_dir.$attach_name;
            // // file_put_contents($target_dir.'test1.txt',$target_file);
            // // $uploadOk = 1;
            // // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // // $check = getimagesize($_FILES["file_upload"]["tmp_name"]);
            // // if($check !== false) {
            // // echo "File is an image - " . $check["mime"] . ".";
            // // $uploadOk = 1;
            // // } else {
            // // echo "File is not an image.";
            // // $uploadOk = 0;
            // // }
            // // if (file_exists($target_file)) {
            // // //echo "Sorry, file already exists.";
            // // $uploadOk = 0;
            // // }
            // // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            // // && $imageFileType != "gif" ) {
            // // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            // // $uploadOk = 0;
            // // }

            // }
            // if (!empty($_FILES["file_upload1"]["name"])) {
            // $attach_name = $account_id.'_'.basename($_FILES["file_upload"]["name"]);
            // $target_dir = "/home/birchgold.com/public_html/wp-content/uploads/customerdoc/";
            // $target_file = $target_dir.$attach_name;

            // // $attach_name = $account_id.'_'.basename($_FILES["file_upload"]["name"]);
            // // $target_dir = "/home/birchgold.com/public_html/wp-content/uploads/customerdoc/";
            // // file_put_contents($target_dir.'test.txt',$attach_name);
            // // $target_file = $target_dir.$attach_name;
            // // file_put_contents($target_dir.'test1.txt',$target_file);
            // // $uploadOk = 1;
            // // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // // $check = getimagesize($_FILES["file_upload"]["tmp_name"]);
            // // if($check !== false) {
            // // echo "File is an image - " . $check["mime"] . ".";
            // // $uploadOk = 1;
            // // } else {
            // // echo "File is not an image.";
            // // $uploadOk = 0;
            // // }
            // // if (file_exists($target_file)) {
            // // //echo "Sorry, file already exists.";
            // // $uploadOk = 0;
            // // }
            // // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            // // && $imageFileType != "gif" ) {
            // // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            // // $uploadOk = 0;
            // // }

            // }

            // if (!empty($_FILES["file_upload2"]["name"])) {
            // $attach_name = $account_id.'_'.basename($_FILES["file_upload"]["name"]);
            // $target_dir = "/home/birchgold.com/public_html/wp-content/uploads/customerdoc/";
            // $target_file = $target_dir.$attach_name;

            // // $attach_name = $account_id.'_'.basename($_FILES["file_upload"]["name"]);
            // // $target_dir = "/home/birchgold.com/public_html/wp-content/uploads/customerdoc/";
            // // file_put_contents($target_dir.'test.txt',$attach_name);
            // // $target_file = $target_dir.$attach_name;
            // // file_put_contents($target_dir.'test1.txt',$target_file);
            // // $uploadOk = 1;
            // // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // // $check = getimagesize($_FILES["file_upload"]["tmp_name"]);
            // // if($check !== false) {
            // // echo "File is an image - " . $check["mime"] . ".";
            // // $uploadOk = 1;
            // // } else {
            // // echo "File is not an image.";
            // // $uploadOk = 0;
            // // }
            // // if (file_exists($target_file)) {
            // // //echo "Sorry, file already exists.";
            // // $uploadOk = 0;
            // // }
            // // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            // // && $imageFileType != "gif" ) {
            // // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            // // $uploadOk = 0;
            // // }
            // }

            // if (!empty($_FILES["file_upload3"]["name"])) {
            // $attach_name = $account_id.'_'.basename($_FILES["file_upload"]["name"]);
            // $target_dir = "/home/birchgold.com/public_html/wp-content/uploads/customerdoc/";
            // $target_file = $target_dir.$attach_name;
            // // // file_put_contents($target_dir.'test.txt',$attach_name);
            // // file_put_contents($target_dir.'test1.txt',$target_file);
            // // $uploadOk = 1;
            // // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // // $check = getimagesize($_FILES["file_upload"]["tmp_name"]);
            // // if($check !== false) {
            // // echo "File is an image - " . $check["mime"] . ".";
            // // $uploadOk = 1;
            // // } else {
            // // echo "File is not an image.";
            // // $uploadOk = 0;
            // // }
            // // if (file_exists($target_file)) {
            // // //echo "Sorry, file already exists.";
            // // $uploadOk = 0;
            // // }
            // // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            // // && $imageFileType != "gif" ) {
            // // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            // // $uploadOk = 0;
            // // }
            // }

            if (!empty($_FILES["file_upload"]["name"])) {
                $attach_name = $account_id . '_' . basename($_FILES["file_upload"]["name"]);
                $target_dir = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";
                $target_file = $target_dir . $attach_name;
            } else {
                $target_file;
            }
            if (!empty($_FILES["file_upload1"]["name"])) {
                $attach_name1 = $account_id . '_' . basename($_FILES["file_upload1"]["name"]);
                $target_dir1 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";
                $target_file1 = $target_dir1 . $attach_name1;
            } else {
                $target_file1;
            }
            if (!empty($_FILES["file_upload2"]["name"])) {
                $attach_name2 = $account_id . '_' . basename($_FILES["file_upload2"]["name"]);
                $target_dir2 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";
                $target_file2 = $target_dir2 . $attach_name2;
            } else {
                $target_file2;
            }
            if (!empty($_FILES["file_upload3"]["name"])) {
                $attach_name3 = $account_id . '_' . basename($_FILES["file_upload3"]["name"]);
                $target_dir3 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";
                $target_file3 = $target_dir3 . $attach_name3;
            } else {
                $target_file3;
            }
            //exit();
            // if ($uploadOk == 0) {
            // echo "Sorry, your file was not uploaded.";
            // } else  {
            // if ( || move_uploaded_file($_FILES["file_upload1"]["tmp_name"], $target_file1) || move_uploaded_file($_FILES["file_upload2"]["tmp_name"], $target_file2)  ||move_uploaded_file($_FILES["file_upload3"]["tmp_name"], $target_file3) ) {
            //Customerrelations@birchgold.com
            //customerrelations@birchgold.com
            //HEsparza626@gmail.com
            //clientrelations@birchgold.com
            //$emailf=wp_mail( $to, $subject, $message, $headers );
            //wp_mail( $email, $subject, $message, $headers,$mail_attachment);
            //wp_mail( $email, $subject, $message, $headers);
            //wp_mail("saeedurrehman15@yahoo.com", $subject, $message, $headers,$mail_attachment);
            //wp_mail("hesparza@birchgold.com", $subject, $message, $headers,$mail_attachment);
            //$headers = array();
            //add_filter( 'wp_mail_content_type', function( $content_type ) {return 'text/html';});
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

            // $admin_email = array(
            // 'From: 7niteweb@gmail.com',
            // 'CC: websolution807@gmail.com'
            // );
            // $mail_attachment = array(WP_CONTENT_DIR . '/uploads/customerdoc/'.$attach_name);
            $mail_attachment = [];
            $uploadOk = 0;
            if (!empty($_FILES["file_upload"]["name"])) {

                $attach_name00 = $account_id . '_' . basename($_FILES["file_upload"]["name"]);
                $target_dir00 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";
                $target_file00 = $target_dir00 . $attach_name00;
                if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file00)) {
                    $mail_attachment[] = WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name00;
                    $uploadOk = 1;
                    //echo 'mail_attachment';
                }
            }
            //echo '<pre>';
            //print_r($_FILES);
            //echo '</pre>';
            if (!empty($_FILES["file_upload1"]["name"])) {
                $attach_name100 = $account_id . '_' . basename($_FILES["file_upload1"]["name"]);
                $target_dir100 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";
                $target_file100 = $target_dir100 . $attach_name100;
                if (move_uploaded_file($_FILES["file_upload1"]["tmp_name"], $target_file100)) {
                    $mail_attachment[] = WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name100;
                    //$mail_attachment[] =WP_CONTENT_DIR . '/uploads/customerdoc/'.$attach_name100;
                    // echo 'mail_attachment 2';
                    $uploadOk = 1;
                }
            }
            //echo '<pre>';
            //print_r($_FILES);
            //echo '</pre>';
            if (!empty($_FILES["file_upload2"]["name"])) {
                $attach_name200 = $account_id . '_' . basename($_FILES["file_upload2"]["name"]);
                $target_dir200 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";
                $target_file200 = $target_dir200 . $attach_name200;
                if (move_uploaded_file($_FILES["file_upload2"]["tmp_name"], $target_file200)) {
                    $mail_attachment[] = WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name200;
                    //$mail_attachment[] = WP_CONTENT_DIR . '/uploads/customerdoc/'.$attach_name200;
                    //echo 'mail_attachment 2';
                    $uploadOk = 1;
                }
            }
            if (!empty($_FILES["file_upload3"]["name"])) {
                $attach_name300 = $account_id . '_' . basename($_FILES["file_upload3"]["name"]);
                $target_dir300 = "/home/customer/www/birchgold.com/public_html/wp-content/uploads/customerdoc/";
                $target_file300 = $target_dir300 . $attach_name300;
                if (move_uploaded_file($_FILES["file_upload3"]["tmp_name"], $target_file300)) {
                    $mail_attachment[] = WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name300;
                    //$mail_attachment[] = WP_CONTENT_DIR . '/uploads/customerdoc/'.$attach_name300;
                    //echo 'mail_attachment 3';
                    $uploadOk = 1;
                }
            }
            if ($uploadOk == 1) {
                wp_mail($admin_email, $subject, $message, $headers, $mail_attachment);
            }
            //echo '<pre>';
            //print_r($mail_attachment);
            //echo '</pre>';
            foreach ($mail_attachment as $att) {
                @unlink($att);
            }
            //	exit();
            $to = "7niteweb@gmail.com";
            //wp_mail($to, $subject, $message, $headers);
            // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578

            remove_filter('wp_mail_content_type', 'set_html_content_type');
            if (!is_wp_error($errors)) {
                $msg_success = "true";
                unlink('wp-content/uploads/customerdoc/' . $attach_name);


                //unset($_POST);
            } else {
                $errors['file_upload'] = "failed to upload file.";
            }
            // }
            // }
            $address = urlencode($address);
			if($state == "Idaho"){
				echo $data = "https://www.docusign.net/Member/PowerFormSigning.aspx?PowerFormId=cbb9f5e5-4428-48f6-bbad-58877022e951&env=na1&acct=12f8b00b-1980-40bb-86a6-2dbc8a744207&v=2&Recipient_UserName=$first_name $last_name&Recipient_Email=$email&Name=$acc_name&LeadId=$account_id&address=$address&Day=$phone&City=$city%2C$state%2C$zip&Email=$email";
            	header("Location: $data");
			}else{
				echo $data = "https://www.docusign.net/Member/PowerFormSigning.aspx?PowerFormId=58842f0b-8e37-456a-8117-83485895ff63&env=na1&acct=12f8b00b-1980-40bb-86a6-2dbc8a744207&v=2&acct=77e96df0-eb10-4d68-b0ca-4659e0911f4a&v=2&Recipient_UserName=$first_name $last_name&Recipient_Email=$email&Name=$acc_name&LeadId=$account_id&address=$address&Day=$phone&City=$city%2C$state%2C$zip&Email=$email";
            	header("Location: $data");
			}
            

            /*  $envelop_summary = null;
if(!empty($testConfig->getAccountId()))
{
    $envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($testConfig->getApiClient());
    // assign recipient to template role by setting name, email, and role name.  Note that the
    // template role name must match the placeholder role name saved in your account template.
    $templateRole = new  DocuSign\eSign\Model\TemplateRole();
    $templateRole->setEmail($testConfig->getRecipientEmail());
    $templateRole->setName($testConfig->getRecipientName());
    $templateRole->setRoleName($testConfig->getTemplateRoleName());
    $envelop_definition = new DocuSign\eSign\Model\EnvelopeDefinition();
    $envelop_definition->setEmailSubject("[DocuSign PHP SDK] - Please sign this template doc");
    // add the role to the envelope and assign valid templateId from your account
    $envelop_definition->setTemplateRoles(array($templateRole));
    $envelop_definition->setTemplateId($testConfig->getTemplateId());
    // set envelope status to "sent" to immediately send the signature request
    $envelop_definition->setStatus("sent");
    $options = new \DocuSign\eSign\Api\EnvelopesApi\CreateEnvelopeOptions();
    $options->setCdseMode(null);
    $options->setMergeRolesOnDraft(null);
    $envelop_summary = $envelopeApi->createEnvelope($testConfig->getAccountId(), $envelop_definition, $options);
}
$this->assertNotEmpty($envelop_summary);

return $testConfig;



            header('Location:'.home_url().'/upload?account_id='.$account_id);exit(); */
        }
    }
}
?>
<script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	/* jQuery('.bankacct').click(function(){
		alert('test');
		//$('.sec_img2').hide();
		//$('.upload2').show();
	}); */
	/* $('.checkacct').click(function(){
		alert('test');
		$('.sec_img2').hide();
		$('.upload2').show();
	}); */
	/* function showtick() {
		$('.upload').hide();
		$('.sec_img').show();

	} */

	function showticks() {
		$('.upload1').hide();
		$('.sec_img1').show();

	}



	function showticks2() {
		$('.upload3').hide();
		$('.sec_img3').show();

	}
	$(document).ready(function() {

		var arrowUp = $('.footer-block .arrow-up');

		arrowUp.hide();

		$(window).scroll(function() {
			if ($(this).scrollTop() > 700) {
				arrowUp.show();
			} else {
				arrowUp.hide();
			}
		});

		arrowUp.click(function() {
			$('html, body').animate({
				scrollTop: 0
			}, 1000);
			return false;
		});


		$('select[name^="state"] option[value="<?php echo $state; ?>"]').attr("selected", "selected");
		$('select[name^="state"] option:selected').attr("selected", null);

		$("input[name$='account']").click(function() {

			var acct = $(this).val();
			if (acct == 'Joint') {
				$(".detail_full1").show();
				$(".detail_full2").show();
				$(".detail_full3").hide();
				$(".text_three").hide();
				$(".upload1").hide();
				$(".text_four").hide();
				$(".upload2").hide();
				$(".text_five").hide();
				$(".upload3").hide();
				$(".sec_img1").hide();
				$(".sec_img2").hide();
				$(".sec_img3").hide();
				$(".sec_img").hide();
				if ($(".checkacct").is(':checked') && $(".checacct").is(':checked')) {
					$(".text_three").show();
					$(".upload1").show();
				} else {
					$(".text_four").hide();
					$(".upload2").hide();
					$(".text_five").hide();
					$(".upload3").hide();
				}

			} else if (acct == "corporation") {

				$(".detail_full1").show();
				$(".detail_full2").show();
				$(".detail_full3").hide();
				$(".text_three").hide();
				$(".upload1").hide();
				$(".text_five").hide(); //
				$(".upload3").hide(); //
				$(".sec_img1").hide();
				$(".sec_img2").hide(); //
				$(".sec_img").hide(); //
				$('.sec_img3').hide();
				if ($(".checkacct").is(':checked') || $(".bankacct").is(':checked')) {
					$(".text_four").show();
					$(".upload2").show();
					$("test").show(); ///////
				} else {
					$(".text_three").hide();
					$(".upload1").hide();
					$(".text_five").hide();
					$(".upload3").hide();
				}

			} else if (acct == "Trust") {

				$(".detail_full1").show();
				$(".detail_full2").show();
				$(".detail_full3").hide();
				$(".text_three").hide();
				$(".upload1").hide();
				$(".text_four").hide(); //
				$(".upload2").hide(); //
				$(".text_five").hide();
				$(".upload3").hide();
				$(".upload").show();

				$(".sec_img1").hide();
				$(".sec_img3").hide(); //
				$(".sec_img").hide();
				//if($(".checkacct").is(':checked') && $(".checacct").is(':checked')) {
				if ($(".checkacct").is(':checked') || $(".bankacct").is(':checked')) {
					$(".text_five").show();
					$(".upload3").show();
				} else {
					$(".text_three").hide();
					$(".upload1").hide();
					$(".text_four").hide();
					$(".upload2").hide();

				}
			} else if (acct == "personal") {
				$(".detail_full2").show();
				$(".text_three").hide(); //////
				$(".upload1").hide(); ///////
				$(".text_four").hide();
				$(".upload2").hide();
				$(".upload").show();
				$(".text_five").hide();
				$(".upload3").hide();
				$(".sec_img1").hide();
				$(".sec_img2").hide();
				$(".sec_img3").hide();
				$(".sec_img").hide();

				if ($(".checkacct").is(':checked') && $(".checacct").is(':checked')) {
					//if($(".checkacct").is(':checked') || $(".bankacct").is(':checked')){
					$(".text_three").show();
					$(".upload1").show();
				} else {
					$(".text_four").hide();
					$(".upload2").hide();
					$(".text_five").hide();
					$(".upload3").hide();
				}
				if ($(".bankacct").is(':checked')) {
					$(".detail_full3").show();
				} else {
					$(".detail_full3").hide();
				}
			} else {
				$(".detail_full1").hide();
				$(".detail_full2").hide();
			}
		});

		// $("input[name$='account']").click(function() {
		// var acctt = $(this).val();
		// if(acctt == 'personal') {
		// $(".detail_full2").show();
		// $(".upload1").hide();


		// } else {
		// $(".detail_full2").hide();

		// }
		// });


		// $("input[name$='Account']").click(function() {
		// var acctttt = $(this).val();
		// if(acctttt == 'Check') {
		// $(".text_two").show();
		// $(".upload").show();



		// } else {
		// $(".text_two").hide();
		// $(".upload").hide();

		// }
		// });



		/* $("input[name$='Account']").click(function() {
        var accttt = $(this).val();
		if(accttt == 'Check') {
			$(".text_two").show();
			$(".upload").show();
			
			
		} else {
			$(".text_two").hide();
			$(".upload").hide();
			
		}
    });
	 */
		$("input[name$='Account']").click(function() {
			var acctttt = $(this).val();
			if (acctttt == 'Bank') {
				if ($(".corpacct").is(':checked')) {
					$(".detail_full3").hide();
					$(".text_two").show();
					$(".upload").show();
					$(".text_four").show();
					$(".upload2").show();
					$(".text_five").hide();
					$(".upload3").hide();
					$('.sec_img3').hide();

				} else if ($(".jointacct").is(':checked')) {
					$(".detail_full3").show();
					$(".text_two").show();
					$(".upload").show();
					$(".text_four").hide();
					$(".upload2").hide();
					$(".text_three").show();
					$(".upload1").show();
					$(".text_five").hide();
					$(".upload3").hide();
					$('.sec_img1').hide();
					$(".sec_img2").hide();
					$(".sec_img3").hide();

				} else if ($(".personalacct").is(':checked')) {
					$(".detail_full3").show();
					$(".text_four").hide();
					$(".upload2").hide();
					$(".text_three").show();
					$(".upload1").show();
					$(".text_five").hide();
					$(".upload3").hide();
					$('.sec_img1').hide();
					$(".sec_img2").hide();
					$(".sec_img3").hide();

				} else if ($(".trustacct").is(':checked')) {
					$(".detail_full3").hide();
					$(".text_two").show();
					$(".upload").show();
					$(".text_four").hide();
					$(".text_three").hide()
					$(".text_five").show()
					$(".upload1").hide();
					$(".upload2").hide();
					$(".upload3").show();

				} else {
					$(".detail_full3").show();
				}
				$(".text_two").show();
				$(".upload").show();
				$(".text_three").hide();
				$(".upload1").hide();


			} else if ($(this).val() == "Check") {
				if ($(".corpacct").is(':checked')) {
					//alert("Hi");
					$(".detail_full3").hide();
					$(".text_four").show();
					$(".upload2").show();
					$(".upload").show();
					$(".text_five").hide();
					$(".upload3").hide();
					$(".sec_image").hide();
					$('.sec_img3').hide();

				} else if ($(".trustacct").is(':checked')) {
					$(".detail_full3").hide();
					$(".text_three").hide();
					$(".upload1").hide();
					$(".text_four").hide();
					$(".upload2").hide();
					$(".text_five").show();
					$(".upload3").show();
					$(".sec_img1").hide();
					$(".sec_img2").hide();
					$(".sec_img3").hide();
					$(".sec_img").hide();
				} else if ($(".jointacct").is(':checked')) {
					$(".detail_full3").hide();
					$(".text_four").hide();
					$(".upload2").hide();
					$(".text_three").show();
					$(".upload1").show();
					$(".text_five").hide();
					$(".upload3").hide();
					$(".sec_img1").hide();
					$(".sec_img2").hide();
					$(".sec_img3").hide();


				} else if ($(".personalacct").is(':checked')) { //(acctttt =="personal"){
					$(".detail_full3").hide();
					$(".text_two").show();
					$(".text_three").show();
					$(".upload").show();
					$(".upload1").show();
					$(".upload2").hide();
					$(".upload3").hide();
					$(".sec_img1").hide();
					$(".sec_img2").hide();
					$(".sec_img3").hide();
					$(".sec_img").hide();


				}
				$(".text_two").show();
				//$(".text_three").show();
				$(".upload").show();
				//$(".upload1").show();
				$(".detail_full3").hide();



			} else {
				$(".detail_full3").hide();
				$(".text_two").hide();
				$(".upload").hide();


			}
		});


		$("input[name$='Accounttt']").click(function() {
			var accttttt = $(this).val();
			if (accttttt == 'Up' || accttttt == 'Over') {
				$(".text_two").show();
				$(".upload").show();
				$(".sec_img2").hide();
				$(".sec_img3").hide();
				$(".sec_img").hide();
				$(".sec_img1").hide();



			} else {
				$(".text_two").hide();
				$(".upload").hide();

			}
		});

		$("input[name$='Accounttt']").click(function() {
			var accttttt = $(this).val();
			if (accttttt == 'Over') {
				$(".text_three").show();
				$(".upload1").show();



			} else {
				$(".text_three").hide();
				$(".upload1").hide();

			}
		});

		$('.submitbtn').click(function() {
			var pri_phone = $('#pphone').val();
			var alt_phone = $('#aphone').val();
			var zip_code = $('#zip').val();
			var email = $('#email').val();
			var fname = $('#fname').val();
			var lname = $('#lname').val();
			var city = $('#city').val();
			var adress = $('#adress').val();
			var accnt = $('[name="account"]:checked').length;
			var accnt_type = $('[name="account"]:checked').val();
			var acc_fullname = fname + " " + lname;

			var success = "";

			if (accnt_type == 'Joint' || accnt_type == 'Trust') {
				var acc_name = $('#accountname').val();
				/* if(acc_name == '') {
				fullnameaccount_error.style.color = '#ea1b1b';
				//cityerror.innerHTML = "City not to be empty";
				$("#fullnameaccount_error").text("Account Name Required").show();
				$('#accountname').focus();
				success = '0';
			}  */
			} else {
				var acc_name = $('#accountname').val(acc_fullname);
			}
			var acct_name1 = $('#accountname').val();

			if (acct_name1 == '') {
				fullnameaccount_error.style.color = '#ea1b1b';
				//cityerror.innerHTML = "City not to be empty";
				$("#fullnameaccount_error").text("Account Name Required").show();
				$("#fullnameaccount_error").css("font-weight", "100");
				$('#accountname').focus();
				//alert('Phone number must be 10 digit!');
				success = '0';
			} else {
				$('#fullnameaccount_error').hide();
			}

			/* if(accnt == 0){
				accounterror.style.color = '#ea1b1b';
				//cityerror.innerHTML = "City not to be empty";
				$("#accounterror").text("Account Type Required");
				$('#personalacct').focus();
				//alert('Phone number must be 10 digit!');
				success = '0';
			}else {
				$('#accounterror').hide();
				
			} */

			if (zip_code == '') {
				message1.style.color = '#ea1b1b';
				// message1.innerHTML = "Zip Code not to be empty!";
				$("#message1").text("Zip Code Required").show();
				$('#zip').focus();
				success = '0';
			} else if (zip_code.length != 5) {

				//pphone.style.backgroundColor = '#FF9B37';
				message1.style.color = '#ea1b1b';
				//message1.innerHTML = "Zip Code must be 5 digits!";
				$("#message1").text("Zip Code must be 5 digits").show();
				$('#zip').focus();
				//alert('Zip code must be 5 digit!');
				success = '0';
			} else {
				$('#message1').hide();
			}

			if (city == '') {
				cityerror.style.color = '#ea1b1b';
				//cityerror.innerHTML = "City not to be empty";
				$("#cityerror").text("City Required").show();
				$('#city').focus();
				//alert('Phone number must be 10 digit!');
				success = '0';
			} else {
				$('#cityerror').hide();
			}


			if (adress == '') {
				adresserror.style.color = '#ea1b1b';
				//adresserror.innerHTML = "Adress not to be empty";
				$("#adresserror").text("Address Required").show();
				$('#adress').focus();
				//alert('Phone number must be 10 digit!');
				success = '0';
			} else {
				$('#adresserror').hide();
			}

			if (email == '') {
				err_email.style.color = '#ea1b1b';
				//err_email.innerHTML = "email not to be empty!";
				$("#err_email").text("Email Required").show();
				$('#email').focus();
				success = '0';
			} else if (IsEmail(email) == false) {
				err_email.style.color = '#ea1b1b';
				//err_email.innerHTML = "Please enter valid Email !";
				$("#err_email").text("Please enter valid Email").show();
				$('#email').focus();
				success = '0';
			} else {
				$('#err_email').hide();
			}

			if (alt_phone.length == '') {

			} else if (alt_phone.length != 10) {
				// message.style.color = '#FF9B37';
				//aphone.style.backgroundColor = '#FF9B37';
				message.style.color = '#ea1b1b';
				//message.innerHTML = "Phone number must be 10 digits!";
				$("#message").text("Alternate Phone must be 10 digits").show();
				$('#aphone').focus();
				//alert('Phone number must be 10 digit!');
				success = '0';
			} else {
				$('#message').hide();
			}


			if (pri_phone == '') {
				error.style.color = '#ea1b1b';
				//error.innerHTML = "Primary phone not to be empty";
				$("#error").text("Primary Phone Required").show();
				$('#pphone').focus();
				//alert('Phone number must be 10 digit!');
				success = '0';
			} else if (pri_phone.length != 10) {
				// message.style.color = '#FF9B37';
				//aphone.style.backgroundColor = '#FF9B37';
				error.style.color = '#ea1b1b';
				//error.innerHTML = "Phone number must be 10 digits!";
				$("#error").text("Primary Phone must be 10 digits").show();
				$('#pphone').focus();
				//alert('Phone number must be 10 digit!');
				success = '0';
			} else {
				$('#error').hide();
			}


			if (lname == '') {
				lnameerror.style.color = '#ea1b1b';
				//lnameerror.innerHTML = "Last name not to be empty";
				$("#lnameerror").text("Last Name Required").show();
				$('#lname').focus();
				//alert('Phone number must be 10 digit!');
				success = '0';
			} else {
				$('#lnameerror').hide();
			}

			if (fname == '') {
				fnameerror.style.color = '#ea1b1b';
				//fnameerror.innerHTML = "First Name not to be empty";
				$("#fnameerror").text("First Name Required").show();
				$('#fname').focus();
				//alert('Phone number must be 10 digit!');
				success = '0';
			} else {
				$('#fnameerror').hide();
			}

			function IsEmail(email) {
				var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (!regex.test(email)) {
					return false;
				} else {
					return true;
				}
			}

			if (success == '0') {
				return false;
			} else {
				//$( "#form_datta" ).submit();
				return true;
			}
		});

		document.getElementById("pphone").addEventListener("keydown", function(e) {
			var key = e.keyCode ? e.keyCode : e.which;

			if (!([8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
					(key == 65 && (e.ctrlKey || e.metaKey)) ||
					(key >= 35 && key <= 40) ||
					(key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
					(key >= 96 && key <= 105)
				)) e.preventDefault();
		});

		document.getElementById("zip").addEventListener("keydown", function(e) {
			var key = e.keyCode ? e.keyCode : e.which;

			if (!([8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
					(key == 65 && (e.ctrlKey || e.metaKey)) ||
					(key >= 35 && key <= 40) ||
					(key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
					(key >= 96 && key <= 105)
				)) e.preventDefault();
		});

		document.getElementById("aphone").addEventListener("keydown", function(e) {
			var key = e.keyCode ? e.keyCode : e.which;

			if (!([8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
					(key == 65 && (e.ctrlKey || e.metaKey)) ||
					(key >= 35 && key <= 40) ||
					(key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
					(key >= 96 && key <= 105)
				)) e.preventDefault();
		});
	});
</script>


<div id="blogHeaderSidebar" class="row clearfix">
</div>

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
				<hr class="style-six fadeInDown animated" data-rt-animation-group="single" data-rt-animation-type="fadeInDown" data-rt-animate="animate" style="animati
on-delay: 0s;">
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
		<!-- / end section .content -->
		<?php // get_sidebar();
        ?>
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
	<form class="review sec_review" name="form1" action="" method="post" id="form_datta" enctype="multipart/form-data">
		<div class="detail_full">
			<div class="detail_new">
				<label>Account ID* </label>
				<input type="text" name="accountid" id="accountid" style="background-color:lightgrey" class="name_one" value="<?php echo $account_id; ?>" readonly>
			</div>
		</div>
		<div class="Alternate">
			<div class="detail">
				<label>First Name* </label>
				<input type="text" name="fname" id="fname" value="<?php echo $first_name; ?>" class="name_one" style="text-transform: capitalize">
				<span id="fnameerror"></span>
			</div>
			<div class="detail">
				<label>Last Name*</label>
				<input type="text" name="lname" id="lname" value="<?php echo $last_name; ?>" class="name_one" style="text-transform: capitalize">
				<span id="lnameerror"></span>
			</div>
		</div>
		<div class="detail">
			<label>Primary Phone*</label>
			<input type="text" name="pphone" id='pphone' maxlength="10" value="<?php echo $phone; ?>" class="name_one">
			<!--input type="text" name="pphone" id = 'pphone' pattern="[1-9]{1}[0-9]{9}"-->
			<span id="error"></span>
		</div>
		<div class="detail">
			<label>Alternate Phone (optional)</label>
			<input type="text" name="aphone" id='aphone' maxlength="10" value="<?php echo $mobile; ?>" class="name_one">
			<span id="message"></span>
		</div>
		<div class="Alternate">
			<div class="detail">
				<label>Email*</label>
				<input type="email" name="email" id="email" value="<?php echo $email; ?>" class="name_one">
				<span id="err_email"></span>

			</div>
		</div>
		<div class="Alternate">
			<div class="detail_full">
				<label>Street Address*</label>
				<input type="text" name="adress" id="adress" value="<?php echo $address; ?>" class="name_one">
				<span id="adresserror"></span>
			</div>
		</div>
		<div class="city_main">
			<div class="detail_city">
				<label>City*</label>
				<input type="text" name="city" id="city" value="<?php echo $city; ?>" class="name_one">
				<span id="cityerror"></span>
			</div>
			<div class="detail_city2">
				<label>State*</label>
				<div class="alabama">

					<!--input type="text" name="state" id="state" value="<--?php echo $state; ?>" class="name_one" -->
					<select name="state">
						<option value="Alabama">Alabama</option>
						<option value="Alaska">Alaska</option>
						<option value="Arizona">Arizona</option>
						<option value="Arkansas">Arkansas</option>
						<option value="California">California</option>
						<option value="Colorado">Colorado</option>
						<option value="Connecticut">Connecticut</option>
						<option value="Delaware">Delaware</option>
						<option value="Florida">Florida</option>
						<option value="Georgia">Georgia</option>
						<option value="Hawaii">Hawaii</option>
						<option value="Idaho">Idaho</option>
						<option value="Illinois">Illinois</option>
						<option value="Indiana">Indiana</option>
						<option value="Iowa">Iowa</option>
						<option value="Kansas">Kansas</option>
						<option value="Kentucky">Kentucky</option>
						<option value="Louisiana">Louisiana</option>
						<option value="Maine">Maine</option>
						<option value="Maryland">Maryland</option>
						<option value="Massachusetts">Massachusetts</option>
						<option value="Michigan">Michigan</option>
						<option value="Minnesota">Minnesota</option>
						<option value="Mississippi">Mississippi</option>
						<option value="Missouri">Missouri</option>
						<option value="Montana">Montana</option>
						<option value="Nebraska">Nebraska</option>
						<option value="Nevada">Nevada</option>
						<option value="New Hampshire">New Hampshire</option>
						<option value="New Jersey">New Jersey</option>
						<option value="New Mexico">New Mexico</option>
						<option value="New York">New York</option>
						<option value="North Carolina">North Carolina</option>
						<option value="North Dakota">North Dakota</option>
						<option value="Ohio">Ohio</option>
						<option value="Oklahoma">Oklahoma</option>
						<option value="Oregon">Oregon</option>
						<option value="Pennsylvania">Pennsylvania</option>
						<option value="Rhode Island">Rhode Island</option>
						<option value="South Carolina">South Carolina</option>
						<option value="South Dakota">South Dakota</option>
						<option value="Tennessee">Tennessee</option>
						<option value="Texas">Texas</option>
						<option value="Utah">Utah</option>
						<option value="Vermont">Vermont</option>
						<option value="Virginia">Virginia</option>
						<option value="Washington">Washington</option>
						<option value="West Virginia">West Virginia</option>
						<option value="Wisconsin">Wisconsin</option>
						<option value="Wyoming">Wyoming</option>
					</select>
				</div>
			</div>
			<div class="detail_city3">
				<label>Zip Code*</label>
				<input type="text" maxlength="5" name="zip" id="zip" value="<?php echo $zip; ?>" class="name_one">
				<span id="message1"></span>
			</div>
		</div>

		<div class="detail_full">
			<label style="color:black; width:100%;display: block; margin-bottom: 6px;"><b>What type of account will your funds come from?*</b></label>
			<label>
				<input type="radio" name="account" id="personalacct" value="personal" class="personalacct"><span>Personal Account </span></label>
			<label>
				<input type="radio" name="account" id="jointacct" value="Joint" class="jointacct"><span>Joint Account</span></label>
			<label>
				<input type="radio" name="account" id="trustacct" value="Trust" class="trustacct"><span>Trust </span></label>
			<label>
				<input type="radio" name="account" id="corpacct" value="corporation" class="corpacct"><span>Corporation, LLC, S Corp and any other business type </span></label>
			<span id="accounterror"></span>
		</div>

		<div class="detail_full1" style="display:none;">
			<label style="color:black;"><b>What is the full name on the account that the funds will come from?*<b></label>
			<input type="text" name="accountname" id="accountname" value="" class="accountname">
			<span id="fullnameaccount_error"></span>
		</div>

		<div class="detail_full2" id="detail_full2" style="display:none;">
			<label style="color:black; width:100%;display: block; margin-bottom: 6px;"><b>How are you intend to send funds for your purchase?*</b></label>
			<label>
				<input type="radio" name="Account" id="bankacct" value="Bank" class="bankacct"><span>Bank wire </span></label>
			<label>
				<input type="radio" name="Account" id="checkacct" value="Check" class="checkacct"><span>Check</span></label>
			<span id="Accounterror"></span>
		</div>

		<div class="detail_full3" style="display:none;">
			<label style="color:black; width:100%;display: block; margin-bottom: 6px;"><b>What is your intended purchase amount?*</b></label>
			<label>
				<input type="radio" name="Accounttt" id="baacct" value="Up" class="baacct"><span>Up to $25,000 </span></label>
			<label>
				<input type="radio" name="Accounttt" id="checacct" value="Over" class="checacct"><span>Over $25,000</span></label>
			<span id="Accounttterror"></span>
		</div>



		<div class="text_two">
			<h3>
				Attach Your Identification
			</h3>
			<p>
				<span>Please attach a photo or scan of government identification, such as a driver's license or passport. The image must be clear and include<span> the entire card or document.</span></span>
			</p>
		</div>




		<div class="upload">
			<input type="file" id="myFile" name="file_upload" onchange="showtick();" required>
		</div>

		<div class="sec_img" style="display:none; ">
			<div class="sec_inner">
				<img id="succ_img" src="https://www.birchgold.com/wp-content/uploads/checkmark12.gif" style="max-width: 150px;; margin:auto;">
				<p class="file-return">ID Uploaded</p>
			</div>
		</div>
		<!--div class="input-file-container">  
				<input class="input-file" id="my-file" type="file">
				<label tabindex="0" for="my-file" class="input-file-trigger">Select a file...</label>
			  </div-->

		<div class="text_three" style="display:none;">
			<h3>
				Attach Proof of Current Address
			</h3>
			<p>


				<span>Please attach a photo or scan of a document showing your current address such as a utility bill, cable bill, mortgage statement or signed lease agreement. The image must be clear and include the entire card or document.</span>
			</p>
		</div>


		<div class="upload1" style="display:none;">
			<input type="file" id="File" name="file_upload1" onchange="showticks();">
		</div>


		<div class="sec_img1" style="display:none; ">
			<div class="sec_inner1">
				<img id="succ_img" src="https://www.birchgold.com/wp-content/uploads/checkmark12.gif" style="max-width: 150px;; margin:auto;">
				<p class="file-return">ID Uploaded</p>
			</div>
		</div>



		<div class="text_four" style="display:none;">
			<h3>
				Attach Articles of Incorportion
			</h3>
			<p>
				<span>Please attach a photo or scan of (1) your articles of incorporation or (2) a statement of information from the Secretary of the State website. The image must be clear and include the entire document.</span>
			</p>
		</div>
		<div class="test">
			<div class="upload2" style="display:none;">
				<input type="file" id="Fi" name="file_upload2" onchange="showticks1();">
			</div>
		</div>
		<div class="sec_img2" style="display:none; ">
			<div class="sec_inner2">
				<img id="succ_img" src="https://www.birchgold.com/wp-content/uploads/checkmark12.gif" style="max-width: 150px;; margin:auto;">
				<p class="file-return">ID Uploaded</p>
			</div>
		</div>


		<div class="text_five" style="display:none;">
			<h3>
				Attach Trust Documents
			</h3>
			<p>
				<span>Please attach a photo or scan of the first page of your trust documents, which must include the name of the person who will be sending funds. The image must be clear and include the entire document.</span>
			</p>
		</div>
		<div class="test1">
			<div class="upload3" style="display:none;">
				<input type="file" id="F" name="file_upload3" onchange="showticks2();">
			</div>
		</div>

		<div class="sec_img3" style="display:none; ">
			<div class="sec_inner3">
				<img id="succ_img" src="https://www.birchgold.com/wp-content/uploads/checkmark12.gif" style="max-width: 150px;; margin:auto;">
				<p class="file-return">ID Uploaded</p>
			</div>
		</div>

		<div class="below">
			<p>
				<span>When you click "Next" below, you will redirect to a page to sign Birch Gold's Shipping and Transaction Agreement. This will be the final step to complete at this time.</span>
			</p>
			<div class="click">
				<input type="submit" class="submitbtn" id="nextbtn" name="nextbtn" value="Next">
			</div>
		</div>
	</form>
</section>
<!--div class="footer_menu">
			<ul>
				<li>
					<a href="#">About Us</a>
				</li>
				<li>
					<a href="#">Product</a>
				</li>
				<li>
					<a href="#">Precious Metals IRA Education</a>
				</li>
				<li>
					<a href="#">Market Update</a>
				</li>
				<li>
					<a href="#">Contact Us</a>
				</li>
			</ul>
			<div class="avenue">
				<img src="https://www.birchgold.com/wp-content/uploads/cash-purchase-desktop.png">
			</div>
			<p>
				<span>Central Park Building</span> <span>3500 West Olive Avenue, Suite730</span> <span>Burbank, CA 91505</span>
			</p>
		</div-->
<!--div class="rating">
			<p>Brich Gold Group Has A Shopper Approved Rating Of 5.0/5 Based On 10 Rating And Reviews</p>
			<p>
				Roll Over All Or A Portion of Your IRA Or 401k Into A Precious Metals IRA Gold & Silver Are on The Rise! Invest in Gold IRAS And Silver Iras Or Invest In Silver Or Gold Coin From One of Our Specialists Today.
			</p>
		</div-->
<div class="footer-block" id="blogFooterSidebar">
	<?php dynamic_sidebar('footer nonav'); ?>
</div>

</section>
</section>
<div class="icon_foo">
	<?php get_footer('nonav'); ?>
	<!--div class="invest">
			<ul>
				<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
				<li><a href="#"><i class="fab fa-twitter"></i></a></li>
				<li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
				<li><a href="#"><i class="fab fa-youtube"></i></a></li>
				<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
				<li><a href="#"><i class="fab fa-instagram"></i></a></li>
				<li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
			</ul>
</div-->
</div>
<script>
	function showticks1() {

		$('.upload2').hide();
		$('.sec_img2').show();

	}

	function showtick() {
		$('.upload').hide();
		$('.sec_img').show();

	}


	$(".test").ready(function() {

	});

	$('.bankacct').click(function() {
		var radioValue = $("input[name='account']:checked").val();
		if (radioValue == 'personal') {
			//alert(radioValue);
			$('.upload2').hide();
			$('.test1').hide();
			$('.test').hide();


		}
		$('.sec_img2').hide();
		$('.upload2').show();
		$('.upload').show();
		$('.sec_img').hide();


	});
	$('.checkacct').click(function() {
		//alert('test');
		$('.sec_img2').hide();
		$('.upload2').show();
		$('.upload').show();
		$('.sec_img').hide();

	});

	$(".test1").ready(function() {

	});
	$('.bankacct').click(function() {
		$('.sec_img3').hide();
		$('.upload3').show();
		$('.upload').show();
		$('.sec_img').hide();
	});
	$('.checkacct').click(function() {
		$('.sec_img3').hide();
		$('.upload3').show();
		$('.upload').show();
		$('.sec_img').hide();

	});
</script>
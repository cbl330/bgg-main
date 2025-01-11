<?php
/**
 *
 * Template Name: Purchase Info Upload */
/* echo (WP_CONTENT_DIR);
exit(); */
get_header('nonavnofollow');

global $wpdb;

$first_name = $last_name = $email = $phone = $mobile = $address = $city = $state = $zip = $acc_type = $acc_name = "";
$api_first_name = $api_last_name = $api_email = $api_phone = $api_mobile = $api_address = $api_city = $api_state = $api_zip = $api_acc_type = $api_acc_name = "";

if (isset($_REQUEST['nextbtn'])) {
	$errors = [];
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (!empty($_FILES["file_upload"]["name"])) {
			$attach_name = $account_id . '_' . basename($_FILES["file_upload"]["name"]);
			$target_dir = WP_CONTENT_DIR . "/uploads/purchase-info-upload/";
			$target_file = $target_dir . $attach_name;
		} else {
			$target_file;
		}
		if (!empty($_FILES["file_upload1"]["name"])) {
			$attach_name1 = $account_id . '_' . basename($_FILES["file_upload1"]["name"]);
			$target_dir1 = WP_CONTENT_DIR . "/uploads/purchase-info-upload/";
			$target_file1 = $target_dir1 . $attach_name1;
		} else {
			$target_file1;
		}
		if (!empty($_FILES["file_upload2"]["name"])) {
			$attach_name2 = $account_id . '_' . basename($_FILES["file_upload2"]["name"]);
			$target_dir2 = WP_CONTENT_DIR . "/uploads/purchase-info-upload/";
			$target_file2 = $target_dir2 . $attach_name2;
		} else {
			$target_file2;
		}
		if (!empty($_FILES["file_upload3"]["name"])) {
			$attach_name3 = $account_id . '_' . basename($_FILES["file_upload3"]["name"]);
			$target_dir3 = WP_CONTENT_DIR . "/uploads/purchase-info-upload/";
			$target_file3 = $target_dir3 . $attach_name3;
		} else {
			$target_file3;
		}
		
		if (!empty($_FILES["file_upload4"]["name"])) {
			$attach_name4 = $account_id . '_' . basename($_FILES["file_upload4"]["name"]);
			$target_dir4 = WP_CONTENT_DIR . "/uploads/purchase-info-upload/";
			$target_file4 = $target_dir4 . $attach_name4;
		} else {
			$target_file4;
		}
		if (!empty($_FILES["file_upload5"]["name"])) {
			$attach_name5 = $account_id . '_' . basename($_FILES["file_upload5"]["name"]);
			$target_dir5 = WP_CONTENT_DIR . "/uploads/purchase-info-upload/";
			$target_file5 = $target_dir5 . $attach_name5;
		} else {
			$target_file5;
		}
		
		$message = "Hello,<br><br>";
		$message .= "Please find attachment as submitted document.'<br><br>";
		
		$message .= "Account type: " . filter_var($_POST['account'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "<br>";
		
		if (!empty($_POST['accountname'])) {
			$message .= "Full account name: " . filter_var($_POST['accountname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "<br>";
		}
		
		$message .= "Transfer type: " . filter_var($_POST['Account'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "<br>";
		
		if (!empty($_POST['Accounttt'])) {
			$message .= "Transaction amount: " . filter_var($_POST['Accounttt'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "<br>";
		}
		
		$subject = __("Document Submission");
		
		$admin_email = "clientrelations@birchgold.com";
		
		$headers[] = 'From: clientrelations@birchgold.com';
		// $headers[] = 'Cc: hesparza@birchgold.com';
		$headers[] = 'Content-Type: text/html; charset=UTF-8';
		
		$mail_attachment = [];
		
		$uploadOk = 0;
		
		if (!empty($_FILES["file_upload"]["name"])) {
			$attach_name00 = $account_id . '_' . basename($_FILES["file_upload"]["name"]);
			$target_dir00 = WP_CONTENT_DIR . "/uploads/purchase-info-upload/";
			$target_file00 = $target_dir00 . $attach_name00;
			if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file00)) {
				$mail_attachment[] = WP_CONTENT_DIR . '/uploads/purchase-info-upload/' . $attach_name00;
				$uploadOk = 1;
				//echo 'mail_attachment';
			}
		}
		
		if (!empty($_FILES["file_upload1"]["name"])) {
			$attach_name100 = $account_id . '_' . basename($_FILES["file_upload1"]["name"]);
			$target_dir100 = WP_CONTENT_DIR . "/uploads/purchase-info-upload/";
			$target_file100 = $target_dir100 . $attach_name100;
			if (move_uploaded_file($_FILES["file_upload1"]["tmp_name"], $target_file100)) {
				$mail_attachment[] = WP_CONTENT_DIR . '/uploads/purchase-info-upload/' . $attach_name100;
				//$mail_attachment[] =WP_CONTENT_DIR . '/uploads/purchase-info-upload/'.$attach_name100;
				// echo 'mail_attachment 2';
				$uploadOk = 1;
			}
		}
		
		if (!empty($_FILES["file_upload2"]["name"])) {
			$attach_name200 = $account_id . '_' . basename($_FILES["file_upload2"]["name"]);
			$target_dir200 = WP_CONTENT_DIR . "/uploads/purchase-info-upload/";
			$target_file200 = $target_dir200 . $attach_name200;
			if (move_uploaded_file($_FILES["file_upload2"]["tmp_name"], $target_file200)) {
				$mail_attachment[] = WP_CONTENT_DIR . '/uploads/purchase-info-upload/' . $attach_name200;
				//$mail_attachment[] = WP_CONTENT_DIR . '/uploads/purchase-info-upload/'.$attach_name200;
				//echo 'mail_attachment 2';
				$uploadOk = 1;
			}
		}
		
		if (!empty($_FILES["file_upload3"]["name"])) {
			$attach_name300 = $account_id . '_' . basename($_FILES["file_upload3"]["name"]);
			$target_dir300 = WP_CONTENT_DIR . "/uploads/purchase-info-upload/";
			$target_file300 = $target_dir300 . $attach_name300;
			if (move_uploaded_file($_FILES["file_upload3"]["tmp_name"], $target_file300)) {
				$mail_attachment[] = WP_CONTENT_DIR . '/uploads/purchase-info-upload/' . $attach_name300;
				//$mail_attachment[] = WP_CONTENT_DIR . '/uploads/purchase-info-upload/'.$attach_name300;
				//echo 'mail_attachment 3';
				$uploadOk = 1;
			}
		}
		
		if (!empty($_FILES["file_upload4"]["name"])) {
			$attach_name400 = $account_id . '_' . basename($_FILES["file_upload4"]["name"]);
			$target_dir400 = WP_CONTENT_DIR . "/uploads/purchase-info-upload/";
			
			$target_file400 = $target_dir400 . $attach_name400;
			if (move_uploaded_file($_FILES["file_upload4"]["tmp_name"], $target_file400)) {
				$mail_attachment[] = WP_CONTENT_DIR . '/uploads/purchase-info-upload/' . $attach_name400;
				$uploadOk = 1;
			}
		}
		if (!empty($_FILES["file_upload5"]["name"])) {
			$attach_name500 = $account_id . '_' . basename($_FILES["file_upload5"]["name"]);
			$target_dir500 = WP_CONTENT_DIR . "/uploads/purchase-info-upload/";
			$target_file500 = $target_dir500 . $attach_name500;
			
			if (move_uploaded_file($_FILES["file_upload5"]["tmp_name"], $target_file500)) {
				$mail_attachment[] = WP_CONTENT_DIR . '/uploads/purchase-info-upload/' . $attach_name500;
				$uploadOk = 1;
			}
		}
		
		if ($uploadOk == 1) {
			// $to = "aleksandarziher@gmail.com";
			$to = 'customercare@birchgold.com';
			
			wp_mail($to, $subject, $message, $headers, $mail_attachment);
		}
		
		foreach ($mail_attachment as $att) {
			@unlink($att);
		}
		
		remove_filter('wp_mail_content_type', 'set_html_content_type');
		
		if (!is_wp_error($errors)) {
			$msg_success = "true";
			unlink('wp-content/uploads/purchase-info-upload/' . $attach_name);
			
			wp_redirect("/purchase-info-complete");
		} else {
			$errors['file_upload'] = "failed to upload file.";
		}
	}
}
?>
<script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


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
	</div>
	<form class="review sec_review" name="form1" action="" method="post" id="form_datta" enctype="multipart/form-data">

		<div class="detail_full">
			<label style="color:black; width:100%;display: block; margin-bottom: 6px;"><b>What type of account will your funds come from?*</b></label>
			<label>
				<input type="radio" name="account" id="personalacct" value="personal" class="personalacct" required="required"><span>Personal Account </span></label>
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
				<input type="radio" name="Account" id="bankacct" value="Bank" class="bankacct" required="required"><span>Bank wire </span></label>
			<label>
				<input type="radio" name="Account" id="checkacct" value="Check" class="checkacct"><span>Check</span></label>
			<span id="Accounterror"></span>
		</div>

		<div class="detail_full3" style="display:none;">
			<label style="color:black; width:100%;display: block; margin-bottom: 6px;"><b>What is your intended purchase amount?*</b></label>
			<label>
				<input type="radio" name="Accounttt" id="baacct" value="Up" class="baacct" required="required"><span>Up to $25,000 </span></label>
			<label>
				<input type="radio" name="Accounttt" id="checacct" value="Over" class="checacct"><span>Over $25,000</span></label>
			<span id="Accounttterror"></span>
		</div>


		<div class="text_two">
			<h3>
				Attach Your Identification
				<span class="for-two-people">(Joint account requires documents for two people)</span>
			</h3>
			<p>
				<span>Please attach a photo or scan of government identification, such as a driver's license or passport. The image must be clear and include<span> the entire card or document.</span></span>
			</p>
		</div>

		<div class="upload">
			<input type="file" id="myFile" name="file_upload" required>
		</div>

		<div class="sec_img" style="display:none;">
			<div class="sec_inner">
				<img id="succ_img" src="https://www.birchgold.com/wp-content/uploads/checkmark12.gif" style="max-width: 150px; margin:auto;">
				<p class="file-return">ID Uploaded</p>
			</div>
		</div>

		<div class="upload_second_person">
			<input type="file" id="myFile_second_person" name="file_upload4">
		</div>
		<div class="sec_img_second_person" style="display:none;">
			<div class="sec_inner">
				<img id="succ_img" src="https://www.birchgold.com/wp-content/uploads/checkmark12.gif" style="max-width: 150px; margin:auto;">
				<p class="file-return">ID Uploaded</p>
			</div>
		</div>

		<div class="text_three" style="display:none;">
			<h3>
				Attach Proof of Current Address
				<span class="for-two-people">(Joint account requires documents for two people)</span>
			</h3>
			<p>
				<span>Please attach a photo or scan of a document showing your current address such as a utility bill, cable bill, mortgage statement or signed lease agreement. The image must be clear and include the entire card or document.</span>
			</p>
		</div>
		<div class="upload1" style="display:none;">
			<input type="file" id="File" name="file_upload1">
		</div>
		<div class="sec_img1" style="display:none; ">
			<div class="sec_inner">
				<img id="succ_img" src="https://www.birchgold.com/wp-content/uploads/checkmark12.gif" style="max-width: 150px; margin:auto;">
				<p class="file-return">Proof of Current Address Uploaded</p>
			</div>
		</div>

		<div class="upload_second_person1" style="display:none;">
			<input type="file" id="File" name="file_upload5">
		</div>
		<div class="sec_img_second_person1" style="display:none; ">
			<div class="sec_inner">
				<img id="succ_img" src="https://www.birchgold.com/wp-content/uploads/checkmark12.gif" style="max-width: 150px; margin:auto;">
				<p class="file-return">Proof of Current Address Uploaded</p>
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
		<div class="upload3" style="display:none;">
			<input type="file" id="F" name="file_upload3">
		</div>
		<div class="sec_img3" style="display:none; ">
			<div class="sec_inner">
				<img id="succ_img" src="https://www.birchgold.com/wp-content/uploads/checkmark12.gif" style="max-width: 150px; margin:auto;">
				<p class="file-return">Trust Documents Uploaded</p>
			</div>
		</div>

		<div class="text_four" style="display:none;">
			<h3>
				Attach Articles of Incorporation
			</h3>
			<p>
				<span>Please attach a photo or scan of (1) your articles of incorporation or (2) a statement of information from the Secretary of the State website. The image must be clear and include the entire document.</span>
			</p>
		</div>

		<div class="upload2" style="display:none;">
			<input type="file" id="Fi" name="file_upload2">
		</div>
		<div class="sec_img2" style="display:none; ">
			<div class="sec_inner2">
				<img id="succ_img" src="https://www.birchgold.com/wp-content/uploads/checkmark12.gif" style="max-width: 150px; margin:auto;">
				<p class="file-return">Articles of Incorporation Uploaded</p>
			</div>
		</div>

		<div class="below">
			<p>
				<span>When you click "Next" below, you will redirect to a page to sign Birch Gold's Shipping and Transaction Agreement. This will be the final step to complete at this time.</span>
			</p>
			<div class="click">
				<input type="submit" class="submitbtn" id="nextbtn" name="nextbtn" value="Finish ">
			</div>
		</div>
	</form>
</section>

<div class="footer-block" id="blogFooterSidebar">
	<?php dynamic_sidebar('footer nonav'); ?>
</div>


<div class="icon_foo">
	<?php get_footer('nonav'); ?>
</div>

<script>
	$('.detail_full input').on('change', function () {
		$('.detail_full1').show();
		$('.detail_full2').show();
	});

	$('.detail_full2 input').on('change', function () {
		if ($('input[name="Account"]:checked').val() === 'Bank') {
			$('input[name="Accounttt"]').prop('required', true);

			$('.detail_full3').show();
		} else {
			$('input[name="Accounttt"]').prop('required', false);

			$('.detail_full3').hide();
		}
	});

	$('input[type="file"]').on('change', function () {
		$(this).parent().addClass('upload-field-hidden').hide().next().show();
	});

	$('input[type="radio"]').on('change', function () {
		let type = $('input[name="account"]:checked').val();
		let bank_or_check = $('input[name="Account"]:checked').val();
		let over25k = $('input[name="Accounttt"]:checked').val();

		$('.text_three, .text_four, .text_five').hide();

		$('.upload1, .upload2, .upload3, .upload_second_person, .upload_second_person1').each(function () {
			$(this).find('input').prop('required', false);
			$(this).hide().next().hide();
		});

		$('.for-two-people').hide();

		if (type === 'personal') {
			if ((bank_or_check === 'Bank' && over25k === 'Over') || bank_or_check === 'Check') {
				$('.text_three').show();
				field_toggle('.upload1', true);
			} else {
				$('.text_three').hide();
				field_toggle('.upload1', false);
			}
		} else if (type === 'Joint') {
			$('.for-two-people').show();
			field_toggle('.upload_second_person', true);

			if ((bank_or_check === 'Bank' && over25k === 'Over') || bank_or_check === 'Check') {
				$('.text_three').show();
				field_toggle('.upload1', true);
				field_toggle('.upload_second_person1', true);
			} else {
				$('.text_three').hide();
				field_toggle('.upload1', false);
				field_toggle('.upload_second_person1', false);
			}
		} else if (type === 'Trust') {
			$('.text_five').show();
			field_toggle('.upload3', true);
		} else if (type === 'corporation') {
			$('.text_four').show();
			field_toggle('.upload2', true);
		}
	});

	function field_toggle(field, show) {
		if (show) {
			if ($(field).hasClass('upload-field-hidden')) {
				$(field).next().show();
			} else {
				$(field).show();
			}
		} else {
			if ($(field).hasClass('upload-field-hidden')) {
				$(field).next().hide();
			} else {
				$(field).hide();
			}
		}
	}
</script>

<style>
	section.content_block_background {
		display: none;
	}
	div#blogFooterSidebar {
		background: transparent !important;
		box-shadow: none !important;
	}
	.file-return {
		text-align: center;
	}
	.for-two-people {
		display: none;
		font-size: 60%;
	}
	#myFile_second_person {
		width: 100%;
		height: 100%;
		position: absolute;
		top: 0;
		opacity: 0;
		z-index: 99999;
		cursor: pointer;
	}
	.upload_second_person,
	.upload_second_person1 {
		display: none;
		width: 98%;
		padding: 1em;
		box-sizing: border-box;
		margin: 0 auto;
		position: relative;
		top: 15px;
		height: 350px;
		background: #faf8f2;
		color: #e4e4e4;
		font-size: 0;
		clear: both;
	}
	.upload_second_person:after {
		position: absolute;
		content: 'Attach Identification';
		border: 1px solid #c8c6c1;
		padding: 12px 45px;
		left: 50%;
		bottom: 2em;
		color: #9f9d97;
		cursor: pointer;
		font-size: 19px;
		-webkit-transform: translateX(-50%);
		-ms-transform: translateX(-50%);
		transform: translateX(-50%);
		font-weight: bold;
		border-radius: 4px;
		min-width: 140px;
		text-align: center;
	}
	.upload_second_person:before {
		position: absolute;
		content: '';
		background-image: url(https://www.birchgold.com/wp-content/uploads/cash-purchase-desktop2.png);
		width: 100%;
		height: 145px;
		top: 21%;
		display: block;
		z-index: 99;
		background-repeat: no-repeat;
		background-position: center;
	}
	.sec_img_second_person,
	.sec_img_second_person1 {
		min-height: 350px;
		position: relative;
		top: 15px;
		float: left;
		width: 100%;
		background: #faf8f2;
	}
	.sec_img_second_person .sec_inner,
	.sec_img_second_person1 .sec_inner {
		position: absolute;
		top: 50%;
		left: 0;
		right: 0;
		transform: translateY(-50%);
	}
	.upload_second_person1:before {
		position: absolute;
		content: '';
		background-image: url(https://www.birchgold.com/wp-content/uploads/imgpsh_fullsize_anim.png);
		width: 100%;
		height: 200px;
		top: 13%;
		display: block;
		z-index: 99;
		background-repeat: no-repeat;
		background-position: center;
	}
	.upload_second_person1:after {
		position: absolute;
		content: 'Attach Proof of Current Address';
		border: 1px solid #c8c6c1;
		padding: 12px 24px;
		left: 50%;
		bottom: 2em;
		color: #9f9d97;
		cursor: pointer;
		font-size: 19px;
		-webkit-transform: translateX(-50%);
		-ms-transform: translateX(-50%);
		transform: translateX(-50%);
		font-weight: bold;
		border-radius: 4px;
		min-width: 140px;
		text-align: center;
	}
	.sec_img3 {
		min-height: 350px;
		position: relative;
		top: 15px;
		float: left;
		width: 100%;
		background: #faf8f2;
	}
	.sec_img1 .sec_inner,
	.sec_img3 .sec_inner {
		position: absolute;
		top: 50%;
		left: 0;
		right: 0;
		transform: translateY(-50%);
	}
	.sec_img2 {
		top: 15px;
	}
</style>
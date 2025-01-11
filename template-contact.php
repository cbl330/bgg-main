<?php
/**
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bgg
 */

get_header(); ?>

<div class="wrapper">
        <div class="main-container">

            <!-- Breadcrumb -->
            <div class="container">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active"><span>Contact Us</span></li>
                    </ul>
                </div>
            </div>
            <!-- Content area Part -->
            <main class="main-content">
                <!-- contact-us-section -->
                <section class="contact-us pb-xl-75 pb-50">
                    <div class="container">
                        <div class="row">
                            <div class="cell-lg-5 cu-left">
                                <h1 class="heading-h0 mb-xl-50 mb-30 d-lg-block d-none">Contact Us</h1>
                                <div class="row">
                                    <div class="cell-sm-12">
                                        <div class="cu-left-line mb-30">
                                            <strong class="cu-title">Contact</strong> 
                                            <div class="row mb-15">
                                                <div class="cell-sm-6">
                                                    <div class="cu-left-block d-flex flex-nowrap">
                                                        <i class="icon-pin"></i>
                                                        <address>
                                                            <strong>Birch Gold Group HQ</strong>
                                                            3500 W. Olive Ave., <br>
                                                            Suite 300 Burbank, CA 91505
                                                        </address>
                                                    </div>
                                                    <div class="cu-left-block d-flex flex-nowrap">
                                                        <i class="icon-clock"></i>
                                                        <div>
                                                            <strong>Hours of Operation</strong>
                                                            Monday - Friday <br>
                                                            6AM - 5:30PM (PST)
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="cell-sm-6">
                                                    <div class="cu-left-block d-flex flex-nowrap">
                                                        <i class="icon-call1"></i>
                                                        <a href="tel:8003552116">(800) 355-2116</a>
                                                    </div>
                                                    <div class="cu-left-block d-flex flex-nowrap">
                                                        <i class="icon-fax"></i>
                                                        <a href="tel:8003552116">(800) 965-3620</a>
                                                    </div>
                                                    <div class="cu-left-block d-flex flex-nowrap">
                                                        <i class="icon-mail"></i>
                                                        <a href="mailto:info@birchgold.com">info@birchgold.com</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cell-sm-12">
                                        <div class="cu-left-line mb-30">
                                            <strong class="cu-title">For Purchases</strong> 
                                            <div class="row mb-15">
                                                <div class="cell-sm-6">
                                                    <div class="cu-left-block d-flex flex-nowrap">
                                                        <i class="icon-post-office"></i>
                                                        <address>
                                                            <strong>Personal Check Payments</strong>
                                                            PO Box 743054 <br>
                                                            Los Angeles, CA 90074-3054
                                                        </address>
                                                    </div>
                                                </div>
                                                <div class="cell-sm-6">
                                                    <div class="cu-left-block d-flex flex-nowrap">
                                                        <i class="icon-document"></i>
                                                        <address>
                                                            <strong>Supporting Documents</strong>
                                                            2708 Foothill Blvd. #321 <br>
                                                            La Crescenta, CA 91214
                                                        </address>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cell-sm-12">
                                        <div class="cu-social">
                                            <strong class="cu-title">Social</strong>
                                            <ul class="mb-md-50 mb-30 d-flex">
                                                <li><a href="#" class="icon-facebook" target="_blank"></a></li>
                                                <li><a href="#" class="icon-twitter" target="_blank"></a></li>
                                                <li><a href="#" class="icon-youtube" target="_blank"></a></li>
                                                <li><a href="#" class="icon-linkedin" target="_blank"></a></li>
                                                <li><a href="#" class="fa-brands fa-square-instagram" target="_blank"></a></li>
                                                <!-- <li><a href="#" class="icon-pinterest" target="_blank"></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cell-lg-7 mb-lg-0 mb-30">
                                <h1 class="heading-h0 mb-xl-50 mb-30 d-lg-none d-block">Contact Us</h1>
                                <div class="cu-form-wrap p-sm-50 p-30">
                                    <!-- contact form -->
                                    <form class="cu-form">
                                        <div class="row">
                                            <div class="cell-sm-6 form-group">
                                                <label for="cu-field-1">First Name</label>
                                                <input type="text" id="cu-field-1">
                                            </div>
                                            <div class="cell-sm-6 form-group">
                                                <label for="cu-field-2">Last Name</label>
                                                <input type="text" id="cu-field-2">
                                            </div>
                                            <div class="cell-sm-6 form-group">
                                                <label for="cu-field-4">Email Address</label>
                                                <input type="email" id="cu-field-4">
                                            </div>
                                            <div class="cell-sm-6 form-group">
                                                <label for="cu-field-5">Phone Number</label>
                                                <input type="tel" id="cu-field-5">
                                            </div>
                                            <div class="cell-12 form-group">
                                                <label for="cu-field-6">Message</label>
                                                <textarea name="" id="cu-field-6"></textarea>
                                            </div>
                                            <div class="cell-12 form-group">
                                                <div class="checkbox">
                                                    <input type="checkbox" name="" id="cu-c1">
                                                    <label for="cu-c1">By checking this box, I have read and agree to Birch Gold Group’s <a href="#">Terms & Conditions</a>.</label>
                                                </div>
                                            </div>
                                            <div class="cell-12 mt-xl-30 mt-15">
                                                <input class="w-full" type="submit" value="Send Message">
                                            </div>
                                        </div>
                                    </form>
                                    <!-- thank you message -->
                                    <!-- <div class="cu-msg d-flex align-items-center justify-content-center text-center">
                                        <div class="cu-msg-content">
                                            <i class="icon-right-circle"></i>
                                            <h2>Your message has been sent!</h2>
                                            <p>Our team is working diligently to respond to your message as soon as possible.</p>
                                            <p>Thank you for your patience!</p>
                                        </div>
                                    </div> -->
                                </div>
                            </div>                            
                        </div> 
                    </div>
                </section>
            </main>
        </div>
    </div>


<?php
get_footer();

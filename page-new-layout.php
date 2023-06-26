<?php

/* Template Name: Page_home_new_template */

get_header();
$imgurl =  ot_get_option('top_section_background_image');
$server_name = "";
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $server_name = "https://";
else
    $server_name = "http://";

// Append the host(server name) to the URL.   
$server_name .= $_SERVER['SERVER_NAME'];


// custm fields
$background_image = get_field('hero_background_image');
$title = get_field('title');
$subtitle = get_field('subtitle');
$speaker_name = get_field('speaker_name');
$rating = get_field('rating');
$speaker_url = get_field('speaker_url');
$session_info = get_field('session_info');

?>

<!-- loading div -->
<div id="kd-preloader" class="preloader">
    <h4 id="loading-text">Live L&D is loading
        <span class="dot-container">
            <span class="dot-animation">.</span>
            <span class="dot-animation">.</span>
            <span class="dot-animation">.</span>
            <span class="dot-animation">.</span>
        </span>
    </h4>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/white-home.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<div class="new-homepage-wrapper">
    <!-- hero area -->
    <div class="light-layout-hero hero-area-wrapper" style="background: url('<?php echo $background_image; ?>');">
        <div class="hero-area-overlay"></div>
        <div class="hero-area-inner">
            <div class="row align-items-center">
                <div class="col-md-11">
                    <h1><?php echo $title; ?></h1>
                    <p><?php echo $subtitle; ?></p>

                </div>
                <div class="col-md-5">
                    <p class="main-session-info">
                        <?php echo $session_info; ?>
                    </p>
                    <div class="start-rating-wrapper">
                        <div class="ratings">
                            <ul>
                                <?php
                                for ($i = 0; $i < 5; $i++) {

                                    if (intval($rating) < $i) { ?>
                                <li><i class="fa fa-star"></i></li>
                                <?php   } else { ?>
                                    <li><i class="fa fa-star empty"></i></li>
                                <?php    }
                                }

                                ?>
                            </ul>
                        </div>
                        <div class="speaker">
                            By <?php echo $speaker_name; ?>
                        </div>
                        <div class="more-about-speaker">
                            <a href="<?php echo $speaker_url; ?>">More About This Speaker</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- searching area -->

            <div class="container-fluidx kd-new-search-box">
                <div class="kd-new-searchbox-inner">
                    <div class="kd-searchbox-inner">
                        <form action="" id="kd-search-form" class="kd-search-form" onkeydown="return checkForEnter(event);">
                            <div class="kd-form-group">

                                <label>Category</label>
                                <?php

                                global $wpdb;
                                $tbprefix = $wpdb->prefix;

                                $categoriesSql = "SELECT * FROM $tbprefix" . "amelia_categories GROUP BY `id` ORDER BY `position`;";
                                $catResults = $wpdb->get_results($categoriesSql);

                                //$exclude_cat_id = array(17, 23, 19, 12, 9, 8, 18, 4, 12, 44, 28, 29, 42, 41, 40);
                                $exclude_cat_id;
                                if (ot_get_option('exclude_category_id_s')) {
                                    $exclude_cat_id = explode(',', ot_get_option('exclude_category_id_s'));
                                } ?>
                                <!-- 
                                <select name="kd-search-category" id="kd-search-ccategory" onchange="selectResultBasedCategory(event)">
                                    <option value="select-category">All Categories</option>

                                    <?php //foreach ($catResults as $catResult) {
                                    // if (!in_array(intval($catResult->id), $exclude_cat_id)) {
                                    ?>
                                            <option value="<?php //echo $catResult->name; 
                                                            ?>"><?php //echo $catResult->name; 
                                                                                                ?></option>
                                    <?php //}
                                    //} 
                                    ?>
                                </select> -->

                                <div class="custom-select-wrapper">
                                    <input type="text" id="kd-select-categry-fiels" value="All Categories">
                                    <ul class="kd-custom-select select-category">
                                        <li data-value="all" onclick="selectResultCat(event)">All Categories</li>
                                        <?php foreach ($catResults as $catResult) {
                                            if (!in_array(intval($catResult->id), $exclude_cat_id)) {
                                        ?>
                                                <li data-value="<?php echo $catResult->name; ?>" onclick="selectResultCat(event)"><?php echo $catResult->name; ?></li>
                                        <?php }
                                        } ?>
                                    </ul>
                                </div>

                            </div>

                            <div class="kd-form-group">
                                <label for="max-price" id="max-price-label">Max Price</label>
                                <input type="number" id="kd-price-to" onchange="selectResultBasedPrice(event)" onkeyup="selectResultBasedPrice(event)" placeholder="Max Price" step="500">
                            </div>
                            <div class="kd-form-group">
                                <label>Search</label>
                                <input type="text" id="kd-search-field" onkeyup="selectResultBasedTitle(event)" placeholder="Search">
                            </div>

                            <div class="kd-form-group from-to-dates">
                                <label>From</label>
                                <input type="date" id="kd-from-date" onchange="copyFromDate(event);">
                            </div>

                            <div class="kd-form-group from-to-dates">
                                <label>To</label>
                                <input type="date" id="kd-to-date" onchange="copyFromDate(event);">
                            </div>

                            <div class="kd-form-group reset-button">
                                <label>&nbsp;</label>
                                <button class="kd-search-btn" onclick="return false;">Search</button>
                             </div>
                            <div class="kd-form-group reset-button">
                                <label>&nbsp;</label>
                                <button type="button" class="kd-reset-btn" onclick="resetSearch(event)">Reset Filters</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- search result area -->
    <div class="kd-searchbox-result home-demo">
        <h3 class="hometitle kd-search-title d-none" id="myList">Search results</h3>
        <div class="kd-search-result-carousel-wrapper">

        </div>

        <div class="kd-search-single-popup-wrapper">
            <div class="kd-search-single-popup-inner">
            </div>
        </div>

        <div class="kd-searchbox-loading-overlay">
            <h4 id="loading-text">Searching
                <span class="dot-container">
                    <span class="dot-animation">.</span>
                    <span class="dot-animation">.</span>
                    <span class="dot-animation">.</span>
                    <span class="dot-animation">.</span>
                </span>
            </h4>
        </div>
    </div>

    <!-- carousels section -->
    <div class="carousels-section-wrapper">
        <?php

        global $wpdb;
        $tbprefix = $wpdb->prefix;
        $categoriesSql = "SELECT * FROM $tbprefix" . "amelia_categories GROUP BY `id` ORDER BY `position`;";
        $index = 0;

        $catResults = $wpdb->get_results($categoriesSql);

        $exclude_cat_id = array();
        if (ot_get_option('exclude_category_id_s')) {
            $exclude_cat_id = explode(',', ot_get_option('exclude_category_id_s'));
        }
        foreach ($catResults as $key => $catResult) {
            if (!in_array(intval($catResult->id), $exclude_cat_id)) {
        ?>

                <?php
                if ($index == 2) { ?>

                    <div class="easy-steps-wrapper">
                        <h2 class="text-center">
                            Check Calendars and fees in 3 easy steps
                        </h2>
                        <div class="row">
                            <!-- steps single column -->
                            <div class="col-md-4">
                                <div class="steps-col-inner">
                                    <div class="steps-col-overlay-img">
                                        <img src="https://livelnd.com/wp-content/uploads/2023/06/icon3.png" alt="" srcset="">
                                    </div>
                                    <h2>Find Your Virtual Speaker</h2>
                                    <p>Our curators have carefully selected global experts who specialize in speaking about Diversity & Inclusion, Mental Health, Leadership, and various other topics. Explore the speakers by hovering over their talks and choose your favorite expert speaker.</p>
                                </div>
                            </div>
                            <!-- steps single column -->
                            <div class="col-md-4">
                                <div class="steps-col-inner">
                                <div class="steps-col-overlay-img">
                                        <img src="https://livelnd.com/wp-content/uploads/2023/06/icon1.png" alt="" srcset="">
                                    </div>
                                    <h2>Check Availability & Fees</h2>
                                    <p>All Live L&D speakers have synchronized their calendars with our platform. Search for speakers based on availability and budget. Or schedule a Meet & Greet with the expert before booking.</p>
                                </div>
                            </div>
                            <!-- steps single column -->
                            <div class="col-md-4">
                                <div class="steps-col-inner">
                                <div class="steps-col-overlay-img">
                                        <img src="https://livelnd.com/wp-content/uploads/2023/06/icon2.png" alt="" srcset="">
                                    </div>
                                    <h2>Hold time slot / Book now </h2>
                                    <p>Choose a day and time slot for your Talk. Book now and pay later, or reserve the slot for 72 hours with no obligations. We'll contact you within 24 hours to answer your questions and discuss options. Speaker and time slot guaranteed at the displayed price for 72 hours.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php     }
                ?>

<?php
                if ($index == 5) { ?>

                    <div class="easy-steps-wrapper">
                    <h2 class="text-center">
                    Educate & Inspire Your Team or Company
                        </h2>
                        <div class="row">
                            <!-- steps single column -->
                            <div class="col-md-4">
                                <div class="steps-col-inner">
                                    <div class="steps-col-overlay-img">
                                      <!--  <img src="#" alt="" srcset=""> -->
                                    </div>
                                    <h2>Why</h2>
                                    <p>Educating and inspiring your workforce creates a continuous learning culture, fosters personal and professional growth, and positively impacts the organization's performance, innovation, and long-term success.</p>
                                </div>
                            </div>
                            <!-- steps single column -->
                            <div class="col-md-4">
                                <div class="steps-col-inner">
                                <div class="steps-col-overlay-img">
                                        <!--  <img src="#" alt="" srcset=""> -->
                                    </div>
                                    <h2>How</h2>
                                    <p>By leveraging the expertise and inspiration of global expert speakers, organizations can create impactful learning experiences that educate employees, stimulate their creativity, and inspire them to reach their full potential.</p>
                                </div>
                            </div>
                            <!-- steps single column -->
                            <div class="col-md-4">
                                <div class="steps-col-inner">
                                <div class="steps-col-overlay-img">
                                      <!--  <img src="#" alt="" srcset=""> -->
                                    </div>
                                    <h2>What</h2>
                                    <p>Immerse your workforce in a captivating 60-minute live, online learning session led by a global expert. Through dynamic virtual interaction, participants will gain invaluable insights, practical knowledge, and actionable strategies. Harness the expertise of global experts and unlock the full potential of your team with this transformative virtual learning session.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php     }
                ?>

                <!-- single carousels -->

                <div class="home-demo deskcarousel kd-single-services-section">


                    <h3 id="myList" class="hometitle"><?php echo $catResult->name; ?></h3>

                    <!-- taken from rajika -->
                    <?php
                    $results = $wpdb->get_results("SELECT * FROM $tbprefix" . "amelia_services where status='visible' and categoryId='" . $catResult->id . "'");
                    if (!empty($results)) { ?>

                        <div class="owl-carousel owl-theme">
                            <?php

                            $results = $wpdb->get_results("SELECT * FROM $tbprefix" . "amelia_services where status='visible' and categoryId='" . $catResult->id . "' ORDER BY `position`;");
                            if (!empty($results)) {

                                foreach ($results as $row) {
                                    $servicesingleid = $row->id;
                            ?>

                                    <?php
                                    $employee =  $wpdb->get_results("SELECT $tbprefix" . "amelia_users.* FROM " . $tbprefix . "amelia_services inner join " . $tbprefix . "amelia_providers_to_services inner join " . $tbprefix . "amelia_users on " . $tbprefix . "amelia_services.id=" . $tbprefix . "amelia_providers_to_services.serviceId and " . $tbprefix . "amelia_providers_to_services.userId=" . $tbprefix . "amelia_users.id where " . $tbprefix . "amelia_services.id='$servicesingleid'");

                                    foreach ($employee as $employeedetails) {

                                        $slug5 = sanitize_title($row->name) . '-' . $servicesingleid;
                                        $url = $server_name . '/single-service/' . $slug5;

                                        $externalid = $employeedetails->externalId;

                                        $worduser = 'user_' . $externalid;

                                        $tagone = "";
                                        $tagtwo = "";
                                        $tagthree = "";
                                        $tagfour = "";
                                        $tagfive = "";
                                        if ($row->tag1 != null) {
                                            $tagone = $row->tag1;
                                        }
                                        if ($row->tag2 != null) {
                                            $tagtwo = " - " . $row->tag2;
                                        }
                                        if ($row->tag3 != null) {
                                            $tagthree = " - " . $row->tag3;
                                        }
                                        if ($row->tag4 != null) {
                                            $tagfour = " - " . $row->tag4;
                                        }
                                        if ($row->tag5 != null) {
                                            $tagfive = " - " . $row->tag5;
                                        }
                                    ?>
                                        <?php
                                        // if (get_field('approve', $worduser)) {
                                        if (1 == 1) {
                                            if ($row->pictureFullPath != "") {
                                                $image_url = $row->pictureFullPath;
                                            } else {
                                                $image_url =  $server_name . '/wp-content/uploads/2023/01/default-268x172-1.png';
                                            }
                                        ?>


                                            <div class="item mainitem kd-service-slide" data-id="<?php echo $servicesingleid; ?>" data-tags="<?php echo $tagone . $tagtwo . $tagthree . $tagfour . $tagfive; ?>" data-expert="<?php echo $employeedetails->firstName . " " . $employeedetails->lastName;  ?>" data-category="<?php echo $catResult->name; ?>" data-price="<?php echo $row->price; ?>" data-name="<?php echo $row->name; ?>" data-views="<?php echo $row->videoViews; ?>">

                                                <div onmouseleave="kdAdddeactivatedThumb(event)" onmouseenter="kdOpenPopupFunc(event)" class="gallery-video-thumbnail kd-thumbnnail" data-id="<?php echo $servicesingleid; ?>">
                                                    <a data-id="<?php echo $servicesingleid; ?>" href="<?php echo $url; ?>">
                                                        <img class="thumbnailimg" src="<?php echo $image_url; ?>" alt="" style="height : 120px; object-fit: cover;">
                                                    </a>
                                                    <div class="thumb-info">
                                                        <h4 class="sessionttile-thumb"><b><?php echo $row->name; ?></b></h4>

                                                        <div class="viewsandpricediv">
                                                            <?php if (!empty($row->videoViews) && intval($row->videoViews) > 1000) { ?>
                                                                <span class="views"><?php echo number_format($row->videoViews, 0, '.', ','); ?></span> <span class="viewstext">Youtube Views</span>
                                                            <?php } ?>
                                                            <span class="session-price"><?php echo do_shortcode('[woo_multi_currency_exchange price="' . $row->price . '" currency="' . $curr . '"]'); ?></span>
                                                        </div>
                                                        <?php

                                                        $oFormatter = new \NumberFormatter('de_DE', \NumberFormatter::CURRENCY);
                                                        $formattedPrice = $oFormatter->formatCurrency($row->price, 'EUR');

                                                        ?>

                                                    </div>
                                                </div>

                                            </div>


                                        <?php } else { ?>


                            <?php
                                        }
                                    }
                                }
                            }
                            ?>

                        </div>

                        <!-- popp content -->
                        <div class="kd-single-popup-wrapper">
                            <div class="kd-single-popup-inner">
                                <?php foreach ($results as $row) {
                                    // print_r($row);
                                    $servicesingleid = $row->id;

                                    $employee =  $wpdb->get_results("SELECT $tbprefix" . "amelia_users.* FROM " . $tbprefix . "amelia_services inner join " . $tbprefix . "amelia_providers_to_services inner join " . $tbprefix . "amelia_users on " . $tbprefix . "amelia_services.id=" . $tbprefix . "amelia_providers_to_services.serviceId and " . $tbprefix . "amelia_providers_to_services.userId=" . $tbprefix . "amelia_users.id where " . $tbprefix . "amelia_services.id='$servicesingleid'");
                                    foreach ($employee as $employeedetails) {

                                        $slug6 = sanitize_title($row->name) . '-' . $servicesingleid;
                                        $url = $server_name . '/single-service/' . $slug6;
                                        $externalid = $employeedetails->externalId;
                                        $worduser = 'user_' . $externalid;
                                        if ($row->pictureFullPath != "") {
                                            $image_url = $row->pictureFullPath;
                                        } else {
                                            $image_url =  $server_name . '/wp-content/uploads/2023/01/default-268x172-1.png';
                                        }
                                        $videourl =  "https://www.youtube.com/embed/" . $row->video;
                                        $parameters = "?controls=1&showinfo=0&start=" . $row->videoStartTime . "&modestbranding=1&rel=0&loop=1&autoplay=1&mute=1";
                                        $finalurl = $videourl . $parameters;

                                        // getting cross sells
                                        $kdresults = $wpdb->get_results("SELECT `settings` FROM " . $wpdb->prefix . "amelia_services WHERE id= '" . $servicesingleid . "'");

                                        if ($wpdb->last_error) {
                                            echo 'wpdb error: ' . $wpdb->last_error;
                                        }

                                        $kdsettings = json_decode($kdresults[0]->settings);
                                        // print_r($kdsettings->payments->wc->productId);

                                        //$crosssellProductIds   =   get_post_meta($kdsettings->payments->wc->productId, '_crosssell_ids');
                                        //$crosssellProductIds    =   $crosssellProductIds[0];

                                        if (isset($kdsettings->payments->wc->productId)) {
                                            $crosssellProductIds = get_post_meta($kdsettings->payments->wc->productId, '_crosssell_ids');

                                            if (is_array($crosssellProductIds) && isset($crosssellProductIds[0])) {
                                                $crosssellProductIds = $crosssellProductIds[0];
                                            } else {
                                                // Handle the case where $crosssellProductIds is not an array or the first element is not set
                                                $crosssellProductIds = null;
                                            }
                                        } else {
                                            // Handle the case where the 'productId' property is not set
                                            $crosssellProductIds = null;
                                        }



                                        // print_r($crosssellProductIds);

                                ?>
                                        <div class="kd-popup-content hidden" id="kd-popup-<?php echo $servicesingleid; ?>">
                                            <div class="kd-popup-content-inner">
                                                <div class="kd-popup-content-left">
                                                    <div class="kd-popp-content-left-inner">

                                                        <!-- video container image -->
                                                        <div class="kd-single-video-container">
                                                            <img class="single-video-paceholder-img" src="<?php echo $image_url; ?>" data-videoid="<?php echo $row->video; ?>" data-starttime="<?php echo $row->videoStartTime; ?>" data-finalurl="<?php echo $finalurl; ?>" alt="">
                                                        </div>
                                                        <br>
                                                        <p class="cardauthor"><?php echo $employeedetails->firstName . " " . $employeedetails->lastName  ?>
                                                            <?php if (get_field('verifed', $worduser)) : ?>
                                                                <span class="verifiedtext"><img class="verifyimg" src="<?php echo $server_name . '/wp-content/uploads/2023/01/Vector-Stroke.png' ?>"></span>
                                                            <?php endif;

                                                            ?>
                                                        </p>



                                                        <div class="rate">
                                                            <?php
                                                            $employeefullnamecard = $employeedetails->full_name;
                                                            $rate1 = 0;
                                                            $average1 = 0;
                                                            $reviewresult1 = $wpdb->get_results("SELECT * FROM `review_details` where user='$employeefullnamecard'");
                                                            foreach ($reviewresult1 as $row1) {
                                                                $count1 = count($reviewresult1);
                                                                $review1 = $row1->starreview;

                                                                $rate1 += $review1;
                                                                $average1 = $rate1 / $count1;
                                                            }
                                                            $rating1 = round($average1);
                                                            if ($rating1 == "1") {
                                                            ?>
                                                                <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/09/star-3-1.png' ?>">
                                                                <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">
                                                                <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">
                                                                <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">
                                                                <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">


                                                            <?php
                                                            } else if ($rating1 == "2") {
                                                            ?>
                                                                <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/09/star-3-1.png' ?>">
                                                                <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/09/star-3-1.png' ?>">
                                                                <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">
                                                                <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">
                                                                <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">
                                                            <?php
                                                            } else if ($rating1 == "3") {
                                                            ?>

                                                                <a href="<?php echo $server_name . '/about-us/#curators' ?>"><img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2023/01/starseke.png' ?>"></a>
                                                            <?php
                                                            } else if ($rating1 == "4") {
                                                            ?>

                                                                <a href="<?php echo $server_name . '/about-us/#curators' ?>"><img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2023/01/starsyanti.png' ?>"></a>
                                                            <?php
                                                            } else if ($rating1 == "5") {
                                                            ?>

                                                                <a href="<?php echo $server_name . '/about-us/#curators' ?>"><img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2023/01/starsdanielle.png' ?>"></a>

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>

                                                        <h4 class="sessionttile"><b><?php echo $row->name; ?></b></h4>
                                                        <h4 style="font-size: 16px;"><b><?php echo do_shortcode('[woo_multi_currency_exchange price="' . $row->price . '" currency="' . $curr . '"]');  ?></b></h4>
                                                        <?php
                                                        if ($row->short_excerpt != null) {
                                                        ?>
                                                            <p class="paratext shortdes"><?php echo do_shortcode($row->short_excerpt); ?></p>

                                                        <?php
                                                        }
                                                        ?>

                                                        <p class="staticlabel">60 minutes including Q&A</p>

                                                        <!-- cross sells section -->
                                                        <div class="kd-cross-sells-wrapper">
                                                            <!-- <h4 class="sessionttile"><b>You Might Also Like</b></h4> -->
                                                            <?php
                                                            global  $woocommerce;

                                                            if ($crosssellProductIds !== null) {
                                                                foreach ($crosssellProductIds as $crosssell) {
                                                                    $cross_product = wc_get_product($crosssell);
                                                                    $price = $cross_product->get_price();
                                                                    $cross_url = get_the_permalink($crosssell);
                                                                    $product_name = $cross_product->get_name();
                                                                    $product_name_trimmed = preg_replace('/\(.*/', '', $product_name);

                                                                    echo "<div class='kd-single-popup-cross-sell'><div class='name'>" . $product_name_trimmed . "</div><div class='price'>" . get_woocommerce_currency_symbol() . $price . "</div></div>";
                                                                    // echo str_replace(' ', '-', $result->name) . '-' . $result->id;
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <p class="staticlabel"> Talks about:</p>

                                                        <?php
                                                        $tagone = "";
                                                        $tagtwo = "";
                                                        $tagthree = "";
                                                        $tagfour = "";
                                                        $tagfive = "";
                                                        if ($row->tag1 != null) {
                                                            $tagone = $row->tag1;
                                                        }
                                                        if ($row->tag2 != null) {
                                                            $tagtwo = " - " . $row->tag2;
                                                        }
                                                        if ($row->tag3 != null) {
                                                            $tagthree = " - " . $row->tag3;
                                                        }
                                                        if ($row->tag4 != null) {
                                                            $tagfour = " - " . $row->tag4;
                                                        }
                                                        if ($row->tag5 != null) {
                                                            $tagfive = " - " . $row->tag5;
                                                        }
                                                        ?>

                                                        <p class="tagtext"><?php echo $tagone . $tagtwo . $tagthree . $tagfour . $tagfive; ?></p>
                                                        <!-- <p class="pricesession">60 minutes / <?php //echo do_shortcode('[woo_multi_currency_exchange price="' . $row->price . '" currency="' . $curr . '"]'); 
                                                                                                    ?></p>


                                                    <p class="views"><img class="views-icon" src="https://livelnd.com/wp-content/uploads/2022/10/eyeball.png" /> <?php //echo number_format($row->videoViews, 0, '.', ',');  
                                                                                                                                                                    ?></p> -->
                                                        <p class="paratext"><?php echo do_shortcode($row->description); ?></p>
                                                        <a href="<?php echo $url ?>"><button class="viewmorebtn">Learn More</button></a>

                                                    </div>
                                                </div>
                                                <div class="kd-popup-content-right">
                                                    <div class="booking-widget-wrapper">
                                                        <div class="booking-widget">
                                                            <?php echo do_shortcode('[ameliastepbooking trigger="amelia-popup-' . $servicesingleid . '" service="' . $servicesingleid . '"]'); ?>
                                                            <button class="hidden kd-amelia-popup-button-inst" id="amelia-popup-<?php echo $servicesingleid; ?>">
                                                                Click Here
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- single carousels -->

                <!-- mobile caousels -->

                <div class="home-demo mobicarosel">


                    <h3 id="myList" class="hometitle"><?php echo $catResult->name; ?></h3>

                    <!-- taken from rajika -->


                    <div class="owl-carousel owl-theme">


                        <?php

                        $results = $wpdb->get_results("SELECT * FROM $tbprefix" . "amelia_services where status='visible' and categoryId='" . $catResult->id . "'");
                        if (!empty($results)) {

                            foreach ($results as $row) {
                                $servicesingleid = $row->id;

                                $employee =  $wpdb->get_results("SELECT $tbprefix" . "amelia_users.* FROM " . $tbprefix . "amelia_services inner join " . $tbprefix . "amelia_providers_to_services inner join " . $tbprefix . "amelia_users on " . $tbprefix . "amelia_services.id=" . $tbprefix . "amelia_providers_to_services.serviceId and " . $tbprefix . "amelia_providers_to_services.userId=" . $tbprefix . "amelia_users.id where " . $tbprefix . "amelia_services.id='$servicesingleid'");

                                foreach ($employee as $employeedetails) {

                                    $slug7 = sanitize_title($row->name) . '-' . $servicesingleid;
                                    $url = $server_name . '/single-service/' . $slug7;
                                    $urlcalender =  $server_name . '/single-service/' . $slug7 . "#calenderbooking";

                                    $externalid = $employeedetails->externalId;

                                    $worduser = 'user_' . $externalid;

                        ?>
                                    <?php
                                    //if (get_field('approve', $worduser)) {
                                    if (1 == 1) {
                                    ?>

                                        <div class="item mainitem">
                                            <?php
                                            $videourl1 =  "https://www.youtube.com/embed/" . $row->video;
                                            $parameters1 = "?controls=1&showinfo=0&start=" . $row->videoStartTime . "&modestbranding=1&rel=0&loop=1&autoplay=1";
                                            $finalurl1 = $videourl1 . $parameters1;
                                            // $video_id1 = explode("https://www.youtube.com/embed/", $videourl1)[1];

                                            // print_r($row);
                                            ?>

                                            <!-- <img data-finalurl="<?php //echo $finalurl1;
                                                                        ?>" class="kd-yt-video-img" src="https://img.youtube.com/vi/<?php //echo $video_id1;
                                                                                                                                    ?>/1.jpg"/> -->

                                            <?php
                                            if ($row->pictureFullPath != "") {
                                            ?>
                                                <a href="<?php echo $url; ?>"><img data-videoid="<?php echo $row->video; ?>" data-starttime="<?php echo $row->videoStartTime; ?>" data-finalurl="<?php echo $finalurl1; ?>" class="kd-yt-video-img" src=<?php echo $row->pictureFullPath; ?> /> </a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?php echo $url; ?>"><img data-videoid="<?php echo $row->video; ?>" data-starttime="<?php echo $row->videoStartTime; ?>" data-finalurl="<?php echo $finalurl1; ?>" class="kd-yt-video-img" src="<?php echo $server_name . '/wp-content/uploads/2023/01/default-268x172-1.png' ?>" /> </a>
                                            <?php
                                            }
                                            ?>
                                            <!-- <iframe class="carouselvideo" src=<?php //echo $finalurl1;
                                                                                    ?>></iframe> -->


                                            <div class="container">
                                                <?php
                                                $wordpressuserid = $employeedetails->externalId;
                                                $worduser = 'user_' . $wordpressuserid;

                                                ?>


                                                <div class="contentdiv">
                                                    <div class="firstsecmobi kd-mobile-content-wrapper">
                                                        <a href=<?php echo $url; ?>>
                                                            <p class="cardauthor"><?php echo $employeedetails->firstName . " " . $employeedetails->lastName  ?>
                                                                <?php if (get_field('verifed', $worduser)) : ?>
                                                                    <span class="verifiedtext"><img class="verifyimg" src="<?php echo $server_name . '/wp-content/uploads/2023/01/Vector-Stroke.png' ?>"></span>
                                                                <?php endif; ?>
                                                            </p>

                                                            <h4 class="sessionttile"><b><?php echo $row->name; ?></b></h4>

                                                            <p class="pricesession">60 minutes / <?php echo do_shortcode('[woo_multi_currency_exchange price="' . $row->price . '" currency="' . $curr . '"]'); ?></p>

                                                            <?php if (intval($row->videoViews) > 0) { ?>
                                                                <p class="views"><img class="views-icon" src="<?php echo $server_name . '/wp-content/uploads/2022/10/eyeball.png' ?>" /> <?php echo number_format($row->videoViews, 0, '.', ',');  ?></p>
                                                            <?php } ?>
                                                        </a>
                                                    </div>
                                                    <div class="mobiparadiv">
                                                        <p class="paratext mobi"><?php echo $row->short_excerpt; ?></p>
                                                    </div>

                                                </div>
                                                <p class="calender"><a href="<?php echo $urlcalender; ?>"><img class="calender" src="<?php $server_name . '/wp-content/uploads/2022/12/calender1.png' ?>" /></a> </p>


                                            </div>
                                        </div>



                                    <?php } else { ?>
                        <?php
                                        //  }
                                    }
                                }
                            }
                        }
                        ?>

                    </div>

                    <!-- taken from rajika -->

                </div>

                <!-- mobile carusels -->

        <?php

                $index++;
            }
        }
        ?>
    </div>



    <!-- faq section -->

    <div class="faq-content-wrapper">
        <div class="faqrow ">
            <div class="row">

                <div class="col-md-4 ">
                    <h2>FAQ</h2>
                </div>
                <div class="col-md-8">
                    <div class="container">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <button class="accordion white-back">What is Live L&D?</button>
                            <div class="panel white-back">
                                <p>Live L&D is a platform where you can find your curated guest expert speakers for your organization or team. You can take an option on a specific timeslot for 72 hrs or instantly book your session of choice. </p>
                            </div>

                            <button class="accordion white-back">Are the Live L&D recorded?</button>
                            <div class="panel white-back">
                                <p>Live L&D sessions cannot be recorded, unless you agree on this specifically with the expert speaker. If a speaker has agreed to the recording of the session, you can choose this as an extra option during the booking process. </p>
                            </div>

                            <button class="accordion white-back">I am not sure yet I am able to make the booking, can I take an option on a specific timeslot?</button>
                            <div class="panel white-back">
                                <p>Yes, in the booking process, you can choose to make a reservation for a specific session and timeslot. We will hold this timeslot for you for 72 hrs and will contact you as soon as possible after you have made the reservation.</p>
                            </div>

                            <button class="accordion white-back">Are Live L&D online only?</button>
                            <div class="panel white-back">
                                <p>Yes, the Live L&D are online only, and always live and interactive.</p>
                            </div>

                            <button class="accordion white-back">How do I make sure the expert speaker is informed about any specifics before the session (e.g. size and type of audience, context in which the session takes place)?</button>
                            <div class="panel white-back">
                                <p>In the booking process (on the details page) you have the possibility to leave important information that will be shared with the expert speaker upon booking.</p>
                            </div>

                            <button class="accordion white-back">Is there a limit to the number of people attending a Live L&D session?</button>
                            <div class="panel white-back">
                                <p>In principle no, this is up to you. Two things to take into account: 1) the technical limitations of the video conferencing tool you use and 2) the level of interaction you desire for your audience. </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- faq section -->
</div>

<script>
    function muteCurrentVideo(e) {
        let muteSeperated = e.target.previousElementSibling.src.split("&mute=1")
        muteSeperated.splice(1, 1)
        e.target.previousElementSibling.src = muteSeperated.join()
        let muteOverlays = Array.from(document.getElementsByClassName('mute-button-overlay'))
        muteOverlays.forEach(mutebtn => {
            mutebtn.remove()
        })
    }

    function openFullscreenVideo() {
        let videoElement = document.getElementById('youtube-video')
        videoElement.requestFullscreen()
    }

    // store event on variable
    let alreadyClicked = false
    document.addEventListener('click', (e) => {
        console.log(e.target)
        if (!e.target.classList.contains("kd-amelia-popup-button-inst")) {
            console.log('clicked')
            alreadyClicked = true
        }

    })

    let kdTimeout = null
    let videoLoaded = []

    function kdAdddeactivatedThumb(e) {
        thumbnail = e.target
        thumbnail.classList.remove('kd-active-thumb')
    }

    function openSearchPopup(e) {
        kdOpenPopupFunc(e, "search")
    }

    function kdOpenPopupFunc(e, location = "normal") {
        if (window.innerWidth > 1023) {

            thumbnail = e.target
            thumbnail.classList.add('kd-active-thumb')
            kdTimeout = setTimeout(() => {
                if (thumbnail.classList.contains('kd-active-thumb')) {
                    // console.log('delay works')
                    let thumbnails = Array.from(document.getElementsByClassName('kd-thumbnnail'))
                    let id = thumbnail.dataset.id
                    // 			console.log(id)

                    let poppCont = document.getElementById(`kd-popup-${id}`)
                    // if (location != "normal") {
                    //     poppCont = document.getElementById(`kd-search-popup-${id}`)
                    // }

                    let poppBtn = poppCont.querySelector(`#amelia-popup-${id}`)
                    let popupContents = Array.from(document.getElementsByClassName('kd-popup-content'))
                    let kdCrWidth = document.querySelector('.kd-service-slide').clientWidth
                    popupContents.forEach(popupContent => {
                        popupContent.classList.add('hidden')
                    })

                    thumbnails.forEach(thmb => {
                        thmb.parentElement.parentElement.classList.remove('kd-active-popup-slide')
                    })

                    // 			console.log(poppCont , poppBtn)
                    console.log(`popup button${poppBtn}`)
                    poppBtn.click()
                    poppCont.classList.remove('hidden')
                    // thumbnail.parentElement.parentElement.classList.add('kd-active-popup-slide')
                    // console.log(window.innerWidth, getOffset(thumbnail).left)
                    if ((window.innerWidth - getOffset(thumbnail).left) < 600) {
                        poppCont.style.left = `auto`
                        poppCont.style.right = `30px`
                        poppCont.style.top = `${getOffset(thumbnail).top}px`
                        // const swiper = thumbnail.parentElement.parentElement.parentElement.parentElement.swiper;
                        // swiper.slideNext();
                    } else if (getOffset(thumbnail).left < 100) {
                        poppCont.style.right = `auto`
                        poppCont.style.left = `30px`
                        poppCont.style.top = `${getOffset(thumbnail).top}px`
                    } else {
                        console.log(`this is top offset ${getOffset(thumbnail).top}`)
                        poppCont.style.left = `${getOffset(thumbnail).left}px`
                        poppCont.style.top = `${getOffset(thumbnail).top}px`
                    }

                    // const yOffset = -200;
                    // const y = poppCont.getBoundingClientRect().top + window.pageYOffset + yOffset;

                    // window.scrollTo({
                    //     top: y,
                    //     behavior: 'smooth'
                    // });

                    let formElement = poppCont.querySelector('.el-form')
                    console.log(formElement)
                    console.log('formElement')

                    // let scrollTimeout = setTimeout(() => {
                    //     poppCont.scrollIntoView({ behavior: 'smooth', block: 'start' })
                    //     window.scrollBy(0, -10);
                    //     window.clearTimeout(scrollTimeout)
                    // }, 200);

                    // window.scrollBy(0, -30);

                    window.clearTimeout(kdTimeout)
                    kdTimeout = null
                    hidePopupOnMouseLeave(poppCont, thumbnail)
                    loadYoutubeVideo(poppCont)
                }
            }, 700);

        }
    }

    function getOffset(el) {
        const rect = el.getBoundingClientRect();
        return {
            left: rect.left + window.scrollX,
            top: rect.top + window.scrollY
        };
    }


    // add mouseout event to popup content
    function hidePopupOnMouseLeave(popup, thumbnail) {
        let hidepopupTimeout = setTimeout(() => {
            popup.addEventListener('mouseleave', (e) => {

                let parentEl = null

                if ($(':hover').last().hasClass('el-select__popper') || $(':hover').last().hasClass('el-select-dropdown__item')) {
                    console.log('inside a  select item')
                    parentEl = $(':hover').last()[0].parentElement
                } else {
                    popup.classList.add('hidden')
                    thumbnail.parentElement.parentElement.classList.remove('kd-active-popup-slide')
                    if (videoLoaded.includes(popup.id)) {
                        let videoWrapper = popup.querySelector('.kd-single-video-container')
                        let iframe = videoWrapper.querySelector('.kd-iframe-wrapper')
                        iframe.remove()
                        let arrIndex = videoLoaded.indexOf(popup.id);
                        videoLoaded.splice(arrIndex, 1);
                        if (parentEl != null) {
                            parentEl.style.display = 'none'
                        }
                    }
                }

                window.clearTimeout(hidepopupTimeout)
            })
        }, 00);

    }

    // load video instead of image

    function loadYoutubeVideo(popup) {
        setTimeout(() => {
            if (popup.classList.contains('hidden')) {
                console.log('hidden popup')
            } else {
                let videoWrapper = popup.querySelector('.kd-single-video-container')
                let videoImg = videoWrapper.querySelector('.single-video-paceholder-img')

                let vidUrl = `${videoImg.dataset.finalurl}`

                console.log(alreadyClicked)
                console.log(vidUrl)

                if (alreadyClicked) {
                    let CroppedUrl = videoImg.dataset.finalurl.split("&mute=1")[0]
                    console.log(CroppedUrl)
                    vidUrl = `${CroppedUrl}`
                }


                console.log(vidUrl)

                if (!videoLoaded.includes(popup.id)) {
                    if (videoImg.dataset.finalurl != '') {
                        let iframeWrapper = document.createElement('div')
                        iframeWrapper.classList.add('kd-iframe-wrapper')
                        let iframe = `<iframe class="carouselvideo" width="310" height="170" src=${vidUrl} title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><div class="mute-button-overlay" onclick="muteCurrentVideo(event)"></div>`
                        iframeWrapper.innerHTML = iframe
                        videoWrapper.insertBefore(iframeWrapper, videoImg)
                        videoImg.classList.add('hidden')
                        videoLoaded.push(popup.id)
                    } else {
                        console.log('empty')
                    }
                }
            }

        }, 700);

    }

    setInterval(() => {
        let popups = Array.from(document.getElementsByClassName('kd-popup-content'))
        popups.forEach(popup => {
            if (popup.classList.contains('hidden')) {
                // console.log('captured a hidden popup')
                let videoWrapper = popup.querySelector('.kd-single-video-container')
                let iframe = videoWrapper.querySelector('.kd-iframe-wrapper')
                if (iframe != null) {
                    iframe.remove()
                    let arrIndex = videoLoaded.indexOf(popup.id);
                    videoLoaded.splice(arrIndex, 1);
                }

            }
        })
    }, 1000);

    var owl = $('.brandcarousel');
    owl.owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },

            600: {
                items: 3
            },

            1024: {
                items: 4
            },

            1366: {
                items: 4
            }
        }
    });

    $(function() {
        var owl = $(".owl-carousel");

        owl.owlCarousel({
            margin: 10,
            loop: true,
            nav: true,
            margin: 15,
            mouseDrag: true,
            responsiveClass: true,
            responsiveRefreshRate: 200,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1024: {
                    items: 4
                },
                1366: {
                    items: 6
                },
                2080: {
                    items: 7
                }
            }
        });


        var owl = $(".onecro");
        owl.owlCarousel({
            margin: 10,
            loop: true,
            nav: true,
            mouseDrag: true,
            responsiveClass: true,
            responsiveRefreshRate: 200,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1024: {
                    items: 4
                },
                1366: {
                    items: 6
                },
                2080: {
                    items: 7
                }
            }
        });




    });
</script>

<?php

get_footer();
?>
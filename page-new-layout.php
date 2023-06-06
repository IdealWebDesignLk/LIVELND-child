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
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<div class="new-homepage-wrapper">
    <!-- hero area -->
    <div class="hero-area-wrapper" style="background: url('<?php echo $imgurl; ?>');">
        <div class="hero-area-overlay"></div>
        <div class="hero-area-inner">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h1>Book the best <br>
                        [topic] speakers for <br>
                        Your team</h1>
                    <p>Live, Online & exclusively for your company.</p>

                </div>
                <div class="col-md-5">
                    <p class="main-session-info">
                        Like Anotonia Forster,
                        'LGBTQ' + it's Natural
                    </p>
                    <div class="start-rating-wrapper">
                        <div class="ratings">
                            <ul>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                        </div>
                        <div class="speaker">
                            By Delottie HR
                        </div>
                        <div class="more-about-speaker">
                            <a href="#">More About This Speaker</a>
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

                                <select name="kd-search-category" id="kd-search-ccategory" onchange="selectResultBasedCategory(event)">
                                    <option value="select-category">All Categories</option>
                                    <?php

                                    global $wpdb;
                                    $tbprefix = $wpdb->prefix;
                                    
                                    $categoriesSql = "SELECT * FROM $tbprefix" . "amelia_categories GROUP BY `id` ORDER BY `position`;";
                                    $catResults = $wpdb->get_results($categoriesSql);

                                    //$exclude_cat_id = array(17, 23, 19, 12, 9, 8, 18, 4, 12, 44, 28, 29, 42, 41, 40);
                                    $exclude_cat_id;
                                    if (ot_get_option('exclude_category_id_s')) {
                                        $exclude_cat_id = explode(',', ot_get_option('exclude_category_id_s'));
                                    }

                                    foreach ($catResults as $catResult) {
                                        if (!in_array(intval($catResult->id), $exclude_cat_id)) {
                                    ?>
                                            <option value="<?php echo $catResult->name; ?>"><?php echo $catResult->name; ?></option>
                                    <?php }
                                    } ?>
                                </select>
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
                                <button class="kd-search-btn" onclick="">Search</button>
                                <button class="kd-reset-btn" onclick="resetSearch(event)">Reset Filters</button>
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
                                    <h2>Find your virtual speaker</h2>
                                    <p>Our curators have handpicked global experts who speak about Pride, LGBTQ rights, biases, inclusion and tens of other topics. Discover speakers by hovering over thir talks.</p>
                                </div>
                            </div>
                            <!-- steps single column -->
                            <div class="col-md-4">
                                <div class="steps-col-inner">
                                    <h2>Check availability and fees</h2>
                                    <p>All Live L&D speakers have connected their calendar to our platform. Search for speakers based on availability and budget. Or schedule a Meet & Greet with the expert before booking.</p>
                                </div>
                            </div>
                            <!-- steps single column -->
                            <div class="col-md-4">
                                <div class="steps-col-inner">
                                    <h2>Hold time slot / Book now </h2>
                                    <p>Pick a day/time slot for your Pride Month Talk. Book immediately and pay later. Or pick a time slot for the speaker to hold for 72 hours and we will cntact you to answer your questions before youmake a boking.</p>
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

        <?php

                $index++;
            }
        }
        ?>
    </div>
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
                // console.log(e.target)
                // var hover_element = $(':hover').last().hasClass('el-select-dropdown__item');
                // console.log($(':hover').last())
                // console.log($(':hover').last()[0])
                // console.log($(':hover').last().hasClass('el-select-dropdown__item'))
                // console.log($(':hover').last().hasClass('el-select__popper'))
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
            margin : 15,
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
<?php /* Template Name: Page_home_merged_new_latest */ ?>

 <!--Load Preloader-->

<div id="preloader">
  <h4 id="loading-text">LiveLND is loading for you
    <span class="dot-container">
      <span class="dot-animation">.</span>
      <span class="dot-animation">.</span>
      <span class="dot-animation">.</span>
      <span class="dot-animation">.</span>
    </span>
  </h4>
</div>

<script>
document.body.classList.add("preloader-active");	
</script>
<style>
body.preloader-active {
  overflow: hidden;
}

#preloader {
  display: flex; /* Add flexbox to the preloader */
  align-items: center; /* Center the loading text vertically */
  justify-content: center; /* Center the loading text horizontally */
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: black;
  z-index: 9999;
}

#loading-text {
  font-size: 24px !important;
  font-weight: bold !important;
  text-align: center !important;
  white-space: nowrap;
  letter-spacing: 0.15em !important;
  color: #ff8250;
  position: relative; /* Change position to relative */
}

.dot-container {
  display: inline-flex;
  position: absolute;
  top: 0;
  left: 100%;
  margin-left: 5px;
  width: 50px; /* Add a fixed width */
  height: 24px; /* Add a fixed height */
}
.dot-animation {
  position: absolute;
  animation: dot-bounce 1.2s linear infinite;
  margin-left: 2px;
  will-change: transform;
}

.dot-animation:nth-child(2) {
  margin-left: 14px;
  animation-delay: 0.2s;
}

.dot-animation:nth-child(3) {
  margin-left: 26px;
  animation-delay: 0.4s;
}

.dot-animation:nth-child(4) {
  margin-left: 38px;
  animation-delay: 0.6s;
}

@keyframes dot-bounce {
  0%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-10px);
  }
}

@media only screen and (max-width: 768px) {
  #loading-text {
    font-size: 20px !important;
  }
}

</style>


<?php
get_header();

?>
<?php echo '<script type="text/javascript">let kdHomepage = true; </script>'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


<?php
//new comment
$finalHeroVidUrl = "";
$server_name = "";
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $server_name = "https://";
else
    $server_name = "http://";

// Append the host(server name) to the URL.   
$server_name .= $_SERVER['SERVER_NAME'];

// Output the final server name   

$tbprefix = "";
$tbprefix = $wpdb->prefix;
$tbprefix  = trim($tbprefix);
$serviceid = "7";
$service = $wpdb->get_results("SELECT * FROM $tbprefix" . "amelia_services where id='$serviceid'");

$employee =  $wpdb->get_results("SELECT $tbprefix" . "amelia_users.* FROM " . $tbprefix . "amelia_services inner join " . $tbprefix . "amelia_providers_to_services inner join " . $tbprefix . "amelia_users on " . $tbprefix . "amelia_services.id=" . $tbprefix . "amelia_providers_to_services.serviceId and " . $tbprefix . "amelia_providers_to_services.userId=" . $tbprefix . "amelia_users.id where " . $tbprefix . "amelia_services.id='$serviceid'");

?>

<!-- video to test autoplay -->
<?php
$videosrc =  $server_name . '/wp-content/uploads/2022/09/pexels-artem-podrez-5752724.mp4';
?>
<video src="<?php echo $videosrc; ?>" autoplay class="hidden" id="kd-test-autoplay"></video>


<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="containerx">
            <div class="bg-video-wrap">


                <!-- taken from rajika -->

                <?php
                $paramid = '';
                if (isset($_GET['idx']) && $_GET['idx'] != '') {
                       $paramid = $_GET['idx'];}
                if ($paramid != "") {


                    $service = $wpdb->get_results("SELECT * FROM $tbprefix" . "amelia_services where status='visible' and id='$paramid'");


                    $employee =  $wpdb->get_results("SELECT $tbprefix" . "amelia_users.* FROM " . $tbprefix . "amelia_services inner join " . $tbprefix . "amelia_providers_to_services inner join " . $tbprefix . "amelia_users on " . $tbprefix . "amelia_services.id=" . $tbprefix . "amelia_providers_to_services.serviceId and " . $tbprefix . "amelia_providers_to_services.userId=" . $tbprefix . "amelia_users.id where " . $tbprefix . "amelia_services.id='$paramid'");


                    if ($service[0]->video != "" || $service[0]->video != null) {
                        $videourlhero = "https://www.youtube.com/embed/" . $service[0]->video;
                        $parametershero = "?enablejsapi=1&rel=0&start=" . $service[0]->videoStartTime . "&mute=1&autoplay=1&modestbranding=1";
                        $finalurlhero = $videourlhero . $parametershero;
                    } else {
                        $imgurl =  ot_get_option('top_section_background_image');
                ?>
                        <div class="bg-video-wrap videobackimg" style="background: url(<?php echo $imgurl; ?>)">

                        <?php
                    }


                        ?>

                        <?php
                        if ($finalurlhero != "" || $finalurlhero != null) {
                        ?>
                            <div class="video-background">

                                <div class="video-foreground">
                                    <iframe class="youtube-video" id="youtube-video" width="278" height="154" src=<?php echo  $finalurlhero; ?> title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>

                            </div>




                            <?php

                        }
                    } else if (function_exists('ot_get_option')) {
                        if (ot_get_option('featured_video_id')) {
                            $serviceid = ot_get_option('featured_video_id');

                            $service = $wpdb->get_results("SELECT * FROM $tbprefix" . "amelia_services where status='visible' and id='$serviceid'");


                            $employee =  $wpdb->get_results("SELECT $tbprefix" . "amelia_users.* FROM " . $tbprefix . "amelia_services inner join " . $tbprefix . "amelia_providers_to_services inner join " . $tbprefix . "amelia_users on " . $tbprefix . "amelia_services.id=" . $tbprefix . "amelia_providers_to_services.serviceId and " . $tbprefix . "amelia_providers_to_services.userId=" . $tbprefix . "amelia_users.id where " . $tbprefix . "amelia_services.id='$serviceid'");



                            if ($service[0]->video != "" || $service[0]->video != null) {
                                $videourlhero = "https://www.youtube.com/embed/" . $service[0]->video;
                                $parametershero = "?enablejsapi=1&rel=0&start=" . $service[0]->videoStartTime . "&mute=1&autoplay=1&modestbranding=1";
                                $finalurlhero = $videourlhero . $parametershero;
                                $finalHeroVidUrl = $videourlhero . "?enablejsapi=1&rel=0";
                            } else {
                                $imgurl =  ot_get_option('top_section_background_image');
                            ?>
                                <div class="bg-video-wrap videobackimg" style="background: url(<?php echo $imgurl; ?>)">

                                <?php
                            }


                                ?>
                            <?php
                        }


                            ?>

                            <?php
                            if ($finalurlhero != "" || $finalurlhero != null) {
                            ?>
                                <div class="video-background">
                                    <?php

                                    ?>
                                    <div class="video-foreground">
                                        <iframe class="youtube-video" id="youtube-video" width="278" height="154" src=<?php echo  $finalurlhero; ?> title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>

                                </div>

                            <?php
                            }
                            ?>


                        <?php

                    }


                        ?>



                        <!-- taken from rajikaa -->


                        <div class="overlay mobioverlay" id="kd-video-overlay1" style="background-image:url('<?php echo $service[0]->pictureFullPath ?>')"></div>
                        <div class="overlay deskoverlay" id="kd-video-overlay" style="background-image:url('<?php echo $service[0]->pictureFullPath ?>')"></div>



                        <div class="vsec">
                            <div class="col-12 col-md">
                                <div class="text-wrapper">
                                    <h2 class="mbr-section-title mb-3 mbr-fonts-style display-2">

                                        <strong><?php echo $service[0]->name; ?></strong>

                                    </h2>
                                    <h3 class="headeremployeename">

                                        <?php
                                        $employeefullname = $employee[0]->full_name;
                                        $wordpressuserid = $employee[0]->externalId;
                                        $worduser = 'user_' . $wordpressuserid;
                                        ?>
                                        <?php echo $employee[0]->firstName . " " . $employee[0]->lastName; ?>
                                        <?php if (get_field('verifed', $worduser)) : ?>
                                            <span class="verifiedtext"><img class="verifyimg" src="<?php echo $server_name . '/wp-content/uploads/2023/01/Vector-Stroke.png' ?>"></span>
                                        <?php endif; ?>


                                    </h3>
                                    <div class="rate">
                                        <?php
                                        $average = 0;
                                        $rate = 0;
                                        $reviewresult = $wpdb->get_results("SELECT * FROM `review_details` where user='$employeefullname'");
                                        foreach ($reviewresult as $row) {
                                            $count = count($reviewresult);
                                            $review = $row->starreview;

                                            $rate += $review;
                                            $average = $rate / $count;
                                        }
                                        $rating = round($average);
                                        if ($rating == "1") {
                                        ?>
                                            <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/09/star-3-1.png' ?>">
                                            <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">
                                            <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">
                                            <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">
                                            <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">


                                        <?php
                                        } else if ($rating == "2") {
                                        ?>
                                            <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/09/star-3-1.png' ?>">
                                            <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/09/star-3-1.png' ?>">
                                            <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">
                                            <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">
                                            <img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2022/10/emptystar.png' ?>">
                                        <?php
                                        } else if ($rating == "3") {
                                        ?>

                                            <a href="<?php $server_name . '/how-it-works-iwd-sessions-explained/#curators' ?>"><img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2023/01/starseke.png' ?>"></a>
                                        <?php
                                        } else if ($rating == "4") {
                                        ?>

                                            <a href="<?php $server_name . '/how-it-works-iwd-sessions-explained/#curators' ?>"><img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2023/01/starsyanti.png' ?>"></a>
                                        <?php
                                        } else if ($rating == "5") {
                                        ?>

                                            <a href="<?php $server_name . '/how-it-works-iwd-sessions-explained/#curators' ?>"><img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2023/01/starsdanielle.png' ?>"></a>

                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="sessiondiscription">
                                        <p class="mbr-text mb-3 mbr-fonts-style display-7">
                                            <?php echo do_shortcode($service[0]->description); ?>
                                        </p>
                                    </div>
                                    <div class="price">

                                        <?php

                                        // generate currency format

                                        $oFormatter = new \NumberFormatter('de_DE', \NumberFormatter::CURRENCY);
                                        $formattedPrice = $oFormatter->formatCurrency($service[0]->price, 'EUR');


                                        ?>
                                        <h3 class="session-price"><?php echo do_shortcode('[woo_multi_currency_exchange price="' . $service[0]->price . '" currency="' . $curr . '"]'); ?></h3>
                                    </div>
                                    <p class="staticlabeltop">60 minutes including Q&A</p>
                                    <div class="views">
                                        <?php if (intval($service[0]->videoViews) > 1000) { ?>
                                            <h3 class="viewscount"> <?php echo number_format($service[0]->videoViews, 0, '.', ','); ?> Youtube views</h3>
                                        <?php } ?>
                                    </div>
                                    <?php



                                    $slug1 = sanitize_title($service[0]->name) . '-' . $serviceid;
                                    $topvideosingle =  $server_name . "/single-service/" . $slug1;
                                    ?>
                                    <a href=<?php echo $topvideosingle; ?>><button type="button" class="btn btn-dark sessionbtn">Instant Booking</button></a>
                                    <?php

                                    ?>
                                </div>

                            </div>

                        </div>

                        <!-- 	mute unmute			 -->
                        <p id="unmute"><img class="change-src-on-hover" data-hoverimg="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1SoundOff_Hover.png' ?>" src="<?php echo $server_name . '/wp-content/uploads/2023/03/SoundButton.png' ?>"></p>
                        <p id="mute"><img class="change-src-on-hover" data-hoverimg="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1SoundOn_Hover.png' ?>" src="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1SoundOff.png' ?>"></p>

                        <!--   Play Pause		 -->

                        <p id="kd-play-video" style="width: auto; " class=""><img class="change-src-on-hover" data-hoverimg="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1PauseOn_Hover.png' ?>" src="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1PlayOn.png' ?>"></p>
                        <p id="kd-pause-video" style="width: auto; " class=""><img class="change-src-on-hover" data-hoverimg="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1PlayOn_Hover.png' ?>" src="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1PauseOn.png' ?>"></p>


                        <!-- full screen  -->
                        <p id="kd-full-screen-video" onclick="openFullscreenVideo()" style="width: auto; " class=""><img class="change-src-on-hover" data-hoverimg="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1Hover.png' ?>" src="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1Expand.png' ?>"></p>
                                </div>


                                <div class="container homebodysec">
                                    <div class="innerhomesecondrow">
                                        <div class="secondsec">
                                            <h2>Book a Virtual Live Speaker for International Women's Week!</h2>

                                            <div class="row textrowdiv">
                                                <div class="col-md-4">
                                                    <img class="threeblurbimg" src="<?php echo $server_name . "/wp-content/uploads/2023/01/Group-10.png" ?>">
                                                    <h4>1. Find your virtual speaker</h4>
                                                    Our curators have handpicked global experts who speak about equity, bias & diversity.
                                                    Discover them by hovering over their talks.
                                                </div>

                                                <div class="col-md-4">
                                                    <img class="threeblurbimg" src="<?php echo $server_name . "/wp-content/uploads/2023/01/Group-11.png" ?>">
                                                    <h4>2. Check availability</h4>
                                                    All DEI speakers have connected their calendar to our site. Check their availability throughout the DEI week.
                                                </div>
                                                <div class="col-md-4">
                                                    <img class="threeblurbimg" src="<?php echo $server_name . "/wp-content/uploads/2023/01/Group-12.png" ?>">
                                                    <h4>3. Hold Time Slot / Book Instantly</h4>
                                                    Pick a day/time slot for your virtual talk. We will hold that time slot for 48 hours for you and contact you to answer your questions.
                                                </div>
                                                <p class="bottomtext">Sessions will be held in your company’s own Microsoft Teams, Google Meet, Zoom or Webex environment.</p>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                        </div>
            </div>
    </main>


    <!-- ====================================================================================== -->
    <!-- kd new search box -->
    <div class="container-fluidx background-black kd-new-search-box">
        <div class="kd-new-searchbox-inner">
            <div class="kd-searchbox-inner">
                <form action="" id="kd-search-form" class="kd-search-form">
                    <div class="kd-form-group">

                        <label>Category</label>

                        <select name="kd-search-category" id="kd-search-ccategory" onchange="selectResultBasedCategory(event)">
                            <option value="select-category">Select Category</option>
                            <?php

                            global $wpdb;
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
                        <label>Max Price</label>
                        <input type="number" id="kd-price-to" onchange="selectResultBasedPrice(event)" onkeyup="selectResultBasedPrice(event)">
                    </div>
                    <div class="kd-form-group">
                        <label>Search</label>
                        <input type="text" id="kd-search-field" onkeyup="selectResultBasedTitle(event)">
                    </div>

                    <div class="kd-form-group">
                        <label>From</label>
                        <input type="date" id="kd-from-date" onchange="get_available_dates(event)">
                    </div>

                    <div class="kd-form-group">
                        <label>To</label>
                        <input type="date" id="kd-to-date" onchange="get_available_dates(event)">
                    </div>

                    <div class="kd-form-group">
                        <label>&nbsp;</label>
                        <button class="kd-reset-btn" onclick="resetSearch(event)">Reset Filters</button>
                    </div>
                </form>
            </div>

            <div class="kd-searchbox-result home-demo">
                <h3 class="hometitle kd-search-title d-none" id="myList">Search results</h3>
                <div class="kd-search-result-carousel-wrapper">

                </div>

                <div class="kd-search-single-popup-wrapper">
                    <div class="kd-search-single-popup-inner">
                    </div>
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
    </div>

    <!-- ====================================================================================== -->

    <div class="container-fluidx background-black">

        <!-- getting video carousels -->
        <?php

        global $wpdb;
        $categoriesSql = "SELECT * FROM $tbprefix" . "amelia_categories GROUP BY `id` ORDER BY `position`;";
        $catResults = $wpdb->get_results($categoriesSql);
        //$exclude_cat_id = array(17, 23, 19, 12, 9, 8, 18, 4, 12, 44, 28, 29, 42, 41, 40);
        $exclude_cat_id = array();
        if (ot_get_option('exclude_category_id_s')) {
            $exclude_cat_id = explode(',', ot_get_option('exclude_category_id_s'));
        }
        foreach ($catResults as $catResult) {
            if (!in_array(intval($catResult->id), $exclude_cat_id)) {

        ?>
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


                                            <div class="item mainitem kd-service-slide" data-id="<?php echo $servicesingleid; ?>" data-tags="<?php echo $tagone . $tagtwo . $tagthree . $tagfour . $tagfive; ?>" data-expert="<?php echo $employeedetails->firstName . " " . $employeedetails->lastName;  ?>" data-category="<?php echo $catResult->name; ?>" data-price="<?php echo $row->price; ?>" data-name="<?php echo $row->name; ?>">

                                                <div onmouseleave="kdAdddeactivatedThumb(event)" onmouseenter="kdOpenPopupFunc(event)" class="gallery-video-thumbnail kd-thumbnnail" data-id="<?php echo $servicesingleid; ?>">
                                                    <a data-id="<?php echo $servicesingleid; ?>">
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

                                                                <a href="<?php $server_name . '/how-it-works-iwd-sessions-explained/#curators' ?>"><img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2023/01/starseke.png' ?>"></a>
                                                            <?php
                                                            } else if ($rating1 == "4") {
                                                            ?>

                                                                <a href="<?php $server_name . '/how-it-works-iwd-sessions-explained/#curators' ?>"><img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2023/01/starsyanti.png' ?>"></a>
                                                            <?php
                                                            } else if ($rating1 == "5") {
                                                            ?>

                                                                <a href="<?php $server_name . '/how-it-works-iwd-sessions-explained/#curators' ?>"><img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2023/01/starsdanielle.png' ?>"></a>

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


                                                    <p class="views"><img class="views-icon" src="https://iwdsessions.com/wp-content/uploads/2022/10/eyeball.png" /> <?php //echo number_format($row->videoViews, 0, '.', ',');  
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

                </div>
            <!--Unload Preloader-->
            <script>
            window.addEventListener("load", function(){
            var preloader = document.getElementById('preloader');
            preloader.style.display = 'none';
            document.body.classList.remove("preloader-active");
            });
            </script>
            <noscript>
            <style>
            #preloader {
            display: none;
            }
            </style>
            <p>Your browser has JavaScript disabled. Some features on this website may not work properly. Please enable JavaScript for the best experience.</p>
            </noscript>

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
                                                    <div class="firstsecmobi">
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

    <?php }

                    // 					end if cluse that checks if the category is 12
                }
            }
            // 					end if cluse that checks if the category is 12
    ?>

    </div>
    <div class="mainfaqrow">
        <div class="faqrow ">
            <div class="row">

                <div class="col-md-4 ">
                    <h2>FAQ</h2>
                </div>
                <div class="col-md-8">
                    <div class="container">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <button class="accordion">What is DEI Sessions?</button>
                            <div class="panel">
                                <p>DEI Sessions is a platform where you can find your curated guest expert speakers for International Women's Day and the week in which this day falls (6-10 March). You can take an option on a specific time slot for 48 hrs or instantly book your session of choice.</p>
                            </div>

                            <button class="accordion">Are the DEI sessions recorded?</button>
                            <div class="panel">
                                <p>The DEI sessions cannot be recorded, unless you agree on this specifically with the expert speaker. </p>
                            </div>

                            <button class="accordion">I am not sure yet I am able to make the booking, can I take an option on a specific timeslot?</button>
                            <div class="panel">
                                <p>Yes, in the booking process, you can choose to make a reservation for a specific session and timeslot. We will hold this timeslot for you for 48 hrs and will contact you as soon as possible after you have made the reservation.</p>
                            </div>

                            <button class="accordion">Are DEI sessions online only?</button>
                            <div class="panel">
                                <p>Yes, the DEI sessions are online only, and always live and interactive.</p>
                            </div>

                            <button class="accordion">How do I make sure the expert speaker is informed about any specifics before the session (e.g. size and type of audience, context in which the session takes place)?</button>
                            <div class="panel">
                                <p>In the booking process (on the details page) you have the possibility to leave important information that will be shared with the expert speaker upon booking.</p>
                            </div>

                            <button class="accordion">Is there a limit to the number of people attending a DEI session?</button>
                            <div class="panel">
                                <p>In principle no, this is up to you. Two things to take into account: 1) the technical limitations of the video conferencing tool you use and 2) the level of interaction you desire for your audience. </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
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
    <?php get_sidebar('content-bottom'); ?>

    <!-- adding new cokie popup -->
    <!--     <div class="kd-cookie-popup-wrapper hidden" id="kd-cookie-popup-wrapper">
        <div class="kd-popp-content-inner">
            <span class="kd-cookie-popup-close kd-close-cookie" onclick="closeCookiePopup(event)">X</span>
            <p>We use cookies on our website to give you the most relevant experience by remembering your preferences and repeat visits. By clicking "Allow cookies", you agree to the use of ALL cookies.</p>
            <button class="kd-accept-cookies kd-close-cookie" onclick="closeCookiePopup(event)">Allow cookies</button>
        </div>
    </div> -->
</div><!-- .content-area -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php /* Template Name: Page_home_Optimized_speed */ ?>
<?php
get_header();

// get server name
$server_name = "";
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $server_name = "https://";
else
    $server_name = "http://";

// Append the host(server name) to the URL.   
$server_name .= $_SERVER['SERVER_NAME'];

// iniiate wpdb
global $wpdb;
$tbprefix = $wpdb->prefix;
$tbprefix  = trim($tbprefix);

// get excluded categories
// $exclude_cat_id = array();
// if (ot_get_option('exclude_category_id_s')) {
//     $exclude_cat_id = explode(',', ot_get_option('exclude_category_id_s'));
// }

// get categories
// $categoriesSql = "SELECT id FROM $tbprefix" . "amelia_categories GROUP BY `id` ORDER BY `position`;";
// $catResults = $wpdb->get_results($categoriesSql);

// forEach($catResults as $catresult){
//     print_r($catresult);
// }

// get all service data
// $all_sql = "SELECT u.* , s.* FROM " . $tbprefix . "amelia_services s inner join " . $tbprefix . "amelia_providers_to_services p inner join " . $tbprefix . "amelia_users u on s.id=p.serviceId and p.userId=u.id where s.status  = 'visible' and s.categoryId NOT IN('$exclude_cat_id_string') ORDER BY s.position ASC";
// print_r($all_sql);

// $all_service_data =  $wpdb->get_results($all_sql);

// foreach($all_service_data as $single_service_data){
//     echo '<pre>';
//     print_r($all_service_data);
//     echo '</pre>';

// }

// foreach ($catResults as $category) {
//     print_r($category);
// }




?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">



<?php

// get video placeholder image
$imgurl =  ot_get_option('top_section_background_image');
$serviceid = ot_get_option('featured_video_id');

?>

<!-- preloader -->
<div id="kd-preloader">
    <h4 id="loading-text">Live L&D is loading
        <span class="dot-container">
            <span class="dot-animation">.</span>
            <span class="dot-animation">.</span>
            <span class="dot-animation">.</span>
            <span class="dot-animation">.</span>
        </span>
    </h4>
</div>

<script type="text/javascript">
    window.addEventListener('load', () => {
        document.getElementById('kd-preloader').style.display = "none";
    })
</script>

<!-- preloader -->

<section id="primary" class="content-area">

    <!-- ===================main video area================= -->
    <main id="main" class="site-main" role="main">
        <div class="bg-video-wrap videobackimg" style="background: url(<?php echo $imgurl; ?>)">
            <div class="video-background">

                <div class="video-foreground">
                    <!-- <div class="youtube-video" data-src="<?php echo $service[0]->video; ?>" id="kd-main-youtube-video" width="278" height="154" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></div> -->
                </div>
            </div>

            <!-- vsec area -->

            <!-- controls -->
            <!-- 	mute unmute			 -->
            <p id="unmute"><img class="change-src-on-hover" data-hoverimg="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1SoundOff_Hover.png' ?>" src="<?php echo $server_name . '/wp-content/uploads/2023/03/SoundButton.png' ?>"></p>
            <p id="mute"><img class="change-src-on-hover" data-hoverimg="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1SoundOn_Hover.png' ?>" src="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1SoundOff.png' ?>"></p>

            <!--   Play Pause		 -->

            <p id="kd-play-video" style="width: auto; " class=""><img class="change-src-on-hover" data-hoverimg="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1PauseOn_Hover.png' ?>" src="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1PlayOn.png' ?>"></p>
            <p id="kd-pause-video" style="width: auto; " class=""><img class="change-src-on-hover" data-hoverimg="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1PlayOn_Hover.png' ?>" src="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1PauseOn.png' ?>"></p>


            <!-- full screen  -->
            <p id="kd-full-screen-video" style="width: auto; " class=""><img class="change-src-on-hover" data-hoverimg="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1Hover.png' ?>" src="<?php echo $server_name . '/wp-content/uploads/2023/01/Property-1Expand.png' ?>"></p>
            <!-- controls -->
        </div>

        <div class="container homebodysec">
                <div class="innerhomesecondrow">
                    <div class="secondsec">
                        <h1>Find expert speakers to celebrate Pride Month <a href="https://livelnd.com/pride/">here!</a></h1>

                        <div class="row textrowdiv">
                            <div class="col-md-4">
                                <img class="threeblurbimg" src="<?php echo $server_name . "/wp-content/uploads/2023/01/Group-10.png" ?>">
                                <h4>1. Find your virtual speaker</h4>
                                Our curators have handpicked global experts who speak about Leadership Skills, Diversity & Inclusion, Mental Health & Wellbeing and tens of other topics. Discover 100 speakers by hovering over their talks.
                            </div>

                            <div class="col-md-4">
                                <img class="threeblurbimg" src="<?php echo $server_name . "/wp-content/uploads/2023/01/Group-11.png" ?>">
                                <h4>2. Check availability and fees</h4>
                                All Live L&D speakers have connected their calendar to our platform. Search for speakers based on availability and budget. Or schedule a Meet & Greet with the expert before booking.
                            </div>
                            <div class="col-md-4">
                                <img class="threeblurbimg" src="<?php echo $server_name . "/wp-content/uploads/2023/01/Group-12.png" ?>">
                                <h4>3. Hold Time Slot / Book Instantly</h4>
                                Pick a day/time slot for your Pride Month Talk. Book immediately and pay later. Or pick a time slot for the speaker to hold for 72 hours and we will contact you instantly to answer all your questions before you make an actual booking.
                            </div>
                            <p class="bottomtext"> <b>LIVE L&D Sessions are held in your company's own Microsoft Teams, Google Meet, Zoom or Webex environment. Click <a href="https://livelnd.com/how-it-works-live-l-and-d-explained/">here </a>to see how it works.</b></p>
                        </div>
                    </div>

                    <!-- adding new text -->
                    <div class="kd-new-unique-text">
                        <h5 class="text-center">Live L&D is the world’s first direct booking platform for expert speakers and facilitators</h5>
                        <div class="unique-features">

                            <a href="https://livelnd.com/how-it-works-live-l-and-d-explained/"><u>Instant Availability Check</u></a>
                            <a href="https://livelnd.com/how-it-works-live-l-and-d-explained/"><u>Direct Booking</u></a>
                            <a href="https://livelnd.com/how-it-works-live-l-and-d-explained/"><u>Book Now / Pay Later</u></a>
                            <a href="https://livelnd.com/how-it-works-live-l-and-d-explained/"><u>Meet Experts Before Booking</u></a>

                        </div>
                    </div>

                </div>
            </div>
    </main>
    <!-- ===================main video area================= -->

    <!-- ====================================================================================== -->
    <!-- kd new search box -->
    <div class="container-fluidx background-black kd-new-search-box">
        <div class="kd-new-searchbox-inner">
            <div class="kd-searchbox-inner">
                <form action="" id="kd-search-form" class="kd-search-form" onkeydown="return checkForEnter(event);">
                    <div class="kd-form-group">

                        <label>Category</label>

                        <select name="kd-search-category" id="kd-search-ccategory" onchange="selectResultBasedCategory(event)">
                            <option value="select-category">All Categories</option>
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
    </div>

    <!-- ====================================================================================== -->

    <!-- =======================================categories======================== -->
    <!-- <div class="container-fluidx background-black">
        <?php
        $categoriesSql = "SELECT * FROM $tbprefix" . "amelia_categories GROUP BY `id` ORDER BY `position`;";
        $catResults = $wpdb->get_results($categoriesSql);

        // exclude category ids
        $exclude_cat_id = array();
        if (ot_get_option('exclude_category_id_s')) {
            $exclude_cat_id = explode(',', ot_get_option('exclude_category_id_s'));
        }

        foreach ($catResults as $catresult) {
            $cat_id = floatval($catresult->id);
            $cat_name = $catresult->name;

            if (!in_array($cat_id, $exclude_cat_id)) {
        ?>

                <div class="home-demo deskcarousel kd-single-services-category">
                    <h3 id="myList" class="hometitle"><?php print_r($catresult->name); ?></h3>
                    <div class="kd-single-category-services" data-categoryname="<?php echo $cat_name; ?>" data-catid="<?php echo $cat_id; ?>">
                        <div class="single-category-loader">
                            <h3>Loading <?php print_r($cat_name); ?>...</h3>
                        </div>
                    </div>

                </div>
        <?php }
        }
        ?>
    </div> -->
    <!-- =======================================categories======================== -->


</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>



<?php get_footer(); ?>
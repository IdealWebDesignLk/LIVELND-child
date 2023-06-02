<?php

/* Template Name: Page_home_new_template */

get_header();
$imgurl =  ot_get_option('top_section_background_image');

?>
<div class="new-homepage-wrapper">
    <!-- hero area -->
    <div class="hero-area-wrapper" style="background: url('<?php echo $imgurl; ?>');">

        <div class="row">
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
                            <button class="kd-search-btn" onclick="">Search</button>
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

    </div>
</div>

<!-- carousels section -->
<div class="carousels-section-wrapper">
    <?php
    global $wpdb;
    $categoriesSql = "SELECT * FROM $tbprefix" . "amelia_categories GROUP BY `id` ORDER BY `position`;";

    print_r($categoriesSql);

    $catResults = $wpdb->get_results($categoriesSql);

    print_r($catResults);
    $exclude_cat_id = array();
    if (ot_get_option('exclude_category_id_s')) {
        $exclude_cat_id = explode(',', ot_get_option('exclude_category_id_s'));
    }
    foreach ($catResults as $key => $catResult) {
        if (!in_array(intval($catResult->id), $exclude_cat_id)) {

            echo $key;
    ?>

            <?php
                if($key==1){ ?>

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


            
            <!-- single carousels -->

    <?php
        }
    }
    ?>
</div>

<?php

get_footer();
?>
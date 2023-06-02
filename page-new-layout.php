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

<?php

get_footer();
?>
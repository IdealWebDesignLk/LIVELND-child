<?php /* Template Name: Page_home_Optimized_speed */ ?>
<?php
get_header();


// iniiate wpdb
global $wpdb;
$tbprefix = $wpdb->prefix;
$tbprefix  = trim($tbprefix);

// get excluded categories
$exclude_cat_id = array();
if (ot_get_option('exclude_category_id_s')) {
    $exclude_cat_id = explode(',', ot_get_option('exclude_category_id_s'));
}

$exclude_cat_id_string = implode("' ,'", $exclude_cat_id);

// get categories
$categoriesSql = "SELECT id FROM $tbprefix" . "amelia_categories WHERE id NOT IN('$exclude_cat_id_string') GROUP BY `id` ORDER BY `position`;";
// $catResults = $wpdb->get_results($categoriesSql);

// forEach($catResults as $catresult){
//     print_r($catresult);
// }

// get all service data
$all_sql = "SELECT u.* , s.* FROM " . $tbprefix . "amelia_services s inner join " . $tbprefix . "amelia_providers_to_services p inner join " . $tbprefix . "amelia_users u on s.id=p.serviceId and p.userId=u.id where s.status  = 'visible' and s.categoryId NOT IN('$exclude_cat_id_string') ORDER BY s.position ASC";
print_r($all_sql);

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



<?php

// get video placeholder image
$imgurl =  ot_get_option('top_section_background_image');
$serviceid = ot_get_option('featured_video_id');
$service = $wpdb->get_results("SELECT * FROM $tbprefix" . "amelia_services where status='visible' and id='$serviceid'");
$employee =  $wpdb->get_results("SELECT $tbprefix" . "amelia_users.* FROM " . $tbprefix . "amelia_services inner join " . $tbprefix . "amelia_providers_to_services inner join " . $tbprefix . "amelia_users on " . $tbprefix . "amelia_services.id=" . $tbprefix . "amelia_providers_to_services.serviceId and " . $tbprefix . "amelia_providers_to_services.userId=" . $tbprefix . "amelia_users.id where " . $tbprefix . "amelia_services.id='$serviceid'");

?>

<section id="primary" class="content-area">

    <!-- ===================main video area================= -->
    <main id="main" class="site-main" role="main">
        <div class="bg-video-wrap videobackimg" style="background: url(<?php echo $imgurl; ?>)">
            <div class="video-background">

                <div class="video-foreground">
                    <iframe class="youtube-video" id="kd-main-youtube-video" width="278" height="154" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>

            <!-- overlays -->
            <div class="overlay mobioverlay" id="kd-video-overlay1" style="background-image:url('<?php echo $service[0]->pictureFullPath ?>')"></div>
            <div class="overlay deskoverlay" id="kd-video-overlay" style="background-image:url('<?php echo $service[0]->pictureFullPath ?>')"></div>

            <!-- vsec area -->
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

                                <a href="<?php echo $server_name . '/about-us/#curators' ?>"><img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2023/01/starseke.png' ?>"></a>
                            <?php
                            } else if ($rating == "4") {
                            ?>

                                <a href="<?php echo $server_name . '/about-us/#curators' ?>"><img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2023/01/starsyanti.png' ?>"></a>
                            <?php
                            } else if ($rating == "5") {
                            ?>

                                <a href="<?php echo $server_name . '/about-us/#curators' ?>"><img class="star-rating" src="<?php echo $server_name . '/wp-content/uploads/2023/01/starsdanielle.png' ?>"></a>

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

        </div>
    </main>
    <!-- ===================main video area================= -->
</section>




<?php get_footer(); ?>
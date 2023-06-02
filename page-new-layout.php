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



    </div>
</div>

<?php

get_footer();
?>
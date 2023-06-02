<?php

/* Template Name: Page_home_new_template */

get_header();
$imgurl =  ot_get_option('top_section_background_image');

?>
<div class="new-homepage-wrapper">
    <!-- hero area -->
    <div class="hero-area-wrapper">
        <img src="<?php echo $imgurl; ?>" alt="" srcset="">
    </div>
</div>

<?php

get_footer();
?>
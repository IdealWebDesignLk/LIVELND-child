<?php

class Kd_Custom_Ajax
{

    public function __construct()
    {
        add_action('wp_ajax_get_category_content', array($this, 'create_category_content'));
        add_action('wp_ajax_nopriv_get_category_content', array($this, 'create_category_content'));
    }

    public function create_category_content()
    {
        $server_name = "";
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $server_name = "https://";
        else
            $server_name = "http://";

        // Append the host(server name) to the URL.   
        $server_name .= $_SERVER['SERVER_NAME'];
        global $wpdb;
        $tbprefix = $wpdb->prefix;
        $return_html = '';
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $results = $wpdb->get_results("SELECT * FROM $tbprefix" . "amelia_services where status='visible' and categoryId='" . $category_id . "' ORDER BY `position`;");

        if (!empty($results)) {
            $return_html .= '<div class="owl-carousel owl-theme">';
            foreach ($results as $row) {
                $servicesingleid = $row->id;
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

                    if ($row->pictureFullPath != "") {
                        $image_url = $row->pictureFullPath;
                    } else {
                        $image_url =  $server_name . '/wp-content/uploads/2023/01/default-268x172-1.png';
                    }

                    $return_html .= 
                    '<div class="item mainitem kd-service-slide" data-id="'. $servicesingleid .'" data-tags="'.$tagone . $tagtwo . $tagthree . $tagfour . $tagfive.'" data-expert="'.$employeedetails->firstName . " " . $employeedetails->lastName.'" data-category="'.$category_name.'" data-price="'.$row->price.'" data-name="'.$row->name.'" data-views="'.$row->videoViews.'">

                                                <div onmouseleave="kdAdddeactivatedThumb(event)" onmouseenter="kdOpenPopupFunc(event)" class="gallery-video-thumbnail kd-thumbnnail" data-id="'.$servicesingleid.'">
                                                    <a data-id="'.$servicesingleid.'" href="'.$url.'">
                                                        <img class="thumbnailimg" src="'.$image_url.'" alt="" style="height : 120px; object-fit: cover;">
                                                    </a>
                                                    <div class="thumb-info">
                                                        <h4 class="sessionttile-thumb"><b>'.$row->name.'</b></h4>

                                                        <div class="viewsandpricediv">
                                                            <?php if (!empty($row->videoViews) && intval($row->videoViews) > 1000) { ?>
                                                                <span class="views">'.number_format($row->videoViews, 0, ".", ",").'></span> <span class="viewstext">Youtube Views</span>
                                                            <?php } ?>
                                                            <span class="session-price">{replace this}</span>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>';
                }

            }
            $return_html.='</div>';
        }

        echo $return_html;
        wp_die();
    }
}

<?php /* Template Name: Page_home_Optimized_speed */ ?>
<?php
get_header();


// iniiate wpdb
global $wpdb;
$tbprefix = $wpdb->prefix;
$tbprefix  = trim($tbprefix);

// get categories
$categoriesSql = "SELECT * FROM $tbprefix" . "amelia_categories GROUP BY `id` ORDER BY `position`;";
$catResults = $wpdb->get_results($categoriesSql);

// get all service data
$all_sql = "SELECT u.* , s.* FROM " . $tbprefix . "amelia_services s inner join " . $tbprefix . "amelia_providers_to_services p inner join " . $tbprefix . "amelia_users u on s.id=p.serviceId and p.userId=u.id where s.status  = 'visible' ORDER BY s.position ASC";
print_r($all_sql);

$all_service_data =  $wpdb->get_results($all_sql);

print_r($employees);


?>





<?php get_footer(); ?>
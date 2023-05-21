<?php

class Kd_Custom_Ajax{

    public function __construct(){
        add_action('wp_ajax_get_category_content' , array($this , 'create_category_content'));
        add_action('wp_ajax_nopriv_get_category_content' , array($this , 'create_category_content'));
    }

    public function create_category_content(){
        echo 'hkapn';
    }
}
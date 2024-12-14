<?php

// echo get_template_directory_uri().'/assets/css/bootstrap.min.css';
// echo get_template_directory_uri().'/assets/css/bootstrap.min.css';
add_action('init',function(){

    if (!is_admin()){

        wp_enqueue_style('boot01', get_template_directory_uri().'/assets/css/bootstrap.min.css');
        wp_enqueue_script('bootjs', get_template_directory_uri().'/assets/js/bootstrap.min.js',[],'',true);
    }

    add_theme_support('widgets');
    add_theme_support('menus');
    add_theme_support('post_thumbnails');

    add_image_size('post-preview',280,180,true);


});

// wp_enqueue_script()
?>  
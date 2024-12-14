<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); 

        get_template_part('template-parts/nav');
        
        if(is_home()){
            get_template_part('template-parts/slider');
        }
    ?>

    <div class="p-4 card-group justify-content-center">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                if(is_single()){
                    get_template_part('template-parts/single-post');
                } else{
                    get_template_part('template-parts/post');
                }

            }
        }
        ?> 
    </div>

    <?php wp_footer(); ?>
</body>
</html>


## Introduction

- Just begin, multilanguage website by wordpress 4.9.1

## Deploy edit domain
    - Edit base path in htaccess
    - Edit wp_blogs, domain and path
    - Edit wp_site, domain/path
    - Edit wp_options, siteurl/home
    - Edit file wp-config.php site name and path

## Replace DB
    UPDATE wp_posts SET post_content = REPLACE(post_content,'wordpress49.local','hoteliers.vn');
    UPDATE wp_2_posts SET post_content = REPLACE(post_content,'wordpress49.local','hoteliers.vn');

    UPDATE wp_2_options SET option_value = REPLACE(option_value,'wordpress49.local','hoteliers.vn');
    UPDATE wp_options SET option_value = REPLACE(option_value,'wordpress49.local','hoteliers.vn');

    UPDATE wp_blogs SET domain = REPLACE(domain,'wordpress49.local','hoteliers.vn');
    UPDATE wp_site SET domain = REPLACE(domain,'wordpress49.local','hoteliers.vn');



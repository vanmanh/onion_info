## Introduction

- Just begin, multilanguage website by wordpress 4.9.1

## Deploy edit domain
    - Edit base path in htaccess
    - Edit wp_blogs, domain and path
    - Edit wp_site, domain/path
    - Edit wp_options, siteurl/home
    - Edit file wp-config.php site name and path

## Replace DB
    UPDATE wp_posts SET post_content = REPLACE(post_content,'onion.local','onion-coder.com');

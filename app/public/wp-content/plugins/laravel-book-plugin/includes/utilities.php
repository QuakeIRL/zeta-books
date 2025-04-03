<?php
/**
 * This will hold my functions for api calls to the laravel service.
 */

if (!defined('ABSPATH')) {
    die('No API for you.');
}

add_shortcode('api_book', 'laravel_book_api');
add_shortcode('api_author', 'laravel_author_api');
add_shortcode('api_author_works', 'laravel_author_works_api');

function laravel_book_api()
{
    $results = laravel_get_action(LARAVEL_API . '/book');
}

function laravel_author_api()
{
    $results = laravel_get_action(LARAVEL_API . '/author');
}

function laravel_author_works_api()
{
    $results = laravel_get_action(LARAVEL_API . '/author/works');
}

function laravel_get_action( $url)
{
    $arguments = array(
        'method' => 'GET',
    );

    $response = wp_remote_get($url, $arguments);

    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        echo "Failed to load addtional book details: $error_message";
    }

    return json_decode(wp_remote_retrieve_body($response));
}

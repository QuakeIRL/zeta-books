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
    $title = get_the_title();
    // $results = laravel_get_action(LARAVEL_API . '/book', $title);
    $results = [];
    if ($title == 'Dungeon Crawler Carl') {
        $results = [
            'title' => 'Dungeon Crawler Carl',
            'pages' => '464',
            'publisher' => 'Penguin Publishing Group',
            'published' => '2024-08-07',
            'format' => 'hardcover',
        ];
    } else {
        return '<p> No Additional Book data retrieved </p>';
    }

    $html = '';
    $html .= '<p>';
    $html .= '<b>Published by: </b>' . $results['publisher'] . '</br>';
    $html .= '<b>Publication Date: </b>' . $results['published'] . '</br>';
    $html .= '<b>Print format: </b>' . ucfirst($results['format']);
    $html .= '</p>';
    return $html;
}

function laravel_author_api()
{
    // $results = laravel_get_action(LARAVEL_API . '/author', $author);
    $results = [
        'fullname' => 'Matt Dinniman',
        'website' => 'https://mattdinniman.com',
        'note' => 'Matt Dinniman rocks'
    ];
    return $results;
}

function laravel_author_works_api()
{
    // $results = laravel_get_action(LARAVEL_API . '/author/works', $author);
    $results = [
        'collected-works' => [
            [
                'title' => 'Dungeon Crawler Carl',
                'pages' => '464',
                'publisher' => 'Penguin Publishing Group',
                'published' => '2024-08-07',
                'format' => 'hardcover',
            ],
            [
                'title' => 'Carl\'s Doomsday Scenario',
                'pages' => '384',
                'publisher' => 'Penguin Publishing Group',
                'published' => '2024-09-24',
                'format' => 'hardcover',
            ],
            [
                'title' => 'Dungeon Anarchist\'s Cookbook',
                'pages' => '544',
                'publisher' => 'Penguin Publishing Group',
                'published' => '2024-10-22',
                'format' => 'hardcover',
            ],
            [
                'title' => 'Dominion of Blades',
                'pages' => '438',
                'publisher' => 'CreateSpace Independent Publishing Platform',
                'published' => '2017-03-21',
                'format' => 'paperback',
            ],
        ]
    ];
    return $results;
}

function laravel_get_action($url, $stringParam)
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

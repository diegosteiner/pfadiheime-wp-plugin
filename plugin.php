<?php
/**
 * Plugin Name: My Content Block
 * Description: A simple content block that displays the HTML code <div>{text}</div>.
 * Version: 1.0.0
 * Author: Your Name
 */

// Define the function that outputs the content block HTML code
function my_content_block($attributes) {
    $text = isset($attributes['text']) ? $attributes['text'] : '';
    $content = "<div>{$text}</div>";
    return $content;
}

// Register the content block with editable attributes
function register_my_content_block() {
    register_block_type(
        'my-content-block/my-block',
        array(
            'render_callback' => 'my_content_block',
            'attributes' => array(
                'text' => array(
                    'type' => 'string',
                    'default' => 'Test',
                ),
            ),
            'editor_script' => 'my-block-script',
            // 'script' => 'my-block-script',
            'category' => 'common'
        ),
        
    );
}
add_action('init', 'register_my_content_block');

// Register and enqueue the editor and frontend scripts
function my_block_enqueue_scripts() {

    wp_register_script(
        'my-block-script',
        plugins_url('/js/block.js', __FILE__),
        array('wp-blocks', 'wp-element'),
        filemtime(plugin_dir_path(__FILE__) . '/js/block.js')
    );

    // wp_enqueue_script(
    //     'my-block-script',
    //     'https://example.com/external-script.js', // <-- Replace with the URL of your external script
    //     array('jquery'),
    //     '1.0.0'
    // );
}
add_action('enqueue_block_assets', 'my_block_enqueue_scripts');
add_action('enqueue_block_editor_assets', 'my_block_enqueue_scripts');

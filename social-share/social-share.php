<?php
/*
Plugin Name: Custom Social Sharing Icons
Description: Adds social sharing icons for Facebook, LinkedIn, and Twitter(X).
Version: 1.0
Author: Muhammad Usman
Author URI: https://usmanmumtaz.com
*/

function enqueue_font_awesome_by_king() {
    wp_enqueue_script('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js', array(), null, true);
     wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome_by_king');

// Check if the function doesn't exist before defining it
if (!function_exists('custom_social_icons_shortcode')) {
    // Shortcode to display social icons
    function custom_social_icons_shortcode() {
        $post_url = get_permalink();

        $icons = '
		<style>
		.custom-social-icons {
			text-align: right;
		}

		.custom-social-icons a {
			margin-left: 15px; /* Adjust the margin as needed for spacing between icons */
			font-size: 16px;
			color: #78797B;
			font-family: "Rubik", Sans-serif;
		}
		.custom-social-icons a:hover {
			color: #23dc32;
		}
		@media screen and (max-width: 410px) {
			.custom-social-icons a {
				font-size: 12px
			}
		}
		</style>
		<div class="custom-social-icons">
		<span style="color: #23dc32; font-weight: 700; font-family: "Rubik", Sans-serif; font-size: 18px;">Share</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u=' . esc_url($post_url) . '" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="https://www.linkedin.com/shareArticle?url=' . esc_url($post_url) . '" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="https://twitter.com/intent/tweet?url=' . esc_url($post_url) . '" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
			</div>
        ';

        return $icons;
    }

    // Register the shortcode
    add_shortcode('custom_social_icons', 'custom_social_icons_shortcode');
}

function search_filter_by_king($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts', 'search_filter_by_king');
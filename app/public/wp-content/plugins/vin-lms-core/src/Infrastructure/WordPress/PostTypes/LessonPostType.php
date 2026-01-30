<?php
/**
 * Lesson Custom Post Type Registration
 * Defines WordPress CPT for Lesson entity
 *
 * @package Vin\LMS\Core\Infrastructure\WordPress\PostTypes
 */

namespace Vin\LMS\Core\Infrastructure\WordPress\PostTypes;

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * LessonPostType class
 * Registers the Lesson custom post type with WordPress
 * No business logic - only WordPress CPT configuration
 */
final class LessonPostType
{
    /**
     * Post type slug constant
     */
    public const POST_TYPE = 'lms_lesson';

    /**
     * Register the Lesson custom post type
     * Static method to be called from Loader
     */
    public static function register(): void
    {
        register_post_type(self::POST_TYPE, self::getArgs());
    }

    /**
     * Get post type arguments
     * Defines all labels and configuration for the CPT
     *
     * @return array Post type arguments
     */
    private static function getArgs(): array
    {
        return [
            'labels' => self::getLabels(),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => ['slug' => 'lessons'],
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 6,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'author', 'page-attributes'],
            'show_in_rest' => true,
            'rest_base' => 'lessons',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
        ];
    }

    /**
     * Get post type labels
     * Defines all human-readable labels for WordPress admin
     *
     * @return array Post type labels
     */
    private static function getLabels(): array
    {
        return [
            'name' => _x('Lessons', 'post type general name', 'vin-lms'),
            'singular_name' => _x('Lesson', 'post type singular name', 'vin-lms'),
            'menu_name' => _x('Lessons', 'admin menu', 'vin-lms'),
            'name_admin_bar' => _x('Lesson', 'add new on admin bar', 'vin-lms'),
            'add_new' => _x('Add New', 'lesson', 'vin-lms'),
            'add_new_item' => __('Add New Lesson', 'vin-lms'),
            'new_item' => __('New Lesson', 'vin-lms'),
            'edit_item' => __('Edit Lesson', 'vin-lms'),
            'view_item' => __('View Lesson', 'vin-lms'),
            'all_items' => __('All Lessons', 'vin-lms'),
            'search_items' => __('Search Lessons', 'vin-lms'),
            'parent_item_colon' => __('Parent Lessons:', 'vin-lms'),
            'not_found' => __('No lessons found.', 'vin-lms'),
            'not_found_in_trash' => __('No lessons found in Trash.', 'vin-lms'),
            'featured_image' => __('Lesson Image', 'vin-lms'),
            'set_featured_image' => __('Set lesson image', 'vin-lms'),
            'remove_featured_image' => __('Remove lesson image', 'vin-lms'),
            'use_featured_image' => __('Use as lesson image', 'vin-lms'),
            'archives' => __('Lesson archives', 'vin-lms'),
            'insert_into_item' => __('Insert into lesson', 'vin-lms'),
            'uploaded_to_this_item' => __('Uploaded to this lesson', 'vin-lms'),
            'filter_items_list' => __('Filter lessons list', 'vin-lms'),
            'items_list_navigation' => __('Lessons list navigation', 'vin-lms'),
            'items_list' => __('Lessons list', 'vin-lms'),
        ];
    }
}

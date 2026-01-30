<?php
/**
 * Course Custom Post Type Registration
 * Defines WordPress CPT for Course entity
 *
 * @package Vin\LMS\Core\Infrastructure\WordPress\PostTypes
 */

namespace Vin\LMS\Core\Infrastructure\WordPress\PostTypes;

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * CoursePostType class
 * Registers the Course custom post type with WordPress
 * No business logic - only WordPress CPT configuration
 */
final class CoursePostType
{
    /**
     * Post type slug constant
     */
    public const POST_TYPE = 'lms_course';

    /**
     * Register the Course custom post type
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
            'rewrite' => ['slug' => 'courses'],
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-book-alt',
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'author'],
            'show_in_rest' => true,
            'rest_base' => 'courses',
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
            'name' => _x('Courses', 'post type general name', 'vin-lms'),
            'singular_name' => _x('Course', 'post type singular name', 'vin-lms'),
            'menu_name' => _x('Courses', 'admin menu', 'vin-lms'),
            'name_admin_bar' => _x('Course', 'add new on admin bar', 'vin-lms'),
            'add_new' => _x('Add New', 'course', 'vin-lms'),
            'add_new_item' => __('Add New Course', 'vin-lms'),
            'new_item' => __('New Course', 'vin-lms'),
            'edit_item' => __('Edit Course', 'vin-lms'),
            'view_item' => __('View Course', 'vin-lms'),
            'all_items' => __('All Courses', 'vin-lms'),
            'search_items' => __('Search Courses', 'vin-lms'),
            'parent_item_colon' => __('Parent Courses:', 'vin-lms'),
            'not_found' => __('No courses found.', 'vin-lms'),
            'not_found_in_trash' => __('No courses found in Trash.', 'vin-lms'),
            'featured_image' => __('Course Image', 'vin-lms'),
            'set_featured_image' => __('Set course image', 'vin-lms'),
            'remove_featured_image' => __('Remove course image', 'vin-lms'),
            'use_featured_image' => __('Use as course image', 'vin-lms'),
            'archives' => __('Course archives', 'vin-lms'),
            'insert_into_item' => __('Insert into course', 'vin-lms'),
            'uploaded_to_this_item' => __('Uploaded to this course', 'vin-lms'),
            'filter_items_list' => __('Filter courses list', 'vin-lms'),
            'items_list_navigation' => __('Courses list navigation', 'vin-lms'),
            'items_list' => __('Courses list', 'vin-lms'),
        ];
    }
}

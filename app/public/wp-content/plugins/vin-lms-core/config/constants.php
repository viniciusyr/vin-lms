<?php
/**
 * Constants Configuration
 * Defines plugin-wide constants
 *
 * @package Vin\LMS\Core
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

// Role slugs
if (!defined('VIN_LMS_ROLE_INSTRUCTOR')) {
    define('VIN_LMS_ROLE_INSTRUCTOR', 'lms_instructor');
}

if (!defined('VIN_LMS_ROLE_STUDENT')) {
    define('VIN_LMS_ROLE_STUDENT', 'lms_student');
}

// Post type slugs (reference only - actual registration in PostTypes classes)
if (!defined('VIN_LMS_POST_TYPE_COURSE')) {
    define('VIN_LMS_POST_TYPE_COURSE', 'lms_course');
}

if (!defined('VIN_LMS_POST_TYPE_LESSON')) {
    define('VIN_LMS_POST_TYPE_LESSON', 'lms_lesson');
}

// Taxonomy slugs (for future use)
if (!defined('VIN_LMS_TAXONOMY_COURSE_CATEGORY')) {
    define('VIN_LMS_TAXONOMY_COURSE_CATEGORY', 'lms_course_category');
}

if (!defined('VIN_LMS_TAXONOMY_COURSE_TAG')) {
    define('VIN_LMS_TAXONOMY_COURSE_TAG', 'lms_course_tag');
}

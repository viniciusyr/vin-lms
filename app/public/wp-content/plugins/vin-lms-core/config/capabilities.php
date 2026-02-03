<?php
/**
 * Capabilities Configuration
 * Defines all LMS-specific capabilities for each role
 *
 * @package Vin\LMS\Core
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get LMS capabilities definition
 * Returns an array of capabilities organized by role
 * This configuration is used during plugin activation
 *
 * @return array Capabilities organized by role
 */
function vin_lms_get_capabilities(): array
{
    return [
        // Administrator inherits all capabilities (WordPress default)
        'administrator' => [
            // Course capabilities
            'create_courses',
            'edit_courses',
            'edit_others_courses',
            'publish_courses',
            'read_private_courses',
            'delete_courses',
            'delete_private_courses',
            'delete_published_courses',
            'delete_others_courses',
            'edit_private_courses',
            'edit_published_courses',

            // Lesson capabilities
            'create_lessons',
            'edit_lessons',
            'edit_others_lessons',
            'publish_lessons',
            'read_private_lessons',
            'delete_lessons',
            'delete_private_lessons',
            'delete_published_lessons',
            'delete_others_lessons',
            'edit_private_lessons',
            'edit_published_lessons',

            // Student management
            'manage_lms_students',
            'view_lms_students',
            'manage_lms_enrollments',

            // Progress and reporting
            'view_all_lms_progress',
            'manage_lms_progress',
            'view_lms_reports',

            // Settings
            'manage_lms_settings',
        ],

        // Instructor role - can manage courses and lessons, view student progress
        'lms_instructor' => [
            // Course capabilities
            'create_courses',
            'edit_courses',
            'edit_others_courses',
            'publish_courses',
            'read_private_courses',
            'delete_courses',
            'delete_published_courses',
            'edit_published_courses',

            // Lesson capabilities
            'create_lessons',
            'edit_lessons',
            'edit_others_lessons',
            'publish_lessons',
            'read_private_lessons',
            'delete_lessons',
            'delete_published_lessons',
            'edit_published_lessons',

            // Student management (view only)
            'view_lms_students',
            'manage_lms_enrollments',

            // Progress and reporting (view their courses)
            'view_all_lms_progress',
            'view_lms_reports',

            // WordPress default capabilities
            'read',
            'upload_files',
        ],

        // Student role - can view and complete courses/lessons
        'lms_student' => [
            // Course capabilities (read only)
            'read',

            // Progress tracking
            'view_own_lms_progress',
            'complete_lms_lessons',

            // Enrollment
            'enroll_in_lms_courses',
        ],
    ];
}

/**
 * Register LMS capabilities
 * Adds capabilities to each role
 * Idempotent: safe to run multiple times
 */
function vin_lms_register_capabilities(): void
{
    $capabilities = vin_lms_get_capabilities();

    foreach ($capabilities as $role_slug => $caps) {
        $role = get_role($role_slug);

        // Skip if role doesn't exist
        if (!$role) {
            continue;
        }

        // Add each capability to the role
        foreach ($caps as $cap) {
            // Only add if not already present (idempotent)
            if (!$role->has_cap($cap)) {
                $role->add_cap($cap);
            }
        }
    }
}

// Execute capability registration on plugin activation
vin_lms_register_capabilities();

<?php
/**
 * Roles Configuration
 * Defines and registers custom LMS roles
 *
 * @package Vin\LMS\Core
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get LMS roles definition
 * Returns an array of custom roles to be registered
 *
 * @return array Roles with their display names and base capabilities
 */
function vin_lms_get_roles(): array
{
    return [
        'lms_instructor' => [
            'display_name' => __('LMS Instructor', 'vin-lms'),
            'capabilities' => [
                // Base WordPress capabilities
                'read' => true,
                'upload_files' => true,
            ],
        ],
        'lms_student' => [
            'display_name' => __('LMS Student', 'vin-lms'),
            'capabilities' => [
                // Base WordPress capabilities
                'read' => true,
            ],
        ],
    ];
}

/**
 * Register LMS custom roles
 * Creates roles if they don't exist
 * Idempotent: safe to run multiple times
 */
function vin_lms_register_roles(): void
{
    $roles = vin_lms_get_roles();

    foreach ($roles as $role_slug => $role_data) {
        // Check if role already exists (idempotent)
        if (get_role($role_slug)) {
            continue;
        }

        // Add the role with base capabilities
        add_role(
            $role_slug,
            $role_data['display_name'],
            $role_data['capabilities']
        );
    }
}

/**
 * Remove LMS custom roles
 * Used during plugin uninstallation (not deactivation)
 * Idempotent: safe to run multiple times
 */
function vin_lms_remove_roles(): void
{
    $roles = vin_lms_get_roles();

    foreach ($roles as $role_slug => $role_data) {
        // Only remove if role exists (idempotent)
        if (get_role($role_slug)) {
            remove_role($role_slug);
        }
    }
}

// Execute role registration on plugin activation
vin_lms_register_roles();

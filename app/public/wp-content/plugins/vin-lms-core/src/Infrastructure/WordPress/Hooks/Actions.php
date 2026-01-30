<?php
/**
 * WordPress Actions Hook Manager
 * Centralizes all add_action calls for the plugin
 *
 * @package Vin\LMS\Core\Infrastructure\WordPress\Hooks
 */

namespace Vin\LMS\Core\Infrastructure\WordPress\Hooks;

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Actions class
 * Registers all WordPress action hooks for the plugin
 * No business logic - only connects WordPress actions to handler methods
 */
final class Actions
{
    /**
     * Constructor - registers all actions on instantiation
     */
    public function __construct()
    {
        $this->register();
    }

    /**
     * Register all WordPress actions
     * Centralizes all add_action calls
     */
    private function register(): void
    {
        // Admin actions
        add_action('admin_enqueue_scripts', [$this, 'enqueueAdminAssets']);
        add_action('admin_menu', [$this, 'registerAdminMenus']);
        add_action('admin_init', [$this, 'registerAdminSettings']);

        // Frontend actions
        add_action('wp_enqueue_scripts', [$this, 'enqueueFrontendAssets']);

        // Content actions
        add_action('template_redirect', [$this, 'handleContentAccess']);

        // AJAX actions (for logged-in users)
        add_action('wp_ajax_lms_complete_lesson', [$this, 'handleCompleteLesson']);
        add_action('wp_ajax_lms_enroll_course', [$this, 'handleEnrollCourse']);

        // Custom actions for plugin extensibility
        add_action('lms_after_lesson_complete', [$this, 'handleAfterLessonComplete'], 10, 2);
        add_action('lms_after_course_enroll', [$this, 'handleAfterCourseEnroll'], 10, 2);
    }

    /**
     * Enqueue admin assets (CSS/JS)
     * Hook: admin_enqueue_scripts
     *
     * @param string $hook Current admin page hook
     */
    public function enqueueAdminAssets(string $hook): void
    {
        // Admin assets will be enqueued here
        // Example: wp_enqueue_style('vin-lms-admin', VIN_LMS_PLUGIN_URL . 'assets/css/admin.css');
    }

    /**
     * Register admin menus
     * Hook: admin_menu
     */
    public function registerAdminMenus(): void
    {
        // Admin menu items will be registered here
        // Delegated to Admin classes
    }

    /**
     * Register admin settings
     * Hook: admin_init
     */
    public function registerAdminSettings(): void
    {
        // Settings will be registered here
        // Example: register_setting('lms_options', 'lms_enable_certificates');
    }

    /**
     * Enqueue frontend assets (CSS/JS)
     * Hook: wp_enqueue_scripts
     */
    public function enqueueFrontendAssets(): void
    {
        // Frontend assets will be enqueued here
        // Example: wp_enqueue_style('vin-lms-frontend', VIN_LMS_PLUGIN_URL . 'assets/css/frontend.css');
    }

    /**
     * Handle content access control
     * Hook: template_redirect
     */
    public function handleContentAccess(): void
    {
        // Access control logic will be delegated here
        // Example: Check if user can access lesson content
    }

    /**
     * Handle AJAX request to complete a lesson
     * Hook: wp_ajax_lms_complete_lesson
     */
    public function handleCompleteLesson(): void
    {
        // AJAX handler will delegate to Application layer
        // Example: Use case to mark lesson as complete
    }

    /**
     * Handle AJAX request to enroll in a course
     * Hook: wp_ajax_lms_enroll_course
     */
    public function handleEnrollCourse(): void
    {
        // AJAX handler will delegate to Application layer
        // Example: Use case to enroll user in course
    }

    /**
     * Handle actions after lesson completion
     * Hook: lms_after_lesson_complete
     *
     * @param int $userId User ID
     * @param int $lessonId Lesson ID
     */
    public function handleAfterLessonComplete(int $userId, int $lessonId): void
    {
        // Post-completion actions
        // Example: Send notification, update progress, trigger certificates
    }

    /**
     * Handle actions after course enrollment
     * Hook: lms_after_course_enroll
     *
     * @param int $userId User ID
     * @param int $courseId Course ID
     */
    public function handleAfterCourseEnroll(int $userId, int $courseId): void
    {
        // Post-enrollment actions
        // Example: Send welcome email, grant access to lessons
    }
}

<?php
/**
 * WordPress Filters Hook Manager
 * Centralizes all add_filter calls for the plugin
 *
 * @package Vin\LMS\Core\Infrastructure\WordPress\Hooks
 */

namespace Vin\LMS\Core\Infrastructure\WordPress\Hooks;

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Filters class
 * Registers all WordPress filter hooks for the plugin
 * No business logic - only connects WordPress filters to handler methods
 */
final class Filters
{
    /**
     * Constructor - registers all filters on instantiation
     */
    public function __construct()
    {
        $this->register();
    }

    /**
     * Register all WordPress filters
     * Centralizes all add_filter calls
     */
    private function register(): void
    {
        // Content filters
        add_filter('the_content', [$this, 'filterLessonContent'], 10);
        add_filter('the_title', [$this, 'filterCourseTitle'], 10, 2);

        // Query filters
        add_filter('pre_get_posts', [$this, 'filterCourseQuery']);

        // Template filters
        add_filter('template_include', [$this, 'filterLessonTemplate']);
        add_filter('single_template', [$this, 'filterCourseTemplate']);

        // User capability filters
        add_filter('user_has_cap', [$this, 'filterUserCapabilities'], 10, 4);

        // Custom filters for plugin extensibility
        add_filter('lms_lesson_access', [$this, 'filterLessonAccess'], 10, 3);
        add_filter('lms_course_progress', [$this, 'filterCourseProgress'], 10, 2);
        add_filter('lms_enrollment_status', [$this, 'filterEnrollmentStatus'], 10, 2);
    }

    /**
     * Filter lesson content
     * Hook: the_content
     *
     * @param string $content Post content
     * @return string Modified content
     */
    public function filterLessonContent(string $content): string
    {
        // Content filtering will be implemented here
        // Example: Add lesson navigation, progress tracker, access restrictions
        return $content;
    }

    /**
     * Filter course title
     * Hook: the_title
     *
     * @param string $title Post title
     * @param int $postId Post ID
     * @return string Modified title
     */
    public function filterCourseTitle(string $title, int $postId): string
    {
        // Title filtering will be implemented here
        // Example: Add course completion badge to title
        return $title;
    }

    /**
     * Filter course query
     * Hook: pre_get_posts
     *
     * @param \WP_Query $query WordPress query object
     * @return \WP_Query Modified query
     */
    public function filterCourseQuery(\WP_Query $query): \WP_Query
    {
        // Query modification will be implemented here
        // Example: Show only enrolled courses for students
        return $query;
    }

    /**
     * Filter lesson template
     * Hook: template_include
     *
     * @param string $template Template path
     * @return string Modified template path
     */
    public function filterLessonTemplate(string $template): string
    {
        // Template override will be implemented here
        // Example: Load custom lesson template
        return $template;
    }

    /**
     * Filter course single template
     * Hook: single_template
     *
     * @param string $template Template path
     * @return string Modified template path
     */
    public function filterCourseTemplate(string $template): string
    {
        // Template override will be implemented here
        // Example: Load custom course template
        return $template;
    }

    /**
     * Filter user capabilities
     * Hook: user_has_cap
     *
     * @param array $allcaps All capabilities
     * @param array $caps Required capabilities
     * @param array $args Additional arguments
     * @param \WP_User $user User object
     * @return array Modified capabilities
     */
    public function filterUserCapabilities(array $allcaps, array $caps, array $args, \WP_User $user): array
    {
        // Capability filtering will be implemented here
        // Example: Grant/revoke LMS-specific capabilities
        return $allcaps;
    }

    /**
     * Filter lesson access permission
     * Hook: lms_lesson_access
     *
     * @param bool $hasAccess Whether user has access
     * @param int $userId User ID
     * @param int $lessonId Lesson ID
     * @return bool Modified access permission
     */
    public function filterLessonAccess(bool $hasAccess, int $userId, int $lessonId): bool
    {
        // Access filtering will be implemented here
        // Example: Check enrollment, prerequisites, payment status
        return $hasAccess;
    }

    /**
     * Filter course progress calculation
     * Hook: lms_course_progress
     *
     * @param float $progress Current progress percentage
     * @param int $courseId Course ID
     * @return float Modified progress percentage
     */
    public function filterCourseProgress(float $progress, int $courseId): float
    {
        // Progress calculation filtering will be implemented here
        // Example: Include quiz scores, assignment completion
        return $progress;
    }

    /**
     * Filter enrollment status
     * Hook: lms_enrollment_status
     *
     * @param string $status Current enrollment status
     * @param int $enrollmentId Enrollment ID
     * @return string Modified enrollment status
     */
    public function filterEnrollmentStatus(string $status, int $enrollmentId): string
    {
        // Status filtering will be implemented here
        // Example: Check payment status, expiration dates
        return $status;
    }
}

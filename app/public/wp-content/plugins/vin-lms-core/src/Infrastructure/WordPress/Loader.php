<?php
/**
 * WordPress Infrastructure Loader
 * Initializes all WordPress-specific components
 *
 * @package Vin\LMS\Core\Infrastructure\WordPress
 */

namespace Vin\LMS\Core\Infrastructure\WordPress;

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Infrastructure loader class
 * Responsible for initializing all WordPress-specific infrastructure components
 * This class knows nothing about Domain or Application layers
 * It only deals with WordPress integration: CPTs, hooks, admin pages, auth
 */
final class Loader
{
    /**
     * Singleton instance
     *
     * @var Loader|null
     */
    private static ?Loader $instance = null;

    /**
     * Private constructor to enforce singleton pattern
     */
    private function __construct()
    {
    }

    /**
     * Get singleton instance
     *
     * @return Loader
     */
    public static function getInstance(): Loader
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Initialize all infrastructure components
     * This is the main entry point for WordPress infrastructure setup
     */
    public function init(): void
    {
        $this->registerPostTypes();
        $this->registerHooks();
        $this->registerAdminPages();
        $this->registerAuth();
    }

    /**
     * Register custom post types
     * Delegates to PostTypes classes to register Course and Lesson CPTs
     */
    private function registerPostTypes(): void
    {
        // Post Types will be registered here
        // Example: CoursePostType::register();
        // Example: LessonPostType::register();
    }

    /**
     * Register WordPress hooks (actions and filters)
     * Delegates to Hooks classes to wire up WordPress actions and filters
     */
    private function registerHooks(): void
    {
        // Initialize Actions and Filters classes
        // These classes register all WordPress hooks on instantiation
        new Hooks\Actions();
        new Hooks\Filters();
    }

    /**
     * Register admin pages and functionality
     * Delegates to Admin classes for WordPress admin interface
     */
    private function registerAdminPages(): void
    {
        // Admin pages will be registered here
        // Example: new CourseAdmin();
        // Example: new LessonAdmin();
    }

    /**
     * Register authentication and authorization
     * Delegates to Auth classes for access control
     */
    private function registerAuth(): void
    {
        // Access control will be registered here
        // Example: new AccessControl();
    }

    /**
     * Prevent cloning of singleton instance
     */
    private function __clone()
    {
    }

    /**
     * Prevent unserialization of singleton instance
     */
    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize singleton');
    }
}

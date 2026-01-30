<?php
/**
 * Bootstrap application for Vin LMS
 * Contains the infrastructure initialization and WordPress wiring
 *
 * @package Vin\LMS\Core
 */

namespace Vin\LMS\Core\Bootstrap;

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main plugin initialization class
 * Serves as the single entry point for the entire plugin
 * Coordinates the loading and initialization of all infrastructure components
 */
final class App
{
    /**
     * Singleton instance
     * Ensures only one instance of the plugin runs at a time
     *
     * @var App|null
     */
    private static ?App $instance = null;

    /**
     * Private constructor to enforce singleton pattern
     * Prevents direct instantiation from outside the class
     */
    private function __construct()
    {
        $this->init();
    }

    /**
     * Get singleton instance
     * Provides global access point to the plugin instance
     *
     * @return App
     */
    public static function getInstance(): App
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Initialize plugin infrastructure
     * Loads configuration and registers WordPress hooks
     * No business logic here - only infrastructure wiring
     */
    private function init(): void
    {
        // Load configuration files
        $this->loadConfig();

        // Register activation/deactivation hooks
        register_activation_hook(VIN_LMS_PLUGIN_FILE, [$this, 'activate']);
        register_deactivation_hook(VIN_LMS_PLUGIN_FILE, [$this, 'deactivate']);

        // Hook into WordPress initialization
        add_action('plugins_loaded', [$this, 'loadInfrastructure']);
        add_action('init', [$this, 'registerPostTypes']);
        add_action('init', [$this, 'loadTextDomain']);
    }

    /**
     * Load configuration files
     * Centralizes plugin configuration (roles, capabilities, constants)
     */
    private function loadConfig(): void
    {
        $configDir = VIN_LMS_PLUGIN_DIR . 'config/';

        if (file_exists($configDir . 'constants.php')) {
            require_once $configDir . 'constants.php';
        }
    }

    /**
     * Plugin activation hook
     * Runs once when plugin is activated
     * Sets up database tables, roles, and capabilities
     */
    public function activate(): void
    {
        // Load roles and capabilities configuration
        $configDir = VIN_LMS_PLUGIN_DIR . 'config/';

        if (file_exists($configDir . 'roles.php')) {
            require_once $configDir . 'roles.php';
        }

        if (file_exists($configDir . 'capabilities.php')) {
            require_once $configDir . 'capabilities.php';
        }

        // Flush rewrite rules to register custom post types permalinks
        flush_rewrite_rules();
    }

    /**
     * Plugin deactivation hook
     * Cleanup actions when plugin is deactivated
     */
    public function deactivate(): void
    {
        // Flush rewrite rules to clean up custom post types permalinks
        flush_rewrite_rules();
    }

    /**
     * Load infrastructure layer
     * Initializes WordPress-specific implementations (repositories, hooks, admin)
     * This is where the infrastructure components get wired up
     */
    public function loadInfrastructure(): void
    {
        // Infrastructure components will be initialized here
        // Examples: Repositories, Admin pages, Hooks, Access Control
        // This keeps infrastructure separate from domain and application layers
    }

    /**
     * Register custom post types
     * Registers Course and Lesson CPTs via Infrastructure layer
     */
    public function registerPostTypes(): void
    {
        // Post type registration will be delegated to Infrastructure/WordPress/PostTypes
        // This maintains separation of concerns
    }

    /**
     * Load plugin text domain for internationalization
     * Enables translations for the plugin
     */
    public function loadTextDomain(): void
    {
        load_plugin_textdomain(
            'vin-lms',
            false,
            dirname(VIN_LMS_PLUGIN_BASENAME) . '/languages'
        );
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

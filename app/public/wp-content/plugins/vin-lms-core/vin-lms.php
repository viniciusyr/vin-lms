<?php
/**
 * Plugin Name: Vin LMS
 * Plugin URI: https://example.com/vin-lms
 * Description: Minimal Learning Management System for WordPress with domain-driven architecture
 * Version: 1.0.0
 * Author: Vinicius Rodrigues
 * Author URI: https://viniciusysrodrigues.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: vin-lms
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 *
 * @package Vin\LMS\Core
 */

namespace Vin\LMS\Core;

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define plugin constants
 * These provide easy access to plugin paths and metadata throughout the codebase
 */
define('VIN_LMS_VERSION', '1.0.0');
define('VIN_LMS_PLUGIN_FILE', __FILE__);
define('VIN_LMS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('VIN_LMS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('VIN_LMS_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * Composer autoloader
 * PSR-4 autoloading ensures classes are loaded on-demand following namespace structure
 */
$autoloader = VIN_LMS_PLUGIN_DIR . 'vendor/autoload.php';

if (!file_exists($autoloader)) {
    // Display admin notice if Composer dependencies are not installed
    add_action('admin_notices', function () {
        echo '<div class="error"><p>';
        echo '<strong>Vin LMS:</strong> Composer autoloader not found. ';
        echo 'Please run <code>composer install</code> in the plugin directory.';
        echo '</p></div>';
    });
    return;
}

require_once $autoloader;

/**
 * Main plugin initialization class
 * Serves as the single entry point for the entire plugin
 * Coordinates the loading and initialization of all infrastructure components
 */
final class Plugin
{
    /**
     * Singleton instance
     * Ensures only one instance of the plugin runs at a time
     *
     * @var Plugin|null
     */
    private static ?Plugin $instance = null;

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
     * @return Plugin
     */
    public static function getInstance(): Plugin
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
        throw new \Exception("Cannot unserialize singleton");
    }
}

/**
 * Bootstrap the plugin
 * This is the single entry point that starts everything
 */
Plugin::getInstance();

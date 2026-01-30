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

// Load the bootstrap app (keeps entrypoint thin and infrastructure isolated)
require_once VIN_LMS_PLUGIN_DIR . 'bootstrap/app.php';

/**
 * Bootstrap the plugin
 * Single entry point that starts the infrastructure wiring
 */
\Vin\LMS\Core\Bootstrap\App::getInstance();

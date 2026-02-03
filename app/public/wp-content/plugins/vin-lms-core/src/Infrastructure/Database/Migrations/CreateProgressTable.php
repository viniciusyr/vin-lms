<?php
/**
 * CreateProgressTable
 * WordPress migration to create the LMS progress table.
 * - Uses $wpdb and dbDelta
 * - Idempotent (safe to run multiple times)
 * - No business logic
 * - No Domain/Application dependencies
 * - Uses Schema only to resolve table names
 *
 * @package Vin\LMS\Core\Infrastructure\Database\Migrations
 */

namespace Vin\LMS\Core\Infrastructure\Database\Migrations;

use Vin\LMS\Core\Infrastructure\Database\Schema;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

final class CreateProgressTable
{
    /**
     * Run the migration (create/update table via dbDelta).
     */
    public static function run(): void
    {
        global $wpdb;

        // Ensure dbDelta is available
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $table           = Schema::progress();
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$table} (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            user_id bigint(20) unsigned NOT NULL,
            lesson_id bigint(20) unsigned NOT NULL,
            course_id bigint(20) unsigned NULL,
            completed_at datetime NULL DEFAULT NULL,
            status varchar(50) NOT NULL DEFAULT 'completed',
            PRIMARY KEY  (id),
            UNIQUE KEY uniq_user_lesson (user_id, lesson_id),
            KEY idx_user (user_id),
            KEY idx_lesson (lesson_id),
            KEY idx_course (course_id)
        ) {$charset_collate};";

        // Idempotent creation/update
        dbDelta($sql);
    }
}

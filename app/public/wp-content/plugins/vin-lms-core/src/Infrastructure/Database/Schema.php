<?php
/**
 * LMS Schema
 * Centralizes custom table names and resolves the WordPress prefix.
 *
 * Rules:
 * - Does NOT execute SQL
 * - Does NOT create/alter tables
 * - Contains NO business logic
 * - Only serves as a single source of truth for table names
 *
 * @package Vin\LMS\Core\Infrastructure\Database
 */

namespace Vin\LMS\Core\Infrastructure\Database;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

final class Schema
{
    /**
     * Logical (without WP prefix) LMS table names.
     * Kept simple as per project specification.
     */
    public const ENROLLMENTS = 'enrollments'; // user ↔ course
    public const PROGRESS    = 'progress';    // user ↔ lesson

    /**
     * Return the full table name with the WordPress prefix.
     * Multisite-compatible when a Blog ID is provided.
     *
     * @param string   $logicalName Logical name (one of this class constants)
     * @param int|null $blogId      Site ID (multisite). Null uses the current site.
     * @return string  Full table name (e.g., wp_enrollments)
     */
    public static function table(string $logicalName, ?int $blogId = null): string
    {
        global $wpdb;
        $prefix = $blogId ? $wpdb->get_blog_prefix($blogId) : $wpdb->prefix;
        return $prefix . $logicalName;
    }

    /**
     * Convenience helpers for direct use of current stage tables.
     */
    public static function enrollments(?int $blogId = null): string
    {
        return self::table(self::ENROLLMENTS, $blogId);
    }

    public static function progress(?int $blogId = null): string
    {
        return self::table(self::PROGRESS, $blogId);
    }
}

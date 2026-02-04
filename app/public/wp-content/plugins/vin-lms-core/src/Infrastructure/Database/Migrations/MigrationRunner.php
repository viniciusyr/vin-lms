<?php
/**
 * MigrationRunner
 * Centralizes execution of all LMS migrations.
 * - Isolated from plugin logic and business rules
 * - Uses dbDelta via individual migration classes
 * - Safe to run on activation only
 *
 * @package Vin\LMS\Core\Infrastructure\Database\Migrations
 */

namespace Vin\LMS\Core\Infrastructure\Database\Migrations;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

final class MigrationRunner
{
    /**
     * Execute all migrations in order.
     * Idempotent: each migration uses dbDelta and can be re-run safely.
     */
    public static function runAll(): void
    {
        // Enrollments and Progress tables for current phase
        CreateEnrollmentsTable::run();
        CreateProgressTable::run();
    }
}

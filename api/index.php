<?php

// Enable error reporting during bootstrapping
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Vercel Serverless Function entrypoint for Laravel

// Initialize writable storage and cache directories in /tmp
$storageDirs = [
    '/tmp/storage',
    '/tmp/storage/app',
    '/tmp/storage/app/public',
    '/tmp/storage/bootstrap',
    '/tmp/storage/bootstrap/cache',
    '/tmp/storage/framework',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/testing',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Copy pre-compiled manifests from read-only app root to writable /tmp cache if present
$manifests = ['packages.php', 'services.php'];
foreach ($manifests as $manifest) {
    $src = __DIR__ . '/../bootstrap/cache/' . $manifest;
    $dst = '/tmp/storage/bootstrap/cache/' . $manifest;
    if (file_exists($src) && !file_exists($dst)) {
        @copy($src, $dst);
    }
}

// Set environment variables for ephemeral serverless filesystem
$_ENV['APP_STORAGE'] = '/tmp/storage';
$_SERVER['APP_STORAGE'] = '/tmp/storage';
putenv('APP_STORAGE=/tmp/storage');

$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
$_SERVER['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');

$_ENV['APP_SERVICES_CACHE'] = '/tmp/storage/bootstrap/cache/services.php';
$_SERVER['APP_SERVICES_CACHE'] = '/tmp/storage/bootstrap/cache/services.php';
putenv('APP_SERVICES_CACHE=/tmp/storage/bootstrap/cache/services.php');

$_ENV['APP_PACKAGES_CACHE'] = '/tmp/storage/bootstrap/cache/packages.php';
$_SERVER['APP_PACKAGES_CACHE'] = '/tmp/storage/bootstrap/cache/packages.php';
putenv('APP_PACKAGES_CACHE=/tmp/storage/bootstrap/cache/packages.php');

$_ENV['APP_CONFIG_CACHE'] = '/tmp/storage/bootstrap/cache/config.php';
$_SERVER['APP_CONFIG_CACHE'] = '/tmp/storage/bootstrap/cache/config.php';
putenv('APP_CONFIG_CACHE=/tmp/storage/bootstrap/cache/config.php');

$_ENV['APP_ROUTES_CACHE'] = '/tmp/storage/bootstrap/cache/routes-v7.php';
$_SERVER['APP_ROUTES_CACHE'] = '/tmp/storage/bootstrap/cache/routes-v7.php';
putenv('APP_ROUTES_CACHE=/tmp/storage/bootstrap/cache/routes-v7.php');

$_ENV['APP_EVENTS_CACHE'] = '/tmp/storage/bootstrap/cache/events.php';
$_SERVER['APP_EVENTS_CACHE'] = '/tmp/storage/bootstrap/cache/events.php';
putenv('APP_EVENTS_CACHE=/tmp/storage/bootstrap/cache/events.php');

try {
    // Delegate execution to the standard Laravel front controller
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Laravel Initialization Error</h1>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . " (line " . $e->getLine() . ")</p>";
    echo "<pre style='background:#f4f4f4;padding:12px;border:1px solid #ccc;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

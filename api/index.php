<?php

// ============================================================
// Vercel Serverless Entry Point for Laravel
// ============================================================
// Vercel filesystem is READ-ONLY except /tmp.
// We must redirect all writable Laravel paths to /tmp.
// ============================================================

// 1. Create required temporary directories
$storagePath = '/tmp/storage';
$dirs = [
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/views',
    $storagePath . '/framework/testing',
    $storagePath . '/logs',
    $storagePath . '/app/public',
    '/tmp/bootstrap/cache',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 2. Set environment variables to point Laravel to /tmp paths
$_ENV['APP_STORAGE_PATH'] = $storagePath;
$_SERVER['APP_STORAGE_PATH'] = $storagePath;
putenv("APP_STORAGE_PATH={$storagePath}");

// 3. Bootstrap and run Laravel
require __DIR__ . '/../public/index.php';

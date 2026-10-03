<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/database.php';
header('Content-Type: application/json; charset=utf-8');

try {
    db()->query('SELECT 1');
    echo json_encode(['status' => 'ok', 'database' => 'connected']);
} catch (Throwable $error) {
    error_log('Database health check failed: ' . get_class($error));
    http_response_code(503);
    echo json_encode(['status' => 'error', 'database' => 'unavailable']);
}

<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->safeLoad();

/*
// Now you can access the environment variables
$dbHost = getenv('DB_HOST');
$dbUser = getenv('DB_USER');
$dbPass = getenv('DB_PASS');

echo "Database Host: $dbHost\n";
echo "Database User: $dbUser\n";
echo "Database Password: $dbPass\n";
*/
